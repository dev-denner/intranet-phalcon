<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace DevDenners\Library\Auth;

use Phalcon\Mvc\User\Component;
use DevDenners\Library\Auth\Exception;
use Nucleo\Models\Users;
use Nucleo\Models\Tokens;
use Nucleo\Models\Logins;
use Nucleo\Models\UsersGroups;
use Nucleo\Models\Perfils;
use Nucleo\Models\RM\Pfunc;
use Nucleo\Models\Protheus\Colaboradores;

class Auth extends Component {

    /**
     *
     */
    public function initialize() {

    }

    /**
     *
     * @param type $credentials
     * @throws Exception
     */
    public function check($credentials) {

        $cpf = str_replace('-', '', $credentials['cpf']);
        $user = Users::findFirstByCpf($cpf);

        if ($user == false) {
            //$this->registerUserThrottling(null, 'F');
            throw new Exception('CPF não encontrado no sistema!!!');
        }

        if (!$this->security->checkHash($credentials['password'], $user->password)) {
            //$this->registerUserThrottling($user->id, 'T');
            $this->security->hash(rand());
            throw new Exception('Senha não confere ao cadastro!!! Se necessario clique no link \'ESQUECEU A SENHA?\' abaixo do painel de login.');
        }

        $this->checkUserFlags($user);
        //$this->saveSuccessLogin($user);

        if (isset($credentials['rememberMe'])) {
            $this->createRememberEnvironment($user);
        }

        $this->authUserById($user->id);
    }

    /**
     *
     * @param Users $user
     * @throws Exception
     */
    public function saveSuccessLogin(Users $user) {

        $logins = new Logins();
        $logins->SetId($logins->autoincrement());
        $logins->setUserId($user->id);
        $logins->setIpAddress($this->request->getClientAddress());
        $logins->setUserAgent($this->request->getUserAgent());
        $logins->setAttempted(time());
        $logins->setType('S');

        if (!$logins->save()) {
            $messages = $logins->getMessages();
            throw new Exception($messages[0]);
        }
    }

    /**
     *
     * @param type $userId
     * @param type $type
     */
    public function registerUserThrottling($userId, $type) {

        $logins = new Logins();
        $logins->SetId($logins->autoincrement());
        $logins->setUserId($userId);
        $logins->setIpAddress($this->request->getClientAddress());
        $logins->setUserAgent($this->request->getUserAgent());
        $logins->setAttempted(time());
        $logins->setType($type);

        $logins->save();

        $attempts = Logins::count([
                    "ipAddress = ?0 AND attempted BETWEEN ?1 - 50 AND ?1 AND (type = ?2 OR type = ?3)",
                    'bind' => [
                        $this->request->getClientAddress(),
                        time() - 3600 * 6,
                        'T', 'F'
        ]]);

        switch ($attempts) {
            case 1:
            case 2:
                break;
            case 3:
            case 4:
                sleep(2);
                break;
            default:
                sleep(4);
                break;
        }
    }

    /**
     *
     * @param Users $user
     */
    public function createRememberEnvironment(Users $user) {
        $userAgent = $this->request->getUserAgent();
        $token = md5($user->email . $user->password . $userAgent);

        $tokens = new Tokens();
        $tokens->setId($tokens->autoincrement());
        $tokens->setUsersId($user->id);
        $tokens->setToken($token);
        $tokens->setUserAgent($userAgent);

        if ($tokens->save() != false) {
            $expire = time() + 86400 * 8;

            $this->cookies->set('RMU', $user->id, $expire);
            $this->cookies->set('RMT', $token, $expire);
        }
    }

    /**
     *
     * @return type
     */
    public function hasRememberMe() {
        return $this->cookies->has('RMU');
    }

    /**
     *
     * @return type
     */
    public function loginWithRememberMe() {
        $userId = $this->cookies->get('RMU')->getValue();
        $cookieToken = $this->cookies->get('RMT')->getValue();

        $user = Users::findFirstById($userId);

        if ($user) {

            $userAgent = $this->request->getUserAgent();
            $token = md5($user->email . $user->password . $userAgent);

            if ($cookieToken == $token) {

                $remember = Tokens::findFirst([
                            'usersId = ?0 AND token = ?1',
                            'bind' => [
                                $user->id,
                                $token
                ]]);
                if ($remember) {
                    $this->checkUserFlags($user);
                    $this->authUserById($user->getId());
                    $this->saveSuccessLogin($user);

                    return $this->response->redirect('index');
                }
            }
        }

        $this->cookies->get('RMU')->delete();
        $this->cookies->get('RMT')->delete();

        return $this->response->redirect('nucleo/login');
    }

    /**
     *
     * @param Users $user
     * @throws Exception
     */
    public function checkUserFlags(Users $user) {
        if ($user->status == 'D') {
            throw new Exception('Este usuário está desativado');
        }

        if ($user->status == 'I') {
            throw new Exception('Este usuário está não foi ativado. Entre em contato com o suporte.');
        }
    }

    /**
     *
     * @return type
     */
    public function getIdentity() {
        return $this->session->get('auth-identity');
    }

    /**
     *
     * @return type
     */
    public function getName() {
        $identity = $this->session->get('auth-identity');
        return $identity['name'];
    }

    /**
     *
     */
    public function remove() {
        if ($this->cookies->has('RMU')) {
            $this->cookies->get('RMU')->delete();
        }
        if ($this->cookies->has('RMT')) {
            $this->cookies->get('RMT')->delete();
        }

        $this->session->remove('auth-identity');
    }

    /**
     *
     * @param type $id
     * @throws Exception
     */
    public function authUserById($id) {
        $user = Users::findFirstById($id);
        if ($user == false) {
            throw new Exception('The user does not exist');
        }

        $this->checkUserFlags($user);

        $userInfo['id'] = $user->id;
        $userInfo['cpf'] = $user->cpf;
        $userInfo['email'] = $user->email;
        $userInfo['userName'] = explode('@', $user->email)[0];
        $colaboradores = new Colaboradores();
        $colaborador = $colaboradores->getDadosFuncionario($user->cpf);

        $profile = [];
        $userGroups = UsersGroups::find('userId = ' . $user->id);

        if (count($userGroups) > 0) {
            foreach ($userGroups as $userGroup) {
                $perfils = Perfils::find('groupId = ' . $userGroup->groupId);
                if (count($perfils) > 0) {
                    foreach ($perfils as $perfil) {
                        $profile[$perfil->modules->name][$perfil->controllers->slug][$perfil->actions->slug] = $perfil->permission;
                    }
                }
            }
        }
        $perfils = Perfils::find('userId = ' . $user->id);
        if (count($perfils) > 0) {
            foreach ($perfils as $perfil) {
                $profile[$perfil->modules->name][$perfil->controllers->slug][$perfil->actions->slug] = $perfil->actions->permission;
            }
        }

        $this->session->set('auth-identity', [
            'userInfo' => $userInfo,
            'dadosERP' => $colaborador,
            'profile' => $profile
        ]);
    }

    /**
     *
     * @return boolean
     * @throws Exception
     */
    public function getUser() {
        $identity = $this->session->get('auth-identity');
        if (isset($identity['id'])) {

            $user = Users::findFirstById($identity['id']);
            if ($user == false) {
                throw new Exception('The user does not exist');
            }

            return $user;
        }

        return false;
    }

}

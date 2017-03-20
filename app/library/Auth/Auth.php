<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace App\Library\Auth;

use Phalcon\Mvc\User\Component;
use App\Library\Auth\Exception;
use App\Modules\Nucleo\Models\Mysql\RememberTokens;
use App\Modules\Nucleo\Models\Mysql\SuccessLogins;
use App\Modules\Nucleo\Models\Mysql\FailedLogins;
use App\Modules\Nucleo\Models\Users;
use App\Modules\Nucleo\Models\UsersGroups;
use App\Modules\Nucleo\Models\Perfils;
use App\Modules\Nucleo\Models\RM\Pfunc;
use App\Modules\Nucleo\Models\Protheus\Colaboradores;

class Auth extends Component
{

    /**
     * Checks the user credentials
     *
     * @param array $credentials
     * @return boolean
     * @throws Exception
     */
    public function check($credentials)
    {

        $cpf = str_replace('-', '', $credentials['cpf']);
        $user = Users::findFirstByCpf($cpf);

        $userName = explode('@', $user->email)[0];

        if ($user == false) {
            $this->registerUserThrottling($cpf);
            throw new Exception('CPF não encontrado no sistema!!!');
        }

        if (!$this->security->checkHash($credentials['password'], $user->password)) {
            $this->registerUserThrottling($userName);
            $this->security->hash(rand());
            throw new Exception('Senha não confere ao cadastro!!! Se necessario clique no link \'ESQUECEU A SENHA?\' abaixo do painel de login.');
        }

        $this->checkUserFlags($user);
        $this->saveSuccessLogin($userName);

        if (isset($credentials['rememberMe'])) {
            $this->createRememberEnvironment($user);
        }

        $this->authUserById($user->id);
    }

    /**
     * Creates the remember me environment settings the related cookies and generating tokens
     *
     * @param \Nucleo\Models\Users $user
     * @throws Exception
     */
    public function saveSuccessLogin($userName)
    {
        $this->session->set('auth', true);
        $successLogin = new SuccessLogins();
        $successLogin->usersName = $userName;
        $successLogin->ipAddress = $this->request->getClientAddress();
        $successLogin->userAgent = $this->request->getUserAgent();

        if (!$successLogin->save()) {
            $messages = $successLogin->getMessages();
            throw new Exception($messages[0]);
        }
    }

    /**
     * Implements login throttling
     * Reduces the effectiveness of brute force attacks
     *
     * @param int $userName
     */
    public function registerUserThrottling($userName)
    {
        $failedLogin = new FailedLogins();
        $failedLogin->usersName = $userName;
        $failedLogin->ipAddress = $this->request->getClientAddress();
        $failedLogin->attempted = time();
        $failedLogin->save();

        $attempts = FailedLogins::count([
                    'ipAddress = ?0 AND attempted >= ?1',
                    'bind' => [
                        $this->request->getClientAddress(),
                        time() - 3600 * 6
                    ]
        ]);

        switch ($attempts) {
            case 1:
            case 2:
                // no delay
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
     * Creates the remember me environment settings the related cookies and generating tokens
     *
     * @param \Nucleo\Models\Users $user
     */
    public function createRememberEnvironment(Users $user)
    {
        $userAgent = $this->request->getUserAgent();
        $token = md5($user->email . $user->password . $userAgent);

        $userName = explode('@', $user->email)[0];

        $remember = new RememberTokens();
        $remember->usersName = $userName;
        $remember->token = $token;
        $remember->userAgent = $userAgent;

        if ($remember->save() != false) {
            $expire = time() + 86400 * 8;
            $this->cookies->set('RMU', $user->id, $expire);
            $this->cookies->set('RMT', $token, $expire);
        }
    }

    /**
     *
     * @return type
     */
    public function hasRememberMe()
    {
        return $this->cookies->has('RMU');
    }

    /**
     * Logs on using the information in the cookies
     *
     * @return \Phalcon\Http\Response
     */
    public function loginWithRememberMe()
    {
        $userId = $this->cookies->get('RMU')->getValue();
        $cookieToken = $this->cookies->get('RMT')->getValue();

        $user = Users::findFirstById($userId);

        if ($user) {

            $userAgent = $this->request->getUserAgent();
            $token = md5($user->email . $user->password . $userAgent);

            if ($cookieToken == $token) {

                $userName = explode('@', $user->email)[0];

                $remember = RememberTokens::findFirst(array(
                            'usersName = ?0 AND token = ?1',
                            'bind' => [$userName, $token]
                ));

                if ($remember) {

                    // Check if the cookie has not expired
                    if ((time() - (86400 * 8)) < $remember->createdAt) {

                        // Check if the user was flagged
                        $this->checkUserFlags($user);

                        // Register identity
                        $this->authUserById($user->id);

                        // Register the successful login
                        $this->saveSuccessLogin($userName);

                        return $this->response->redirect();
                    }
                }
            }
        }

        $this->cookies->get('RMU')->delete();
        $this->cookies->get('RMT')->delete();

        return $this->response->redirect('login');
    }

    /**
     *
     * @param Users $user
     * @throws Exception
     */
    public function checkUserFlags(Users $user)
    {
        if ($user->status == 'D') {
            throw new Exception('Este usuário está desativado');
        }

        if ($user->status == 'I') {
            throw new Exception('Este usuário não foi ativado. Entre em contato com o suporte.');
        }
    }

    /**
     *
     * @return type
     */
    public function getIdentity()
    {
        return $this->session->get('auth-identity');
    }

    /**
     *
     * @return type
     */
    public function getName()
    {
        $identity = $this->session->get('auth-identity');
        return $identity['name'];
    }

    /**
     *
     */
    public function remove()
    {
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
    public function authUserById($id)
    {
        $user = Users::findFirstById($id);
        if ($user == false) {
            throw new Exception('Este usuário não existe.');
        }

        $this->checkUserFlags($user);

        $userInfo['id'] = $user->id;
        $userInfo['cpf'] = $user->cpf;
        $userInfo['email'] = $user->email;
        $userInfo['userName'] = explode('@', $user->email)[0];
        $colaboradores = new Colaboradores();
        $colaborador = $colaboradores->getDadosFuncionario($user->cpf);

        $funcionarios = new Pfunc();
        $funcionario = $funcionarios->getDadosFuncionario($colaborador['CPF'], $colaborador['CHAPA']);

        $infoColaborador = $colaborador;

        if ($funcionario) {
            $infoColaborador = array_merge($colaborador, $funcionario);
        }

        $profile = [];
        $userGroups = UsersGroups::find('userId = ' . $user->id);

        if (count($userGroups) > 0) {
            foreach ($userGroups as $userGroup) {
                $perfils = Perfils::find('groupId = ' . $userGroup->groupId);
                if (count($perfils) > 0) {
                    foreach ($perfils as $perfil) {
                        $profile[$perfil->modules->slug][$perfil->controllers->slug][$perfil->actions->slug] = $perfil->permission;
                    }
                }
            }
        }
        $perfils = Perfils::find('userId = ' . $user->id);
        if (count($perfils) > 0) {
            foreach ($perfils as $perfil) {
                $profile[$perfil->modules->slug][$perfil->controllers->slug][$perfil->actions->slug] = $perfil->actions->permission;
            }
        }

        $this->session->set('auth-identity', [
            'userInfo' => $userInfo,
            'dadosERP' => $infoColaborador,
            'profile' => $profile
        ]);
    }

    /**
     *
     * @return boolean
     * @throws Exception
     */
    public function getUser()
    {
        $identity = $this->session->get('auth-identity');
        if (isset($identity['userInfo']['id'])) {
            $user = Users::findFirstById($identity['userInfo']['id']);
            if ($user == false) {
                throw new Exception('Este usuário não existe');
            }

            return $user;
        }

        return false;
    }

}

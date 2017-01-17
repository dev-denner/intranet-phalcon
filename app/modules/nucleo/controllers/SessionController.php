<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Nucleo\Controllers;

use App\Modules\Nucleo\Models\Users;
use App\Modules\Nucleo\Models\Mysql\ResetPasswords;
use App\Modules\Nucleo\Models\Mysql\PasswordChanges;
use App\Modules\Nucleo\Models\Protheus\Colaboradores;
use App\Modules\Nucleo\Models\UsersGroups;
use App\Shared\Controllers\ControllerBase;

class SessionController extends ControllerBase
{

    /**
     *
     */
    public function initialize()
    {
        $this->tag->setTitle(' Login ');
        parent::initialize();
        $this->view->setTemplateBefore('public');
    }

    /**
     *
     * @return type
     */
    public function indexAction()
    {
        try {

            if ($this->auth->hasRememberMe()) {
                return $this->auth->loginWithRememberMe();
            }
            $this->assets->collection('footerJs')->addJs('app/nucleo/session/register.js');
            $colaboradores = new Colaboradores();
            $this->view->empresas = $colaboradores->getEmpresas();
            $this->view->keyToken = $this->security->getTokenKey();
            $this->view->valueToken = $this->security->getToken();
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

    /**
     *
     * @return type
     * @throws Exception
     */
    public function logonAction()
    {

        try {
            if ($this->request->isPost()) {
                //if ($this->security->checkToken()) {

                if ($this->validation()) {

                    $this->auth->check([
                        'cpf' => $this->request->getPost('cpf', 'alphanum'),
                        'password' => $this->request->getPost('password'),
                        'rememberMe' => $this->request->getPost('rememberMe')
                    ]);

                    $user = $this->auth->getUser();

                    if ($user->mustChangePassword == 'S') {
                        $msg = 'Este é seu primeiro acesso ao sistema, ou foi solicitado a mudança de sua senha pelo Administrador.<br>Por favor, redefina sua senha.';
                        $this->flash->notice($msg);
                        return $this->response->redirect('change-password');
                    }

                    return $this->response->redirect();
                }
                /* } else {
                  $this->security->hash(rand());
                  throw new Exception('Chave CSRF inválida.');
                  } */
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
        return $this->response->redirect('login');
    }

    /**
     *
     * @return type
     * @throws Exception
     */
    public function registerAction()
    {

        try {
            if (!$this->request->isPost()) {
                return $this->response->redirect('login');
            } else {
                // if ($this->security->checkToken()) {

                if ($this->validation()) {

                    if ($this->makeRegister()) {
                        $this->flash->success('Cadastro realizado com sucesso.');
                    }
                }
                /* } else {
                  $this->security->hash(rand());
                  throw new Exception('Chave CSRF inválida.');
                  } */
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }

        return $this->response->redirect('login');
    }

    /**
     * Shows the forgot password form
     */
    public function forgotPasswordAction()
    {

        try {
            if ($this->request->isPost()) {
                //if ($this->security->checkToken()) {
                if ($this->validation()) {
                    $user = Users::findFirstByEmail($this->request->getPost('email', 'email'));
                    if (!$user) {
                        throw new Exception('Não há nenhuma conta associada a este e-mail');
                    } else {
                        $resetPassword = new ResetPasswords();
                        $userName = explode('@', $user->email)[0];
                        $resetPassword->usersName = $userName;
                        if ($resetPassword->save()) {
                            $this->flash->success('Sucesso! Por favor verifique suas mensagens de e-mail para redefinir sua senha.');
                        } else {
                            foreach ($resetPassword->getMessages() as $message) {
                                $msg = '';
                                foreach ($resetPassword->getMessages() as $message) {
                                    $msg .= $message . '<br>';
                                }
                                throw new Exception($msg);
                            }
                        }
                    }
                }
                /* } else {
                  $this->security->hash(rand());
                  throw new Exception('Chave CSRF inválida.');
                  } */
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
        return $this->response->redirect('login');
    }

    /**
     *
     * @return type
     */
    public function logoutAction()
    {

        $this->auth->remove();
        $this->session->destroy();
        session_unset();
        session_write_close();
        setcookie(session_name(), '', 0, '/');
        session_regenerate_id(true);

        return $this->response->redirect('login');
    }

    /**
     *
     * @return boolean
     * @throws Exception
     */
    private function validation()
    {

        $cpf = $this->request->getPost('cpf', 'alphanum');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirmPassword');
        $email = $this->request->getPost('email', 'email');
        $dataAdmissao = $this->request->getPost('dataAdmissao', 'string');
        $empresa = $this->request->getPost('empresa');

        $msg = '';
        $validator = $this->validator;

        if (!is_null($cpf)) {
            if (!$validator::stringType()->notEmpty()->validate($cpf)) {
                $msg .= 'Por favor preencha o campo CPF.<br>';
            }
        }
        if (!is_null($password)) {
            if (!$validator::stringType()->notEmpty()->validate($password)) {
                $msg .= 'Por favor preencha o campo Senha.<br>';
            }
        }
        if (!is_null($confirmPassword)) {
            if (!$validator::stringType()->notEmpty()->validate($confirmPassword)) {
                $msg .= 'Por favor preencha o campo Confirme sua Senha.<br>';
            }
            if (!$validator::equals($password)->validate($confirmPassword)) {
                $msg .= 'As senhas não conferem.<br>';
            }
        }
        if (!is_null($email)) {
            if (!$validator::stringType()->notEmpty()->validate($email)) {
                $msg .= 'Por favor preencha o campo E-mail.<br>';
            }
            if (!$validator::email()->validate($email)) {
                $msg .= 'E-mail não é válido.<br>';
            }
        }
        if (!is_null($dataAdmissao)) {
            if (!$validator::stringType()->notEmpty()->validate($dataAdmissao)) {
                $msg .= 'Por favor preencha o campo Data de Admissão.<br>';
            }
            if (!$validator::date('d/m/Y')->validate($dataAdmissao)) {
                $msg .= 'Por favor insira Data de Admissão no formato dd/mm/aaaa<br>';
            }
        }
        if (!is_null($empresa)) {
            if (!$validator::stringType()->notEmpty()->validate($empresa)) {
                $msg .= 'Por favor escolha uma opção do campo Empresa.<br>';
            }
        }
        if (!empty($msg)) {
            throw new Exception($msg);
        }
        return true;
    }

    /**
     *
     * @return boolean
     * @throws Exception
     */
    private function makeRegister()
    {

        $cpf = $this->request->getPost('cpf', 'alphanum');
        $dataAdmissao = $this->request->getPost('dataAdmissao');
        $empresa = $this->request->getPost('empresa', 'alphanum');

        $colaboradores = new Colaboradores();
        $funcionarioProtheus = $colaboradores->validaDadosFuncionario($cpf, $empresa, $dataAdmissao);

        if (empty($funcionarioProtheus)) {
            throw new Exception('Não foi encontrado esse CPF na base de dados. Verifique sua Data de Admissão ou Empresa e tente novamente.');
        }

        $user = new Users();

        $user->setId($user->autoincrement());
        $user->setName($funcionarioProtheus['NOME']);
        $user->setCpf($cpf);
        $email = $this->request->getPost('email', 'email');
        $user->setEmail($email);
        $user->setUserName(explode('@', $email)[0]);
        $user->setPassword($this->security->hash($this->request->getPost('password')));
        $user->setMustChangePassword('N');
        $user->setStatus('A');

        if (!$user->create()) {
            $msg = '';
            foreach ($user->getMessages() as $message) {
                $msg .= $message . '<br>';
            }
            throw new Exception($msg);
        }

        $userGroup = new UsersGroups();
        $userGroup->setId($userGroup->autoincrement());
        $userGroup->setUserId($user->getId());
        $userGroup->setGroupId(3);

        if (!$userGroup->save()) {
            $msg = '';
            foreach ($userGroup->getMessages() as $message) {
                $msg .= $message . '<br>';
            }
            throw new Exception($msg);
        }

        return true;
    }

    /**
     *
     * @return type
     * @throws Exception
     */
    public function resetPasswordAction()
    {

        try {

            $code = $this->dispatcher->getParam('code');

            $resetPassword = ResetPasswords::findFirstByCode($code);

            if (!$resetPassword) {
                throw new Exception('Não foi possível encontrar o código.');
            }

            if ($resetPassword->reset != 'N') {
                throw new Exception('Código expirado.');
            }

            $resetPassword->reset = 'Y';

            if (!$resetPassword->save()) {
                $msg = '';
                foreach ($resetPassword->getMessages() as $message) {
                    $msg .= $message . '<br>';
                }
                throw new Exception($msg);
            }

            $user = Users::findFirst([
                          'userName = ?0',
                          'bind' => [$resetPassword->usersName]
            ]);

            $this->auth->authUserById($user->id);
            $this->flash->notice('Por favor, redefina sua senha.');
            return $this->response->redirect('change-password');
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
        return $this->response->redirect('login');
    }

    /**
     *
     * @return type
     * @throws Exception
     */
    public function changePasswordAction()
    {

        try {
            $user = $this->auth->getUser();

            if (!$user) {
                throw new Exception('Acesso inválido.');
            }
            if ($this->request->isPost()) {
                if ($this->security->checkToken()) {
                    if ($this->validation()) {
                        $user->password = $this->security->hash($this->request->getPost('password'));
                        $user->mustChangePassword = 'N';
                        if (!$user->update()) {
                            $msg = '';
                            foreach ($user->getMessages() as $message) {
                                $msg .= $message . '<br>';
                            }
                            throw new Exception($msg);
                        } else {
                            $passwordChange = new PasswordChanges();
                            $passwordChange->usersName = $user->userName;
                            $passwordChange->ipAddress = $this->request->getClientAddress();
                            $passwordChange->userAgent = $this->request->getUserAgent();

                            if (!$passwordChange->save()) {
                                $msg = '';
                                foreach ($passwordChange->getMessages() as $message) {
                                    $msg .= $message . '<br>';
                                }
                                throw new Exception($msg);
                            } else {

                                $this->flash->success('Sua senha foi alterada com sucesso');
                            }
                        }
                    }
                } else {
                    $this->security->hash(rand());
                    throw new Exception('Chave CSRF inválida.');
                }
                return $this->response->redirect();
            }
            $this->view->name = $user->name;
            $this->view->keyToken = $this->security->getTokenKey();
            $this->view->valueToken = $this->security->getToken();
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
            return $this->response->redirect('login');
        }
    }

}

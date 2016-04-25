<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Controllers;

use DevDenners\Library\Auth\Exception as AuthException;
use Nucleo\Controllers\UsersController;
use Nucleo\Forms\UsersForm;
use Nucleo\Models\Users;
use Nucleo\Models\ResetPasswords;
use Nucleo\Models\RM\Pfunc;
use Nucleo\Models\Protheus\Colaboradores;
use Nucleo\Models\UsersGroups;
use DevDenners\Controllers\ControllerBase;

class SessionController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle(' Login ');
        parent::initialize();
        $this->view->setTemplateBefore('public');
    }

    public function indexAction() {
        try {
            if ($this->auth->hasRememberMe()) {
                return $this->auth->loginWithRememberMe();
            }
            $this->assets->collection('footerJs')->addJs('app/nucleo/session/register.js');
            $colaboradores = new Colaboradores();
            $this->view->empresas = $colaboradores->getEmpresas();
            $this->view->keyToken = $this->security->getTokenKey();
            $this->view->valueToken = $this->security->getToken();
        } catch (Exception $exc) {
            $this->flash->error($e->getMessage());
        }
    }

    public function logonAction() {

        try {
            if ($this->request->isPost()) {
                //if ($this->security->checkToken()) {
                $form = [
                    'type' => 'login',
                    'title' => false
                ];
                $user = new Users();

                /* $formUsers = new UsersForm($user, $form);

                  if ($formUsers->isValid($this->request->getPost()) == false) {
                  $msg = '';
                  foreach ($formUsers->getMessages() as $message) {
                  $msg .= $message . '<br />';
                  }
                  throw new Exception($msg);
                  } else { */
                $this->auth->check([
                    'cpf' => $this->request->getPost('cpf', 'alphanum'),
                    'password' => $this->request->getPost('password'),
                    'rememberMe' => $this->request->getPost('rememberMe')
                ]);

                return $this->response->redirect('/');
                //}
                /* } else {
                  $this->security->hash(rand());
                  throw new Exception('Chave CSRF inválida.');
                  } */
            }
        } catch (AuthException $e) {
            $this->flash->error($e->getMessage());
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        return $this->response->redirect('login');
    }

    public function registerAction() {

        try {
            if (!$this->request->isPost()) {
                return $this->response->redirect('login');
            } else {
                //if ($this->security->checkToken()) {

                $form = [
                    'type' => 'login',
                    'title' => false
                ];
                $user = new Users();
                /* $formUsers = new UsersForm($user, $form);

                  if ($formUsers->isValid($this->request->getPost()) == false) {
                  $msg = '';
                  foreach ($formUsers->getMessages() as $message) {
                  $msg .= $message . '<br />';
                  }
                  throw new Exception($msg);
                  } else { */

                if ($this->makeRegister()) {
                    $this->flash->success('Cadastro realizado com sucesso.');
                }
                //}
                /* } else {
                  $this->security->hash(rand());
                  throw new Exception('Chave CSRF inválida.');
                  } */
            }
        } catch (AuthException $e) {
            $this->flash->error($e->getMessage());
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }

        return $this->response->redirect('login');
    }

    public function forgotPasswordAction() {

        try {
            if ($this->request->isPost()) {
                //if ($this->security->checkToken()) {
                /* $form = [
                  'type' => 'forgot',
                  'title' => false
                  ]; */
                $users = new Users();
                /* $formUsers = new UsersForm($users, $form);

                  if ($formUsers->isValid($this->request->getPost()) == false) {
                  $msg = '';
                  foreach ($formUsers->getMessages() as $message) {
                  $msg .= $message . '<br>';
                  }
                  throw new Exception($msg);
                  } else { */
                $user = Users::findFirstByEmail($this->request->getPost('email'));
                if (!$user) {
                    throw new Exception('Não há nenhuma conta associada a este e-mail');
                } else {
                    $resetPassword = new ResetPasswords();
                    $resetPassword->id = $resetPassword->autoincrement();
                    $resetPassword->usersId = $user->id;
                    if ($resetPassword->save()) {
                        $this->flash->success('Sucesso! Por favor verifique suas mensagens de e-mail para uma redefinir sua senha.');
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
                //}
                /* } else {
                  $this->security->hash(rand());
                  throw new Exception('Chave CSRF inválida.');
                  } */
            }
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        return $this->response->redirect('login');
    }

    public function logoutAction() {
        $this->auth->remove();
        $this->session->destroy();

        return $this->response->redirect('login');
    }

    /**
     *
     * @return boolean
     * @throws Exception
     */
    public function makeRegister() {

        $cpf = str_replace('-', '', $this->request->getPost('cpf', 'int'));
        $dataAdmissao = $this->request->getPost('dataAdmissao');
        $empresa = $this->request->getPost('empresa', 'int');

        $colaboradores = new Colaboradores();
        $funcionarioProtheus = $colaboradores->validaDadosFuncionario($cpf, $empresa, $dataAdmissao);

        if (empty($funcionarioProtheus)) {
            throw new Exception('Não foi encontrado esse CPF na base de dados.');
        }

        $user = new Users();

        $user->setId($user->autoincrement());
        $user->setCpf($cpf);
        $user->setEmail($this->request->getPost('email', 'email'));
        $user->setPassword($this->security->hash($this->request->getPost('password')));
        $user->setMustChangePassword('S');
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
     */
    public function confirmEmailAction() {
        $code = $this->dispatcher->getParam('code');

        $confirmation = EmailConfirmations::findFirstByCode($code);

        if (!$confirmation) {
            return $this->response->redirect('nucleo/login');
        }

        if ($confirmation->confirmed != 'N') {
            return $this->response->redirect('nucleo/login');
        }

        $confirmation->confirmed = 'Y';

        $confirmation->user->status = 'Y';


        if (!$confirmation->save()) {

            foreach ($confirmation->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        'controller' => 'index',
                        'action' => 'index'
            ));
        }

        /**
         * Identify the user in the application
         */
        $this->auth->authUserById($confirmation->user->id);

        /**
         * Check if the user must change his/her password
         */
        if ($confirmation->user->mustChangePassword == 'Y') {

            $this->flash->success('The email was successfully confirmed. Now you must change your password');

            return $this->dispatcher->forward(array(
                        'controller' => 'users',
                        'action' => 'changePassword'
            ));
        }

        $this->flash->success('The email was successfully confirmed');

        return $this->dispatcher->forward(array(
                    'controller' => 'users',
                    'action' => 'index'
        ));
    }

    /**
     *
     * @return type
     * @throws Exception
     */
    public function resetPasswordAction() {
        $code = $this->dispatcher->getParam('code');

        $resetPassword = ResetPasswords::findFirstByCode($code);

        if (!$resetPassword) {
            $this->flash->error('Não foi possível encontrar o codigo.');
            return $this->response->redirect('login');
        }

        if ($resetPassword->reset != 'N') {
            return $this->response->redirect('login');
        }

        $resetPassword->reset = 'Y';

        if (!$resetPassword->save()) {
            $msg = '';
            foreach ($resetPassword->getMessages() as $message) {
                $msg .= $message . '<br>';
            }
            throw new Exception($msg);

            return $this->response->redirect('login');
        }
        $this->auth->authUserById($resetPassword->usersId);
        $this->flash->success('Por favor, redefina sua senha');
        return $this->response->redirect('change-password');
    }

    /**
     *
     * @throws Exception
     */
    public function changePasswordAction() {
        try {
            $form = [
                'type' => 'password',
                'title' => false,
                'action' => 'change-password'
            ];

            $user = $this->entity;
            $userForm = new UsersForm($user, $form);

            if ($this->request->isPost()) {
                if ($this->security->checkToken()) {

                    if (!$userForm->isValid($this->request->getPost())) {

                        $msg = '';
                        foreach ($userForm->getMessages() as $message) {
                            $msg .= $message . '<br>';
                        }
                        throw new Exception($msg);
                    } else {

                        $user = $this->auth->getUser();

                        $user->password = $this->security->hash($this->request->getPost('password'));
                        $user->mustChangePassword = 'N';

                        $passwordChange = new PasswordChanges();
                        $passwordChange->user = $user;
                        $passwordChange->ipAddress = $this->request->getClientAddress();
                        $passwordChange->userAgent = $this->request->getUserAgent();

                        if (!$passwordChange->save()) {
                            $this->flash->error($passwordChange->getMessages());
                        } else {

                            $this->flash->success('Your password was successfully changed');

                            Tag::resetInput();
                        }
                    }
                } else {
                    $this->security->hash(rand());
                    throw new Exception('Chave CSRF inválida.');
                }
            }

            $this->view->form = $userForm;
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

}

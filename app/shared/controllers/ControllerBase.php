<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace SysPhalcon\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\DI\FactoryDefault as Di;
use Phalcon\Mvc\Dispatcher as Dispatcher;
use Phalcon\Config as ObjectPhalcon;
use Noherczeg\Breadcrumb\Breadcrumb;

class ControllerBase extends Controller {

    /**
     *
     * @var type
     */
    protected $uri = '';

    /**
     *
     * @var type
     */
    protected $bc = '';

    /**
     *
     * @var type
     */
    protected $entity;

    /**
     *
     */
    public function initialize() {

        $di = $this->di->get('config');
        $this->uri = $di->application->baseUri;

        $this->tag->prependTitle('Intranet :: ');
        $this->tag->appendTitle(' :: Grupo MPE');

        $moduleName = $this->dispatcher->getModuleName();
        $controllerName = $this->dispatcher->getControllerName();
        $actionName = $this->dispatcher->getActionName();

        $this->view->pick([$moduleName . '/' . $controllerName . '/' . $actionName, $moduleName . '/' . $controllerName]);

        $this->view->setTemplateBefore('main');
        $this->view->titleLogo = 'Grupo MPE';

        $this->breadcrumb($moduleName, $controllerName, $actionName);
        $this->view->breadcrumb = $this->bc;


        $auth_identity = $this->auth_identity();
        $this->view->icon_identity = $auth_identity->sexo == 'F' ? 'female' : 'male';
        $this->view->auth_identity = $auth_identity;
    }

    /**
     *
     * @return ObjectPhalcon
     */
    private function auth_identity() {
        $return = [];
        if (!empty($this->session->get('auth-identity'))) {
            $auth_identity = new ObjectPhalcon($this->session->get('auth-identity'));
            if (!empty($auth_identity->dadosERP)) {
                $return['nome'] = ucwords(strtolower($auth_identity->dadosERP->NOME));
                $return['empresa'] = $auth_identity->dadosERP->EMPRESA;
                $return['cpf'] = $auth_identity->dadosERP->CPF;
                $return['emailCorporativo'] = $auth_identity->dadosERP->EMAIL;
                $return['dataAdmissao'] = $auth_identity->dadosERP->DATAADMISSAO;
                $return['codSituacao'] = $auth_identity->dadosERP->SITUACAO;
                $return['cceo'] = $auth_identity->dadosERP->CCEO;
                $return['codSecao'] = $auth_identity->dadosERP->CODSECAO;

                $return['pessoa'] = $auth_identity->dadosERP->PESSOA;
                $return['emailPessoal'] = $auth_identity->dadosERP->EMAILPESSOAL;
                $return['cnpj'] = $auth_identity->dadosERP->CNPJ;
                $return['situacao'] = $auth_identity->dadosERP->SITUACAO;
                $return['dataDemissao'] = $auth_identity->dadosERP->DATADEMISSAO;
                $return['motivoDemissao'] = $auth_identity->dadosERP->MOTIVODEMISSAO;
                $return['ramal'] = $auth_identity->dadosERP->RAMAL;
                $return['coligada'] = $auth_identity->dadosERP->COLIGADA;
                $return['chapa'] = $auth_identity->dadosERP->CHAPA;
                $return['funcao'] = $auth_identity->dadosERP->FUNCAO;
                $return['secao'] = $auth_identity->dadosERP->SECAO;
                $return['codTipoFuncionario'] = $auth_identity->dadosERP->CODTIPOFUNC;
                $return['descSituacao'] = $auth_identity->dadosERP->DESCSITUACAO;
                $return['dataNascimento'] = $auth_identity->dadosERP->DATANASCIMENTO;
                $return['sexo'] = $auth_identity->dadosERP->SEXO;
                $return['tipoFuncionario'] = $auth_identity->dadosERP->TIPOFUNC;
            }
            $return['userId'] = $auth_identity->userInfo->id;
            $return['userCpf'] = $auth_identity->userInfo->cpf;
            $return['email'] = $auth_identity->userInfo->email;
            $return['userName'] = $auth_identity->userInfo->userName;
        }
        return new ObjectPhalcon($return);
    }

    /**
     *
     * @param type $moduleName
     * @param type $controllerName
     * @param type $actionName
     */
    private function breadcrumb($moduleName, $controllerName, $actionName) {

        $this->breadcrumbs->setTemplate(
                '<li><a href="{{link}}">{{icon}}{{label}}</a></li>', // linked
                '<li class="active">{{icon}}{{label}}</li>', // not linked
                '<i class="fa fa-home"></i> ' // first icon
        );

        $this->breadcrumbs->setSeparator('');

        if ($controllerName == 'index' && $actionName == 'index') {
            $this->breadcrumbs->add($moduleName, null, ['linked' => false]);
        } else {
            $this->breadcrumbs->add($moduleName, $moduleName);
        }
        if ($controllerName != 'index') {
            if ($actionName == 'index') {
                $this->breadcrumbs->add($controllerName, null, ['linked' => false]);
            } else {
                $this->breadcrumbs->add($controllerName, $controllerName);
            }
        }
        if ($actionName != 'index') {
            $this->breadcrumbs->add($actionName, null, ['linked' => false]);
        }
    }

    /**
     *
     * @param Dispatcher $dispatcher
     */
    public function beforeExecuteRoute(Dispatcher $dispatcher) {

        try {

            $identity = $this->auth->getIdentity();

            $moduleCurrent = $dispatcher->getModuleName();
            $controllerCurrent = $dispatcher->getControllerName();
            $actionCurrent = $dispatcher->getActionName();

            if (is_null($identity)) {
                if (!$this->access->isAllowed('public', $moduleCurrent, $controllerCurrent, $actionCurrent)) {
                    if ($moduleCurrent . $controllerCurrent . $actionCurrent == 'intranetindexindex') {
                        return $this->response->redirect('login');
                    }
                    throw new Exception('Sua sessão foi finalizada.');
                }
            } else {
                if (!$this->access->isAllowed('public', $moduleCurrent, $controllerCurrent, $actionCurrent)) {
                    if (!$this->access->isAllowed('private', $moduleCurrent, $controllerCurrent, $actionCurrent)) {
                        if ($this->access->isAllowed('private', $moduleCurrent, $controllerCurrent, 'index')) {
                            $this->flash->error('Você não tem acesso a ' . $moduleCurrent . '/' . $controllerCurrent . '/' . $actionCurrent);
                            $this->response->redirect($moduleCurrent . '/' . $controllerCurrent . '/index');
                        } else {
                            if ($this->access->isAllowed('private', 'intranet', 'index', 'index')) {
                                $this->flash->error('Você não tem acesso a ' . $moduleCurrent . '/' . $controllerCurrent);
                                return $this->response->redirect('/');
                            } else {
                                throw new Exception('Sua sessão foi finalizada.');
                            }
                        }
                    }
                }
            }
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
            $this->response->redirect('login');
        }
    }

    /**
     *
     * @return type
     */
    protected function getAllModules() {
        $dirs = scandir(APP_PATH . '/app/modules/');
        $modules = [];
        foreach ($dirs as $dir) {
            if ($dir != '.' && $dir != '..')
                $modules[] = $dir;
        }
        return $modules;
    }

    /**
     *
     * @param type $module
     * @return type
     */
    protected function getAllControllers($module) {
        $files = scandir(APP_PATH . '/app/modules/' . $module . '/controllers');
        $controllers = [];
        foreach ($files as $file) {
            if ($controller = $this->extractController($file)) {
                $controllers[] = $controller;
            }
        }
        return $controllers;
    }

    /**
     *
     * @param type $controller
     * @return type
     */
    protected function getAllActs($controller) {
        $class = $controller . 'Controller';
        $functions = get_class_methods($class);
        $actions = [];
        foreach ($functions as $name) {
            $actions[] = $this->extractAct($name);
        }
        return array_filter($actions);
    }

    /**
     *
     * @param type $name
     * @return type
     */
    private function extractAct($name) {
        $action = explode('Action', $name);
        if ((count($action) > 1)) {
            return $action[0];
        }
    }

    /**
     *
     * @param type $name
     * @return boolean
     */
    private function extractController($name) {
        $filename = explode('Controller.php', $name);
        if (count($filename) > 1) {
            return $filename[0];
        }
        return false;
    }

}

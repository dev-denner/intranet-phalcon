<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Shared\Controllers;

use App\Modules\Nucleo\Models\Mysql\Clicks;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher as Dispatcher;
use Phalcon\Config as ObjectPhalcon;

class ControllerBase extends Controller
{

    /**
     *
     * @var type
     */
    protected $uri = '';

    /**
     *
     * @var type
     */
    protected $entity;

    /**
     *
     * @var type
     */
    protected $auth_identity;

    /**
     *
     */
    public function initialize()
    {

        $this->uri = $this->url->getBaseUri();

        $this->tag->prependTitle('Intranet :: ');
        $this->tag->appendTitle(' :: Grupo MPE');

        $moduleName = $this->dispatcher->getModuleName();
        $controllerName = $this->dispatcher->getControllerName();
        $actionName = $this->dispatcher->getActionName();

        $this->view->pick([$moduleName . '/' . $controllerName . '/' . $actionName, $moduleName . '/' . $controllerName]);

        $this->view->setTemplateBefore('main');
        $this->view->titleLogo = 'Grupo MPE';


        $this->auth_identity = $this->auth_identity();

        $this->breadcrumb($moduleName, $controllerName, $actionName); //componente
        if ($this->session->has('auth-identity')) {
            $this->view->icon_identity = $this->auth_identity->sexo == 'F' ? 'female' : 'male'; //componente
            $this->view->auth_identity = $this->auth_identity; //componente
            $this->view->logo = $this->auth_identity->empresa; //componente
        }
        $this->clicksPerPage($moduleName, $controllerName, $actionName);
    }

    /**
     *
     * @return ObjectPhalcon
     */
    private function auth_identity()
    {
        $return = [];
        if ($this->session->has('auth-identity')) {
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
                $return['contrato'] = $this->getContract($auth_identity->dadosERP->CCEO);
            }
            $return['userId'] = $auth_identity->userInfo->id;
            $return['userCpf'] = $auth_identity->userInfo->cpf;
            $return['email'] = $auth_identity->userInfo->email;
            $return['userName'] = $auth_identity->userInfo->userName;
        }
        return (object) $return;
    }

    /**
     *
     * @param type $contract
     * @return type
     */
    private function getContract($contract)
    {

        if (substr($contract, 0, 1) == '1') {
            return substr($contract, 0, 7);
        } else {
            return substr($contract, 0, 4);
        }
    }

    /**
     *
     * @param type $moduleName
     * @param type $controllerName
     * @param type $actionName
     */
    private function breadcrumb($moduleName, $controllerName, $actionName)
    {

        $this->breadcrumbs->setSeparator('');

        if ($controllerName == 'index' && $actionName == 'index') {
            $this->breadcrumbs->add($moduleName, null, ['linked' => false]);
        } else {
            $this->breadcrumbs->add($moduleName, $this->uri . $moduleName);
        }
        if ($controllerName != 'index') {
            if ($actionName == 'index') {
                $this->breadcrumbs->add($controllerName, null, ['linked' => false]);
            } else {
                $this->breadcrumbs->add($controllerName, $this->uri . $moduleName . '/' . $controllerName);
            }
        }
        if ($actionName != 'index') {
            $this->breadcrumbs->add($actionName, null, ['linked' => false]);
        }
        $this->breadcrumbs->setTemplate(
                  '<li><a href="{{link}}">{{icon}}{{label}}</a></li>', // linked
                  '<li class="active">{{icon}}{{label}}</li>', // not linked
                  '<i class="fa fa-home"></i> ' // first icon
        );
    }

    /**
     *
     * @param Dispatcher $dispatcher
     */
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {

        try {
            $moduleCurrent = $dispatcher->getModuleName();
            $controllerCurrent = $dispatcher->getControllerName();
            $actionCurrent = $dispatcher->getActionName();

            if (!$this->session->has('auth')) {

                if (!$this->access->isAllowed('public', $moduleCurrent, $controllerCurrent, $actionCurrent)) {
                    if ($moduleCurrent . $controllerCurrent . $actionCurrent == 'intranetindexindex') {
                        $this->response->redirect('login/logout');
                        return false;
                    }
                    throw new \Exception('Sua sessão foi finalizada.');
                }
            } else {
                if (!$this->access->isAllowed('public', $moduleCurrent, $controllerCurrent, $actionCurrent)) {
                    if (!$this->access->isAllowed('private', $moduleCurrent, $controllerCurrent, $actionCurrent)) {
                        if ($this->access->isAllowed('private', $moduleCurrent, $controllerCurrent, 'index')) {
                            $this->flash->error('Você não tem acesso a ' . $moduleCurrent . '/' . $controllerCurrent . '/' . $actionCurrent);
                            $this->response->redirect('forbidden');
                            return false;
                        } else {
                            if ($this->access->isAllowed('private', 'intranet', 'index', 'index')) {
                                $this->flash->error('Você não tem acesso a ' . $moduleCurrent . '/' . $controllerCurrent);
                                $this->response->redirect('forbidden');
                                return false;
                            } else {
                                throw new \Exception('Sua sessão foi finalizada.');
                            }
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
            $this->response->redirect('login/logout');
            return false;
        }
        return true;
    }

    /**
     *
     * @param type $moduleName
     * @param type $controllerName
     * @param type $actionName
     * @return type
     */
    private function clicksPerPage($moduleName, $controllerName, $actionName)
    {
        $identity = $this->auth->getIdentity();

        $click = new Clicks();
        if (!is_null($identity)) {
            $click->usersName = $identity['userInfo']['userName'];
        } else {
            $click->usersName = $this->request->getClientAddress();
        }
        $click->uri = $moduleName . '/' . $controllerName . '/' . $actionName;
        $click->dataAccess = date('Y-m-d h:i:s');
        return $click->save();
    }

    /**
     *
     * @param type $object
     */
    protected function makeGetObject($object)
    {

        foreach ($object->toArray() as $key => $value) {

            $name = 'get' . ucfirst($key);
            $this->tag->setDefault($key, $object->$name());
        }
    }

    /**
     *
     * @param type $request
     * @param type $object
     */
    protected function makeSetObject($request, $object)
    {

        foreach ($request as $key => $value) {
            $name = 'set' . ucfirst($key);
            $object->$name($value);
        }
    }

    protected function hidrateRequest($request)
    {

        $return = [];

        foreach ($request as $key => $value) {
            $return[$key] = $this->strToReal($value, '.', '');
            $return[$key] = $this->strToReal($return[$key]);
        }
        return $return;
    }

    /**
     *
     * @param type $request
     * @param type $search
     * @param type $replace
     * @return type
     */
    protected function strToReal($value, $search = ',', $replace = '.')
    {
        if (!$this->isRealString($value)) {
            return str_replace($search, $replace, $value);
        } else {
            return $value;
        }
    }

    /**
     *
     * @param type $string
     * @return boolean
     */
    protected function isRealString($string = '')
    {

        if (empty($string)) {
            return false;
        }
        $space = explode(' ', $string);
        if (isset($space[1])) {
            return true;
        }
        $dot = explode('.', $string);
        if (isset($dot[1])) {
            if (ereg('[^0-9]', substr($dot[0], -1, 1)) or ereg('[^0-9]', substr($dot[1], 0, 1))) {
                return true;
            }
        }
        return false;
    }

    /**
     *
     * @param type $messages
     * @return string
     */
    protected function getMessage($messages)
    {
        $return = '';
        foreach ($messages as $message) {
            $return .= $message . '<br />';
        }
        return $return;
    }

    /**
     *
     * @param type $files
     * @return type
     */
    protected function eraseFiles($files)
    {
        foreach ($files as $file) {
            unlink($file);
        }
        return;
    }

}

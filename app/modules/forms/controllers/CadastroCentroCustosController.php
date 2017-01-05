<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Forms\Controllers;

use SysPhalcon\Controllers\ControllerBase;
use SysPhalcon\Plugins\Tools;
use Nucleo\Models\Protheus\Protheus;

class CadastroCentroCustosController extends ControllerBase
{

    /**
     * initialize
     */
    public function initialize()
    {
        $this->tag->setTitle('Formulário de Cadastro de Centro de Custo');
        parent::initialize();
    }

    public function indexAction()
    {

        if ($this->request->isPost()) {

            if ($this->request->isAjax()) {
                echo json_encode($this->getByAjax());
                return $this->view->disable();
            }
        }

        $protheus = new Protheus();
        $empresas = $protheus->getEmpresasProtheus();
        $empresa = [];

        foreach ($empresas as $value) {
            $empresa[$value['code']] = $value['name'];
        }

        $gestores = $protheus->getGestores();
        $gestor = [];

        foreach ($gestores as $value) {
            $gestor[$value['code'] . ' - ' . $value['name']] = $value['code'] . ' - ' . $value['name'];
        }

        $itensFiscais = $protheus->getItensContabeis();
        $itemFiscal = [];

        foreach ($itensFiscais as $value) {
            $itemFiscal[$value['code'] . ' - ' . $value['name']] = $value['code'] . ' - ' . $value['name'];
        }

        $classesValores = $protheus->getClassesValores();
        $classeValor = [];

        foreach ($classesValores as $value) {
            $classeValor[$value['code'] . ' - ' . $value['name']] = $value['code'] . ' - ' . $value['name'];
        }

        $this->view->empresas = $empresa;
        $this->view->gestores = $gestor;
        $this->view->itensFiscais = $itemFiscal;
        $this->view->classesValores = $classeValor;
        $this->assets->collection('footerJs')->addJs('app/forms/cadastro_centro_custos/index.js');
    }

    private function getByAjax()
    {
        $type = $this->request->getPost('type', 'string');
        $dados = $this->request->getPost('data', 'alphanum');

        $protheus = new Protheus();

        if (empty($dados)) {
            return [];
        }

        switch ($type) {
            case 'filial':
                return $protheus->getFiliais($dados);
                break;
            case 'cliente':
                return $protheus->getClientes($dados);
                break;

            default:
                break;
        }
    }

    public function sendFormAction()
    {
        try {
            if ($this->request->isPost()) {
                $this->view->setTemplateBefore('blank');

                $uploadedFiles = '';
                if ($this->request->hasFiles(true) == true) {
                    $tools = new Tools();
                    $uploadedFiles = $tools->uploadedFiles($this->request->getUploadedFiles());

                    if (!empty($uploadedFiles['error'])) {
                        $this->flash->error($uploadedFiles['error']);
                        unset($uploadedFiles['error']);
                    }
                    $options['attach'] = $uploadedFiles;
                }

                $options['copy'] = ['contabilidade@grupompe.com.br' => 'Contabilidade - Grupo MPE'];

                $this->view->campos = $this->request->getPost();
                $to = [$this->auth_identity->email => $this->auth_identity->nome];
                $subject = 'Solicitação Cadastro de Centro de Custo';
                $params = ['campos' => $this->request->getPost()];

                //log
                $options['log'] = [
                    'formName' => 'Formulário de Cadastro de Centro de Custo',
                    'usersName' => $this->auth_identity->userName,
                    'identKey' => 'Contrato: ' . $this->request->getPost('Número_do_Contrato') . ' - ' .
                    'Descrição CC: ' . $this->request->getPost('Descrição_do_Centro_de_Custo') . ' - ' .
                    'CNPJ Cliente: ' . $this->request->getPost('Cliente') . ' - ' .
                    'Gestor : ' . $this->request->getPost('Gestor'),
                ];

                $return = $this->mail->send($to, $subject, 'blank', $params, $options);

                if ($return) {
                    $this->flash->success('Sua solicitação foi enviada com Sucesso. Você receberá, em breve, um e-mail contendo as informações dessa solicitação.');
                }

                if (!empty($uploadedFiles)) {
                    foreach ($uploadedFiles as $file) {
                        unlink($file['file']);
                    }
                }
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
        return $this->response->redirect('forms/cadastro_centro_custos/');
    }

}

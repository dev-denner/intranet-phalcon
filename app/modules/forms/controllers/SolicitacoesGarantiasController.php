<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Forms\Controllers;

use App\Shared\Controllers\ControllerBase;
use App\Modules\Nucleo\Models\Protheus\Colaboradores;
use App\Plugins\Tools;

class SolicitacoesGarantiasController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle('Formulário de Seguro Garantia');
        parent::initialize();
    }

    public function indexAction() {
        $colaboradores = new Colaboradores();
        $empresas = $colaboradores->getEmpresas();
        $empresa = '';

        foreach ($empresas as $key => $value) {
            $empresa[$value] = $value;
        }

        $this->view->empresas = $empresa;
        $this->assets->collection('headerCss')->addJs('app/forms/solicitacoes_garantias/index.css');
        $this->assets->collection('footerJs')->addJs('app/forms/solicitacoes_garantias/index.js');
    }

    public function sendFormAction() {
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

                $this->view->campos = $this->request->getPost();
                $emailSolicitante = $this->request->getPost('Email_do_Solicitante', 'email');

                if ($emailSolicitante != $this->auth_identity->email) {
                    $options['copy'][$emailSolicitante] = $this->request->getPost('Nome_do_Solicitante', 'string');
                }

                $options['copy']['mauricio.reis@grupompe.com.br'] = 'Mauricio Reis';
                $options['copy']['maria.eduarda@grupompe.com.br'] = 'Maria Eduarda';

                $to = [$this->auth_identity->email => $this->auth_identity->nome];
                $subject = 'Formulário de Seguro Garantia';
                $params = ['campos' => $this->request->getPost()];

                //log
                $options['log'] = [
                    'formName' => $subject,
                    'usersName' => $this->auth_identity->userName,
                    'identKey' => 'CPF do Solicitante: ' . $this->request->getPost('CPF_do_Solicitante') . ' - ' .
                    'Número do Contrato: ' . $this->request->getPost('Número_do_Contrato') . ' - ' .
                    'Opção de Garantia: ' . $this->request->getPost('Opção_de_Garantia'),
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
        return $this->response->redirect('forms/solicitacoes_garantias/');
    }

}

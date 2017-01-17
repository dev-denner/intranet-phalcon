<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Forms\Controllers;

use App\Shared\Controllers\ControllerBase;

class CadastroFiliaisController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle('Formulário de Abertura de Filial');
        parent::initialize();
    }

    public function indexAction() {
        $this->assets->collection('headerCss')->addJs('app/forms/cadastro_filiais/index.css');
        $this->assets->collection('footerJs')->addJs('app/forms/cadastro_filiais/index.js');
    }

    public function sendFormAction() {
        try {
            if ($this->request->isPost()) {
                $this->view->setTemplateBefore('blank');

                $this->view->campos = $this->request->getPost();
                $to = [$this->auth_identity->email => $this->auth_identity->nome];
                $subject = 'Formulário de Abertura de Filial';
                $params = ['campos' => $this->request->getPost()];
                $options = ['copy' => ['fiscal.matriz@grupompe.com.br' => 'Fiscal Matriz - Grupo MPE']];

                //log
                $options['log'] = [
                    'formName' => $subject,
                    'usersName' => $this->auth_identity->userName,
                    'identKey' => 'Nome Comercial: ' . $this->request->getPost('Nome_Comercial') . ' - ' .
                    'CNPJ: ' . $this->request->getPost('CNPJ'),
                ];

                $return = $this->mail->send($to, $subject, 'blank', $params, $options);

                if ($return) {
                    $this->flash->success('Sua solicitação foi enviada com Sucesso. Você receberá, em breve, um e-mail contendo as informações dessa solicitação.');
                }
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
        return $this->response->redirect('forms/cadastro_filiais/');
    }

}

<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Forms\Controllers;

use App\Shared\Controllers\ControllerBase;

class CadastroClientesController extends ControllerBase
{

    /**
     * initialize
     */
    public function initialize()
    {
        $this->tag->setTitle('Formulário de Cadastro de Clientes');
        parent::initialize();
    }

    public function indexAction()
    {
        $this->assets->collection('footerJs')->addJs('app/forms/cadastro_clientes/index.js');
    }

    public function sendFormAction()
    {
        try {
            if ($this->request->isPost()) {
                $this->view->setTemplateBefore('blank');

                $this->view->campos = $this->request->getPost();
                $to = [$this->auth_identity->email => $this->auth_identity->nome];
                $subject = 'Solicitação Cadastro de Clientes';
                $params = ['campos' => $this->request->getPost()];
                $options = ['copy' => ['cadastro@grupompe.com.br' => 'Cadastro - Grupo MPE']];

                //log
                $options['log'] = [
                    'formName' => $subject,
                    'usersName' => $this->auth_identity->userName,
                    'identKey' => 'CPF / CNPJ: ' . $this->request->getPost('CPF_/_CNPJ') . ' - ' .
                    'Razão Social: ' . $this->request->getPost('Razão_Social'),
                ];

                $return = $this->mail->send($to, $subject, 'blank', $params, $options);

                if ($return) {
                    $this->flash->success('Sua solicitação foi enviada com Sucesso. Você receberá, em breve, um e-mail contendo as informações dessa solicitação.');
                }
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
        return $this->response->redirect('forms/cadastro_clientes/');
    }

}

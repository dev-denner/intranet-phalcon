<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Forms\Controllers;

use App\Modules\Nucleo\Models\Protheus\Filiais;
use App\Modules\Nucleo\Models\TablesSystem;
use App\Modules\Nucleo\Models\RM\Gcoligada;
use App\Shared\Controllers\ControllerBase;

class RequisicaoMudancaController extends ControllerBase
{

    /**
     * initialize
     */
    public function initialize()
    {
        $this->tag->setTitle('Requisição de Mudança');
        parent::initialize();
    }

    public function indexAction()
    {
        try {


        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

    public function sendFormAction()
    {
        try {
            if ($this->request->isPost()) {
                $this->view->setTemplateBefore('blank');

                $solicitante = $this->auth_identity->email;
                $colaborador = $this->request->getPost('email_colaborador', 'email');
                $gestor = $this->request->getPost('email_gestor');
                $options = ['copy' => ['suporte@grupompe.com.br' => 'Suporte - Grupo MPE']];

                if ($colaborador != $solicitante && $colaborador != $gestor && !empty($colaborador)) {
                    if (!empty($colaborador)) {
                        $options['copy'][$colaborador] = $this->request->getPost('nome_colaborador');
                    }
                }
                if ($gestor != $colaborador && $gestor != $solicitante) {
                    $options['copy'][$gestor] = $this->request->getPost('nome_gestor');
                }

                $subject = 'Solicitação Acesso ';

                $this->view->campos = $this->request->getPost();
                $to = [$this->auth_identity->email => $this->auth_identity->nome];

                $params = ['campos' => $this->request->getPost()];

                //log
                $options['log'] = [
                    'formName' => $subject,
                    'usersName' => $this->auth_identity->userName,
                    'identKey' => 'Nome do Colaborador: ' . $this->request->getPost('nome_colaborador') . ' - ' .
                    'CPF do Colaborador: ' . $this->request->getPost('cpf') . ' - ' .
                    'Nome do Gestor: ' . $this->request->getPost('nome_gestor') . ' - ' .
                    'E-mail do Gestor: ' . $this->request->getPost('email_gestor'),
                ];

                $return = $this->mail->send($to, $subject, 'blank', $params, $options);

                if ($return) {
                    $this->flash->success('Sua solicitação foi enviada com Sucesso. Você receberá, em breve, um e-mail contendo as informações dessa solicitação');
                }
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
        return $this->response->redirect('forms/solicitacoes_acessos/');
    }

}

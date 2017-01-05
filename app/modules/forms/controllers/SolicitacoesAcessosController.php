<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Forms\Controllers;

use Nucleo\Models\Protheus\Filiais;
use Nucleo\Models\TablesSystem;
use Nucleo\Models\RM\Gcoligada;
use SysPhalcon\Controllers\ControllerBase;

class SolicitacoesAcessosController extends ControllerBase
{

    /**
     * initialize
     */
    public function initialize()
    {
        $this->tag->setTitle('Solicitações de Acessos a Serviços de TI');
        parent::initialize();
    }

    public function indexAction()
    {
        try {

            if ($this->request->isPost()) {

                if ($this->request->isAjax()) {
                    $filiais = new Filiais();
                    echo json_encode($filiais->getFiliais($this->request->getPost('empresa', 'string')));
                    return $this->view->disable();
                }
            }

            $filiais = new Filiais();

            $empresas = [];
            foreach ($filiais->getEmpresas() as $filial) {
                $empresas[$filial['CODEMPRESA']] = $filial['CODEMPRESA'] . ' ' . $filial['EMPRESA'];
            }

            $coligadas = new Gcoligada();

            $this->view->empresas = $empresas;
            $this->view->modulos = TablesSystem::find(["table = 'module_protheus'", 'order' => 'value']);
            $this->view->rede_matriz = TablesSystem::find(["table = 'mother_network'", 'order' => 'value']);
            $this->view->papeis_otrs = TablesSystem::find(["table = 'papeis_otrs'", 'order' => 'value']);
            $this->view->coligadas = $coligadas->getColigada();
            $this->view->perfils = TablesSystem::find(["table = 'perfil_rm'", 'order' => 'value']);

            $this->assets->collection('headerCss')->addJs('app/forms/solicitacoes_acessos/index.css');
            $this->assets->collection('footerJs')->addJs('app/forms/solicitacoes_acessos/index.js');
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

                if (!is_null($this->request->getPost('servico_email'))) {
                    $subject .= 'E-mail/';
                }
                if (!is_null($this->request->getPost('servico_sistemas'))) {
                    $subject .= 'Sistemas/';
                }
                if (!is_null($this->request->getPost('servico_matriz'))) {
                    $subject .= 'Matriz/';
                }
                $subject = substr($subject, 0, strlen($subject) - 1);

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

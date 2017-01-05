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
use Forms\Models\SolicitacoesExternas;

class SolicitacoesExternasController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle('Formulário de Solicitações Externas');
        parent::initialize();
    }

    /**
     *
     */
    public function indexAction() {
        $this->view->setTemplateBefore('externo');

        $protheus = new Protheus();
        $empresas = $protheus->getEmpresasGrupo();
        $empresa = [];

        foreach ($empresas as $value) {
            $empresa[$value['name']] = $value['name'];
        }
        $this->view->empresas = $empresa;
        $this->assets->collection('footerJs')->addJs('app/forms/solicitacoes_externas/index.js');
    }

    public function sendFormAction() {
        try {
            if (!$this->request->isPost()) {
                throw new \Exception('Acesso indevido a essa action.');
            }

            $type = $this->request->getPost('area_ativa', 'string');
            $cpf = $this->request->getPost('CPF', 'alphanum');

            $solicitacoes_externas = '';

            if ($type != 'outros') {
                $solicitacoes_externas = SolicitacoesExternas::find("cpf = '{$cpf}' AND type = '{$type}' AND status = 'A'");
                if (count($solicitacoes_externas) > 0) {
                    throw new \Exception('Você possue uma solicitação do mesmo tipo que ainda não foi retornada por nossa equipe. Por favor aguarde nosso retorno.');
                }

                $solicitacoes_externas = new SolicitacoesExternas();

                $solicitacoes_externas->setId($solicitacoes_externas->autoincrement());
                $solicitacoes_externas->setCpf($cpf);
                $solicitacoes_externas->setType($type);
                $solicitacoes_externas->setStatus('A');

                if (!$solicitacoes_externas->create()) {
                    throw new \Exception($this->getMessage($solicitacoes_externas->getMessages()));
                }
            }

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
            $to = [$this->request->getPost('E-mail', 'email') => $this->request->getPost('Nome', 'string')];
            $subject = 'Formulário de Solicitações Externas';
            $params = ['campos' => $this->request->getPost()];
            $options['copy'] = ['dp@grupompe.com.br' => 'Departamento de Pessoal - Grupo MPE'];

            //log
            $options['log'] = [
                'formName' => $subject,
                'identKey' => 'CPF: ' . $cpf . ' - Tipo: ' . $type,
                'usersName' => $cpf,
            ];

            $return = $this->mail->send($to, $subject, 'blank', $params, $options);

            if ($return) {
                $this->flash->success('Sua solicitação foi enviada com Sucesso. Você receberá, em breve, um e-mail contendo as informações dessa solicitação.');
            }

            if (!empty($uploadedFiles)) {
                $this->eraseFiles($uploadedFiles);
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
        return $this->response->redirect('forms/solicitacoes_externas/');
    }

    public function controleAction() {
        $this->view->solicitacoes_externas = SolicitacoesExternas::find();
    }

    public function closeAction($id) {
        try {

            $solicitacoes_externas = SolicitacoesExternas::findFirstByid($id);
            if (!$solicitacoes_externas) {
                throw new \Exception('Solicitação Externa não encontrada!');
            }

            $solicitacoes_externas->setStatus('F');

            if (!$solicitacoes_externas->update()) {

                $msg = '';
                foreach ($solicitacoes_externas->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new \Exception($msg);
            }

            $this->flash->success('Solicitação Externa encerrada!!!');
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
        return $this->response->redirect('forms/solicitacoes_externas/controle');
    }

    public function deleteAction() {

        try {
            if (!$this->request->isPost()) {
                throw new \Exception('Acesso não permitido a essa action.');
            }

            if ($this->request->isAjax()) {
                $this->view->disable();
            }

            $id = $this->request->getPost('id');

            $solicitacoes_externas = SolicitacoesExternas::findFirstByid($id);

            if (!$solicitacoes_externas) {
                throw new \Exception('Solicitação Externa não encontrada!');
            }

            if (!$solicitacoes_externas->delete()) {

                $msg = '';
                foreach ($solicitacoes_externas->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new \Exception($msg);
            }
            echo 'ok';
        } catch (\Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('forms/solicitacoes_externas/');
        }
    }

}

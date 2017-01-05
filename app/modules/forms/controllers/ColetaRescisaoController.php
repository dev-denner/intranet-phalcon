<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Forms\Controllers;

use SysPhalcon\Controllers\ControllerBase;
use Nucleo\Models\RM\RM;
use Forms\Models\ColetaRecisao;
use SysPhalcon\Plugins\Tools;

class ColetaRescisaoController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle('Formulário de Coleta de Informações para Rescisão Contratual');
        parent::initialize();
    }

    /**
     *
     */
    public function indexAction() {

        if (substr($this->auth_identity->contrato, 0, 1) == '0') {
            $this->view->coleta_rescisoes = ColetaRecisao::find();
        } else {
            $this->view->coleta_rescisoes = ColetaRecisao::findByContract($this->auth_identity->contrato);
        }
        $this->assets->collection('footerJs')->addJs('app/forms/coleta_rescisao/index.js');
    }

    /**
     *
     */
    public function newAction() {

        $rm = new RM();
        $verbas = $rm->getVerbas();
        $verba = [];

        foreach ($verbas as $value) {
            $verba[$value['code'] . ' - ' . $value['name']] = $value['name'];
        }

        $this->view->verbas = $verba;
        $this->assets->collection('footerJs')->addJs('app/forms/coleta_rescisao/index.js');
    }

    /**
     *
     * @param type $sequence
     * @return type
     * @throws \Exception
     */
    public function editAction($sequence) {

        try {
            $coleta_recisao = ColetaRecisao::findFirst("status = 'A' AND sequence = '{$sequence}'");

            if (!$coleta_recisao) {
                throw new \Exception("O lote <b class='c-black'>{$sequence}</b> está fechado para edição ou ele não existe!");
            }

            $rm = new RM();
            $verbas = $rm->getVerbas();
            $verba = [];

            foreach ($verbas as $value) {
                $verba[$value['code'] . ' - ' . $value['name']] = $value['name'];
            }

            $this->view->verbas = $verba;

            $path = APP_PATH . '/public/downloads/coleta_rescisao/';

            $this->view->files = $this->manageDirs($path . $sequence);
            $this->view->sequence = $sequence;
            $this->tag->setDefault('sequence', $sequence);

            $this->assets->collection('footerJs')->addJs('app/forms/coleta_rescisao/index.js');
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
            return $this->response->redirect('forms/coleta_rescisao/');
        }
    }

    /**
     *
     * @return type
     * @throws \Exception
     */
    public function addAction() {

        try {

            if (!$this->request->isPost()) {
                throw new \Exception('Acesso inválido a essa action.');
            }

            $this->view->setTemplateBefore('blank');

            $path = APP_PATH . '/public/downloads/coleta_rescisao/';
            $sequence = $this->prepareEnvironmentForBatch($this->request->getPost('sequence', 'string'));
            $this->manageDirs($path . $sequence);

            $options['attach'] = $this->getAttachments($path . $sequence);

            $this->view->campos = $this->request->getPost();
            $params = ['campos' => $this->request->getPost()];

            $cpf = $this->request->getPost('CPF', 'alphanum');
            $name = $this->request->getPost('Nome', 'string');

            $tools = new Tools();
            $html = $tools->getTemplate($params, 'pdfTemplates', 'blank');

            $options['title'] = $cpf . date('Ymdhis') . '.pdf';
            $options['path'] = $path . $sequence;
            $tools->writePdf2($html, false, $options);

            $files = [
                $options['path'] . $options['title'],
                $options['attach'][0]['file']
            ];

            $pronto = $path . $sequence . $name . ' - ' . $cpf . '.pdf';

            $this->sendMergePdf($tools, $files, $pronto);

            $this->flash->success('Arquivo adicionado: ' . $name . ' - ' . $cpf);

            if (!empty($files)) {
                $this->eraseFiles($files);
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }

        return $this->response->redirect('forms/coleta_rescisao/edit/' . $sequence);
    }

    /**
     *
     * @return string
     * @throws \Exception
     */
    public function sendFormAction() {
        try {

            $this->view->setTemplateBefore('blank');

            $path = APP_PATH . '/public/downloads/coleta_rescisao/';
            $sequence = $this->request->getPost('sequence');

            $files = $this->manageDirs($path . $sequence);
            $fileMerge = [];

            foreach ($files as $file) {
                $fileMerge[] = $path . $sequence . '/' . $file;
            }

            $pronto = $path . $sequence . '/' . $sequence . '.pdf';

            $this->sendMergePdf(new Tools(), $fileMerge, $pronto);

            $this->view->sequence = $sequence;
            $this->view->link = $sequence . '/' . $sequence . '.pdf';

            $options['copy'] = ['dp@grupompe.com.br' => 'Departamento de Pessoal - Grupo MPE'];

            $to = [$this->auth_identity->email => $this->auth_identity->nome];
            $subject = 'Formulário de Coleta de Informações para Rescisão Contratual';

            //log
            $options['log'] = [
                'formName' => $subject,
                'usersName' => $this->auth_identity->userName,
                'identKey' => 'Sequência: ' . $sequence,
            ];

            $return = $this->mail->send($to, $subject, 'blank', $params, $options);

            if (!$return) {
                throw new \Exception('Falha ao enviar E-mail. <br>E-mail não enviado');
            }
            $this->flash->success('O lote de rescisões foi enviado para matriz. Você receberá, em breve, um e-mail contendo as informações dessa solicitação.');

            $coleta_recisao = ColetaRecisao::findFirstBySequence($sequence);
            $coleta_recisao->setStatus('E');

            if (!$coleta_recisao->update()) {
                throw new \Exception($this->getMessage($coleta_recisao->getMessages()));
            }
            if (!empty($fileMerge)) {
                $this->eraseFiles($fileMerge);
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
        return 'ok';
    }

    /**
     *
     * @param type $sequence
     * @return type
     * @throws \Exception
     */
    private function prepareEnvironmentForBatch($sequence) {

        if (empty($sequence)) {
            $coleta_recisao = new ColetaRecisao();

            $filing = date('Ymd');
            $contract = $this->auth_identity->contrato;
            $nextval = str_pad($coleta_recisao->getSequenceTable(), 8, 0, STR_PAD_LEFT);
            $sequence = $filing . $nextval;

            $coleta_recisao->setId($coleta_recisao->autoincrement());
            $coleta_recisao->setContract($contract);
            $coleta_recisao->setSequence($sequence);
            $coleta_recisao->setStatus('A');

            if (!$coleta_recisao->create()) {
                throw new \Exception($this->getMessage($coleta_recisao->getMessages()));
            }
        } else {
            $coleta_recisao = ColetaRecisao::findFirstBySequence($sequence);
            if (!$coleta_recisao->update()) {
                throw new \Exception($this->getMessage($coleta_recisao->getMessages()));
            }
            $sequence = $coleta_recisao->getSequence();
        }

        return $sequence . '/';
    }

    /**
     *
     * @return type
     */
    private function getAttachments($sequence) {

        $uploadedFiles = '';
        if ($this->request->hasFiles() == true) {
            $tools = new Tools();
            $limit = 1024 * 512;
            $files = $this->request->getUploadedFiles();

            $uploadedFiles = $tools->uploadedFiles($files, $limit, $sequence);

            if (!empty($uploadedFiles['error'])) {
                $this->flash->error($uploadedFiles['error']);
                unset($uploadedFiles['error']);
            }
        }
        return $uploadedFiles;
    }

    /**
     *
     * @param Tools $tools
     * @param type $files
     * @param type $pronto
     * @return type
     */
    private function sendMergePdf(Tools $tools, $files, $pronto) {
        try {
            return $tools->mergePdf($files, $pronto);
        } catch (\Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
    }

    /**
     *
     * @param type $dir
     * @return string
     */
    private function manageDirs($dir) {

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $dirs = scandir($dir);
        $remove = array('.', '..');
        $dirs = array_diff($dirs, $remove);
        sort($dirs);

        return $dirs;
    }

}

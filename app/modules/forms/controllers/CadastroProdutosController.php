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

class CadastroProdutosController extends ControllerBase
{

    /**
     * initialize
     */
    public function initialize()
    {
        $this->tag->setTitle('Formulário de Cadastro de Produtos');
        parent::initialize();
    }

    public function indexAction()
    {

    }

    public function sendFormAction()
    {
        try {
            if (!$this->request->isPost()) {
                throw new \Exception('Acesso indevido a essa action.');
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
            $to = [$this->auth_identity->email => $this->auth_identity->nome];
            $subject = 'Solicitação Cadastro de Produtos';
            $params = ['campos' => $this->request->getPost()];
            $options['copy'] = ['cadastro@grupompe.com.br' => 'Cadastro - Grupo MPE'];

            //log
            $options['log'] = [
                'formName' => $subject,
                'usersName' => $this->auth_identity->userName,
                'identKey' => 'Nome do Material: ' . $this->request->getPost('Nome_do_Material') . ' - ' .
                'Material de Fabricação: ' . $this->request->getPost('Material_de_Fabricação'),
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
        return $this->response->redirect('forms/cadastro_produtos/');
    }

}

<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Forms\Controllers;

use App\Shared\Controllers\ControllerBase;
use App\Plugins\Tools;

class CadastroServicosController extends ControllerBase
{

    /**
     * initialize
     */
    public function initialize()
    {
        $this->tag->setTitle('Formulário de Cadastro de Serviços');
        parent::initialize();
    }

    public function indexAction()
    {

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

                $options['copy'] = ['cadastro@grupompe.com.br' => 'Cadastro - Grupo MPE'];

                $this->view->campos = $this->request->getPost();
                $to = [$this->auth_identity->email => $this->auth_identity->nome];
                $subject = 'Solicitação Cadastro de Serviços';
                $params = ['campos' => $this->request->getPost()];

                //log
                $options['log'] = [
                    'formName' => $subject,
                    'usersName' => $this->auth_identity->userName,
                    'identKey' => 'Tipo do Serviço: ' . $this->request->getPost('Tipo_do_Serviço') . ' - ' .
                    'Nome Modificador do Serviço: ' . $this->request->getPost('Nome_Modificador_do_Serviço'),
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
        return $this->response->redirect('forms/cadastro_servicos/');
    }

}

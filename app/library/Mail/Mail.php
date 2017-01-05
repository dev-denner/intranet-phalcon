<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace SysPhalcon\Library\Mail;

use Phalcon\Mvc\User\Component;
use Nucleo\Models\Mysql\LogForms;

class Mail extends Component {

    protected $transport;
    protected $amazonSes;

    public function initialize() {
        parent::initialize();
    }

    public function getTemplate($name, $params) {
        $parameters = array_merge(['publicUrl' => $this->config->application->baseUri,], $params);
        return $this->view->getRender('emailTemplates', $name, $parameters, function($view) use ($name) {
                      $view->setMainView('common/emailTemplates/' . $name);
                  });
        return $this->view->getContent();
    }

    public function send($to, $subject, $name, $params, $options = []) {

        $mailSettings = $this->config->mail;
        $template = $this->getTemplate($name, $params);
        $fromEmail = $mailSettings->fromEmail;
        $fromName = $mailSettings->fromName;

        if (isset($options['fromEmail'])) {
            $fromEmail = $options['fromEmail'];
        }
        if (isset($options['fromName'])) {
            $fromName = $options['fromName'];
        }

        //echo $template, exit;

        $message = \Swift_Message::newInstance()
                  ->setSubject($subject)
                  ->setTo($to)
                  ->setBcc([$mailSettings->fromEmail => $mailSettings->fromName])
                  ->setFrom([$fromEmail => $fromName])
                  ->setReplyTo($to)
                  ->setBody($template, 'text/html');

        if (isset($options['copy'])) {
            $message->setCc($options['copy']);
        }

        if (isset($options['attach'])) {
            foreach ($options['attach'] as $attach) {
                $message->attach(\Swift_Attachment::fromPath($attach['file'], $attach['type'])->setFilename($attach['name']));
            }
        }

        if (!$this->transport) {
            $this->transport = \Swift_SmtpTransport::newInstance($mailSettings->smtp->server, $mailSettings->smtp->port, $mailSettings->smtp->security)
                      ->setUsername($mailSettings->smtp->username)
                      ->setPassword($mailSettings->smtp->password);
        }

        $mailer = \Swift_Mailer::newInstance($this->transport);

        //logs
        if (isset($options['log'])) {
            $this->logForms($options['log']);
        }

        return $mailer->send($message);
    }

    private function logForms($options) {
        $log_forms = new LogForms();

        $log_forms->formName = $options['formName'];
        $log_forms->identKey = $options['identKey'];
        $log_forms->usersName = $options['usersName'];
        $log_forms->save();
    }

}

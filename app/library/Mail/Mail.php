<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace SysPhalcon\Library\Mail;

use Phalcon\Mvc\User\Component;
use Phalcon\Mvc\View;

class Mail extends Component {

    protected $transport;
    protected $amazonSes;
    protected $directSmtp = true;

    private function amazonSESSend($raw) {
        if ($this->amazonSes == null) {
            $this->amazonSes = new \Aws\S3\S3Client([
                'key' => $this->config->amazon->AWSAccessKeyId,
                'secret' => $this->config->amazon->AWSSecretKey,
                'version' => 'latest',
                'region' => 'us-east-1'
            ]);
            @$this->amazonSes->disable_ssl_verification();
        }

        $response = $this->amazonSes->send_raw_email(
                [
            'Data' => base64_encode($raw)
                ], [
            'curlopts' => [
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0
            ]
                ]
        );

        if (!$response->isOK()) {
            $this->logger->error('Error sending email from AWS SES: ' . $response->body->asXML());
        }

        return true;
    }

    public function getTemplate($name, $params) {
        $parameters = array_merge(['publicUrl' => $this->config->application->baseUri,], $params);
        return $this->view->getRender('emailTemplates', $name, $parameters, function($view) use ($name) {
                    $view->setMainView('common/emailTemplates/' . $name);
                });
        return $view->getContent();
    }

    public function send($to, $subject, $name, $params) {

        $mailSettings = $this->config->mail;

        $template = $this->getTemplate($name, $params);

        $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setTo($to)
                ->setFrom([$mailSettings->fromEmail => $mailSettings->fromName])
                ->setReplyTo([$mailSettings->fromEmail => $mailSettings->fromName])
                ->setBody($template, 'text/html');

        if ($this->directSmtp) {

            if (!$this->transport) {
                $this->transport = \Swift_SmtpTransport::newInstance(
                                $mailSettings->smtp->server, $mailSettings->smtp->port, $mailSettings->smtp->security
                        )
                        ->setUsername($mailSettings->smtp->username)
                        ->setPassword($mailSettings->smtp->password);
            }

            $mailer = \Swift_Mailer::newInstance($this->transport);

            return $mailer->send($message);
        } else {
            return $this->amazonSESSend($message->toString());
        }
    }

}

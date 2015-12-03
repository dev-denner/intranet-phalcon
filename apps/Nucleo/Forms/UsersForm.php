<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsersForm
 *
 * @author DennerFernandes
 */

namespace Nucleo\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Email as Email;
use Phalcon\Forms\Element\Check;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email as ValidEmail;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\Identical;

class UsersForm extends Form {

  public function initialize($entity = null, $options = array()) {

    // $id
    if (isset($options['edit'])) {
      $id = new Hidden('id');
      $id->setLabel(' ');
      $this->add($id);
    }

    // $cpf
    $cpf = new Text('cpf');
    $cpf->setLabel('CPF');
    $cpf->setFilters(array('striptags', 'string'));
    $cpf->addValidators(array(
        new PresenceOf(array('mensage' => 'CPF é Obrigatório')),
        new Regex(
                array(
            'message' => 'Não é um formato válido de CPF',
            'pattern' => '([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})',
                )
        ),
        new Uniqueness(
                array(
            'model' => 'Nucleo\Models\Users',
            'message' => ':field já está cadastrado.'
                ))
    ));
    $this->add($cpf);

    // $password
    if (!isset($options['search'])) {

      $password = new Password('password');
      $password->setLabel('Senha');
      $password->setFilters(array('string'));
      $password->addValidators(array(
          new PresenceOf(array('mensage' => 'Senha é Obrigatório')),
          new Confirmation(array(
              'message' => 'Senhas não são identicas',
              'with' => 'confirmPassword'
                  ))
      ));
      $this->add($password);

      $confirmPassword = new Password('confirmPassword');
      $confirmPassword->setLabel('Confirmar Senha');
      $confirmPassword->addValidators(array(
          new PresenceOf(array(
              'message' => 'Confirmar Senha é Obrigatório'
                  ))
      ));
      $this->add($confirmPassword);
    }

    // $email
    $email = new Email('email');
    $email->setLabel('E-mail do Usuário');
    $email->setFilters(array('striptags', 'string'));
    $email->addValidators(array(
        new PresenceOf(array('mensage' => 'E-mail é Obrigatório')),
        new ValidEmail(array('mensage' => 'E-mail não é Válido'))
    ));
    $this->add($email);

    // $name
    $name = new Text('name');
    $name->setLabel('Nome');
    $name->setFilters(array('striptags', 'string'));
    $name->addValidators(array(
        new PresenceOf(array('mensage' => 'Nome é Obrigatório'))
    ));

    $this->add($name);

    // $status
    $status = new Select('status', array(
        'A' => 'Ativo',
        'I' => 'Inativo'
    ));
    $status->setLabel('Status');
    $this->add($status);

    // $usercreate or $userupdate
    if ($this->session->get('auth')) {

      if (isset($options['edit'])) {
        $user = new Hidden('userupdate');
      } else {
        $user = new Hidden('usercreate');
      }
      $user->setLabel(' ');
      $this->add($user);
    }

    // Remember
    $resetSenha = new Check('mustchangepassword', array(
        'value' => 'Y'
    ));
    $resetSenha->setLabel('Resetar Senha?');
    $this->add($resetSenha);

    // csrf
    $csrf = new Hidden('csrf');
    $csrf->setLabel(' ');
    $csrf->addValidator(new Identical(array(
        'value' => $this->security->getSessionToken(),
        'message' => 'Validação CSRF falhou.'
    )));
    $this->add($csrf);
  }

  public function messages($name) {
    if ($this->hasMessagesFor($name)) {
      foreach ($this->getMessagesFor($name) as $message) {
        $this->flash->error($message);
      }
    }
  }

}

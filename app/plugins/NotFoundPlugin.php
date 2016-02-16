<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotFoundPlugin
 *
 * @author denner.fernandes
 */
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Dispatcher;
use Phalcon\Mvc\Dispatcher\Exception as DispatcherException;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;

/**
 * NotFoundPlugin
 *
 * Handles not-found controller/actions
 */
class NotFoundPlugin extends Plugin {

  /**
   * This action is executed before execute any action in the application
   *
   * @param Event $event
   * @param MvcDispatcher $dispatcher
   * @param Exception $exception
   * @return boolean
   */
  public function beforeException(Event $event, MvcDispatcher $dispatcher, Exception $exception) {

    error_log($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());

    if ($event->getType() == 'beforeNotFoundAction') {
      $dispatcher->forward(array(
          'module' => 'nucleo',
          'controller' => 'errors',
          'action' => 'show404'
      ));

      return false;
    }

    if ($event->getType() == 'beforeException') {
      switch ($exception->getCode()) {
        case Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
        case Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
          $this->response->redirect('nucleo/index/show404');
          return false;
        default:
          $this->response->redirect('nucleo/index/show500');
          return false;
      }
    }
  }

}

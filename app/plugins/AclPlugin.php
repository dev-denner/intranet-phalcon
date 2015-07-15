<?php

/**
 * AclPlugin.php
 * Plugins
 *
 * The Acl plugin
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       23/04/2015
 * @category    Plugins
 * @license     MIT
 *
 */
use Phalcon\Acl as Acl;
use Phalcon\Acl\Role as Role;
use Phalcon\Acl\Resource as Resource;
use Phalcon\Acl\Adapter\Memory as Memory;
use Phalcon\Mvc\User\Plugin as Plugin;
use Phalcon\Events\Event as Event;
use Phalcon\Mvc\Dispatcher as Dispatcher;

class AclPlugin extends Plugin {

  /**
   * @var Phalcon\Acl\Adapter\Memory
   */
  protected $_acl;

  public function __construct($di) {
    $this->_dependencyInjector = $di;
  }

  public function getAcl() {

    if (!$this->_acl) {
      $acl = new Memory();

      $acl->setDefaultAction(Acl::DENY);

      // Register roles
      $roles = array(
          'users' => new Role('Users'),
          'guests' => new Role('Guests')
      );
      foreach ($roles as $role) {
        $acl->addRole($role);
      }

      // Private area resources
      $privateResources = array(
          'awards' => array('add', 'edit', 'delete'),
          'players' => array('add', 'edit', 'delete'),
          'episodes' => array('add', 'edit', 'delete'),
      );

      foreach ($privateResources as $resource => $actions) {
        $acl->addResource(new Resource($resource), $actions);
      }

      // Public area resources
      $publicResources = array(
          'index' => array('index'),
          'users' => array('index', 'add', 'edit', 'delete'),
      );

      foreach ($publicResources as $resource => $actions) {
        $acl->addResource(new Resource($resource), $actions);
      }

      //Grant access to public areas to both users and guests
      foreach ($roles as $role) {
        foreach ($publicResources as $resource => $actions) {
          $acl->allow($role->getName(), $resource, '*');
        }
      }

      // Grant access to private area to role Users
      foreach ($privateResources as $resource => $actions) {
        foreach ($actions as $action) {
          $acl->allow('Users', $resource, $action);
        }
      }

      $this->_acl = $acl;
    }
    return $this->_acl;
  }

  /**
   * This action is executed before execute any action in the application
   */
  public function beforeDispatch(Event $event, Dispatcher $dispatcher) {

    $auth = $this->session->get('auth');
    if (!$auth) {
      $role = 'Guests';
    } else {
      $role = 'Users';
    }

    $controller = $dispatcher->getControllerName();
    $action = $dispatcher->getActionName();

    $acl = $this->getAcl();

    $allowed = $acl->isAllowed($role, $controller, $action);

    if ($allowed != Acl::ALLOW) {
      $this->flash->error("You don't have access to this module");
      $dispatcher->forward(
              array(
                  'controller' => 'index',
                  'action' => 'index'
              )
      );
      return false;
    }
  }

}

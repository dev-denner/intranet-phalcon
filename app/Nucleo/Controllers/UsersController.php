<?php

/**
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       30/06/2015 04:47:06
 *
 */


namespace Nucleo\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Controller;
use Nucleo\Models\Users;

/**
 * Class UsersController
 * @package Nucleo\Controllers
 */
class UsersController extends Controller
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for users
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Users', $_POST);
      $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery('page', 'int');
    }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters['order'] = 'id';

    $users = Users::find($parameters);
        if (count($users) == 0) {
            $this->flash->notice('The search did not find any users');

      return $this->dispatcher->forward(array(
                'action' => 'index'
      ));
        }

        $paginator = new Paginator(array(
            'data' => $users,
        'limit' => 10,
        'page' => $numberPage
    ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a user
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $user = Users::findFirstById($id);
            if (!$user) {
                $this->flash->error('user was not found');

        return $this->dispatcher->forward(array(
                    'action' => 'index'
        ));
            }
            $this->view->id = $user->id;

            $this->tag->setDefault('id', $user->getId());
      $this->tag->setDefault('cpf', $user->getCpf());
      $this->tag->setDefault('password', $user->getPassword());
      $this->tag->setDefault('email', $user->getEmail());
      $this->tag->setDefault('name', $user->getName());
      $this->tag->setDefault('status', $user->getStatus());
      $this->tag->setDefault('token', $user->getToken());
      $this->tag->setDefault('delete', $user->getDelete());
      $this->tag->setDefault('usercreate', $user->getUsercreate());
      $this->tag->setDefault('datecreate', $user->getDatecreate());
      $this->tag->setDefault('userupdate', $user->getUserupdate());
      $this->tag->setDefault('dateupdate', $user->getDateupdate());
    }
    }

    /**
     * Creates a new user
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                'action' => 'index'
      ));
        }

        $user = new Users();

        $user->setCpf($this->request->getPost('cpf', 'string'));
    $user->setPassword($this->request->getPost('password', 'string'));
    $user->setEmail($this->request->getPost('email', 'email'));
    $user->setName($this->request->getPost('name', 'string'));
    $user->setStatus($this->request->getPost('status', 'string'));
    $user->setToken($this->request->getPost('token', 'string'));
    $user->setDelete($this->request->getPost('delete', 'string'));
    $user->setUsercreate($this->request->getPost('usercreate', 'string'));
    $user->setDatecreate($this->request->getPost('datecreate', 'string'));
    $user->setUserupdate($this->request->getPost('userupdate', 'string'));
    $user->setDateupdate($this->request->getPost('dateupdate', 'string'));


    if (!$user->save()) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                'action' => 'new'
      ));
        }

        $this->flash->success('user was created successfully');

    return $this->dispatcher->forward(array(
            'action' => 'index'
    ));
    }

    /**
     * Saves a user edited
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                'action' => 'index'
      ));
        }

        $id = $this->request->getPost('id');

    $user = Users::findFirstById($id);
        if (!$user) {
            $this->flash->error('user does not exist ' . $id);

      return $this->dispatcher->forward(array(
                'action' => 'index'
      ));
        }

        $user->setCpf($this->request->getPost('cpf', 'string'));
    $user->setPassword($this->request->getPost('password', 'string'));
    $user->setEmail($this->request->getPost('email', 'email'));
    $user->setName($this->request->getPost('name', 'string'));
    $user->setStatus($this->request->getPost('status', 'string'));
    $user->setToken($this->request->getPost('token', 'string'));
    $user->setDelete($this->request->getPost('delete', 'string'));
    $user->setUsercreate($this->request->getPost('usercreate', 'string'));
    $user->setDatecreate($this->request->getPost('datecreate', 'string'));
    $user->setUserupdate($this->request->getPost('userupdate', 'string'));
    $user->setDateupdate($this->request->getPost('dateupdate', 'string'));


    if (!$user->save()) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                'action' => 'edit',
                  'params' => array($user->id)
      ));
        }

        $this->flash->success('user was updated successfully');

    return $this->dispatcher->forward(array(
            'action' => 'index'
    ));
    }

    /**
     * Deletes a user
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $user = Users::findFirstById($id);
        if (!$user) {
            $this->flash->error('user was not found');

      return $this->dispatcher->forward(array(
                'action' => 'index'
      ));
        }

        if (!$user->delete()) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                'action' => 'search'
      ));
        }

        $this->flash->success('user was deleted successfully');

    return $this->dispatcher->forward(array(
            'action' => 'index'
    ));
    }
}

<?php

/**
 * @copyright   2016 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace SysPhalcon\Plugins;

use Phalcon\Mvc\User\Component;
use Nucleo\Models\Groups;

class Access extends Component {

    private $publicResources;
    private $privateResources;
    private $filePath;

    /**
     *
     * @param type $filePath
     */
    public function __construct($filePath) {
        $this->setFilePath($filePath);
        $this->runAccess();
    }

    /**
     *
     * @return type
     */
    public function getPublicResources() {
        return $this->publicResources;
    }

    /**
     *
     * @return type
     */
    public function getPrivateResources() {
        return $this->privateResources;
    }

    /**
     *
     * @param type $filePath
     * @return \SysPhalcon\Plugins\Access
     */
    private function setFilePath($filePath) {
        if (empty($filePath)) {
            $this->filePath = APP_PATH . '/cache/access/';
        } else {
            $this->filePath = $filePath;
        }

        if (!file_exists($this->filePath)) {
            mkdir($this->filePath, 0777, true);
        }

        return $this;
    }

    /**
     *
     * @return \SysPhalcon\Plugins\Access
     */
    private function setPublicResources() {

        $groups = Groups::findByType('S');

        foreach ($groups as $group) {
            $perfils = $group->perfils;
            foreach ($perfils as $perfil) {
                $this->publicResources[$perfil->modules->slug][$perfil->controllers->slug][$perfil->actions->slug] = $perfil->permission;
            }
        }
        return $this;
    }

    /**
     *
     * @return \SysPhalcon\Plugins\Access
     */
    private function setPrivateResources() {
        $userInfo = $this->auth->getIdentity();

        if (!is_null($userInfo)) {
            $this->privateResources = $userInfo['profile'];
        }

        return $this;
    }

    /**
     * run Access
     */
    private function runAccess() {
        $this->getAccessPublic();
        if (!is_null($this->auth->getIdentity())) {
            $this->getAccessPrivate();
        }
    }

    /**
     *
     * @param string $resource
     * @param type $module
     * @param type $controller
     * @param type $action
     * @return boolean
     */
    public function isAllowed($resource, $module, $controller, $action) {

        $resource = $resource . 'Resources';

        $this->setPrivateResources();

        foreach ($this->$resource as $moduleKey => $controllers) {
            if ($moduleKey == $module) {
                foreach ($controllers as $controllerKey => $actions) {
                    if ($controllerKey == $controller) {
                        foreach ($actions as $actionKey => $permission) {
                            if ($actionKey == $action and $permission == 'S') {
                                return true;
                            }
                        }
                    }
                }
            }
        }
        return false;
    }

    /**
     *
     * @return type
     */
    private function getAccessPrivate() {

        $userInfo = $this->auth->getIdentity();
        $filePath = $this->filePath . $userInfo['userInfo']['cpf'] . date('Ymd') . '.txt';

        if (is_array($this->privateResources)) {
            return $this->privateResources;
        }

        /* if (function_exists('apc_fetch')) {
          $access = apc_fetch('nucleo-access-' . $userInfo['userInfo']['cpf']);
          if (is_array($access)) {
          $this->privateResources = $access;
          return $access;
          }
          } */

        if (!file_exists($filePath)) {
            $this->privateResources = $this->rebuildPrivate();
            return $this->privateResources;
        }

        $data = file_get_contents($filePath);
        $this->privateResources = unserialize($data);

        /* if (function_exists('apc_store')) {
          apc_store('nucleo-access-' . $userInfo['userInfo']['cpf'], $this->privateResources);
          } */

        return $this->privateResources;
    }

    /**
     *
     * @return type
     */
    private function getAccessPublic() {

        $filePath = $this->filePath . 'public-' . date('Ymd') . '.txt';

        if (is_array($this->publicResources)) {
            return $this->publicResources;
        }

        /* if (function_exists('apc_fetch')) {
          $access = apc_fetch('nucleo-access-public');
          if (is_array($access)) {
          $this->publicResources = $access;
          return $access;
          }
          } */

        if (!file_exists($filePath)) {
            $this->publicResources = $this->rebuildPublic();
            return $this->publicResources;
        }

        $data = file_get_contents($filePath);
        $this->publicResources = unserialize($data);


        /* if (function_exists('apc_store')) {
          apc_store('nucleo-access-public', $this->publicResources);
          } */

        return $this->publicResources;
    }

    /**
     *
     * @return type
     * @throws Exception
     */
    private function rebuildPrivate() {

        $userInfo = $this->auth->getIdentity();
        $filePath = $this->filePath . $userInfo['userInfo']['cpf'] . date('Ymd') . '.txt';
        $this->setPrivateResources();
        $acessPrivate = $this->getPrivateResources();

        if (!file_exists($filePath)) {
            $file = fopen($filePath, 'w+');
            if ($file == false) {
                throw new \Exception('Não foi possível criar o arquivo em ' . $filePath);
            }
        }

        if (touch($filePath) && is_writable($filePath)) {

            file_put_contents($filePath, serialize($acessPrivate));

            /* if (function_exists('apc_store')) {
              apc_store('nucleo-access-' . $userInfo['userInfo']['cpf'], $acessPrivate);
              } */
        } else {
            throw new \Exception('O usuário não tem permissões de escrita para criar a lista de acesso em ' . $filePath);
        }

        return $acessPrivate;
    }

    /**
     *
     * @return type
     * @throws Exception
     */
    private function rebuildPublic() {

        $userInfo = $this->auth->getIdentity();
        $filePath = $this->filePath . 'public-' . date('Ymd') . '.txt';
        $this->setPublicResources();
        $acessPublic = $this->getPublicResources();

        if (!file_exists($filePath)) {
            $file = fopen($filePath, 'w+');
            if ($file == false) {
                throw new \Exception('Não foi possível criar o arquivo em ' . $filePath);
            }
        }

        if (touch($filePath) && is_writable($filePath)) {

            file_put_contents($filePath, serialize($acessPublic));

            /* if (function_exists('apc_store')) {
              apc_store('nucleo-access-public', $acessPublic);
              } */
        } else {
            throw new \Exception('O usuário não tem permissões de escrita para criar a lista de acesso em ' . $filePath);
        }

        return $acessPublic;
    }

}

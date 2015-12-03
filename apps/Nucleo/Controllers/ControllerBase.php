<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller {

  public function initialize() {
    $this->tag->prependTitle('Intranet | ');
    $this->tag->appendTitle(' | Grupo MPE');
    $this->view->setTemplateAfter('main');
    $this->view->titleLogo = 'Grupo MPE';
  }

}

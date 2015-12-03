<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Controllers;

/**
 * Class IndexController
 * @package Mpeapi\Nucleo\Controllers
 */
class IndexController extends ControllerBase {

  public function initialize() {
    $this->tag->setTitle('Home');
    parent::initialize();
  }

  public function indexAction() {
    
  }

}

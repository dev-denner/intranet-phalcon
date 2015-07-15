<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller {

  protected function initialize() {
    $this->tag->prependTitle('API - MPE | ');
    $this->view->setTemplateAfter('main');
  }

}

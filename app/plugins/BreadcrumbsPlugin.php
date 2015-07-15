<?php

/**
 * Breadcrumbs.php
 * niden_Breadcrumbs
 *
 * Handles the breadcrumbs for the application
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       23/04/2015
 * @category    Plugins
 * @license     MIT
 *
 */
use Phalcon\Mvc\User\Plugin as Plugin;
use \Phalcon\Tag as Tag;

class BreadcrumbsPlugin extends Plugin {

  /**
   * @var array
   */
  private $_elements = array();

  /**
   * Constructor
   */
  public function __construct() {
    $this->_elements[] = array(
        'active' => false,
        'link' => $this->tag->linkTo('/'),
        'text' => 'Home',
    );
  }

  /**
   * Adds a new element in the stack
   *
   * @param string $caption
   * @param string $link
   */
  public function add($caption, $link) {
    $this->_elements[] = array(
        'active' => false,
        'link' => $this->tag->linkTo($link),
        'text' => $caption,
    );
  }

  /**
   * Resets the internal element array
   */
  public function reset() {
    $this->_elements = array();
  }

  /**
   * Generates the JSON string from the internal array
   *
   * @return string
   */
  public function generate() {
    $lastKey = key(array_slice($this->_elements, -1, 1, true));

    $this->_elements[$lastKey]['active'] = true;

    $elements = '';

    foreach ($this->_elements as $bc) {
      if ($bc['active'])
        $elements .= "<li class='active'>{$bc['text']}</li>";
      else
        $elements .= "<li><a href='{$bc['link']}'>{$bc['text']}</a></li>";
    }

    return $elements;
  }

}

<?php

/**
 * Base model class
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       29/06/2015 22:34:59
 *
 */

namespace Nucleo\Models;

use Phalcon\Mvc\Model;

abstract class ModelBase extends Model {

  /**
   * @inheritdoc
   *
   * @access public
   * @static
   * @param array|string $parameters Query parameters
   * @return Phalcon\Mvc\Model\ResultsetInterface
   */
  public static function find($parameters = null) {
    $parameters = self::softDeleteFetch($parameters);

    return parent::find($parameters);
  }

  /**
   * @inheritdoc
   *
   * @access public
   * @static
   * @param array|string $parameters Query parameters
   * @return Phalcon\Mvc\Model
   */
  public static function findFirst($parameters = null) {
    $parameters = self::softDeleteFetch($parameters);

    return parent::findFirst($parameters);
  }

  /**
   * @inheritdoc
   *
   * @access public
   * @static
   * @param array|string $parameters Query parameters
   * @return mixed
   */
  public static function count($parameters = null) {
    $parameters = self::softDeleteFetch($parameters);

    return parent::count($parameters);
  }

  /**
   * @access protected
   * @static
   * @param array|string $parameters Query parameters
   * @return mixed
   */
  public static function softDeleteFetch($parameters = null) {
    if (method_exists(get_called_class(), 'getDelete') === false) {
      return $parameters;
    }

    $deletedField = call_user_func([get_called_class(), 'getDelete']);

    if ($parameters === null) {
      $parameters = $deletedField . ' = 0';
    } elseif (
            is_array($parameters) === false &&
            strpos($parameters, $deletedField) === false
    ) {
      $parameters .= ' AND ' . $deletedField . ' = 0';
    } elseif (is_array($parameters) === true) {
      if (
              isset($parameters[0]) === true &&
              strpos($parameters[0], $deletedField) === false
      ) {
        $parameters[0] .= ' AND ' . $deletedField . ' = 0';
      } elseif (
              isset($parameters['conditions']) === true &&
              strpos($parameters['conditions'], $deletedField) === false
      ) {
        $parameters['conditions'] .= ' AND ' . $deletedField . ' = 0';
      }
    }

    return $parameters;
  }

}

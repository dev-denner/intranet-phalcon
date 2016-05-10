<?php

namespace SysPhalcon\Models;

use SysPhalcon\Library\CustomConnectionOracle;
use Phalcon\Mvc\Model as MvcModel;

class ModelBase extends \Phalcon\Mvc\Model {

    protected $schema;

    public function initialize() {
        $this->keepSnapshots(true);
        $this->useDynamicUpdate(true);
        MvcModel::setup(['ignoreUnknownColumns' => true]);
    }

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
    protected static function softDeleteFetch($parameters = null) {
        if (method_exists(get_called_class(), 'getDeleted') === false) {
            return $parameters;
        }
        $deletedField = call_user_func([get_called_class(), 'getDeleted']);

        $columns = call_user_func([get_called_class(), 'columnMap']);
        $fields = array_keys($columns);

        if ($parameters === null) {
            $parameters = $deletedField . ' IS NULL';
        }

        if (is_int($parameters)) {
            $parameters = $fields[0] . ' = ' . $parameters . ' AND ' . $deletedField . ' IS NULL';
        }

        if (is_array($parameters) === false && strpos($parameters, $deletedField) === false) {
            $parameters .= ' AND ' . $deletedField . ' IS NULL';
        }

        if (is_array($parameters) === true) {

            if (isset($parameters[0]) === true && strpos($parameters[0], $deletedField) === false) {
                $parameters[0] .= ' AND ' . $deletedField . ' IS NULL';
            } elseif (isset($parameters['conditions']) === true && strpos($parameters['conditions'], $deletedField) === false) {

                $parameters['conditions'] .= ' AND ' . $deletedField . ' IS NULL';
            } else {
                $parameters['conditions'] = $deletedField . ' IS NULL';
            }
        }

        return $parameters;
    }

    public function autoincrement() {

        $class = get_class($this);

        $query = $this->modelsManager->createQuery('SELECT NVL(MAX(id), 0)+1 ID FROM ' . $class . '');
        $return = $query->execute();

        if (!empty($return[0])) {
            return $return[0]['ID'];
        } else {
            throw new \Exception('Erro ao processar autoincrement.');
        }
    }

    public function getHeader($form) {

        $return = [];
        $class = get_class($this);

        $desc = $class->desc();
        $typeForm = $class->typeForms()[$form];

        if (!empty($typeForm)) {
            foreach ($typeForm as $fieldTF => $permission) {
                foreach ($desc as $fieldD => $values) {
                    if ($fieldD == $fieldTF and $permission == true) {
                        if ($values['type'] == 'hidden') {
                            $title = $fieldTF;
                        } else {
                            $title = $values['title'];
                        }
                        $return[$fieldTF] = $title;
                    }
                }
            }
        }
        return $return;
    }

    public function getAttributes($form) {

        $return = [];
        $class = get_class($this);

        $desc = $class->desc();
        $typeForm = $class->typeForms()[$form];

        if (!empty($typeForm)) {
            foreach ($typeForm as $fieldTF => $permission) {
                foreach ($desc as $fieldD => $values) {
                    if ($fieldD == $fieldTF and $permission == true) {
                        $return[$fieldTF] = $values['attributes'];
                    }
                }
            }
        }
        return $return;
    }

    public function getValidation($form) {

        $return = [];
        $class = get_class($this);

        $desc = $class->desc();
        $typeForm = $class->typeForms()[$form];

        if (!empty($typeForm)) {
            foreach ($typeForm as $fieldTF => $permission) {
                foreach ($desc as $fieldD => $values) {
                    if ($fieldD == $fieldTF and $permission == true) {
                        $return[$fieldTF] = $values['validation'];
                    }
                }
            }
        }
        return $return;
    }

    protected function customConnection($serviceDb = 'protheusDb') {

        $db = $this->getDi()->getDatabases()->database->$serviceDb;
        $ora = new CustomConnectionOracle();
        $ora->connect($db->dbname, $db->username, $db->password);
        $ora->setFetchMode(OCI_ASSOC);
        $ora->setAutoCommit(true);
        $this->schema = $db->schema;
        return $ora;
    }

}

<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace App\Library\Forms;

class FormBase extends FormMaterial {

    public function getFormAttributes($type) {

        $return = [];

        switch ($type) {
            case 'search':
                $return = [
                    'legend' => 'Busca',
                    'class' => 'bgm-bluegray',
                    'value' => 'Buscar',
                    'action' => 'index',
                ];
                break;
            case 'insert':
                $return = [
                    'legend' => 'Inserção',
                    'class' => 'bgm-green',
                    'value' => 'Inserir',
                    'action' => 'create',
                ];
                break;
            case 'update':
                $return = [
                    'legend' => 'Atualização',
                    'class' => 'bgm-lime',
                    'value' => 'Atualizar',
                    'action' => 'save',
                ];
                break;
            default:
                $return = [
                    'legend' => 'Visualização',
                    'class' => 'btn-default',
                    'value' => 'OK',
                    'action' => 'view',
                ];
                break;
        }
        return $return;
    }

    /**
     *
     * @param type $name
     * @param type $attr
     * @return \Phalcon\Forms\Element\Text
     */
    protected function _text($name, $attr = []) {

        $element = new \Phalcon\Forms\Element\Text($name, $attr);
        return $element;
    }

    /**
     *
     * @param type $name
     * @param type $attr
     * @return \Phalcon\Forms\Element\Email
     */
    protected function _email($name, $attr = []) {
        $element = new \Phalcon\Forms\Element\Email($name, $attr);
        return $element;
    }

    /**
     *
     * @param type $name
     * @param type $attr
     * @return \Phalcon\Forms\Element\Password
     */
    protected function _password($name, $attr = []) {
        $element = new \Phalcon\Forms\Element\Password($name, $attr);
        return $element;
    }

    /**
     *
     * @param type $name
     * @param type $attr
     * @param type $select
     * @return \Phalcon\Forms\Element\Select
     */
    protected function _select($name, $attr = [], $select) {

        $entity = new $select['entity']();
        if (isset($select['filter'])) {
            $filter = $select['filter'];
            $dados = $entity::find($filter['field'] . " = '{$filter['value']}'");
        } else {
            $dados = $entity::find();
        }

        $selectField = $select['selectField'];
        $attr['using'] = array(
            $selectField['key'],
            $selectField['value']
        );

        if ($select['selectEmpty']) {
            $attr['useEmpty'] = true;
            $attr['emptyText'] = 'Escolha um opção';
            $attr['emptyValue'] = '';
        }

        $element = new \Phalcon\Forms\Element\Select($name, $dados, $attr);

        return $element;
    }

    /**
     *
     * @param type $name
     * @param type $attr
     * @return \Phalcon\Forms\Element\Check
     */
    protected function _checkbox($name, $attr = []) {
        $element = new \Phalcon\Forms\Element\Check($name, $attr);
        return $element;
    }

    /**
     *
     * @param type $name
     * @param type $attr
     * @return \Phalcon\Forms\Element\TextArea
     */
    protected function _textarea($name, $attr = []) {
        $element = new \Phalcon\Forms\Element\TextArea($name, $attr);
        return $element;
    }

    /**
     *
     * @param type $name
     * @param type $attr
     * @return \Phalcon\Forms\Element\Hidden
     */
    protected function _hidden($name, $attr = []) {
        $element = new \Phalcon\Forms\Element\Hidden($name, $attr);
        return $element;
    }

    /**
     *
     * @param type $name
     * @param type $attr
     * @return \Phalcon\Forms\Element\File
     */
    protected function _file($name, $attr = []) {
        $element = new \Phalcon\Forms\Element\File($name, $attr);
        return $element;
    }

    /**
     *
     * @param type $name
     * @param type $attr
     * @return \Phalcon\Forms\Element\Date
     */
    protected function _date($name, $attr = []) {
        $element = new \Phalcon\Forms\Element\Date($name, $attr);
        return $element;
    }

    /**
     *
     * @param type $name
     * @param type $attr
     * @return \Phalcon\Forms\Element\Numeric
     */
    protected function _numeric($name, $attr = []) {
        $element = new \Phalcon\Forms\Element\Numeric($name, $attr);
        return $element;
    }

    /**
     *
     * @param type $name
     * @param type $attr
     * @return \Phalcon\Forms\Element\Radio
     */
    protected function _radio($name, $attr = []) {
        $element = new \Phalcon\Forms\Element\Radio($name, $attr);
        return $element;
    }

    /**
     *
     * @param type $name
     * @param type $attr
     * @return \Phalcon\Forms\Element\Submit
     */
    protected function _submit($name, $attr = []) {
        $element = new \Phalcon\Forms\Element\Submit($name, $attr);
        return $element;
    }

    /**
     *
     * @param type $name
     * @param type $attr
     * @param type $icon
     * @return \App\Library\Forms\Button
     */
    protected function _button($name, $attr = [], $icon = null) {

        $element = new \App\Library\Forms\Button($name, $attr, $icon);
        return $element;
    }

    /**
     *
     * @param type $element
     * @return type
     */
    protected function validatorPresenceOf($element) {
        $element->addValidator(
                new \Phalcon\Validation\Validator\PresenceOf(
                array('message' => 'O campo :field não pode ficar em branco.')
        ));
        return $element;
    }

    /**
     *
     * @param type $element
     * @return type
     */
    protected function validatorEmail($element) {
        $element->addValidator(
                new \Phalcon\Validation\Validator\Email(
                ['message' => 'O campo :field não parece um e-mail válido.']
        ));
        return $element;
    }

    /**
     *
     * @param type $element
     * @param type $regex
     * @return type
     */
    protected function validatorRegex($element, $regex) {
        $element->addValidator(
                new \Phalcon\Validation\Validator\Regex(
                ['message' => 'Não é um formato válido para o campo :field.',
            'pattern' => $regex,]
        ));
        return $element;
    }

    /**
     *
     * @param type $element
     * @param type $min
     * @param type $max
     * @return type
     */
    protected function validatorStringLength($element, $min = 1, $max = 255) {
        $element->addValidator(new \Phalcon\Validation\Validator\StringLength([
            'max' => $max,
            'min' => $min,
            'messageMaximum' => 'Valor do campo :field muito longo. Max: ' . $max,
            'messageMinimum' => 'Valor do campo :field muito curto. Min: ' . $min
        ]));
        return $element;
    }

    /**
     *
     * @param type $element
     * @param type $field
     * @return type
     */
    protected function validatorConfirmation($element, $field) {
        $element->addValidator(new \Phalcon\Validation\Validator\Confirmation([
            'message' => 'Os campos :field e ' . $field . ' não coincidem.',
            'with' => $field
        ]));
        return $element;
    }

    /**
     *
     * @param type $element
     * @param type $model
     * @return type
     */
    protected function validatorUniqueness($element, $model) {
        $element->addValidator(new \Phalcon\Validation\Validator\Uniqueness([
            'model' => $model,
            'message' => 'O campo :field deve ser único.'
        ]));
        return $element;
    }

    /**
     *
     * @param type $element
     * @return type
     */
    protected function validatorIdentical($element) {
        $element->addValidator(new \Phalcon\Validation\Validator\Identical([
            'value' => $this->security->getSessionToken(),
            'message' => 'Error CSRF: Falha na validação.'
        ]));
        return $element;
    }

    /**
     *
     * @param type $name
     * @return string
     */
    public function messages($name) {
        $return = '';
        if ($this->hasMessagesFor($name)) {
            foreach ($this->getMessagesFor($name) as $message) {
                $return .= $message . '<br />';
            }
        }
        return $return;
    }

}

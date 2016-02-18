<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsersForm
 *
 * @author DennerFernandes
 */

namespace Nucleo\Forms;

class UsersForm extends \System\Forms\FormBase {

    public function initialize($entity = null, $options = array()) {

        $desc = $entity->desc();
        $typeForms = $entity->typeForms();
        
        $opt = array(
            'controller' => 'users',
            'active' => $options,
        );

        $names = $this->_typeForm($options['action']);

        $this->startFieldset($names['title'] . ' Usuários', ['class' => 'col-md-8 col-md-offset-2']);

        foreach ($typeForms as $option => $permission) {

            if ($option == $options['action']) {
                foreach ($desc as $nameInput => $attr) {
                    if ($permission[$nameInput]) {

                        $attr['active'] = $options['action'];
                        $element = $this->_element($nameInput, $attr);
                        $element = $this->_validation($element, $attr);
                        $this->add($element);
                    }
                }
            }
        }

        $element = $this->_formAtt($opt);
        $this->add($element);
        $this->endFieldset();
    }

}

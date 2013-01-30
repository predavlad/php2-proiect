<?php
class Form_Input_Text extends Form_Input_Abstract_Simple {
    // enforce text type
    public function __construct($name, $value = '', $id = '') {
        parent::__construct($name, $value, $id, 'text');
    }
}
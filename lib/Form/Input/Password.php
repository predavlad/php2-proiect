<?php
class Form_Input_Password extends Form_Input_Abstract_Simple
{
    // enforce text type
    public function __construct($name, $value = '', $id = '')
    {
        parent::__construct($name, $value, $id, 'password');
    }
}
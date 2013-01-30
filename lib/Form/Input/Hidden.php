<?php
class Form_Input_Hidden extends Form_Input_Abstract_Main
{
    // enforce hidden type
    public function __construct($name, $value = '', $id = '')
    {
        parent::__construct($name, $value, $id, 'hidden');
    }
}
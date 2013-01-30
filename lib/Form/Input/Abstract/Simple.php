<?php

abstract class Form_Input_Abstract_Simple extends Form_Input_Abstract_Main {

    protected $name;
    protected $type = 'text';
    protected $value = '';
    protected $id = '';

    public function __construct($name, $value = '', $id = '', $type = 'text') {
        parent::__construct($name, $id);
        $this->type = $type;
        $this->value = $value;
    }

    public function __toString() {
        return "
            <input
                name='{$this->name}'
                value='{$this->value}'
                type='{$this->type}'
                id='{$this->id}'
            />
        ";
    }

}
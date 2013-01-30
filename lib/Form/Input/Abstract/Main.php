<?php

abstract class Form_Input_Abstract_Main {

    protected $name;
    protected $id;
    protected $type;

    public function __construct($name, $id = '') {
        $this->name = $name;
        $this->id = $id;
    }

    abstract public function __toString();
}
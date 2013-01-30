<?php

abstract class Form_Input_Abstract_Multiple extends Form_Input_Abstract_Main {

    protected $values = array();
    protected $types = array('textarea', 'select', 'checkbox');


    public function __construct($name, $type, $id, $values) {
        parent::__construct($name, $id);
        if (!in_array($type, $this->types)) {
            throw new Exception('Not a valid type');
        } else {
            $this->type = $type;
        }
    }

    // we can expect to receive either a string, or a $key => $value pair
    public function addValue($values) {
        if (is_array($values)) {
            foreach ($values as $key => $value) {
                $this->values = array_merge($this->values, array($key => $value));
            }
        } else if (is_string($values)) {
            $this->values[] = $values;
        }
        return $this;
    }

}
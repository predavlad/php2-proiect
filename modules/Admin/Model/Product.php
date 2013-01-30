<?php

class Admin_Model_Product extends Core_Model_Core {

    public function __construct() {
        $this->tableName = 'produse';
    }

    public function getProducts($id = null, $force = false) {
        return $this->getCollection();
    }


}
<?php
/**
 * Main model that has a basic ORM
 */
class Core_Model_Core {

    protected $data = array();
    protected $isLoaded = false;
    protected $loadedCollection;
    protected $tableName;

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __get($key)
    {
        return $this->data[$key];
    }

    /**
     * add filters functionality
     */
    public function getCollection($force = false, $filters = array()) {
        if ($force == false && $this->isLoaded) {
            return $this->loadedCollection;
        }
        $db = DB::table($this->tableName);
        $collection = $db->fetchAll();
        $this->loadedCollection = $collection;
        $this->isLoaded = true;
        return $this->loadedCollection;
    }

}
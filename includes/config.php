<?php
/**
 * Config class
 * Basic implementation of the singleton and registry design patterns
 */
class Config {

    public static $instance = NULL;
    protected $data = array();

    private function __construct() {

    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new Config;
        }

        return self::$instance;
    }

    public static function set($key, $value) {

        $config = Config::getInstance();

        if (array_key_exists($key, $config->data)) {
            throw new Exception("Config class. Key `{$key}` is already set.");
        }

        $config->data[$key] = $value;

    }

    public static function exists($key) {

        $config = Config::getInstance();

        return (array_key_exists($key, $config));

    }

    public static function delete($key) {

        $config = Config::getInstance();

        unset ($config->data[$key]);

    }

    public static function get($key) {

        $config = Config::getInstance();

        if (!array_key_exists($key, $config->data)) {
//            throw new Exception("Config class. Key `{$key}` is not set.");
            return null;
        }

        return $config->data[$key];

    }


}
<?php

error_reporting(E_ALL ^ E_NOTICE);

/*
 * include the main stuff
 */
include ('includes/config.php');
include ('includes/database.php');
include ('includes/constants.php');
include ('includes/core.php');


/*
 * setup the class autoloader
 */
spl_autoload_register('Core::autoload');

/**
 * start the application
 */
try {
    Core::run();
} catch (Exception $e) {
    echo $e->getMessage();
}



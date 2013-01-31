<?php
/**
 * Just a bit of info on how the "framework" works:
 * 1. Get the route and params from the URL ( module_name/controller_name/action_name/param1/1/param2/5 )
 * $_GET isn't used, but these params are stored in Config::get('get')
 * 2. Autoloader is made so that it loads the controller based on the URL
 * For example, Product_Model_View can be found in /modules/Product/Model/View.php
 * 3. The parameters for the view are assigned in the controller. The controller doesn't work
 * directly with the models, this is handled by the template class. Each controller has its own template class
 * for interacting with the models
 * 4. The render function for templates can be called recursively. A limit should be added though.
 *
 * Made by Preda Vlad
 * Copyright @PredaVlad
 * One of those licences where you can use whatever you want and have no legal repercussions
 */
error_reporting(E_ALL ^ E_NOTICE);

session_start(); // aaaaand start the session
/*
 * include the main stuff
 */
include ('includes/config.php');
include ('includes/database.php');
include ('includes/constants.php');
include ('includes/core.php');

/*
 * setup the class autoloader(s)
 */
spl_autoload_register('Core::autoload');
spl_autoload_register('Core::libAutoload');


/**
 * start the application
 */
try {
    Core::run();
} catch (Exception $e) {
    echo $e->getMessage();
}

<?php
/**
* Some site constants
*/
Config::set('BASE', 'http://localhost/');
Config::set('FOLDER', 'php2/php2-proiect');
Config::set('SITE_URL', Config::get('BASE') . Config::get('FOLDER') );
Config::set('IMAGE_PATH', 'static/images/');
Config::set('JS_PATH', 'static/js/');
Config::set('CSS_PATH', 'static/css/');


/*
 * this is how you can set various site templates
 * for example 2 column, 1 column, simple ajax requests, etc
 */

Config::set('2col', array(
    'main' => '2col-main',
    'areas' => array(
        'head' => '2col/head.php',
        'header' => '2col/header.php',
        'left' => '2col/left.php',
        'content' => '2col/content.php',
        'footer' => '2col/footer.php'
    )
));
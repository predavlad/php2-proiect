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
Config::set('CORE_XML', 'layout/core.xml');
Config::set('LAYOUT_PATH', 'layout/modules');
<?php
/**
* PDO connection
*/
$db = new PDO('mysql:dbname=proiect;host=localhost', 'root', '');

Config::set('db', $db);
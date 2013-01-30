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
 * OPEN SOURCE FTW !!! I used so much open source code (who am I kidding - cracked torrents) so far I owe the world a few millions of free code lines :)
 * I'm just doing my share for this corrupt society we live in, where money matter more than what you think and what you are.
 * Unfortunately I gave in. I am one of the materialist, selfish and superficial people out there. At least I know what I am, and I understand what this world can do to people. To everyone. Even to smart, rational people.
 * Marketing is a whore. It makes me want to buy a f..king galaxy note 2 which I don't f..king need.
 * But alcohol makes things better. For a few minutes, and then everything goes bad. I start feeling depressed when I drink, but at least I have strong feelings about something.
 * I don't care ... at all. About nobody. I think I should care about my family ... and I think I do. I just don't want to spend time with them. I really wonder why, because they are smart people.
 * I can talk to them about biology, and physics, and even learn from them. But for some reason, they are so boring and annoying I can barely stand to talk to them for more than 20 minutes.
 *
 * My rant went on for more than enough, I should stop before GIT thinks I want to commit this code with these retarded, drunken comments. Who knows, maybe I will commit and forget I placed this code here. I need a hooker, and I'm probably in the best place to get one. Except I am writing code instead of doing something ... fun. Fuck programming and programmers like me ... we waste our lives to do things we're not appreciated for. F..k this economy where you have to work 8h / day to be able to survive. I would think that technology would allow us to live comfortably, and the people who want to be over the rest should work for a few hours / day.
 * Here are some jobs that would be pointless if there was no need for money: Banking, Stock exchange(or whatever the fuck this is called, but both these first 2 groups are cunts). And let's not talk about the adevertisers, those are the real cunts out there.They make you wanna buy something you don't need are you know doesn't work. They play with your brain man ... that's how good they are.
 * Anyway ... I should go to sleep now, good night !!!
 *
 * This code is on github somewhere. Who the hell cares.
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

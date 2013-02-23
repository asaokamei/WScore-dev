<?php
// load Composer's autoloader. 
require_once( __DIR__ . '/../vendor/autoload.php' );

// register autoloader for Apps. 
$loader = new \Composer\Autoload\ClassLoader();
$loader->add( 'App', __DIR__.'' );
$loader->register();


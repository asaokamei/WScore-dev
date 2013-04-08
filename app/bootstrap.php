<?php
// load Composer's autoloader. 
require_once( __DIR__ . '/../vendor/autoload.php' );
require_once( __DIR__ . '/boot.php' );
// register autoloader for Apps. 
$loader = new \Composer\Autoload\ClassLoader();
$loader->add( 'App', dirname( __DIR__ ) . '/src/' );
$loader->add( 'Demo', dirname( __DIR__ ) . '/src/' );
$loader->register();

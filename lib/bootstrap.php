<?php
// load Composer's autoloader. 
require_once( __DIR__ . '/../vendor/autoload.php' );
require_once( __DIR__ . '/App/boot.php' );
// register autoloader for Apps. 
$loader = new \Composer\Autoload\ClassLoader();
$loader->add( 'App', __DIR__.'' );
$loader->register();

return getApp( 'WsDemo-app', $boot );

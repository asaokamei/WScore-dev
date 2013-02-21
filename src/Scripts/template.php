<?php
use \App\Site\App;
$view = require( __DIR__ . '/../../vendor/wscore/template/scripts/instance.php' );
$view->set( 'basePath', '/WSdev' ); // not good.
$view->parent( \App\Site\App::$template_root . '/layout.php' );
return $view;
<?php
$view = require( __DIR__ . '/../../vendor/wscore/template/scripts/instance.php' );
$view->set( 'basePath', '/WSdev' ); // not good.
$view->parent( __DIR__ . '/../../template/layout.php' );
return $view;
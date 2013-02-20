<?php
$view = require( __DIR__ . '/../../../vendor/wscore/template/scripts/instance.php' );
$view->set( 'basePath', '/WSdev' ); // not good.
return $view;
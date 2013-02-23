<?php
$app = require_once( __DIR__ . '/../lib/bootstrap.php' );
/** @var $app App\App */
$app->pathInfo( $_SERVER );
$response = $app->run();
if( $response ) $response->send();
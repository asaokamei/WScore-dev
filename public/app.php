<?php
require_once( __DIR__ . '/../lib/bootstrap.php' );
use \App\Site\App;

$app = App::$app;
$app->pathInfo( $_SERVER );
$response = $app->run();
if( $response ) $response->send();
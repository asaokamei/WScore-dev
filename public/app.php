<?php
require_once( __DIR__ . '/../lib/bootstrap.php' );
use \App\Site\App;

$app = App::getCached();
$app->pathInfo( $_SERVER );
$response = $app->run();
if( $response ) $response->send();
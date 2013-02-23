<?php
require_once( __DIR__ . '/../lib/bootstrap.php' );
use \App\App;

$app = App::getCached();

/** @var $view WScore\Template\Template */
$view = $app->container->get( 'Template' );
$view->renderSelf();

phpinfo();
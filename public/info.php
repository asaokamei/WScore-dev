<?php
require_once( __DIR__ . '/../lib/bootstrap.php' );
use \App\App;

/** @var $view WScore\Template\Template */
$view = App::$service->get( 'Template' );
$view->renderSelf();

phpinfo();
<?php
$app = require_once( __DIR__ . '/../lib/bootstrap.php' );

/** @var $view WScore\Template\Template */
$view = $app->container->get( 'Template' );
$view->renderSelf();

phpinfo();
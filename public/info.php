<?php
require_once( __DIR__ . '/../lib/bootstrap.php' );
$app = App\getApp( 'info', false );

    /** @var $view WScore\Template\TemplateInterface */
$view = $app->container->get( 'TemplateInterface' );
$view->renderSelf();

phpinfo();
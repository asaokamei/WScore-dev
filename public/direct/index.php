<?php
require_once( __DIR__ . '/../../app/bootstrap.php' );
$app = App\getApp( 'WsDemo-app', true );
/** @var $app Demo\Web */
/** @var $view \Demo\Classes\Template */
$view = $app->container->get( 'TemplateInterface' );
$root = $app->container->get( 'rootDirectory' );
$view->addParent( $root . '/documents/layout.php' );
$view->renderSelf();
$view->set( 'baseUrl', '/WSdev/' );

?>
<h4>Direct Folder</h4>
<p>contents under this directory is rendered directly, not through the web-application. </p>
<h1>Top of Direct Folder</h1>
<div class="row-fluid marketing">
    <div class="span6">

        <h3>Direct View</h3>
        <p>this page is rendered directly, i.e. skipping front-end dispatcher. </p>
        <p>not sure how useful this is. demonstration of renderSelf function in WScore\Template. </p>

    </div>
    <div class="span6">

        <h3>Setting View</h3>
        <p>set up template ($view in this source code) to render the page inside a common layout. </p>

    </div>
    <div class="span6">
    </div>
</div>

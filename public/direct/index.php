<?php
require_once( __DIR__ . '/../../lib/bootstrap.php' );
$app = App\getApp( 'info', false );
/** @var $app App\App */
/** @var $view WScore\Template\TemplateInterface */
$view = $app->container->get( 'TemplateInterface' );
$view->renderSelf();

?>
<h4>Direct Folder</h4>
<p>contents under this directory is rendered directly, not through the web-application. </p>
<h1>Top of Direct Folder</h1>
<div class="row-fluid marketing">
    <div class="span6">
        <h3>brah brah</h3>
        <p>aasdf asdf asdfasd fasdf asdf asfawea efasdfa sdfad fasdf asdfa sfasd fasd. </p>
    </div>
    <div class="span6">
        <h3>more brah</h3>
        <p>qwerqwer qwerqwerq werq werqwe rqwerqwerqwertqwerqwerqwe . </p>
        <p>a l ljl ;lj lj;lkjkloiuo ij  ljl jl; j;lj lkj; kll;l . </p>
    </div>
    <div class="span12">
        <p>12394123904712390 123 4129384 12394 12 4129038 41928074 0129 741209 412...</p>
    </div>
</div>

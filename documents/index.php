<?php
/** @var $this \Demo\Classes\Template */
$this->set( 'HomePage', true );

?>
    <style type="text/css">

            /* Main marketing message and sign up button */
        .jumbotron {
            margin: 30px 0;
            text-align: center;
        }
        .jumbotron h1 {
            font-size: 60px;
            line-height: 1;
        }
        .jumbotron .btn {
            font-size: 20px;
            padding: 10px 10px;
        }
        .marketing {
            margin: 30px 0;
        }
    </style>
    <header class="jumbotron">
        <h1>WScore framework ♫</h1>
        <p class="lead">Simple Data Mapper and Cena data transfer agent <br />for web application development.</p>
        <a href="https://github.com/asaokamei/WScore-dev" class="btn btn-success">see it at GitHub</a>
        <hr>
    </header>
    <div class="row-fluid marketing">
        <div class="span6">
            <h3>About WScore</h3>

            <h4>&gt; <a href="templates/index" >about WScore</a></h4>
            <p>documents about WScore framework. some are written in markdown, others are html. </p>

            <h4>&gt; error pages</h4>
            <p>sample error pages.  <br />
                [<a href="direct/">direct</a>]
                [<a href="templates/badRequest.php" >bad request</a>] 
                [<a href="templates/noService.php" >no service</a>]</p>

            <h3>Caches, etc.</h3>
            <p>majority of the application is cached into APC as a single object image, as inspired (copied) from BEAR.Sunday.</p>
            <p>[<a href="cache.php" >cache.php</a>] [<a href="apc.php" >apc</a>] [<a href="info.php" >phpinfo</a>]</p>

        </div>
        <div class="span6">

            <h3>Sample Applications</h3>

            <h4>&gt; <a href="password/index.php" >generate password</a></h4>
            <p>demo for building form elements.</p>

            <h4>&gt; <a href="tasks/" >task/todo application</a></h4>
            <p>a simple task/todo manager using data mapper, model, and entity. </p>

            <h4>&gt; <a href="contacts/" >contacts using Cena</a></h4>
            <p>a conceptual demo for using Cena-DTA using friends and contact demo. </p>

        </div>
    </div>

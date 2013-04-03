<?php
/** @var $this WScore\Template\Template */
$this->HomePage = true;

?>
    <style type="text/css">

            /* Main marketing message and sign up button */
        .jumbotron {
            margin: 20px 0;
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
            margin: 20px 0;
        }
    </style>
    <header class="jumbotron">
        <h1>WScore framework</h1>
        <p class="lead">Simple Data Mapper and Cena data transfer agent <br />for web application development.</p>
        <a href="https://github.com/asaokamei/WScore-dev" class="btn btn-success">see it at GitHub</a>
        <hr>
    </header>
    <div class="row-fluid marketing">
        <div class="span6">
            <h3>Serving Html Files</h3>
            <h4>&gt; <a href="direct/" >direct</a></h4>
            <p>viewing files under public directly. </p>
            <h4>&gt; <a href="templates/index.php" >from template folder</a></h4>
            <p>viewing files under template folder (outside of public). 
                [<a href="templates/badRequest.php" >bad request</a>] [<a href="templates/noService.php" >no service</a>]</p>
            <h3>Simple Applications</h3>
            <h4>&gt; <a href="password/index.php" >generate password</a></h4>
            <p>demo for building form elements. 
                another demo using AppLoader (<a href="pwd/" >pwd</a>). </p>
        </div>
        <div class="span6">
            <h3>DataBase Sample</h3>
            <h4>&gt; <a href="tasks/" >task/todo application</a></h4>
            <p>demo for using data mapper, model, and entity. </p>
            <h4>&gt; <a href="contacts/" >contacts using Cena</a></h4>
            <p>a conceptual demo for using Cena-DTA using friends and contact demo. </p>
            <h3>Caching Application</h3>
            <p>majority of the application is cached into APC as a single object image, as inspired (copied) from BEAR.Sunday.</p>
        </div>
    </div>

<?php
/** @var $this WScore\Template\Template */
$this->HomePage = true;

?>
    <style type="text/css">

            /* Main marketing message and sign up button */
        .jumbotron {
            margin: 60px 0;
            text-align: center;
        }
        .jumbotron h1 {
            font-size: 60px;
            line-height: 1;
        }
        .jumbotron .btn {
            font-size: 21px;
            padding: 14px 24px;
        }
    </style>
    <header class="jumbotron">
        <h1>WScore framework</h1>
        <p class="lead">Data Mapper and Cenatar technology for web applications.<br />
            Wishes wishes wishes. </p>
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
            <h4>&gt; <a href="tasks/" >task/todo application</a></h4>
            <p>demo for using data mapper, model, and entity. </p>
        </div>
        <div class="span6">
            <h3>Experimental Demo</h3>
            <h4>&gt; <a href="cenaFriends" >contacts using Cena</a></h4>
            <p>a conceptual demo for using Cena-DTA using friends and contact demo. </p>
            <h4>&gt; interaction with forms</h4>
            <p>demo for data mapper and interactions. </p>
            <ul>
                <li><a href="interaction1.php" >demo #1: insert friend's data</a></li>
                <li><a href="interaction2.php" >demo #2: interaction like a wizard</a></li>
            </ul>
            <h3>Caching Application</h3>
            <p>development still undergoing. more demo should come up, hopefully sometime soon...</p>
            <p>[<a href="info.php">php info</a>],
                [<a href="cache.php" >apc info</a>],
                [<a href="cache.php?act=cache-clear" >clear apc cache</a>], </p>
        </div>
    </div>

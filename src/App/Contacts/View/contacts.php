<?php

/** @var $this \WScore\Template\TemplateInterface */
$baseUrl = $this->get( 'baseUrl' );
$taskUrl = $this->get( 'appUrl' );
$appRoot = $this->get( 'appRoot' );

?>
    <style type="text/css">
        ul.subMenu { clear: both; float: right;}
    </style>
    <ul class="nav nav-pills subMenu">
        <li><a href="<?php echo $appRoot; ?>" >Contacts</a></li>
        <li><a href="<?php echo $appRoot; ?>create" >Add New</a></li>
        <li><a href="<?php echo $appRoot; ?>tags" >Tags</a></li>
        <li><a href="<?php echo $appRoot; ?>setup" >setup</a></li>
    </ul>
    <h4>contacts demo with Cena</h4>
    <!-- HtmlTest: Needle=Tasks/View/task -->
    <p>contacts demo application using Cena data transfer agent. </p>
    <div style="clear:both">
    </div>
    <h1><?= $this->get( 'title' ); ?></h1>
<?php

if( $this->get( 'alert' ) ) {
    echo 'alert'; 
    echo $view->get( 'alert' );
}

echo $this->get( 'content' );

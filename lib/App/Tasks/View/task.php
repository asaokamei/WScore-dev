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
        <li><a href="<?php echo $appRoot; ?>" >My Tasks</a></li>
        <li><a href="<?php echo $appRoot; ?>create" >New Task</a></li>
        <li><a href="<?php echo $appRoot; ?>setup" >setup</a></li>
    </ul>
    <h4>task/todo demo</h4>
    <p>task/todo application using data mapper and basic MVC. </p>
    <div style="clear:both">
    </div>
    <h1><?= $this->get( 'title' ); ?></h1>
<?php

if( $this->get( 'alert' ) ) {
    echo 'alert'; 
    echo $view->get( 'alert' );
}

echo $this->get( 'content' );

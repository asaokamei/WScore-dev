<?php

/** @var $this \Demo\Classes\Template */
$baseUrl = $this->get( 'baseUrl' );
$taskUrl = $this->get( 'appUrl' );
$appRoot = $this->get( 'appRoot' );
$render  = $this->get( 'render' );
$render  = substr( $render, 1 ); // remove first slash... 

// build menus.
$menu = array(
    array( 'title' => 'Contacts', 'icon' => 'home',    'url' => $appRoot,          ),
    array( 'title' => 'New',      'icon' => 'edit',    'url' => $appRoot.'create', ),
    array( 'title' => 'Tags',     'icon' => 'hand-up', 'url' => $appRoot.'tags', ),
    array( 'title' => 'Setup',    'icon' => 'file',    'url' => $appRoot.'setup',  ),
);
$menu = $this->score->setMenu( $menu, $appRoot . $render );
$this->menu->setMenu( $menu )->setTags( 'pill' );

?>
    <style type="text/css">
        div#taskMenu { clear: both; float: right;}
    </style>
    <div id="taskMenu">
        <?php echo $this->menu->draw(); ?>
    </div>
    <h4>contacts demo with Cena</h4>
    <!-- HtmlTest: Needle=Tasks/View/task -->
    <p>contacts demo application using Cena data transfer agent. </p>
    <div style="clear:both">
    </div>
    <h1><?= $this->get( 'title' ); ?></h1>
<?php

if( $this->get( 'alert' ) ) {
    $alert = $this->get( 'alert' );
    echo '<div class="alert alert-error">
      <strong>Error:</strong><br/>
      <strong>' .$alert.'</strong>
    </div>';
}

echo $this->get( 'content' );

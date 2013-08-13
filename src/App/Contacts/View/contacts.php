<?php

/** @var $this \Demo\Classes\Template */
$appRoot = $this->get( 'requestRoot' );

// build menus.
$menu = array(
    array( 'title' => 'Contacts', 'icon' => 'home',    'url' => $appRoot,          ),
    array( 'title' => 'New',      'icon' => 'edit',    'url' => $appRoot.'create', ),
    array( 'title' => 'Tags',     'icon' => 'hand-up', 'url' => $appRoot.'tags', ),
    array( 'title' => 'Setup',    'icon' => 'file',    'url' => $appRoot.'setup',  ),
);
$this->set( 'sub_menu', $menu );

?>
    <h4>contacts demo with Cena</h4>
    <!-- HtmlTest: Needle=Tasks/View/task -->
    <p>contacts demo application using Cena data transfer agent. </p>
    <div style="clear:both">
    </div>
    <h1><?= $this->get( 'title' ); ?></h1>
<?php

echo $this->get( 'content' );

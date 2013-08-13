<?php

/** @var $this \Demo\Classes\Template */
$appRoot = $this->get( 'requestRoot' );

// build menus.
$menu = array(
    array( 'title' => 'Tasks',    'icon' => 'home', 'url' => $appRoot,          ),
    array( 'title' => 'New',      'icon' => 'edit', 'url' => $appRoot.'create', ),
    array( 'title' => 'Setup',    'icon' => 'file', 'url' => $appRoot.'setup',  ),
);
$this->set( 'sub_menu', $menu );

?>
    <h4>task/todo demo</h4>
    <!-- HtmlTest: Needle=Tasks/View/task -->
    <p>task/todo application using data mapper and basic MVC. </p>
    <div style="clear:both">
    </div>
    <h1><?= $this->get( 'title' ); ?></h1>
<?php

echo $this->get( 'content' );

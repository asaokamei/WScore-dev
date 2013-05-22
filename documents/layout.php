<?php

/** @var $this \Demo\Classes\Template */
$baseUrl = $this->get( 'baseUrl' );
$pathInfo= $this->get( 'pathInfo' );

// build menus.
$menu = array(
    array( 'title' => 'Top',      'icon' => 'home',      'url' => $baseUrl, ),
    array( 'title' => 'About',    'icon' => 'file',      'url' => $baseUrl.'templates/index',  ),
    array( 'title' => 'Password', 'icon' => 'plus-sign', 'url' => $baseUrl.'password/index',  ),
    array( 'title' => 'Tasks',    'icon' => 'edit',      'url' => $baseUrl.'tasks/', ),
    array( 'title' => 'Contacts', 'icon' => 'hand-up',   'url' => $baseUrl.'contacts/', ),
);
$menu = $this->score->setMenu( $menu, $baseUrl.$pathInfo );
$menu = $this->menu->setMenu( $menu )->setTags( 'tabs' )->draw();

if( $subMenu = $this->get( 'sub_menu' ) ) {
    $subMenu = $this->score->setMenu( $subMenu, $baseUrl.$pathInfo );
    $subMenu = $this->menu->setMenu( $subMenu )->setTags( 'pill' )->draw();
} else {
    $subMenu = '';
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>bootstrap/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>bootstrap/css/main.css" />
    <title>WScore Public Demo</title>
    <style type="text/css">
        div#mainMenu ul {
            margin-bottom: 5px;
        }
        div#subMenu ul {
            margin-bottom: 5px;
            clear: both; 
            float: right;
        }
    </style>
</head>
<body>
<!-- HtmlTest: Needle=documents/layout -->
<div class="container-narrow">
    <div class="masthead">
        <?php if( $this->HomePage ) { ?>
            <h3 class="muted">WScore Demo</h3>
        <?php } else { ?>
            <h3 class="muted"><a href="<?php echo $this->baseUrl;?>index">WScore Demo</a></h3>
        <?php  } ?>
            <div id="mainMenu">
                <?php echo $menu; ?>
            </div>
            <div id="subMenu">
                <?php echo $subMenu; ?>
            </div>
        <div style="clear:both;"></div>
    </div>
    <?php
    // displaying alerts. 
    if( $this->get( 'alert' ) ) {
        $alert = $this->get( 'alert' );
        echo '
        <div class="alert alert-error">
          <strong>Error:</strong><br/>
          <strong>' .$alert.'</strong>
        </div>
        ';
    }
    ?>
    <?php echo $this->get( 'content' ); ?>
    <footer class="footer">
        <hr>
        <p>WScore Developed by WorkSpot.JP<br />
            thanks, bootstrap. </p>
    </footer>
</div>
</body>
</html>

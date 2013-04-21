<?php

/** @var $this \Demo\Classes\Template */
$baseUrl = $this->get( 'baseUrl' );
$appRoot = $this->get( 'appRoot' );
$appRoot = substr( $appRoot, 1 ); // remove first slash... 

// build menus.
$menu = array(
    array( 'title' => 'Top',      'icon' => 'home',    'url' => $baseUrl, ),
    array( 'title' => 'Password', 'icon' => 'home',    'url' => $baseUrl.'pwd/index',  ),
    array( 'title' => 'Tasks',    'icon' => 'edit',    'url' => $baseUrl.'tasks/', ),
    array( 'title' => 'Contacts', 'icon' => 'hand-up', 'url' => $baseUrl.'contacts/', ),
    array( 'title' => 'About',    'icon' => 'file',    'url' => $baseUrl.'templates/index',  ),
);
$menu = $this->score->setMenu( $menu, $baseUrl.$appRoot );
$this->menu->setMenu( $menu )->setTags( 'tabs' );

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>bootstrap/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>bootstrap/css/main.css" />
    <title>WScore Public Demo</title>
</head>
<body>
<!-- HtmlTest: Needle=documents/layout -->
<style type="text/css">
    div#mainMenu > ul { clear: both; float: right;}
</style>
<div class="container-narrow">
    <div class="masthead">
        <h3 class="muted"><?php if( $this->HomePage ) { ?>WScore Public Demo<?php } else { echo "<a href=\"{$this->baseUrl}index.php\">WScore Public Demo</a>"; } ?></h3>
        <div id="mainMenu">
            <?php echo $this->menu->draw(); ?>
        </div>
        <div style="clear:both;"></div>
    </div>
    <?php echo $this->get( 'content' ); ?>
    <footer class="footer">
        <hr>
        <p>WScore Developed by WorkSpot.JP<br />
            thanks, bootstrap. </p>
    </footer>
</div>
</body>
</html>

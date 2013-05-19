<?php
/** @var $this \Demo\Classes\Template */

$appRoot = $this->get( 'appURL' );
$render  = $this->get( 'appInfo' );
$render  = substr( $render, 1 ); // remove first slash... this looks like a bad-know-how. 

$menu = array(
    array( 'title' => 'WScore',        'url' => $appRoot.'templates/index',          ),
    array( 'title' => 'Cena-DTA',      'url' => $appRoot.'templates/cena', ),
    array( 'title' => 'Inspirations',  'url' => $appRoot.'templates/inspired',  ),
);
$menu = $this->score->setMenu( $menu, $appRoot . $render );
$this->menu->setMenu( $menu )->setTags( 'pill');

?>
<style type="text/css">
    ul.subMenu { clear: both; float: right;}
</style>
<!-- HtmlTest: Needle=documents/template -->
<ul class="subMenu">
    <?php echo $this->menu->draw(); ?>
</ul>
<h4>documents</h4>
<p>some texts about WScore Framework. </p>
<?php echo $this->get( 'content' ); ?>

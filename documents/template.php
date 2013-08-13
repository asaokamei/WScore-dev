<?php
/** @var $this \Demo\Classes\Template */

$appRoot = $this->get( 'requestRoot' );

$menu = array(
    array( 'title' => 'WScore',        'url' => $appRoot.'templates/index',          ),
    array( 'title' => 'Cena-DTA',      'url' => $appRoot.'templates/cena', ),
    array( 'title' => 'Inspirations',  'url' => $appRoot.'templates/inspired',  ),
);
$this->set( 'sub_menu', $menu );

?>
<!-- HtmlTest: Needle=documents/template -->
<h4>documents</h4>
<p>some texts about WScore Framework. </p>
<?php echo $this->get( 'content' ); ?>

<?php
/** @var $this \WScore\Template\PhpTemplate */

$appRoot = $this->get( 'appURL' );
$menu = array(
    array( 'title' => 'New Passwords', 'url' => $appRoot.'password/index',          ),
);
$this->set( 'sub_menu', $menu );

?>
<!-- HtmlTest: Needle=documents/password -->
<h4>Password</h4>
<p>generates password as you like. </p>
<?php echo $this->get( 'content' ); ?>

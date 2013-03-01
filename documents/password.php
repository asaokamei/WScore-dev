<?php
/** @var $_v \WScore\Template\Template */
$_v->parent( 'layout.php' );
?>
<style type="text/css">
    ul.subMenu { clear: both; float: right;}
</style>
<ul class="nav nav-pills subMenu">
    <li><a href="index.php" >New Passwords</a></li>
</ul>
<h4>Password</h4>
<p>generates password as you like. </p>
<?php echo $_v->get( 'content' ); ?>

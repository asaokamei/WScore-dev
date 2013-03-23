<?php
/** @var $this \WScore\Template\Template */
$this->parent( 'layout.php' );
?>
<style type="text/css">
    ul.subMenu { clear: both; float: right;}
</style>
<!-- Template: documents/password -->
<ul class="nav nav-pills subMenu">
    <li><a href="index.php" >New Passwords</a></li>
</ul>
<h4>Password</h4>
<p>generates password as you like. </p>
<?php echo $this->get( 'content' ); ?>

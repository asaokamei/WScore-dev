<?php
/** @var $this \WScore\Template\Template */
?>
<style type="text/css">
    ul.subMenu { clear: both; float: right;}
</style>
<!-- HtmlTest: Needle=documents/password -->
<ul class="nav nav-pills subMenu">
    <li><a href="index.php" >New Passwords</a></li>
</ul>
<h4>Password</h4>
<p>generates password as you like. </p>
<?php echo $this->get( 'content' ); ?>

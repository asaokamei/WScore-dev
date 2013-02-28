<?php
/** @var $this \WScore\Template\TemplateInterface */
$this->setParent( 'layout.php' );
?>
<style type="text/css">
    ul.subMenu { clear: both; float: right;}
</style>
<ul class="nav nav-pills subMenu">
    <li><a href="index.php" >Top</a></li>
    <li><a href="another.php" >Another</a></li>
    <li><a href="html.html" >Html</a></li>
</ul>
<h4>Template Folder</h4>
<p>contents under template folder is rendered here. </p>
<?php echo $this->get( 'content' ); ?>

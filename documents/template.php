<?php
/** @var $this \WScore\Template\TemplateInterface */
?>
<style type="text/css">
    ul.subMenu { clear: both; float: right;}
</style>
<!-- HtmlTest: Needle=documents/template -->
<ul class="nav nav-pills subMenu">
    <li><a href="index.php" >Top</a></li>
    <li><a href="another.php" >Another</a></li>
    <li><a href="html.html" >Html</a></li>
</ul>
<h4>documents</h4>
<p>some texts about WScore Framework. </p>
<?php echo $this->get( 'content' ); ?>

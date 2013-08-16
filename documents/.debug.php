<?php
/** @var $this \WScore\Template\TemplateInterface */
?>
<?php echo $this->get( 'content' ); ?>
<div class="navbar navbar-fixed-bottom">
    <div class="navbar-inner">
        <a class="brand" href="#">_debug:</a>
        <ul class="nav">
            <li><a href="<?php echo $this->baseUrl;?>apc.php">APC</a></li>
            <li><a href="<?php echo $this->baseUrl;?>cache.php?act=cache-clear" >Clear cache</a></li>
            <li><a href="<?php echo $this->baseUrl;?>info.php">php info</a></li>
        </ul>
    </div>
</div>

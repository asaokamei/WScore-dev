<?php
/** @var $this \WScore\Template\TemplateInterface */
$this->setDefault( 'basePath', '/WSdev')
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->basePath; ?>/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->basePath; ?>/bootstrap/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->basePath; ?>/bootstrap/css/main.css" />
    <title>WScore Public Demo</title>
</head>
<body>
<!-- HtmlTest: Needle=documents/layout -->
<div class="container-narrow">
    <div class="masthead">
        <h3 class="muted"><?php if( $this->HomePage ) { ?>WScore Public Demo<?php } else { echo "<a href=\"{$this->basePath}/index.php\">WScore Public Demo</a>"; } ?></h3>
    </div>
    <hr>
    <?php echo $this->get( 'content' ); ?>
    <footer class="footer">
        <hr>
        <p>WScore Developed by WorkSpot.JP<br />
            thanks, bootstrap. </p>
    </footer>
    <div class="navbar navbar-fixed-bottom">
        <div class="navbar-inner">
            <div class="container">
                some debug info
            </div>
        </div>
    </div>
</div>
</body>
</html>

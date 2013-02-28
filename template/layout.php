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
    <style type="text/css">

            /* Main marketing message and sign up button */
        .jumbotron {
            margin: 60px 0;
            text-align: center;
        }
        .jumbotron h1 {
            font-size: 60px;
            line-height: 1;
        }
        .jumbotron .btn {
            font-size: 21px;
            padding: 14px 24px;
        }
    </style>
</head>
<body>
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
</div>
</body>
</html>
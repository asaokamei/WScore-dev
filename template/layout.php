<?php
/** @var $_v \WScore\Template\Template */
$_v->setDefault( 'basePath', '/WSdev')
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo $_v->basePath; ?>/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $_v->basePath; ?>/bootstrap/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $_v->basePath; ?>/bootstrap/css/main.css" />
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
        <h3 class="muted">WScore Public Demo</h3>
    </div>
    <hr>
    <?php echo $_v->get( 'content' ); ?>
    <footer class="footer">
        <hr>
        <p>WScore Developed by WorkSpot.JP<br />
            thanks, bootstrap. </p>
    </footer>
</div>
</body>
</html>
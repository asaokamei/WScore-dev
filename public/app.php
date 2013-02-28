<?php
$app = require_once( __DIR__ . '/../lib/bootstrap.php' );
/** @var $app App\App */
try {

    $app->pathInfo( $_SERVER );
    $response = $app->run();
    if( $response ) {
        $response->send();
        exit;
    }
// no response means nothing found.
    $app->template->setTemplate( 'errors/e404.php' );
    echo $app->template->render();

} catch ( Exception $e ) {
    $code = $e->getCode();
    if( !in_array( $code, array( '400', '404' ) ) ) $code = '503';
    $app->template->setTemplate( "errors/e{$code}.php" );
    echo $app->template->render();
}

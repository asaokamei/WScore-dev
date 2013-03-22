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
    echo $app->template->setTemplate( 'errors/e404.php' )->render();

} catch ( Exception $e ) {
    $code = $e->getCode();
    $app->template->set( 'code', $code );
    if( !in_array( $code, array( '400', '404' ) ) ) $code = '503';
    echo $app->template->setTemplate( "errors/e{$code}.php" )->render();
}

<?php
$app = require_once( __DIR__ . '/../lib/bootstrap.php' );
/** @var $app App\App */
try {

    $app->pathInfo( $_SERVER );
    $response = $app->run();
    if( $response ) $response->send();
// no response means nothing found.
    echo $app->template->render( 'errors/e404.php' );

} catch ( Exception $e ) {
    $code = $e->getCode();
    if( !in_array( $code, array( '400', '404' ) ) ) $code = '503';
    echo $app->template->render( "errors/e{$code}.php" );
}

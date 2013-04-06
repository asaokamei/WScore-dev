<?php
require_once( __DIR__ . '/../app/bootstrap.php' );

// router.php
if (php_sapi_name() == 'cli-server') {
    /* route static assets and return false */
    if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js)$/', $_SERVER["REQUEST_URI"])) {
        return false;    // serve the requested resource as-is.
    }
}

try {

    // make app object.
    /** @var $app App\App */
    $app = App\getApp( 'WsDemo-app', true );
    $app = App\debugApp( $app );

    // set app for serving web. 
    $app->pathInfo( $_SERVER );
    $app->logger->info( 'app->run', array( 'time' => date( 'Y-m-d H:i:s' ), 'path' => $app->pathInfo ) );
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
    if( !in_array( $code, array( '400', '404' ) ) ) {
        // last minute log about the crash.
        if( isset( $app ) && isset( $app->logger ) ) {
            $app->logger->critical( 'crashed', array( 'exception' => $e ) );
        }
        $code = '503';
    }
    echo $app->template->setTemplate( "errors/e{$code}.php" )->render();
}

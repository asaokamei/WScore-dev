<?php
use Monolog\Processor\UidProcessor;

require_once( __DIR__ . '/../app/bootstrap.php' );

try {

    // make app object.
    /** @var $app Demo\Web */
    if( !isset( $runMode ) ) {
        $app = App\getApp( 'WsDemo-app', true );
    } elseif( $runMode == 'debug' ) {
        $app = App\getApp( 'WsDemo-app', false );
        $app = App\debugApp( $app );
    }

    // set app for serving web. 
    $app->pathInfo( $_SERVER )->with( $_POST )->on( $app->request->getMethod() );
    $app->logger->pushProcessor( new UidProcessor() );
    $app->logger->info( 'app->run', array( 'time' => date( 'Y-m-d H:i:s' ), 'path' => $app->pathInfo, 'on' => $app->method ) );
    $response = $app->load();
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

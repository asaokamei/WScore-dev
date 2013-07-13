<?php
use Monolog\Processor\UidProcessor;

if( !isset( $runMode ) ) {
    $runMode = 'prod';
}

require_once( __DIR__ . '/../app/bootstrap.php' );

try {

    // make app object.
    /** @var $app Demo\Web */
    if( $runMode == 'debug' ) {
        $app = App\getApp( 'WsDemo-app', false );
        $app = App\debugApp( $app );
    } else {
        $app = App\getApp( 'WsDemo-app', true );
    }

    // set app for serving web. 
    $app->setHttpRequest( $_SERVER, $_POST );
    $app->logger->pushProcessor( new UidProcessor() );
    $app->logger->info( 'app->run', array( 'time' => date( 'Y-m-d H:i:s' ), 'path' => $app->request->pathInfo, 'on' => $app->request->method ) );
    $response = $app->respond();
    if( $response ) {
        $app->render()->emit();
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

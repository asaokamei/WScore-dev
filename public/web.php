<?php
use Monolog\Processor\UidProcessor;

if( !isset( $runMode ) ) {
    $runMode = 'debug';
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
    $app->setHttpRequest( $_SERVER, $_GET + $_POST );
    $app->logger->pushProcessor( new UidProcessor() );
    $app->logger->info( 'app->run', array( 
        'time' => date( 'Y-m-d H:i:s' ), 
        'path' => $app->request->getInfo( 'pathInfo' ), 
        'on'   => $app->request->getInfo( 'requestMethod' ) ) );
    $response = $app->respond();
    if( $response ) {
        $app->render()->emit();
        exit;
    }
    // no response means nothing found.
    echo $app->renderer->setTemplate( 'errors/e404.php' )->render();

} catch ( Exception $e ) {

    $code = $e->getCode();
    $app->renderer->set( 'code', $code );
    if( !in_array( $code, array( '400', '404' ) ) ) {
        // last minute log about the crash.
        if( isset( $app ) && isset( $app->logger ) ) {
            $app->logger->critical( 'crashed', array( 'exception' => $e ) );
        }
        $code = '503';
    }
    echo $app->renderer->setTemplate( "errors/e{$code}.php" )->render();
}

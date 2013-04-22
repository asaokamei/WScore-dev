<?php
namespace App;

use Monolog\Formatter\ChromePHPFormatter;
use Monolog\Handler\ChromePHPHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * @param bool     $cache
 * @return \Demo\Web
 */
function buildApp( $cache )
{
    // set up folders.
    $root = dirname( __DIR__ );

    // set up container/service. 
    /** @noinspection PhpIncludeInspection */
    if( $cache ) {
        $service = include( $root . '/vendor/wscore/dicontainer/scripts/withCache.php' );
    } else {
        $service = include( $root . '/vendor/wscore/dicontainer/scripts/instance.php' );
    }
    $service->set( 'ContainerInterface', $service );
    $service->set( 'rootDirectory',      $root );
    
    // set up database access
    $dba = include( $root . '/app/config/dbaccess.php' );
    $service->set( '\Pdo', $dba );
    
    // set up logger
    $logger = new Logger( 'demoApp' );
    $stream = new StreamHandler( $root . '/app/logs/access.log', Logger::INFO );
    $logger->pushHandler( $stream );
    $service->singleton( 'LoggerInterface', $logger );

    // set up Template
    $service->singleton( 'TemplateInterface', '\Demo\Classes\Template' ); 

    // generate myself, app, object.
    $app = $service->get( 'Demo\Web' );
    return $app;
};


/**
 * @param string  $appName
 * @param bool    $cache
 * @return \Demo\Web
 */
function getApp( $appName, $cache=true )
{
    if( !$cache ) return buildApp( $cache );
    if( !function_exists( 'apc_fetch' ) ) return buildApp( false );
    if( $app = apc_fetch( $appName ) ) return $app;
    $app = buildApp( $cache );
    apc_store( $appName, $app );
    return $app;
}

/**
 * @param \Demo\Web $app
 * @return \Demo\Web
 */
function debugApp( $app )
{
    $stream = new ChromePHPHandler();
    $stream->setFormatter( new ChromePHPFormatter() );
    $app->logger->pushHandler( $stream );
    
    $app->template->addParent( 'debug.php' );
    return $app;
}

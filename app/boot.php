<?php
namespace App;

use Monolog\Formatter\ChromePHPFormatter;
use Monolog\Handler\ChromePHPHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * @param bool     $apc
 * @return \Demo\Web
 */
function buildApp( $apc )
{
    // set up folders.
    $root = dirname( __DIR__ );

    // set up container/service. 
    /** @var $service \WScore\DiContainer\Container */
    /** @noinspection PhpIncludeInspection */
    if( $apc ) {
        $service = include( $root . '/vendor/wscore/dicontainer/scripts/containerCached.php' );
    } else {
        $service = include( $root . '/vendor/wscore/dicontainer/scripts/container.php' );
    }
    $service->set( 'ContainerInterface', $service );
    $service->set( 'rootDirectory',      $root );
    
    $service->set( '\WScore\DbAccess\Query' )->scope( 'shared' );
    // set up app-tasks namespace
    $dba = include( $root . '/app/config/sqlite.php' );
    $service->set( '\Pdo', $dba )->inNamespace( 'App-Tasks');
    // set up database access
    $dba = include( $root . '/app/config/dbaccess.php' );
    $service->set( '\Pdo', $dba );
    
    // set up logger
    $logger = new Logger( 'demoApp' );
    $stream = new StreamHandler( $root . '/app/logs/access.log', Logger::INFO );
    $logger->pushHandler( $stream );
    $service->set( 'LoggerInterface', $logger );

    // set up Template
    $service->set( 'TemplateInterface', '\Demo\Classes\Template' )->singleton(); 

    // generate myself, app, object.
    $app = $service->get( 'Demo\Web' );
    return $app;
};


/**
 * @param string $appName
 * @param bool $cache
 * @param bool $apc
 * @return \Demo\Web
 */
function getApp( $appName, $cache=true, $apc=true )
{
    if( !$cache ) return buildApp( $apc );
    if( !function_exists( 'apc_fetch' ) ) return buildApp( $apc );
    if( $app = apc_fetch( $appName ) ) return $app;
    $app = buildApp( $cache );
    $app->instantiate();
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
    
    $app->renderer->addParent( '.debug.php' );
    return $app;
}

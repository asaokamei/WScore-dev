<?php
namespace App;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * @param bool     $cache
 * @return \App\App
 */
function buildApp( $cache )
{
    // set up folders.
    $root = dirname( dirname( __DIR__ ) );
    $template_root = $root . '/documents';

    // set up container/service. 
    /** @noinspection PhpIncludeInspection */
    if( $cache ) {
        $service = include( $root . '/vendor/wscore/dicontainer/scripts/withCache.php' );
    } else {
        $service = include( $root . '/vendor/wscore/dicontainer/scripts/instance.php' );
    }
    $service->set( 'ContainerInterface', $service );
    
    // set up database access
    $dba = include( $root . '/lib/config/dbaccess.php' );
    $service->set( '\Pdo', $dba );
    
    // set up logger
    $logger = new Logger( 'demoApp' );
    $stream = new StreamHandler( $root . '/lib/logs/access.log', Logger::INFO );
    $logger->pushHandler( $stream );
    $service->singleton( 'LoggerInterface', $logger );

    // set up Template
    /** @var $template \WScore\Template\TemplateInterface */
    $service->singleton( 'TemplateInterface', '\WScore\Template\PhpTemplate' ); 
    $template = $service->get( 'TemplateInterface' );
    $template->setRoot( $template_root );
    $template->setParent( 'layout.php' );

    // generate myself, app, object.
    $app = $service->get( 'App\App' );
    return $app;
};


/**
 * @param string  $appName
 * @param bool    $cache
 * @return \App\App
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


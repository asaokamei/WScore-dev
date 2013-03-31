<?php
namespace App;

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
    $service->set( '\Pdo', 'dsn=mysql:dbname=test_WScore username=admin password=admin' );
    
    // set up logger
    /** @var $logger \Monolog\Logger */
    $service->singleton( 'LoggerInterface', '\Monolog\Logger' );
    $logger = $service->get( 'LoggerInterface' );
    $logger->pushHandler( new \Monolog\Handler\ChromePHPHandler() );
    $logger->addInfo( 'starting WScore demo' );

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


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
    $service->set( 'LoggerInterface', '\Monolog\Logger', array( 'singleton' => true ) );
    /** @var $logger \Monolog\Logger */
    $logger = $service->get( 'LoggerInterface' );
    $logger->pushHandler( new \Monolog\Handler\ChromePHPHandler() );
    $logger->addInfo( 'starting WScore demo' );

    // set up Template
    $service->set( 'TemplateRoot',      $template_root );
    $service->set( 'TemplateLayout',    'layout.php' );
    $service->set( 'TemplateInterface', '\WScore\Template\PhpTemplate', array(
        'setter' => array(
            'setRoot'   => array( 'root'           => 'TemplateRoot' ),
            'setParent' => array( 'parentTemplate' => 'TemplateLayout' ),
        ),
        'singleton' => true,
    ) );

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


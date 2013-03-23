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

    /** @noinspection PhpIncludeInspection */
    if( $cache ) {
        $service = include( $root . '/vendor/wscore/dicontainer/scripts/withCache.php' );
    } else {
        $service = include( $root . '/vendor/wscore/dicontainer/scripts/instance.php' );
    }
    $service->set( 'ContainerInterface', $service );
    $service->set( '\Pdo', 'dsn=mysql:dbname=test_WScore username=admin password=admin' );

    // set Template
    $service->set( 'TemplateInterface', '\WScore\Template\PhpTemplate', array(
        'setter' => array(
            'setRoot' => array( 'root' => $template_root ),
            'setParent' => array( 'parentTemplate' => 'layout.php' ),
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
 * @return App\App
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


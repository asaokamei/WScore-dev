<?php

/**
 * @return \App\App
 */
$boot = function()
{
    // set up folders.
    $root = dirname( dirname( __DIR__ ) );
    $template_root = $root . '/template';

    /** @noinspection PhpIncludeInspection */
    $service = include( $root . '/vendor/wscore/dicontainer/scripts/container.php' );
    $service->set( 'ContainerInterface', $service );

    // set Template
    $service->set( 'Template', '\WScore\Template\Template', array(
        'setter' => array(
            'setRoot' => array( 'root' => $template_root ),
            'parent' => array( 'parentTemplate' => 'layout.php' ),
        ),
        'singleton' => true,
    ) );

    // generate myself, app, object.
    $app = $service->get( 'App\App' );
    return $app;
};


/**
 * @param string  $appName
 * @param Closure $boot
 * @param bool    $cache
 * @return App\App
 */
function getApp( $appName, $boot, $cache=true )
{
    if( !$cache ) return $boot();
    if( !function_exists( 'apc_fetch' ) ) return $boot();
    if( $app = apc_fetch( $appName ) ) return $app;
    $app = $boot();
    apc_store( $appName, $app );
    return $app;
}


<?php

$rootDir = dirname( dirname( __DIR__ ) );

require $rootDir . '/vendor/autoload.php';
$composerLoader = new \Composer\Autoload\ClassLoader();
$composerLoader->add( 'Modules', $rootDir . '/src/' );
$composerLoader->add( 'Demo', $rootDir . '/src/' );
$composerLoader->register();

require $rootDir . '/app/boot.php';
require $rootDir . '/vendor/classpreloader/classpreloader/src/ClassPreloader/ClassLoader.php';

use ClassPreloader\ClassLoader;

$config = ClassLoader::getIncludes(
    function (ClassLoader $loader) use ($rootDir) {
        
        $loader->register();
        $service = include( $rootDir . '/vendor/wscore/dicontainer/scripts/containerCached.php' );
        //$app = new \Demo\Web();
        //$app = $service->get( 'Demo\Web' );
        $app = \App\buildApp( false );
    }
);

return $config;
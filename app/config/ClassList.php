<?php

$rootDir = dirname( dirname( __DIR__ ) );
$wscoreDir = $rootDir . '/vendor/wscore/*/src/WScore/*/';

// find php files to preLoad.

$files = array();
while( $ret = glob( $wscoreDir . '*.php' ) ) {
    $files = array_merge( $files, $ret );
    $wscoreDir .= '*/';
}

$files = array_merge( $files, glob( $rootDir . '/src/Demo/*.php' ) );
$files = array_merge( $files, glob( $rootDir . '/src/Demo/Classes/*.php' ) );
$files = array_merge( $files, glob( $rootDir . '/src/Demo/Model/*.php' ) );
$files = array_merge( $files, glob( $rootDir . '/src/Demo/Role/*.php' ) );
$files = array_merge( $files, glob( $rootDir . '/src/Modules/*.php' ) );
$files = array_merge( $files, glob( $rootDir . '/src/Modules/Entity/*.php' ) );
$files = array_merge( $files, glob( $rootDir . '/src/Modules/Model/*.php' ) );

return $files;
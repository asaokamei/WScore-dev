<?php

/*
 * for PHP built-in web server. 
 * adds debug info bar and chrome-php outputs by setting $runMode = 'debug'. 
 * 
 * example:
 * php -S localhost:8080 webDebug.php
 * 
 */

// router.php
if( php_sapi_name() == 'cli-server' ) {
    /* route static assets and return false */
    if( preg_match('/\.(?:png|jpg|jpeg|gif|css|js)$/', $_SERVER["REQUEST_URI"] ) ) {
        return false;    // serve the requested resource as-is.
    }
    // hack.
    $_SERVER[ 'SCRIPT_NAME' ] = '/app.php';
}

$runMode = 'debug';
include( 'web.php' );
<?php
/*
 * ClassPreloader
 * 
 * build bootstrap.cache.php file that compiles all WScore's PHP files
 * into one file for quick loading classes. 
 * 
 * run this script whenever a framework class is modified. 
 * 
 * Usage:
 * to-be-written
 * 
 */

// set up directories.

$rootDir = dirname( dirname( __DIR__ ) );
$preLoader = $rootDir . '/vendor/classpreloader/classpreloader/classpreloader.php';
$cacheFile = $rootDir . '/app/cache/bootstrap.php.cache';
$config    = $rootDir . '/app/config/ClassList.php';
$config    = $rootDir . '/app/config/ClassConfig.php';

$cmd = "php {$preLoader} compile --config={$config} --output={$cacheFile}";
echo $cmd . PHP_EOL;
passthru($cmd);


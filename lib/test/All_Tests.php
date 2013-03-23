<?php
namespace test;

ini_set( 'display_errors', 1 );
error_reporting( E_ALL );

class All_Tests
{
    public static function suite()
    {
        $suite = new \PHPUnit_Framework_TestSuite( 'all tests for WScore\'s Demo Site' );
        $folder = __DIR__ . '/';
        $suite->addTestFile( $folder . 'App/App_BasicTest.php' );
        $suite->addTestFile( $folder . 'App/App_PasswordTest.php' );
        $suite->addTestFile( $folder . 'App/App_PwdTest.php' );
        return $suite;
    }

}

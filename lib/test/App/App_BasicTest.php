<?php
namespace test\App;

use \WSTests\DataMapper\entities\friend;

require( __DIR__ . '/../../bootstrap.php' );

class App_BasicTests extends \PHPUnit_Framework_TestCase
{
    /** @var \App\App */
    public $app;
    /**
     *
     */
    function setUp()
    {
        /** @var $container \App\App */
        $this->app = \App\getApp( 'WsTest-app', false );
    }

    function test0()
    {
        $this->assertEquals( 'App\App', get_class( $this->app ) );
    }
}

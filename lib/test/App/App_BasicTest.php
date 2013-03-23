<?php
namespace test\App;

use \WSTests\DataMapper\entities\friend;

require( __DIR__ . '/../../bootstrap.php' );

class App_BasicTests extends \PHPUnit_Framework_TestCase
{
    /** @var \App\App */
    public $app;
    
    public $template_root;
    
    /**
     *
     */
    function setUp()
    {
        /** @var $container \App\App */
        $this->app = \App\getApp( 'WsTest-app', false );
        $this->template_root = __DIR__ . '/../../../documents/';
    }

    function test0()
    {
        $this->assertEquals( 'App\App', get_class( $this->app ) );
    }
    
    function test_top_index()
    {
        $this->app->pathInfo( 'index.php' );
        /** @var $response \WScore\Web\Http\Response */
        $response = $this->app->run();
        $contents = $response->content;
        
        // read index.php
        $index = file_get_contents( $this->template_root . 'index.php' );
        $index = substr( $index, strpos( $index, '<header class="jumbotron">' ) );
        $this->assertContains( $index, $contents );
        $this->assertContains( '<!-- Template: documents/layout -->', $contents );
    }

    function test_template_files()
    {
        $this->app->pathInfo( 'templates/index.php' );
        /** @var $response \WScore\Web\Http\Response */
        $response = $this->app->run();
        $contents = $response->content;

        // read index.php
        $index = file_get_contents( $this->template_root . 'templates/index.php' );
        $this->assertContains( $index, $contents );
        $this->assertContains( '<!-- Template: documents/layout -->', $contents );
        $this->assertContains( '<!-- Template: documents/template -->', $contents );
    }

    function test_template_another()
    {
        $this->app->pathInfo( 'templates/another.php' );
        /** @var $response \WScore\Web\Http\Response */
        $response = $this->app->run();
        $contents = $response->content;

        // read index.php
        $index = file_get_contents( $this->template_root . 'templates/another.php' );
        $this->assertContains( $index, $contents );
        $this->assertContains( '<!-- Template: documents/layout -->', $contents );
        $this->assertContains( '<!-- Template: documents/template -->', $contents );
    }

    function test_not_found()
    {
        $this->app->pathInfo( 'not_found.php' );
        /** @var $response \WScore\Web\Http\Response */
        $response = $this->app->run();
        $this->assertEquals( null, $response );
    }

    /**
     */
    function test_bad_request()
    {
        $this->app->pathInfo( 'templates/badRequest.php' );
        /** @var $response \WScore\Web\Http\Response */
        try {
            $response = $this->app->run();
        } catch( \RuntimeException $e ) {
            $this->assertEquals( 'RuntimeException', get_class( $e ) );
            $this->assertEquals( '400', $e->getCode() );
        }
    }

    /**
     */
    function test_no_service()
    {
        $this->app->pathInfo( 'templates/noService.php' );
        /** @var $response \WScore\Web\Http\Response */
        try {
            $response = $this->app->run();
        } catch( \RuntimeException $e ) {
            $this->assertEquals( 'RuntimeException', get_class( $e ) );
            $this->assertEquals( '503', $e->getCode() );
        }
    }
}

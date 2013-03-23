<?php
namespace test\App;

use \WSTests\DataMapper\entities\friend;

require( __DIR__ . '/../../bootstrap.php' );

class App_BasicTests extends \PHPUnit_Framework_TestCase
{
    /** @var \App\App */
    public $app;
    
    public $template_root;
    
    public $public_root;
    
    /**
     *
     */
    function setUp()
    {
        /** @var $container \App\App */
        $this->app = \App\getApp( 'WsTest-app', false );
        $this->template_root = __DIR__ . '/../../../documents/';
        $this->public_root   = __DIR__ . '/../../../public/';
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
        $this->assertContains( '<!-- HtmlTest: Needle=documents/layout -->', $contents );
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
        $this->assertContains( '<!-- HtmlTest: Needle=documents/layout -->', $contents );
        $this->assertContains( '<!-- HtmlTest: Needle=documents/template -->', $contents );
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
        $this->assertContains( '<!-- HtmlTest: Needle=documents/layout -->', $contents );
        $this->assertContains( '<!-- HtmlTest: Needle=documents/template -->', $contents );
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

    /**
     * trying to test direct/index, but cannot test. 
     * $view (template) does not deconstructed as expected. 
     */
    function test_direct()
    {
        // read index.php
        $contents = $this->drawDirect();

        $index = file_get_contents( $this->public_root . 'direct/index.php' );
        $index = substr( $index, strpos( $index, '<h4>Direct Folder</h4>' ) );
        $this->assertContains( $index, $contents );
    }
    function drawDirect()
    {
        ob_start();
        include( $this->public_root . 'direct/index.php' );
        unset( $view );
        $contents = ob_get_clean();
        return $contents;
    }
}

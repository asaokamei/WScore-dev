<?php
namespace test\App;

use \WSTests\DataMapper\entities\friend;

require( __DIR__ . '/../../../app/bootstrap.php' );

class App_BasicTests extends \PHPUnit_Framework_TestCase
{
    /** @var \Demo\Web */
    public $app;
    
    public $template_root;
    
    public $public_root;
    
    /**
     *
     */
    function setUp()
    {
        /** @var $container \Demo\Web */
        $this->app = \App\getApp( 'WsTest-app', false );
        $this->template_root = __DIR__ . '/../../../documents/';
        $this->public_root   = __DIR__ . '/../../../public/';
    }

    function test0()
    {
        $this->assertEquals( 'Demo\Web', get_class( $this->app ) );
    }
    
    function test_top_index()
    {
        $this->app->pathInfo( 'index.php' );
        /** @var $response \WScore\Web\Http\Response */
        $response = $this->app->load( 'index.php' );
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
        $response = $this->app->load( 'templates/index.php' );
        $contents = $response->content;

        // read index.php
        $index = file_get_contents( $this->template_root . 'templates/index.php' );
        $this->assertContains( $index, $contents );
        $this->assertContains( '<!-- HtmlTest: Needle=documents/layout -->', $contents );
        $this->assertContains( '<!-- HtmlTest: Needle=documents/template -->', $contents );
    }

    function test_template_another()
    {
        /** @var $response \WScore\Web\Http\Response */
        $response = $this->app->load( 'templates/another.php' );
        $contents = $response->content;

        // read index.php
        $index = file_get_contents( $this->template_root . 'templates/another.php' );
        $this->assertContains( $index, $contents );
        $this->assertContains( '<!-- HtmlTest: Needle=documents/layout -->', $contents );
        $this->assertContains( '<!-- HtmlTest: Needle=documents/template -->', $contents );
    }

    function test_not_found()
    {
        /** @var $response \WScore\Web\Http\Response */
        $response = $this->app->load( 'not_found.php' );
        $this->assertEquals( null, $response );
    }

    /**
     */
    function test_bad_request()
    {
        /** @var $response \WScore\Web\Http\Response */
        try {
            $response = $this->app->load( 'templates/badRequest.php' );
        } catch( \RuntimeException $e ) {
            $this->assertEquals( 'RuntimeException', get_class( $e ) );
            $this->assertEquals( '400', $e->getCode() );
        }
    }

    /**
     */
    function test_no_service()
    {
        /** @var $response \WScore\Web\Http\Response */
        try {
            $response = $this->app->load( 'templates/noService.php' );
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

<?php
namespace test\App;

use \WScore\Web\Tests\Html;

require( __DIR__ . '/../../../app/bootstrap.php' );

class App_PwdTests extends \PHPUnit_Framework_TestCase
{
    /** @var \Demo\Web */
    public $app;

    public $template_root;

    public $document_root;

    /**
     *
     */
    function setUp()
    {
        /** @var $container \Demo\Web */
        $this->app = \App\getApp( 'WsTest-app', false );
        $this->document_root = __DIR__ . '/../../../documents/';
        $this->template_root = __DIR__ . '/../../../src/App/Pwd/View/';
    }

    function test_password_menu()
    {
        $this->verifyNeedles( 
            'pwd/', 
            array(
                $this->document_root . 'layout.php',
                $this->template_root . 'generate.php'
            ) 
        );
    }

    function test_password_post()
    {
        $server = array(
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI'    => 'pwd/',
        );
        $post = array(
            'length' => '12',
            'count'  => '6',
            'symbol' => '',
        );
        $contents = $this->verifyNeedles(
            $server,
            array(
                $this->document_root . 'layout.php',
                $this->template_root . 'generate.php'
            ),
            $post
        );
        $needle = "<!-- HtmlTest: NumberOfPasswords: {$post{'count'}} -->";
        $this->assertContains( $needle, $contents );
    }

    public function test_pwd_match()
    {
        $server = array(
            'REQUEST_METHOD' => 'get',
            'SCRIPT_NAME'    => '/test/app.php',
            'REQUEST_URI'    => '/test/pwd/',
        );
        //$this->app->pathInfo( $server );
        /** @var $response \WScore\Web\Http\Response */
        $response = $this->app->load( 'pwd/' );
        $contents = Html::extractHtmlTestMatches( $response->content );

        $html = file_get_contents( $this->template_root . 'generate.php' );
        $match = Html::extractHtmlTestMatches( $html );
        foreach( $match as $m ) {
            $this->assertContains( $m, $contents );
        }
    }
    
    public function verifyNeedles( $page, $sources, $post=array() )
    {
        $contents = Html::getAppContents( $this->app, $page, $post );
        foreach( $sources as $src ) {
            $needle = Html::getFileContents( $src );
            $needle = Html::extractHtmlTestNeedles( $needle );
            $this->assertContains( $needle, $contents );
        }
        return $contents;
    }
}
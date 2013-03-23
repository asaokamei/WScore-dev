<?php
namespace test\App;

use \WSTests\DataMapper\entities\friend;

require( __DIR__ . '/../../bootstrap.php' );

class App_PwdTests extends \PHPUnit_Framework_TestCase
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
        $this->template_root = __DIR__ . '/../../../lib/App/Pwd/View/';
    }

    function test_password_menu()
    {
        $server = array(
            'REQUEST_METHOD' => 'get',
            'SCRIPT_NAME'    => '/test/app.php',
            'REQUEST_URI'    => '/test/pwd/',
        );
        $this->app->pathInfo( $server );
        /** @var $response \WScore\Web\Http\Response */
        $response = $this->app->run();
        $contents = $response->content;

        // read index.php
        $this->assertContains( '<form name="password" method="post" action="">', $contents );
        $this->assertContains( '<!-- Template: documents/layout -->', $contents );
        $this->assertContains( '<!-- View: Pwd/View/generate -->', $contents );
        $this->assertContains( '<dt>length of password</dt>', $contents );
    }

    function test_password_post()
    {
        $server = array(
            'REQUEST_METHOD' => 'POST',
            'SCRIPT_NAME'    => '/test/app.php',
            'REQUEST_URI'    => '/test/pwd/',
        );
        $post = array(
            'range' => '12',
            'count' => '6',
            'symbol' => '',
        );
        $this->app->pathInfo( $server );
        /** @var $response \WScore\Web\Http\Response */
        $response = $this->app->using( $post )->run();
        $contents = $response->content;

        // read index.php
        $this->assertContains( '<form name="password" method="post" action="">', $contents );
        $this->assertContains( '<!-- Template: documents/layout -->', $contents );
        $this->assertContains( '<!-- View: Pwd/View/generate -->', $contents );
        $this->assertContains( '<dt>length of password</dt>', $contents );
        $this->assertContains( '            <table class="table">
            <tr>
                <th>password</th>
                <th>crypt</th>
                <th>md5</th>
            </tr>', $contents );
    }

    public function test_pwd_match()
    {
        $server = array(
            'REQUEST_METHOD' => 'get',
            'SCRIPT_NAME'    => '/test/app.php',
            'REQUEST_URI'    => '/test/pwd/',
        );
        $this->app->pathInfo( $server );
        /** @var $response \WScore\Web\Http\Response */
        $response = $this->app->run();
        $contents = $this->extractHtmlTestMatch( $response->content );

        $html = file_get_contents( $this->template_root . 'generate.php' );
        $match = $this->extractHtmlTestMatch( $html );
        foreach( $match as $m ) {
            $this->assertContains( $m, $contents );
        }
    }
    
    public function extractHtmlTestMatch( $html )
    {
        $startTag = '<!-- HtmlTest: matchStart -->';
        $endTag   = '<!-- HtmlTest: matchEnd -->';
        if( preg_match_all( "/{$startTag}(.*?){$endTag}/ms", $html, $match ) ) {
            $html = $match[1];
        }
        return $html;
    }
}
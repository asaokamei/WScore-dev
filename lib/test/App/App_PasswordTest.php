<?php
namespace test\App;

use \WSTests\DataMapper\entities\friend;

require( __DIR__ . '/../../bootstrap.php' );

class App_PasswordTests extends \PHPUnit_Framework_TestCase
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

    function test_password_menu()
    {
        $server = array(
            'REQUEST_METHOD' => 'get',
            'SCRIPT_NAME'    => '/test/app.php',
            'REQUEST_URI'    => '/test/password/index.php',
        );
        $this->app->pathInfo( $server );
        /** @var $response \WScore\Web\Http\Response */
        $response = $this->app->run();
        $contents = $response->content;

        // read index.php
        $this->assertContains( '<form name="password" method="post" action="index.php">', $contents );
        $this->assertContains( '<!-- Template: documents/password -->', $contents );
        $this->assertContains( '<!-- Template: documents/password/index -->', $contents );
        $this->assertContains( '<dt>length of password</dt>', $contents );
    }

    function test_password_post()
    {
        $server = array(
            'REQUEST_METHOD' => 'POST',
            'SCRIPT_NAME'    => '/test/app.php',
            'REQUEST_URI'    => '/test/password/index.php',
        );
        $post = array(
            'length' => '12',
            'count'  => '6',
            'symbol' => '',
        );
        $this->app->pathInfo( $server );
        /** @var $response \WScore\Web\Http\Response */
        $response = $this->app->using( $post )->run();
        $contents = $response->content;

        // read index.php
        $this->assertContains( '<form name="password" method="post" action="index.php">', $contents );
        $this->assertContains( '<!-- Template: documents/password -->', $contents );
        $this->assertContains( '<!-- Template: documents/password/index -->', $contents );
        $this->assertContains( '<dt>length of password</dt>', $contents );
        $this->assertContains( '            <table class="table">
            <tr>
                <th>password</th>
                <th>crypt</th>
                <th>md5</th>
            </tr>', $contents );
    }
    
}
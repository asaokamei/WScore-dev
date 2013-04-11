<?php
namespace test\App;

use \WSTests\DataMapper\entities\friend;

require( __DIR__ . '/../../../app/bootstrap.php' );

class App_PasswordTests extends \PHPUnit_Framework_TestCase
{
    /** @var \Demo\Web */
    public $app;

    public $template_root;

    /**
     *
     */
    function setUp()
    {
        /** @var $container \Demo\Web */
        $this->app = \App\getApp( 'WsTest-app', false );
        $this->template_root = __DIR__ . '/../../../documents/';
    }

    function test_password_menu()
    {
        /** @var $response \WScore\Web\Http\Response */
        $response = $this->app->load( 'password/index.php' );
        $contents = $response->content;

        // read index.php
        $this->assertContains( '<form name="password" method="post" action="index.php">', $contents );
        $this->assertContains( '<!-- HtmlTest: Needle=documents/password -->', $contents );
        $this->assertContains( '<!-- HtmlTest: Needle=documents/password/index -->', $contents );
        $this->assertContains( '<dt>length of password</dt>', $contents );
    }

    function test_password_post()
    {
        $post = array(
            'length' => '12',
            'count'  => '6',
            'symbol' => '',
        );
        /** @var $response \WScore\Web\Http\Response */
        $response = $this->app->with( $post )->on( 'post' )->load( 'password/index.php' );
        $contents = $response->content;

        // read index.php
        $this->assertContains( '<form name="password" method="post" action="index.php">', $contents );
        $this->assertContains( '<!-- HtmlTest: Needle=documents/password -->', $contents );
        $this->assertContains( '<!-- HtmlTest: Needle=documents/password/index -->', $contents );
        $this->assertContains( '<dt>length of password</dt>', $contents );
        $this->assertContains( '            <table class="table">
            <tr>
                <th>password</th>
                <th>crypt</th>
                <th>md5</th>
            </tr>', $contents );
    }
    
}
<?php
namespace test\App;

use \WSTests\DataMapper\entities\friend;

require( __DIR__ . '/../../bootstrap.php' );

class App_TaskTests extends \PHPUnit_Framework_TestCase
{
    /** @var \App\App */
    public $app;

    public $template_root;
    
    public $document_root;

    /**
     *
     */
    function setUp()
    {
        /** @var $container \App\App */
        $this->app = \App\getApp( 'WsTest-app', false );
        $this->document_root = __DIR__ . '/../../../documents/';
        $this->template_root = __DIR__ . '/../../../lib/App/Tasks/View/';
    }

    public function test_task_needles()
    {
        $this->verifyNeedles(
            'tasks/',
            array(
                $this->document_root . 'layout.php',
                $this->template_root . 'task.php',
                $this->template_root . 'index.php'
            )
        );
    }
    function test_create_needles()
    {
        $this->verifyNeedles(
            'tasks/create',
            array(
                $this->document_root . 'layout.php',
                $this->template_root . 'task.php',
                $this->template_root . 'create.php'
            )
        );
    }
    function test_setup_needles()
    {
        $this->verifyNeedles(
            'tasks/setup',
            array(
                $this->document_root . 'layout.php',
                $this->template_root . 'task.php',
                $this->template_root . 'setup.php'
            )
        );
    }
    function test_edit_needles()
    {
        $this->verifyNeedles(
            'tasks/1',
            array(
                $this->document_root . 'layout.php',
                $this->template_root . 'task.php',
                $this->template_root . 'edit.php'
            )
        );
    }
    
    public function verifyNeedles( $page, $sources )
    {
        $contents = $this->getAppContents( $page );
        foreach( $sources as $src ) {
            $needle = $this->getFileContents( $src );
            $needle = $this->extractHtmlTestNeedles( $needle );
            $this->assertContains( $needle, $contents );
        } 
    }
    /**
     * @param string $file
     * @return string
     */
    public function getFileContents( $file )
    {
        return file_get_contents( $file );
    }
    /**
     * @param array|string $server
     * @return string
     */
    public function getAppContents( $server ) 
    {
        if( !is_array( $server ) ) {
            $server = array(
                'REQUEST_METHOD' => 'GET',
                'SCRIPT_NAME'    => '/test/app.php',
                'REQUEST_URI'    => '/test/' . $server,
            );
        }
        $this->app->pathInfo( $server );
        /** @var $response \WScore\Web\Http\Response */
        $response = $this->app->run();
        return $response->content;
    }

    /**
     * @param string $html
     * @return string
     */
    public function extractHtmlTestMatches( $html )
    {
        $startTag = '<!-- HtmlTest: matchStart -->';
        $endTag   = '<!-- HtmlTest: matchEnd -->';
        if( preg_match_all( "/{$startTag}(.*?){$endTag}/ms", $html, $match ) ) {
            $html = $match[1];
        }
        return $html;
    }

    /**
     * @param string $html
     * @return array
     */
    public function extractHtmlTestNeedles( $html )
    {
        $needles = array();
        $startTag = '<!-- HtmlTest: Needle=';
        $endTag   = ' -->';
        if( preg_match( "/({$startTag}.*?{$endTag})/ms", $html, $match ) ) {
            $needles = $match[1];
        }
        return $needles;
    }
}
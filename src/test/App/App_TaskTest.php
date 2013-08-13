<?php
namespace test\App;

use \WScore\Web\Tests\Html;

require( __DIR__ . '/../../../app/bootstrap.php' );

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
        $this->template_root = __DIR__ . '/../../../lib/Modules/Tasks/View/';
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
        $contents = Html::getAppContents( $this->app, $page );
        foreach( $sources as $src ) {
            $needle = Html::getFileContents( $src );
            $needle = Html::extractHtmlTestNeedles( $needle );
            $this->assertContains( $needle, $contents );
        } 
    }
}
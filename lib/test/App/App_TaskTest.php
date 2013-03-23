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
        $this->template_root = __DIR__ . '/../../../lib/App/Tasks/View/';
    }

    public function extractHtmlTestMatches( $html )
    {
        $startTag = '<!-- HtmlTest: matchStart -->';
        $endTag   = '<!-- HtmlTest: matchEnd -->';
        if( preg_match_all( "/{$startTag}(.*?){$endTag}/ms", $html, $match ) ) {
            $html = $match[1];
        }
        return $html;
    }
    
    public function extractHtmlTestNeedles( $html )
    {
        $needles = array();
        $startTag = '<!-- HtmlTest: Needle=';
        $endTag   = ' -->';
        if( preg_match_all( "/({$startTag}.*?{$endTag})/ms", $html, $match ) ) {
            $needles = $match[1];
        }
        return $needles;
    }
}
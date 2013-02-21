<?php
namespace App\Site;
/**
 * Front-end controller for the Site's application. 
 * Should extend \WScore\Web\FrontMC class...
 * 
 * BAD IMPLEMENTATION!
 * 
 */

class App
{
    /** @var string    root folder for application classes */
    public static $application_root;
    
    /** @var string    root folder for template files. */
    public static $template_root;
    
    public static function setUp()
    {
        self::$application_root = __DIR__;
        self::$template_root = dirname( dirname( dirname( __DIR__ ) ) ) . '/template';
    }
}
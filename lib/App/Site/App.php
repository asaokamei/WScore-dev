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
    /** @var string    root folder of everything, including vendor.  */
    public static $root;
    
    /** @var string    root folder of vendor. */
    public static $vendor_root;
    
    /** @var string    root folder for application classes */
    public static $application_root;
    
    /** @var string    root folder for template files. */
    public static $template_root;
    
    public static $basePath;
    
    /** @var \WScore\DiContainer\Container */
    public static $container;
    
    public static function start()
    {
        // set up folders.
        self::$root = dirname( dirname( dirname( __DIR__ ) ) );
        self::$vendor_root = self::$root . '/vendor';
        self::$application_root = __DIR__;
        self::$template_root = self::$root . '/template';
        
        // set up base paths
        self::$basePath = '/WSdev'; // ugly.

        /** @noinspection PhpIncludeInspection */
        self::$container = include( self::$vendor_root . '/wscore/dicontainer/scripts/instance.php' );
        self::$container->set( 'Template', '\WScore\Template\Template', array( 
            'setter' => array( 
                'parent' => array( 'parentTemplate' => self::$template_root.'/layout.php' ),
                'set'    => array( 'name' => 'basePath', 'value' => self::$basePath )
            )
        ) );
    }
}
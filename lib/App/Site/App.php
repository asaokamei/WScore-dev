<?php
namespace App\Site;

use \WScore\DiContainer\ContainerInterface;

/**
 * Front-end controller for the Site's application. 
 * Should extend \WScore\Web\FrontMC class...
 * 
 * BAD IMPLEMENTATION!
 * 
 */

class App extends \WScore\Web\FrontMC
{
    public static $appName = 'WsDemo';
    
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
    public static $service;

    /** @var \App\Site\App */
    public static $app;
    
    public static $cache;

    /**
     * @Inject
     * @var ContainerInterface
     */
    public $container;
    
    public static function getCached() 
    {
        /** @var $app self */
        self::$cache = $cache = \WScore\DiContainer\Cache::getCache();
        if( !$app = $cache->fetch( self::$appName ) ) return self::start();
        self::$service = $app->container;
        return $app;
    }
    
    public static function start()
    {
        // set up folders.
        self::$root = dirname( dirname( dirname( __DIR__ ) ) );
        self::$application_root = __DIR__;
        self::$template_root = self::$root . '/template';
        
        // set up base paths
        self::$basePath = '/WSdev'; // ugly.

        /** @noinspection PhpIncludeInspection */
        self::$service = include( self::$root . '/vendor/wscore/dicontainer/scripts/container.php' );
        self::$service->set( 'ContainerInterface', self::$service );

        // set Template
        self::$service->set( 'Template', '\WScore\Template\Template', array(
            'setter' => array( 
                'setRoot' => array( 'root' => self::$template_root ),
                'parent' => array( 'parentTemplate' => 'layout.php' ),
            )
        ) );

        // generate myself, app, object.
        self::$app = self::$service->get( 'App\Site\App' );
        return self::$app;
    }

    /**
     * @Inject
     * @param \App\Site\Loader\Renderer $render
     */
    public function loader( $render )
    {
        $this->loaders[] = $render;
    }
}
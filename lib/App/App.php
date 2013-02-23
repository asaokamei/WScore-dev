<?php
namespace App;

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

    /**
     * @return App
     */
    public static function getCached() 
    {
        /** @var $app self */
        if( !function_exists( 'apc_fetch' ) ) return self::start();
        if( $app = apc_fetch( self::$appName ) ) return $app;
        $app = self::start();
        apc_store( self::$appName, $app );
        return $app;
    }

    /**
     * @return App
     */
    public static function start()
    {
        // set up folders.
        $root = dirname( dirname( __DIR__ ) );
        $template_root = $root . '/template';
        
        /** @noinspection PhpIncludeInspection */
        $service = include( $root . '/vendor/wscore/dicontainer/scripts/container.php' );
        $service->set( 'ContainerInterface', $service );

        // set Template
        $service->set( 'Template', '\WScore\Template\Template', array(
            'setter' => array( 
                'setRoot' => array( 'root' => $template_root ),
                'parent' => array( 'parentTemplate' => 'layout.php' ),
            )
        ) );

        // generate myself, app, object.
        $app = $service->get( 'App\App' );
        return $app;
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
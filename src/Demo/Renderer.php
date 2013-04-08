<?php
namespace Demo;

use WScore\Web\Module\AppLoader;

class Renderer extends AppLoader
{
    public function __construct()
    {
        parent::__construct();
        $routes = array(
            '/'   => array( 'render' => 'index.php' ),
            '/*'  => array(),
        );
        $this->setRoute( $routes );
        $this->viewRoot = dirname( dirname( __DIR__ ) ). '/documents';
    }
    
    public function load( $pathInfo )
    {
        if( substr( $pathInfo, 0, 10 ) == 'templates/') {
            $this->template->addParent( 'template.php' );
        }
        return parent::load( $pathInfo );
    }
}
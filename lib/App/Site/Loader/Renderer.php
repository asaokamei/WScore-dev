<?php
namespace App\Site\Loader;

class Renderer extends \WScore\Web\Loader\Renderer
{
    public function __construct()
    {
        $routes = array(
            '/templates/*' => array( 'addParent' => 'template.php' ),
            '/index.php'   => array(),
            '/'   => array( 'render' => 'index.php' ),
        );
        $this->setRoute( $routes );
    }
}
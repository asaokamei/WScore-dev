<?php
namespace App\Site\Loader;

class Renderer extends \WScore\Web\Loader\Renderer
{
    public function __construct()
    {
        $routes = array(
            '/templates/*' => array( 'found' => 'true', 'addParent' => 'template.php' ),
            '/index.php'   => array( 'found' => 'true' ),
            '/'   => array( 'found' => 'true' ),
        );
        $this->setRoute( $routes );
    }

}
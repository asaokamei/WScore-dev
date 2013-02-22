<?php
namespace App\Site\Loader;

class Renderer extends \WScore\Web\Loader\Renderer
{
    public function __construct()
    {
        $routes = array(
            '/templates/*' => array( 'found' => 'true' ),
        );
        $this->setRoute( $routes );
    }

}
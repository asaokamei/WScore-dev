<?php
namespace App\Site\Loader;

class Renderer extends \WScore\Web\Loader\Renderer
{
    public function __construct()
    {
        $routes = array(
            '/self' => array( 'found' => 'self' ),
        );
        $this->setRoute( $routes );
    }

}
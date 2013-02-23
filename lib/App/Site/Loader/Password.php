<?php
namespace App\Site\Loader;

class Password extends \WScore\Web\Loader\Renderer
{
    public function __construct()
    {
        $routes = array(
            '/password/*' => array( 'found' => 'true' ),
        );
        $this->setRoute( $routes );
    }
}

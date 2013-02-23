<?php
namespace App\Site\Loader;

class Password extends \WScore\Web\Loader\Pager
{
    public function __construct()
    {
        $routes = array(
            '/password/*' => array( 'found' => 'true' ),
        );
        $this->setRoute( $routes );
    }
}

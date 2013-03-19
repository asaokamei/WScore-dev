<?php
namespace App\Pwd;

use WScore\Web\Loader\AppLoader;

class Generator extends AppLoader
{
    public function __construct()
    {
        $routes = array(
            '/*' => array( 'found' => 'true', 'render' => 'password' ),
        );
        $this->setRoute( $routes );
    }
}

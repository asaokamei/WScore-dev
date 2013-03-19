<?php
namespace App\Pwd;

use WScore\Web\Loader\AppLoader;

class Generator extends AppLoader
{
    public function __construct()
    {
        $routes = array(
            '*' => array( 'load' => 'generate' ),
        );
        $this->setRoute( $routes );

        $this->templateRoot = __DIR__ . '/View/';
    }
}

<?php
namespace App\Pwd;

use WScore\Web\Module\AppLoader;

class Generator extends AppLoader
{
    public function __construct()
    {
        parent::__construct( __DIR__ );
        $routes = array(
            '*' => array( 'render' => '/generate' ),
        );
        $this->setRoute( $routes );
    }
}

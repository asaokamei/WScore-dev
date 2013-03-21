<?php
namespace App\Site\Loader;

use WScore\Web\Loader\Pager;

class PwdGenerator extends Pager
{
    public function __construct()
    {
        $routes = array(
            '/password/*' => array( 'render' => 'password/index.php' ),
        );
        $this->setRoute( $routes );
    }
}

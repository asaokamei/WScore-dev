<?php
namespace Demo;

use WScore\Web\Module\AppLoader;
use WScore\Web\Respond\Dispatch;
use WScore\Web\Respond\ResponsePage;

class Renderer extends Dispatch
{
    public function __construct()
    {
        parent::__construct();
        $routes = array(
            'password/*'  => array( 'addParent' => 'password.php' ),
            'templates/*' => array( 'addParent' => 'template.php' ),
            '/'   => array( 'render' => 'index.php' ),
            '/*'  => array(),
        );
        $this->setRoute( $routes );
        $this->viewRoot = dirname( dirname( __DIR__ ) ). '/documents';
    }
}
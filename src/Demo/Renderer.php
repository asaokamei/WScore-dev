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
            'password/index.php' => array( 'addParent' => 'password.php' ),
            '/'   => array( 'render' => 'index.php' ),
            '/*'  => array(),
        );
        $this->setRoute( $routes );
        $this->viewRoot = dirname( dirname( __DIR__ ) ). '/documents';
    }
    
    public function respond( $match=array() )
    {
        $pathInfo = $this->request->pathInfo;
        if( substr( $pathInfo, 0, 10 ) == 'templates/') {
            $this->template->addParent( 'template.php' );
        }
        return parent::respond( $match );
    }
}
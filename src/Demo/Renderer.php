<?php
namespace Demo;

use WScore\Response\DispatchAbstract;
use WScore\Response\ModuleTrait;
use WScore\Template\TemplateInterface;

class Renderer extends DispatchAbstract
{
    /**
     * @Inject
     * @var TemplateInterface
     */
    public $template;

    public function __construct()
    {
        parent::__construct();
        $routes = array(
            'password/*'  => array( 'addParent' => '.password.php' ),
            'templates/*' => array( 'addParent' => '.template.php' ),
            '/'   => array( 'render' => 'index' ),
            '/*'  => array(),
        );
        $this->setRoute( $routes );
        $this->viewRoot = dirname( dirname( __DIR__ ) ). '/documents';
    }

    public function respond( $match=array() )
    {
        if( !$pageUri = $this->match() ) {
            return null;
        }
        if( isset( $this->match[ 'addParent' ] ) ) {
            $this->template->addParent( $this->match[ 'addParent' ] );
        }
        return $this->dispatch( $pageUri );
    }
}
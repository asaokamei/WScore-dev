<?php
namespace Demo;

use \WScore\DiContainer\ContainerInterface;
use \WScore\Template\TemplateInterface;
use \Monolog\Logger as LoggerInterface;
use \WScore\Web\WebApp;

class Web extends WebApp
{
    /**
     * @Inject
     * @var ContainerInterface
     */
    public $container;

    /**
     * @Inject
     * @var TemplateInterface
     */
    public $template;

    /**
     * @Inject
     * @var \Demo\Renderer
     */
    public $render;

    /**
     * @Inject
     * @var \Demo\Logger
     */
    public $lastLog;

    /**
     * @Inject
     * @var LoggerInterface
     */
    public $logger;

    /**
     */
    public function __construct()
    {
        $dic = $this->container;
        //$this->setModule( $this->setter );
        //$this->setModule( $this->contacts, 'contacts/' );
        $this->setModule( $dic->get( '\App\Tasks\TaskApp' ),   'tasks/' );
        $this->setModule( $dic->get( '\App\Pwd\Generator' ),   'pwd/' );
        //$this->setModule( $this->pwd );
        $this->setModule( $this->render );
        $this->setModule( $this->lastLog );
    }
}
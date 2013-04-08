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
        //$this->setModule( $this->setter );
        //$this->setModule( $this->contacts, 'contacts/' );
        //$this->setModule( $this->tasks,    'tasks/' );
        //$this->setModule( $this->pwdGen,   'pwd/' );
        //$this->setModule( $this->pwd );
        $this->setModule( $this->render );
        $this->setModule( $this->lastLog );
    }
}
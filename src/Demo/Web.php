<?php
namespace Demo;

use \WScore\DiContainer\ContainerInterface;
use \WScore\Template\TemplateInterface;
use \Monolog\Logger as LoggerInterface;
use \WScore\Web\WebApp as WebApp;

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
     * @var LoggerInterface
     */
    public $logger;

    /**
     */
    public function __construct()
    {
        $dic = $this->container;
        $this->addModule( '\Demo\Setup' );
        $this->addModule( '\App\Tasks\TaskApp',   'tasks/' );
        $this->addModule( '\App\Contacts\ContactApp', 'contacts/' );
        /*
        $this->addResponder( $dic->get( '\App\Pwd\Generator' ),   'pwd/' );
        */
        $this->addModule( '\Demo\Renderer' );
        $this->addModule( '\Demo\Logger', true );
    }
}
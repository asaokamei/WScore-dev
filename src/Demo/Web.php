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
     * @var LoggerInterface
     */
    public $logger;

    /**
     */
    public function __construct()
    {
        $dic = $this->container;
        $this->setModule( $dic->get( '\App\Contacts\ContactApp' ), 'contacts/' );
        $this->setModule( $dic->get( '\App\Tasks\TaskApp' ),   'tasks/' );
        $this->setModule( $dic->get( '\App\Pwd\Generator' ),   'pwd/' );
        $this->setModule( $dic->get( '\Demo\Renderer' ) );
        $this->setModule( $dic->get( '\Demo\Logger' ), true );
    }
}
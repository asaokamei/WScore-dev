<?php
namespace Demo;

use \WScore\DiContainer\ContainerInterface;
use \WScore\Template\TemplateInterface;
use \Monolog\Logger as LoggerInterface;
use \WScore\Web\HttpResponder as WebApp;

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
        $this->addResponder( $dic->get( '\Demo\Setup' ) );
        /*
        $this->addResponder( $dic->get( '\App\Contacts\ContactApp' ), 'contacts/' );
        $this->addResponder( $dic->get( '\App\Tasks\TaskApp' ),   'tasks/' );
        $this->addResponder( $dic->get( '\App\Pwd\Generator' ),   'pwd/' );
        */
        $this->addResponder( $dic->get( '\Demo\Renderer' ) );
        $this->addResponder( $dic->get( '\Demo\Logger' ), true );
    }
}
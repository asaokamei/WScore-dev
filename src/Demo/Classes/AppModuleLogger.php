<?php
namespace Demo\Classes;

use WScore\Web\Module\AppLoader;
use \Psr\Log\LoggerInterface as LoggerInterface;


class AppModuleLogger extends AppLoader
{

    /**
     * @Inject
     * @var LoggerInterface
     */
    public $logger;
    
    public function load( $pathInfo )
    {
        $this->logger->info( get_called_class() . "::load( '{$pathInfo}' ) on {$this->method}" );
        return parent::load( $pathInfo );
    }
}
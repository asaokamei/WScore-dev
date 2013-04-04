<?php
namespace App;

use \WScore\DiContainer\ContainerInterface;
use \WScore\Template\TemplateInterface;
use \Monolog\Logger as LoggerInterface;

/**
 * Front-end controller for the Site's application. 
 * Should extend \WScore\Web\FrontMC class...
 * 
 * BAD IMPLEMENTATION!
 * 
 */

class App extends \WScore\Web\FrontMC
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
     * @var \App\Tasks\TaskApp
     */
    public $tasks;

    /**
     * @Inject
     * @var \App\Pwd\Generator
     */
    public $pwdGen;

    /**
     * @Inject
     * @var \App\Site\Loader\PwdGenerator
     */
    public $pwd;

    /**
     * @Inject
     * @var \App\Site\Loader\Renderer
     */
    public $render;

    /**
     * @Inject
     * @var \App\Contacts\ContactApp
     */
    public $contacts;

    /**
     * @Inject
     * @var \App\Site\Loader\Logger
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
        $this->loaders[ 'contacts/' ] = $this->contacts;
        $this->loaders[ 'tasks/' ] = $this->tasks;
        $this->loaders[ 'pwd/' ] = $this->pwdGen;
        $this->loaders[] = $this->pwd;
        $this->loaders[] = $this->render;
        $this->loaders[] = $this->lastLog;
    }
}
<?php
namespace App;

use \WScore\DiContainer\ContainerInterface;
use \WScore\Template\TemplateInterface;

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
     * @var TemplateInterface
     */
    public $template;

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
     */
    public function __construct()
    {
        $this->loaders[ 'pwd/' ] = $this->pwdGen;
        $this->loaders[] = $this->pwd;
        $this->loaders[] = $this->render;
    }
}
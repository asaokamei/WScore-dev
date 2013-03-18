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
     * @param \App\Site\Loader\Renderer $render
     * @param \App\Site\Loader\PwdGenerator $pwd
     * @return void
     */
    public function loader( $render, $pwd )
    {
        $this->loaders[ 'password' ] = $pwd;
        $this->loaders[] = $render;
    }
}
<?php
namespace App;

use \WScore\DiContainer\ContainerInterface;

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
     * @param \App\Site\Loader\Renderer $render
     * @param \App\Site\Loader\Password $pwd
     * @return void
     */
    public function loader( $render, $pwd )
    {
        $this->loaders[] = $render;
        $this->loaders[] = $pwd;
    }
}
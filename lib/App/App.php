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
     */
    public function loader( $render )
    {
        $this->loaders[] = $render;
    }
}
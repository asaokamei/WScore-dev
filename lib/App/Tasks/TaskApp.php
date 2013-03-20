<?php
namespace App\Tasks;

use WScore\Web\Loader\AppLoader;

class TaskApp extends AppLoader
{
    public function __construct()
    {
        $routes = array(
            'setup'  => array(),
            'create' => array(),
            '*'      => array( 'load' => 'index' ),
        );
        $this->setRoute( $routes );

        $this->templateRoot = __DIR__ . '/View/';
        $this->template->addParent( $this->templateRoot . 'task.php' );
    }
}
<?php
namespace App\Tasks;

use WScore\Web\Loader\AppLoader;

class TaskApp extends AppLoader
{
    public function __construct()
    {
        $routes = array(
            ':id'    => array( 'load' => 'edit' ),
            'setup'  => array(),
            'create' => array(),
            '*'      => array( 'load' => 'index' ),
        );
        $this->setRoute( $routes );

        $this->templateRoot = __DIR__ . '/View/';
    }

    /**
     * @param string $pathInfo
     * @return null|string
     */
    public function load( $pathInfo )
    {
        $this->template->set( 'baseUrl', $this->front->baseUrl );
        $this->template->addParent( $this->templateRoot . 'task.php' );
        return parent::load( $pathInfo );
    }
}
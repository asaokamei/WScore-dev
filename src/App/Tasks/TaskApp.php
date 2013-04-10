<?php
namespace App\Tasks;

use Demo\Classes\AppModuleLogger as AppLoader;

class TaskApp extends AppLoader
{
    /**
     * @Inject
     * @var \WScore\DataMapper\EntityManager
     */
    protected $em;

    /**
     * @Inject
     * @var \WScore\DataMapper\RoleManager
     */
    protected $role;

    public function __construct()
    {
        parent::__construct( __DIR__ );
        $routes = array(
            'setup'  => array(),
            'create' => array(),
            'done/:id'=> array(),
            ':id'    => array( 'render' => 'edit' ),
            '/'      => array( 'render' => 'index' ),
        );
        $this->setRoute( $routes );

        $this->em->getModel( '\App\Tasks\Entity\Task' );
    }

    /**
     * @param string $pathInfo
     * @return null|string
     */
    public function load( $pathInfo )
    {
        $this->template->addParent( $this->viewRoot . '/task.php' );
        return parent::load( $pathInfo );
    }
}
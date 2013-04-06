<?php
namespace App\Tasks;

use WScore\Web\Loader\AppLoader;

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
        $routes = array(
            'setup'  => array(),
            'create' => array(),
            'done/:id'=> array(),
            ':id'    => array( 'render' => 'edit' ),
            '/'      => array( 'render' => 'index' ),
        );
        $this->setRoute( $routes );

        $this->templateRoot = __DIR__ . '/View/';

        $this->em->getModel( '\App\Tasks\Entity\Task' );
    }

    /**
     * @param string $pathInfo
     * @return null|string
     */
    public function load( $pathInfo )
    {
        $this->template->addParent( $this->templateRoot . 'task.php' );
        return parent::load( $pathInfo );
    }
}
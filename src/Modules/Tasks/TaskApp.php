<?php
namespace Modules\Tasks;

use WScore\Response\DispatchAbstract;
use WScore\Template\TemplateInterface;

/**
 * Class TaskApp
 *
 * @package Modules\Tasks
 *
 * @namespace Modules-Tasks
 */
class TaskApp extends DispatchAbstract
{
    /**
     * @Inject
     * @var \WScore\DataMapper\EntityManager
     */
    public $em;

    /**
     * @Inject
     * @var \WScore\DataMapper\RoleManager
     */
    public $role;

    /**
     * @Inject
     * @var \Modules\Tasks\Core\TaskModel
     */
    public $tasks;

    /**
     * @Inject
     * @var TemplateInterface
     */
    public $template;

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

        $this->em->getModel( '\Modules\Tasks\Core\Task' );
        $this->em->setNamespace( '\Modules\Tasks\Core' );
    }

    /**
     * @param array $match
     * @internal param string $pathInfo
     * @return null|string
     */
    public function respond( $match=array() )
    {
        $this->template->addParent( $this->viewRoot . '/task.php' );
        return parent::respond( $match );
    }
}
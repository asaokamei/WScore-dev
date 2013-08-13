<?php
namespace App\Tasks;

use WScore\Response\DispatchAbstract;
use WScore\Template\TemplateInterface;

/**
 * Class TaskApp
 *
 * @package App\Tasks
 *
 * @namespace App-Tasks
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
     * @var \App\Tasks\Model\Tasks
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

        $this->em->getModel( '\App\Tasks\Entity\Task' );
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
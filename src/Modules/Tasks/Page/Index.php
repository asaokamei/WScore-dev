<?php
namespace Modules\Tasks\Page;

use WScore\Response\PageAbstract;

/**
 * Class Index
 *
 * @package Modules\Tasks\Page
 *
 * @namespace Modules-Tasks
 */
class Index extends PageAbstract
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
     * @var \Modules\Tasks\Model\Tasks
     */
    public $tasks;

    public function onGet( $match=array() )
    {
        $tasks = $this->tasks->query()->order( 'status, done_by, task_id' )->select();
        $tasks = $this->em->fetch( '\Modules\Tasks\Entity\Task', $tasks );
        $roles = array();
        foreach( $tasks as $key => $t ) {
            $roles[$key] = $this->role->applyDataIO( $t );
        }
        return array( 'tasks' => $roles );
    }
}
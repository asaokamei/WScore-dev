<?php
namespace App\Tasks\Page;

class Index
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
    
    /**
     * @Inject
     * @var \App\Tasks\Model\Tasks
     */
    protected $tasks;

    public function onGet( $match )
    {
        $tasks = $this->tasks->query()->order( 'status, done_by, task_id' )->select();
        $tasks = $this->em->fetch( '\App\Tasks\Entity\Task', $tasks );
        $roles = array();
        foreach( $tasks as $key => $t ) {
            $roles[$key] = $this->role->applyDataIO( $t );
        }
        return array( 'tasks' => $roles );
    }
}
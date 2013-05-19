<?php
namespace App\Tasks\Page;

use WScore\Web\Respond\ResponsePage;

class Index extends ResponsePage
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
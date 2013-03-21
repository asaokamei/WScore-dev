<?php
namespace App\Tasks\Page;

class Edit
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
        $id    = $match[ 'id' ];
        $task  = $this->em->fetch( 'App\Tasks\Entity\Task', $id );
        $task  = $this->role->applyDataIO( $task );
        return array( 'task' => $task );
    }
}
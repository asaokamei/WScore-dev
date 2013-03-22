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

    /**
     * @param array $match
     * @return array
     * @throws \Exception
     */
    public function onGet( $match )
    {
        $id = $match[ 'id' ];
        //if( !$id ) throw new \Exception( 'no id', 404 );
        $task = $this->em->fetch( 'App\Tasks\Entity\Task', $id );
        $task = $this->role->applyDataIO( $task[0] );
        $match[ 'task' ] = $task;
        return $match;
    }
}
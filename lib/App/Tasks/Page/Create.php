<?php
namespace App\Tasks\Page;

class Create
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
        $task = $this->em->newEntity( '\App\Tasks\Entity\Task' );
        $task = $this->role->applyDataIO( $task );
        $match[ 'task' ] = $task;
        return $match;
    }

    /**
     * @param array $match
     * @return array
     * @throws \Exception
     */
    public function onPost( $match )
    {
        $task = $this->em->newEntity( '\App\Tasks\Entity\Task' );
        $task = $this->role->applyDataIO( $task );
        $task->load( $_POST );
        if( $task->validate() ) {
            $active = $this->role->applyActive( $task );
            $active->save();
            header( "Location: " . $match[ 'appRoot' ] );
            exit;
        }
        $match[ 'task' ] = $task;
        return $match;
    }
}
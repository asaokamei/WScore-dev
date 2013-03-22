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
        $task = $this->fetchTask( $match );
        $task = $this->role->applyDataIO( $task );
        $match[ 'task' ] = $task;
        return $match;
    }


    /**
     * @param array $match
     * @return array
     * @throws \Exception
     */
    public function onPut( $match )
    {
        $task = $this->fetchTask( $match );
        $task = $this->role->applyDataIO( $task );
        $task->load( $_POST );
        if( $task->validate() ) {
            $active = $this->role->applyActive( $task );
            $active->save();
        }

        $match[ 'task' ] = $task;
        return $match;
    }

    /**
     * @param $match
     * @return mixed
     * @throws \Exception
     */
    private function fetchTask( $match )
    {
        if( !isset( $match[ 'id' ] ) ) throw new \Exception( 'task id not set', 1400 );
        $id = $match[ 'id' ];
        $task = $this->em->fetch( 'App\Tasks\Entity\Task', $id );
        if( empty( $task ) ) throw new \Exception( 'task not found: id='.$id, 1401 );
        return $task[0];
    }
}
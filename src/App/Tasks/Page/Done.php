<?php
namespace App\Tasks\Page;

use WScore\Web\Respond\ResponsePage;

class Done extends ResponsePage
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
     * @param array $match
     * @return array
     * @throws \Exception
     */
    public function onPut( $match )
    {
        /** @var $task \App\Tasks\Entity\Task */
        $task = $this->fetchTask( $match );
        if( !$task->isDone() ) {
            $task->status = \App\Tasks\Entity\Task::STATUS_DONE;
            $active = $this->role->applyActive( $task );
            $active->save();
        }
        $this->loadAppRoot();
        return array();
    }

    /**
     * @param array $match
     * @return array
     * @throws \Exception
     */
    public function onDelete( $match )
    {
        /** @var $task \App\Tasks\Entity\Task */
        $task = $this->fetchTask( $match );
        if( $task->isDone() ) {
            $active = $this->role->applyActive( $task );
            $active->delete();
            $active->save();
        }
        $this->loadAppRoot();
        return array();
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
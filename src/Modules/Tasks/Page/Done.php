<?php
namespace Modules\Tasks\Page;

use Modules\Tasks\Core\Task;
use WScore\Response\PageAbstract;

/**
 * Class Done
 *
 * @package Modules\Tasks\Page
 *
 * @namespace Modules-Tasks
 */
class Done extends PageAbstract
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
     * @param array $match
     * @return array
     * @throws \Exception
     */
    public function onPut( $match )
    {
        /** @var $task Task */
        $task = $this->fetchTask( $match );
        if( !$task->isDone() ) {
            $task->status = Task::STATUS_DONE;
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
        /** @var $task Task */
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
        $task = $this->em->fetch( 'Task', $id );
        if( empty( $task ) ) throw new \Exception( 'task not found: id='.$id, 1401 );
        return $task[0];
    }
}
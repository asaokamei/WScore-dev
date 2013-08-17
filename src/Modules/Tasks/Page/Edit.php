<?php
namespace Modules\Tasks\Page;

use WScore\Response\PageAbstract;
use WScore\Web\Session\TokenTrait;

/**
 * Class Edit
 *
 * @package Modules\Tasks\Page
 *
 * @namespace Modules-Tasks
 */
class Edit extends PageAbstract
{
    use TokenTrait;

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
     * @param array $post
     * @return array
     */
    public function onPut( $match, $post )
    {
        $task = $this->fetchTask( $match );
        $task = $this->role->applyDataIO( $task );
        $task->load( $post );
        if( $this->request->getInfo( 'requestError' ) ) {
            $match[ 'alert' ] = 'need a valid token. ';
        }
        elseif( $task->validate() ) {
            $active = $this->role->applyActive( $task );
            $active->save();
            $this->loadAppRoot();
            return null;
        }
        $this->invalidParameter( 'Please check the input values.' );
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
        $task = $this->em->fetch( 'Modules\Tasks\Entity\Task', $id );
        if( empty( $task ) ) throw new \Exception( 'task not found: id='.$id, 1401 );
        return $task[0];
    }
}
<?php
namespace App\Tasks\Page;

use WScore\Web\Respond\ResponsePage;

/**
 * Class Create
 *
 * @package App\Tasks\Page
 * 
 * @namespace App-Tasks
 */
class Create extends ResponsePage
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
     * @Inject
     * @var \WScore\Web\Session
     */
    public $session;

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
        $match[ 'tokenVal' ] = $this->session->pushToken();
        $match[ 'tokenTag' ] = $this->session->popTokenTagName();
        return $match;
    }

    /**
     * @param array $match
     * @param array $post
     * @return array
     */
    public function onPost( $match, $post )
    {
        $task = $this->em->newEntity( '\App\Tasks\Entity\Task' );
        $task = $this->role->applyDataIO( $task );
        $task->load( $post );
        if( !$this->session->verifyToken() ){
            $match[ 'alert' ] = 'error on session token. ';
        }
        elseif( $task->validate() ) {
            $active = $this->role->applyActive( $task );
            $active->save();
            $this->loadAppRoot();
            return array();
        }
        $this->invalidParameter( 'Please check the input values.' );
        $match[ 'task' ] = $task;
        $match[ 'tokenVal' ] = $this->session->pushToken();
        $match[ 'tokenTag' ] = $this->session->popTokenTagName();
        return $match;
    }
}
<?php
namespace App\Tasks\Page;

use \WScore\Web\Page\PageInterface;

class Create implements PageInterface
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
     * @Inject
     * @var \WScore\Web\Session
     */
    protected $session;

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
            return self::JUMP_TO_APP_ROOT;
        }
        $match[ 'task' ] = $task;
        $match[ 'tokenVal' ] = $this->session->pushToken();
        $match[ 'tokenTag' ] = $this->session->popTokenTagName();
        return $match;
    }
}
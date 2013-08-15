<?php
namespace Modules\Contacts\Page;

use WScore\Response\PageAbstract;

/**
 * Class Index
 *
 * @package Modules\Contacts\Page
 *
 * @namespace Modules-Contacts
 */
class Index extends FriendBase
{
    /**
     * @Inject
     * @var \WScore\DataMapper\Filter\Paginate
     */
    public $paginate;

    private function loadIndex( $match )
    {
        $this->paginate->set( 'per_page', 4 );
        $this->paginate->setOptions( $_GET );
        $friends = $this->em->query( 'Friend' )
            ->rule( $this->paginate )
            ->order( 'friend_id' )
            ->fetch();
        $roles   = $this->loadRelations( $friends );
        return $roles;
    }

    /**
     * @param \WScore\DataMapper\Entity\Collection $friends
     * @return array
     */
    private function loadRelations( $friends )
    {
        $ids     = $friends->pack( 'friend_id' );
        $ids     = $this->em->fetch( 'Fr2tg', $ids, 'friend_id' )->pack( 'tag_code' );
        $this->em->fetch( 'Tag', $ids );
        $this->em->fetchByGet();
        $roles = array();
        foreach( $friends as $key => $entity ) {
            $this->em->relation( $entity, 'tags' )->fetch();
            $roles[$key] = $this->cm->applyCenaIO( $entity );
        }
        return $roles;
    }

    public function onGet( $match )
    {
        $friends = $this->loadIndex( $match );
        $data = array(
            'friends'  => $friends,
            'paginate' => $this->paginate,
        );
        return $data;
    }

    public function onEdit( $match )
    {
        $tags    = $this->em->getModel( 'Tag' )->query()->select();
        $tagList = $this->em->fetch( 'Tag', $tags );
        $friends = $this->loadIndex( $match );
        // get all tags from database for selection. 
        $data = array( 
            'friends' => $friends,
            'tagList' => $tagList,
        );
        return $data;
    }

    public function onPut( $match, $post )
    {
        if( $this->cm->processor->with( $post )->posts() ) {
            $this->em->save();
            return $this->reload();
        }
        $tags    = $this->em->getModel( 'Tag' )->query()->select();
        $tagList = $this->em->fetch( 'Tag', $tags );
        $friends = $this->em->get( 'Friend', null );
        $roles   = $this->loadRelations( $friends );
        $data = array(
            'friends' => $roles,
            'tagList' => $tagList,
        );
        $this->assign( $data );
        $this->invalidParameter( 'Please check the input values.' );
        return $this;
    }
}
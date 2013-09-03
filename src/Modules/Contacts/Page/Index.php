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
        $this->paginate->set( 'per_page', 10);
        $this->paginate->setOptions( $_GET );
        $friends = $this->em->query( 'Friend' )
            ->rule( $this->paginate )
            ->order( 'friend_id' )
            ->fetch();
        $this->loadRelations( $friends );
        return $friends;
    }

    /**
     * @param \WScore\DataMapper\Entity\Collection $friends
     */
    private function loadRelations( $friends )
    {
        $ids     = $friends->pack( 'friend_id' );
        $ids     = $this->em->fetch( 'Fr2tg', $ids, 'friend_id' )->pack( 'tag_code' );
        $this->em->fetch( 'Tag', $ids );
        $this->em->fetchByGet();
        $this->em->collection->makeIndexOn( 'Fr2tg', 'friend_id' );
        foreach( $friends as $entity ) {
            $this->em->relation( $entity, 'tags' )->fetch();
        }
    }

    public function onGet( $match )
    {
        $friends = $this->loadIndex( $match );
        $data = array(
            'friends'  => $friends,
            'paginate' => $this->paginate,
            'CenaIo'  => $this->cm->getCenaIO(),
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
            'CenaIo'  => $this->cm->getCenaIO(),
        );
        return $data;
    }

    public function onPut( $match, $post )
    {
        $this->em->query( 'Friend' )->begin();
        if( $this->cm->processor->with( $post )->posts() ) {
            $this->em->save();
            $this->em->query( 'Friend' )->commit();
            return $this->reload();
        }
        $this->em->query( 'Friend' )->rollback();
        $tags    = $this->em->getModel( 'Tag' )->query()->select();
        $tagList = $this->em->fetch( 'Tag', $tags );
        $friends = $this->em->get( 'Friend', null );
        $this->loadRelations( $friends );
        $data = array(
            'friends' => $friends,
            'tagList' => $tagList,
            'CenaIo'  => $this->cm->getCenaIO(),
        );
        $this->assign( $data );
        $this->invalidParameter( 'Please check the input values.' );
        return $this;
    }
}
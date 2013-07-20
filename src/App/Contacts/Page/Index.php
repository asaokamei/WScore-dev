<?php
namespace App\Contacts\Page;

use WScore\Web\Respond\ResponsePage;

/**
 * Class Index
 *
 * @package App\Contacts\Page
 *
 * @namespace App-Contacts
 */
class Index extends ResponsePage
{
    /**
     * @Inject
     * @var \WScore\DataMapper\EntityManager
     */
    public $em;

    /**
     * @Inject
     * @var \WScore\Cena\CenaManager
     */
    public $cm;

    /**
     * @Inject
     * @var \WScore\DbAccess\Tools\Paginate
     */
    public $paginate;

    private function loadIndex( $match )
    {
        $this->paginate->per_page = 4;
        $this->paginate->setOptions( $_GET );
        $query   = $this->em->query( '\App\Contacts\Entity\Friend' )->order( 'friend_id' );
        $query   = $this->paginate->setQuery( $query );
        $friends = $query->fetch();
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
        $joiners = $this->em->fetch( '\App\Contacts\Entity\Fr2tg', $ids, 'friend_id' );
        $ids     = $joiners->pack( 'tag_code' );
        $tags    = $this->em->fetch( '\App\Contacts\Entity\Tag', $ids );
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
        $tags    = $this->em->getModel( '\App\Contacts\Entity\Tag' )->query()->select();
        $tagList = $this->em->fetch( '\App\Contacts\Entity\Tag', $tags );
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
        $this->cm->useEntity( '\App\Contacts\Entity\Friend' );
        $this->cm->useEntity( '\App\Contacts\Entity\Tag' );
        $this->cm->useEntity( '\App\Contacts\Entity\Fr2tg' );
        if( $this->cm->processor->with( $post )->posts() ) {
            $this->em->save();
            return $this->reload();
        }
        $tags    = $this->em->getModel( '\App\Contacts\Entity\Tag' )->query()->select();
        $tagList = $this->em->fetch( '\App\Contacts\Entity\Tag', $tags );
        $friends = $this->em->get( '\App\Contacts\Entity\Friend', null );
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
<?php
namespace App\Contacts\Page;

use WScore\Response\PageAbstract;

/**
 * Class FriendBase
 *
 * @package App\Contacts\Page
 *
 * @namespace App-Contacts
 */
class FriendBase extends PageAbstract
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
     * @var \WScore\DataMapper\RoleManager
     */
    public $role;

    // +----------------------------------------------------------------------+
    //  utilities for all on* methods. 
    // +----------------------------------------------------------------------+
    /**
     * @param $match
     * @return \App\Contacts\Entity\Friend
     */
    protected function loadFriend( $match )
    {
        $id = $match[ 'id' ];
        $friend = $this->em->fetch( '\App\Contacts\Entity\Friend', $id );
        $friend = $this->role->applyActive( $friend[0] );
        $friend->relation( 'contacts' )->fetch();
        $friend->relation( 'tags' )->fetch();
        return $friend->retrieve();
    }

    /**
     * @param $friend
     * @return array
     */
    protected function cenaFriend( $friend )
    {
        $data = array();
        $data[ 'friend' ] = $this->cm->applyCenaIO( $friend );
        $contacts = $friend->contacts;
        foreach( $contacts as $c ) {
            $data[ 'contacts' ][] = $this->cm->applyCenaIO( $c );
        }
        $tags = $friend->tags;
        if( !empty( $tags ) )
        foreach( $tags as $t ) {
            $data[ 'tags' ][] = $this->cm->applyCenaIO( $t );
        }
        return $data;
    }

    protected function linkContacts( $data )
    {
        /** @var $friend \WScore\Cena\Role\CenaIO */
        $friend = $data[ 'friend' ];
        foreach( $data[ 'contacts' ] as $contact )
        {
            /** @var $contact \WScore\Cena\Role\CenaIO */
            $contact->relate( 'friend', $friend->retrieve() );
        }
        // get all tags from database for selection. 
        $tags = $this->em->getModel( '\App\Contacts\Entity\Tag' )->query()->select();
        $tagList = $this->em->fetch( '\App\Contacts\Entity\Tag', $tags );
        $data[ 'tagList' ] = $tagList;
        return $data;
    }

}
<?php
namespace App\Contacts\Page;

class Edit
{
    /**
     * @Inject
     * @var \WScore\DataMapper\EntityManager
     */
    protected $em;

    /**
     * @Inject
     * @var \WScore\Cena\CenaManager
     */
    protected $cm;

    /**
     * @Inject
     * @var \WScore\DataMapper\RoleManager
     */
    protected $role;

    // +----------------------------------------------------------------------+
    //  utilities for all on* methods. 
    // +----------------------------------------------------------------------+
    /**
     * @param $match
     * @return \App\Contacts\Entity\Friend
     */
    private function loadFriend( $match )
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
    private function cenaFriend( $friend )
    {
        $data = array();
        $data[ 'friend' ] = $this->cm->applyCenaIO( $friend );
        $contacts = $friend->contacts;
        foreach( $contacts as $c ) {
            $data[ 'contacts' ][] = $this->cm->applyCenaIO( $c );
        }
        $tags = $friend->tags;
        foreach( $tags as $t ) {
            $data[ 'tags' ][] = $this->cm->applyCenaIO( $t );
        }
        return $data;
    }
    
    private function linkContacts( $data )
    {
        /** @var $friend \WScore\Cena\Role\CenaIO */
        $friend = $data[ 'friend' ];
        foreach( $data[ 'contacts' ] as $contact )
        {
            /** @var $contact \WScore\Cena\Role\CenaIO */
            $contact->relate( 'friend', $friend->retrieve() );
        }
    }

    // +----------------------------------------------------------------------+
    //  on* methods. 
    // +----------------------------------------------------------------------+
    public function onGet( $match )
    {
        $friend = $this->loadFriend( $match );
        $data   = $this->cenaFriend( $friend );
        return $data;
    }

    public function onEdit( $match )
    {
        $friend = $this->loadFriend( $match );
        // create new contacts for each type.
        $friend->contacts[] = $this->em->newEntity( '\App\Contacts\Entity\Contact', array( 'type' => '1' ) );
        $friend->contacts[] = $this->em->newEntity( '\App\Contacts\Entity\Contact', array( 'type' => '2' ) );
        $friend->contacts[] = $this->em->newEntity( '\App\Contacts\Entity\Contact', array( 'type' => '3' ) );
        $data   = $this->cenaFriend( $friend );
        $this->linkContacts( $data );
        // get all tags from database for selection. 
        $tags = $this->em->getModel( '\App\Contacts\Entity\Tag' )->query()->select();
        $tagList = $this->em->fetch( '\App\Contacts\Entity\Tag', $tags );
        $data[ 'tagList' ] = $tagList;
        return $data;
    }

    public function onPost( $match )
    {
        $this->cm->useEntity( '\App\Contacts\Entity\Friend' );
        $this->cm->useEntity( '\App\Contacts\Entity\Contact' );
        $this->cm->useEntity( '\App\Contacts\Entity\Tag' );
        $this->cm->useEntity( '\App\Contacts\Entity\Fr2tg' );
        $this->cm->processor->with( $_POST )->clean( '\App\Contacts\Entity\Contact', 'info' )->posts();
        $this->em->save();
        // TODO: think about how to reload itself better!
        header( "Location: " . $_SERVER[ 'REQUEST_URI' ] );
        exit;
    }
    // +----------------------------------------------------------------------+
}
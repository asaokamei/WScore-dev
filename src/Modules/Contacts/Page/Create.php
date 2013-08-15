<?php
namespace Modules\Contacts\Page;
/**
 * Class Create
 *
 * @package Modules\Contacts\Page
 *
 * @namespace Modules-Contacts
 */
class Create extends FriendBase
{
    // +----------------------------------------------------------------------+
    //  on* methods. 
    // +----------------------------------------------------------------------+
    public function onGet( $match )
    {
        /** @var $friend \Modules\Contacts\Entity\Friend */
        $friend = $this->em->newEntity( '\Modules\Contacts\Entity\Friend' );
        // create new contacts for each type.
        $friend->contacts[] = $this->em->newEntity( '\Modules\Contacts\Entity\Contact', array( 'type' => '1' ) );
        $friend->contacts[] = $this->em->newEntity( '\Modules\Contacts\Entity\Contact', array( 'type' => '2' ) );
        $friend->contacts[] = $this->em->newEntity( '\Modules\Contacts\Entity\Contact', array( 'type' => '3' ) );
        $data   = $this->cenaFriend( $friend );
        $data   = $this->linkContacts( $data );
        return $data;
    }

    public function onPost( $match, $post )
    {
        $this->cm->useEntity( '\Modules\Contacts\Entity\Friend' );
        $this->cm->useEntity( '\Modules\Contacts\Entity\Contact' );
        $this->cm->useEntity( '\Modules\Contacts\Entity\Tag' );
        $this->cm->useEntity( '\Modules\Contacts\Entity\Fr2tg' );
        if( $this->cm->processor->with( $post )->clean( '\Modules\Contacts\Entity\Contact', 'info' )->posts() ) {
            $this->em->save();
            return $this->loadAppRoot();
        }
        $this->em->fetchByGet();
        $friend = $this->em->fetch( '\Modules\Contacts\Entity\Friend', null )[0];
        $contacts = $this->em->fetch( '\Modules\Contacts\Entity\Contact', null );
        $types = array( '1', '2', '3' );
        $contact2 = array();
        foreach( $types as $type ) {
            if( !$contact = $contacts->get( $type, 'type' )[0] ) {
                $contact = $this->em->newEntity( '\Modules\Contacts\Entity\Contact', array( 'type' => $type ) );
            }
            $friend->contacts[] = $contact;
        }
        $data   = $this->cenaFriend( $friend );
        $data   = $this->linkContacts( $data );
        return $data;
    }
    // +----------------------------------------------------------------------+

}

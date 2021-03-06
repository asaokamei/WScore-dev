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
        $friend->contacts[] = $this->em->newEntity( 'Contact', array( 'type' => '1' ) );
        $friend->contacts[] = $this->em->newEntity( 'Contact', array( 'type' => '2' ) );
        $friend->contacts[] = $this->em->newEntity( 'Contact', array( 'type' => '3' ) );
        $data   = $this->cenaFriend( $friend );
        $data   = $this->linkContacts( $data );
        return $data;
    }

    public function onPost( $match, $post )
    {
        if( $this->cm->processor->with( $post )->clean( 'Contact', 'info' )->posts() ) {
            $this->em->save();
            return $this->loadAppRoot();
        }
        $this->em->fetchByGet();
        $friend = $this->em->fetch( 'Friend', null )[0];
        $contacts = $this->em->fetch( 'Contact', null );
        $types = array( '1', '2', '3' );
        foreach( $types as $type ) {
            if( !$contact = $contacts->get( $type, 'type' )[0] ) {
                $contact = $this->em->newEntity( 'Contact', array( 'type' => $type ) );
            }
            $friend->contacts[] = $contact;
        }
        $this->em->fetchByGet( false );
        $data   = $this->cenaFriend( $friend );
        $data   = $this->linkContacts( $data );
        $this->invalidParameter( 'Please check the input values.' );
        return $data;
    }
    // +----------------------------------------------------------------------+

}

<?php
namespace App\Contacts\Page;
/**
 * Class Create
 *
 * @package App\Contacts\Page
 *
 * @namespace App-Contacts
 */
class Create extends FriendBase
{
    // +----------------------------------------------------------------------+
    //  on* methods. 
    // +----------------------------------------------------------------------+
    public function onGet( $match )
    {
        /** @var $friend \App\Contacts\Entity\Friend */
        $friend = $this->em->newEntity( '\App\Contacts\Entity\Friend' );
        // create new contacts for each type.
        $friend->contacts[] = $this->em->newEntity( '\App\Contacts\Entity\Contact', array( 'type' => '1' ) );
        $friend->contacts[] = $this->em->newEntity( '\App\Contacts\Entity\Contact', array( 'type' => '2' ) );
        $friend->contacts[] = $this->em->newEntity( '\App\Contacts\Entity\Contact', array( 'type' => '3' ) );
        $data   = $this->cenaFriend( $friend );
        $data   = $this->linkContacts( $data );
        return $data;
    }

    public function onPost( $match, $post )
    {
        $this->cm->useEntity( '\App\Contacts\Entity\Friend' );
        $this->cm->useEntity( '\App\Contacts\Entity\Contact' );
        $this->cm->useEntity( '\App\Contacts\Entity\Tag' );
        $this->cm->useEntity( '\App\Contacts\Entity\Fr2tg' );
        if( $this->cm->processor->with( $post )->clean( '\App\Contacts\Entity\Contact', 'info' )->posts() ) {
            $this->em->save();
        }
        return $this->loadAppRoot();
    }
    // +----------------------------------------------------------------------+

}

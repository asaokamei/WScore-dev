<?php
namespace App\Contacts\Page;

use \WScore\Web\Page\PageInterface;

class Create extends FriendBase implements PageInterface
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

    public function onPost( $match )
    {
        $this->cm->useEntity( '\App\Contacts\Entity\Friend' );
        $this->cm->useEntity( '\App\Contacts\Entity\Contact' );
        $this->cm->useEntity( '\App\Contacts\Entity\Tag' );
        $this->cm->useEntity( '\App\Contacts\Entity\Fr2tg' );
        if( $this->cm->processor->with( $_POST )->clean( '\App\Contacts\Entity\Contact', 'info' )->posts() ) {
            $this->em->save();
        }
        return self::JUMP_TO_APP_ROOT;
    }
    // +----------------------------------------------------------------------+

}

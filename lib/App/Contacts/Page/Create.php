<?php
namespace App\Contacts\Page;

class Create extends FriendBase
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
        $this->cm->processor->with( $_POST )->clean( '\App\Contacts\Entity\Contact', 'info' )->posts();
        $this->em->save();
        // TODO: think about how to reload itself better!
        header( "Location: " . $_SERVER[ 'REQUEST_URI' ] );
        exit;
    }
    // +----------------------------------------------------------------------+

}

<?php
namespace Modules\Contacts\Page;
/**
 * Class Edit
 *
 * @package Modules\Contacts\Page
 *
 * @namespace Modules-Contacts
 */
class Edit extends FriendBase
{
    /**
     * @Inject
     * @var \WScore\DataMapper\Filter\ForUpdate
     */
    public $forUpdate;
    
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
        $this->getParent()->instantiate();
        $this->cm->em()->mm()->addFilter( 'query', $this->forUpdate );
        if( $this->cm->processor->with( $post )->clean( '\Modules\Contacts\Entity\Contact', 'info' )->posts() ) {
            $this->em->save();
            return $this->reload();
        }
        $this->em->fetchByGet();
        $friend = $this->loadFriend( $match );
        $data   = $this->cenaFriend( $friend );
        $this->em->fetchByGet( false );
        $data   = $this->linkContacts( $data );
        $this->assign( $data );
        $this->invalidParameter( 'Please check the input values.' );
        return $this;
    }
    // +----------------------------------------------------------------------+
}
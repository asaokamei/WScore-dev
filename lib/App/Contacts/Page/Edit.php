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

    /**
     * @param $match
     * @return \WScore\DataMapper\Entity\EntityInterface
     */
    private function loadFriend( $match )
    {
        $id = $match[ 'id' ];
        $friend = $this->em->fetch( '\App\Contacts\Entity\Friend', $id );
        $friend = $this->role->applyActive( $friend[0] );
        $friend->relation( 'contacts' )->fetch();
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
        return $data;
    }

    public function onGet( $match )
    {
        $friend = $this->loadFriend( $match );
        $data   = $this->cenaFriend( $friend );
        return $data;
    }

    public function onEdit( $match )
    {
        $friend = $this->loadFriend( $match );
        $data = array(
            'friends'  => $friend,
        );
        return $data;
    }

    public function onPut( $match )
    {
        $friend = $this->loadFriend( $match );
        $this->cm->useEntity( '\App\Contacts\Entity\Friend' );
        $this->cm->processor->with( $_POST )->posts();
        $this->em->save();
        // TODO: think about how to reload itself better!
        header( "Location: " . $_SERVER[ 'REQUEST_URI' ] );
        exit;
    }
}
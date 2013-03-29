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
     * @var \App\Contacts\Model\Friends
     */
    protected $friends;

    /**
     * @Inject
     * @var \WScore\DbAccess\Tools\Paginate
     */
    protected $paginate;

    /**
     * @Inject
     * @var \WScore\Web\View\PaginateBootstrap
     */
    protected $pageView;

    private function loadFriend( $match )
    {
        $id = $match[ 'id' ];
        $friend = $this->em->fetch( '\App\Contacts\Entity\Friend', $id );
        $friend = $this->cm->applyCenaIO( $friend[0] );
        return $friend;
    }

    public function onGet( $match )
    {
        $friend = $this->loadFriend( $match );
        $data = array(
            'friends'  => $friend,
        );
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
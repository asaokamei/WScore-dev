<?php
namespace App\Contacts\Page;

class Index
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

    private function loadIndex( $match )
    {
        $this->paginate->per_page = 3;
        $this->paginate->setOptions( $_GET );
        $query   = $this->paginate->setQuery( $this->friends->query() );
        $friends = $query->order( 'friend_id' )->select();
        $friends = $this->em->fetch( '\App\Contacts\Entity\Friend', $friends );
        $roles = array();
        foreach( $friends as $key => $entity ) {
            $this->em->relation( $entity, 'tags' )->fetch();
            $roles[$key] = $this->cm->applyCenaIO( $entity );
        }
        return $roles;
    }

    public function onGet( $match )
    {
        $friends = $this->loadIndex( $match );
        $data = array(
            'friends'  => $friends,
            'paginate' => $this->paginate,
            'pageView' => $this->pageView,
        );
        return $data;
    }

    public function onEdit( $match )
    {
        $friends = $this->loadIndex( $match );
        // get all tags from database for selection. 
        $tags = $this->em->getModel( '\App\Contacts\Entity\Tag' )->query()->select();
        $tagList = $this->em->fetch( '\App\Contacts\Entity\Tag', $tags );
        $data = array( 
            'friends' => $friends,
            'tagList' => $tagList,
        );
        return $data;
    }

    public function onPut( $match )
    {
        $this->cm->useEntity( '\App\Contacts\Entity\Friend' );
        $this->cm->useEntity( '\App\Contacts\Entity\Tag' );
        $this->cm->useEntity( '\App\Contacts\Entity\Fr2tg' );
        $this->cm->processor->with( $_POST )->posts();
        $this->em->save();
        // TODO: think about how to reload itself better!
        header( "Location: " . $_SERVER[ 'REQUEST_URI' ] );
        exit;
    }
}
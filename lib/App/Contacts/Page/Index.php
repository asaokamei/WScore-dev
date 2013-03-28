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
        $data = array( 'friends' => $friends );
        return $data;
    }
}
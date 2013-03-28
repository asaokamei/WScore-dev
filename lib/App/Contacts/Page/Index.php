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
     * @var string
     */
    protected $friend = '\App\Contacts\Entity\Friend';

    private function loadIndex( $match )
    {
        $friends = $this->friends->query()->order( 'friend_id' )->select();
        $friends = $this->em->fetch( $this->friend, $friends );
        $roles = array();
        foreach( $friends as $key => $entity ) {
            $roles[$key] = $this->cm->applyCenaIO( $entity );
        }
        return $roles;
    }

    public function onGet( $match )
    {
        $friends = $this->loadIndex( $match );
        $data = array( 'friends' => $friends );
        return $data;
    }

    public function onEdit( $match )
    {
        $friends = $this->loadIndex( $match );
        $data = array( 'friends' => $friends );
        return $data;
    }
}
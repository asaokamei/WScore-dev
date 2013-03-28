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
     * @var \WScore\DataMapper\RoleManager
     */
    protected $role;

    /**
     * @Inject
     * @var \App\Contacts\Model\Friends
     */
    protected $friends;

    /**
     * @var string
     */
    protected $friend = '\App\Contacts\Entity\Friend';

    public function onGet( $match )
    {
        $friends = $this->friends->query()->order( 'friend_id' )->select();
        $friends = $this->em->fetch( $this->friend, $friends );
        $roles = array();
        foreach( $friends as $key => $entity ) {
            $roles[$key] = $this->role->applyDataIO( $entity );
        }
        return array( 'friends' => $roles );
    }
}
<?php
namespace App\Contacts\Page;

class Setup
{
    /**
     * @Inject
     * @var \App\Contacts\Model\Friends
     */
    protected $friends;
    
    public function onGet( $match )
    {
        return 'Setup';
    }
    
    public function onPut( $match )
    {
        // setup for friends data.
        $this->friends->setupTable();
        for( $i = 1; $i <= 5; $i++ ) {
            $friend = $this->friends->getFriendData($i);
            $this->friends->insert( $friend );
        }
    }
}
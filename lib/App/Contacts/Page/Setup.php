<?php
namespace App\Contacts\Page;

class Setup
{
    /**
     * @Inject
     * @var \App\Contacts\Model\Friends
     */
    protected $friends;

    /**
     * @Inject
     * @var \App\Contacts\Model\Contacts
     */
    protected $contacts;

    public function onGet( $match )
    {
        return 'Setup';
    }
    
    public function onPut( $match )
    {
        // setup for friends data.
        $this->friends->setupTable();
        for( $i = 1; $i <= 10; $i++ ) {
            $friend = $this->friends->getFriendData($i);
            $this->friends->insert( $friend );
        }
        //setup for contacts data.
        $this->contacts->setupTable();
        for( $i = 1; $i <= 10; $i++ ) {
            $contact = $this->contacts->makeContact($i);
            $this->contacts->insert( $contact );
        }
    }
}
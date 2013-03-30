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

    /**
     * @Inject
     * @var \App\Contacts\Model\Tags
     */
    protected $tags;

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
        for( $i = 1; $i <= 15; $i++ ) {
            $contact = $this->contacts->makeContact($i);
            $this->contacts->insert( $contact );
        }
        //setup for contacts data.
        $this->tags->setupTable();
        for( $i = 0; $i <= 3; $i++ ) {
            $tag = $this->tags->makeTag($i);
            $this->tags->insert( $tag );
        }
    }
}
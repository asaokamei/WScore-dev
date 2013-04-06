<?php
namespace App\Contacts\Page;

use \WScore\Web\Page\PageInterface;

class Setup implements PageInterface
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

    /**
     * @Inject
     * @var \App\Contacts\Model\Fr2tg
     */
    protected $fr2tg;

    public function onGet( $match )
    {
        return self::RENDER_PAGE;
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
        //setup for contacts data.
        $this->fr2tg->setupTable();
        for( $i = 0; $i <= 5; $i++ ) {
            $fr2tg = $this->fr2tg->makeFr2tg($i);
            $this->fr2tg->insert( $fr2tg );
        }
    }
}
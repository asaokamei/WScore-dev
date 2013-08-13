<?php
namespace Modules\Contacts\Page;

use WScore\Response\PageAbstract;

/**
 * Class Setup
 *
 * @package Modules\Contacts\Page
 *
 * @namespace Modules-Contacts
 */
class Setup extends PageAbstract
{
    /**
     * @Inject
     * @var \Modules\Contacts\Model\Friends
     */
    public $friends;

    /**
     * @Inject
     * @var \Modules\Contacts\Model\Contacts
     */
    public $contacts;

    /**
     * @Inject
     * @var \Modules\Contacts\Model\Tags
     */
    public $tags;

    /**
     * @Inject
     * @var \Modules\Contacts\Model\Fr2tg
     */
    public $fr2tg;

    public function onGet( $match )
    {
        return array();
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
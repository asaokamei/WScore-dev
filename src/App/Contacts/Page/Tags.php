<?php
namespace App\Contacts\Page;

use \WScore\Web\Page\PageInterface;

class Tags implements PageInterface
{
    /**
     * @Inject
     * @var \WScore\DataMapper\EntityManager
     */
    public $em;

    /**
     * @Inject
     * @var \WScore\Cena\CenaManager
     */
    public $cm;

    /**
     * @Inject
     * @var \App\Contacts\Model\Tags
     */
    public $tags;

    private function loadIndex( $match )
    {
        $tags = $this->tags->query()->order( 'tag_code' )->select();
        $tags = $this->em->fetch( '\App\Contacts\Entity\Tag', $tags );
        $roles = array();
        foreach( $tags as $key => $entity ) {
            $roles[$key] = $this->cm->applyCenaIO( $entity );
        }
        return $roles;
    }

    public function onGet( $match )
    {
        $tags = $this->loadIndex( $match );
        $data = array(
            'tags'  => $tags,
        );
        return $data;
    }

    public function onEdit( $match )
    {
        $tags = $this->loadIndex( $match );
        $new  = $this->em->newEntity( '\App\Contacts\Entity\Tag' );
        $new  = $this->cm->applyCenaIO( $new );
        $data = array(
            'tags'  => $tags,
            'new'   => $new,
        );
        return $data;
    }

    public function onPost( $match, $post )
    {
        $this->cm->useEntity( '\App\Contacts\Entity\Tag' );
        if( $this->cm->processor->with( $post )->clean( '\App\Contacts\Entity\Tag', 'tag_code' )->posts() ) {
            $this->em->save();
        }
        return self::RELOAD_SELF;
    }

}
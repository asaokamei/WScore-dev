<?php
namespace App\Contacts\Page;

class Tags
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
     * @var \App\Contacts\Model\Tags
     */
    protected $tags;

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

    public function onPost( $match )
    {
        $this->cm->useEntity( '\App\Contacts\Entity\Tag' );
        if( $this->cm->processor->with( $_POST )->clean( '\App\Contacts\Entity\Tag', 'tag_code' )->posts() ) {
            $this->em->save();
        }
        return true;
    }

}
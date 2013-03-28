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
        $data[ 'htmlType' ]   = 'html';
        $data[ 'nextMethod' ] = 'edit';
        $data[ 'button' ]     = 'edit contacts';
        $data[ 'cancel' ]     = false;
        return $data;
    }

    public function onEdit( $match )
    {
        /** @var $model \App\Contacts\Model\Friends */
        $model   = $this->em->getModel( $this->friend );
        //$model->onListEdit();
        $sel = $model->getSelector( 'friend_name' );
        $sel->attributes[ 'class' ] = 'span3';
        $sel = $model->getSelector( 'gender' );
        $sel->attributes[ 'class' ] = 'span2';
        $sel->style = 'select';

        $friends = $this->loadIndex( $match );
        $data = array( 'friends' => $friends );
        $data[ 'htmlType' ]   = 'form';
        $data[ 'nextMethod' ] = 'put';
        $data[ 'button' ]     = 'save changes';
        $data[ 'cancel' ]     = true;
        return $data;
    }
}
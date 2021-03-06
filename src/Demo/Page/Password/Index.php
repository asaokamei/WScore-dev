<?php
namespace Demo\Page\Password;

use WScore\Response\PageAbstract;

class Index extends PageAbstract
{
    /**
     * @Inject
     * @var \Demo\Role\PwdAble
     */
    public $password;

    /**
     * @Inject
     * @var \WScore\Html\Forms
     */
    public $form;

    public function onGet( $match=array() )
    {
        $input = $this->password->init();
        $data = $this->form( $input );
        $data[ 'class' ]  = 'me:'.get_called_class();
        return $data;
    }

    public function onPost( $match )
    {
        $input = $this->password->getInput();
        $data = $this->form( $input );
        $data[ 'passwords' ] = $this->password->generate( $input );
        return $data;
    }
    protected function form( $input )
    {
        $counts = array(
            array(  '5', ' 5 passwords' ),
            array( '10', '10 passwords' ),
            array( '15', '15 passwords' ),
        );
        $data = array();
        $data[ 'length' ]  = $this->form->input( 'range', 'length' ,$input[ 'length' ] )->min(5)->max(24);
        $data[ 'symbol' ]  = $this->form->input( 'checkbox', 'symbol', 'checked' )->checked( $input[ 'symbol' ] );
        $data[ 'count' ]   = $this->form->select( 'count', $counts, array( $input['count'] ) );

        return $data;
    }
}
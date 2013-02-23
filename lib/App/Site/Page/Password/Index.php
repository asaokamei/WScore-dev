<?php
namespace App\Site\Page\Password;

class Index
{
    /**
     * @Inject
     * @var \WScore\Html\Forms
     */
    protected $form;

    public function onGet( $match )
    {
        $input = array( 'length' => 12, 'symbol' => false, 'count' => 5 );
        $data = $this->form( $input );
        $data[ 'class' ]  = 'me:'.get_called_class();
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
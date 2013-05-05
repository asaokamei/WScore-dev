<?php
namespace App\Pwd\Role;

use \App\Pwd\Model\Password;

class PwdAble
{
    /**
     * @Inject
     * @var \WScore\Web\Http\Request
     */
    public $request;
    /**
     * @return array
     */
    public function init() {
        return $input = array(
            'length' => '12',
            'symbol' => false,
            'count'  => '5',
        );
    }

    /**
     * @param array $input
     * @return array
     */
    public function generate( $input )
    {
        $passwords = array();
        for( $i = 0; $i < $input[ 'count' ]; $i ++ ) {
            $pw = Password::generate( $input[ 'length' ], $input[ 'symbol' ] );
            $words = array(
                'password' => $pw,
                'crypt'    => crypt( $pw, Password::generate(2) ),
                'md5'      => md5( $pw ),
            );
            $passwords[] = $words;
        }
        return $passwords;
    }

    public function getInput()
    {
        $input = array();
        $input[ 'length' ] = $this->request->getPost( 'length', 'number' );
        $input[ 'count'  ] = $this->request->getPost( 'count', 'number' );
        $input[ 'symbol' ] = !!$this->request->getPost( 'symbol' );
        return $input;
    }
}

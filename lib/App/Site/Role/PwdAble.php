<?php
namespace App\Site\Role;

use \App\Site\Model\Password;

class PwdAble
{
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
}

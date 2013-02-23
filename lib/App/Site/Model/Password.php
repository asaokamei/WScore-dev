<?php
namespace App\Site\Model;

class Password
{
    /**
     * generates a random password.
     *
     * @param int  $length
     * @param bool $all
     * @return string
     */
    public static function generate( $length=12, $all=false )
    {
        if( $length < 5 ) return static::password4( $length, $all );
        return static::password12( $length, $all );
    }
    public static function password12( $length=12, $all=false )
    {
        $vows   = 'aiue';
        $number = '23456789';
        $letter = 'bcdfghjkmnpqrstvwxyz';
        $symbol = '-_~!@#$%^&*()_+=';

        $select = function( $list, $max ) {
            $str = '';
            for( $i = 0; $i < $max; $i ++ ) {
                $str .= $list[ mt_rand( 0, strlen( $list ) - 1 ) ];
            }
            return $str;
        };
        // first, make password only with numbers and symbols.
        $password  = '';
        $password .= $select( $number, mt_rand( 1, 3 ) );
        if( $all ) { // use symbols.
            $password .= $select( $symbol, mt_rand( 1, 2 ) );
        }
        // create rest of password with alphabets. only one vows.
        $letter .= $select( $letter, mt_rand( 1, 2 ) ); // duplicate one chars.
        $alphabet  = $select( $vows, 1 );
        $alphabet .= $select( $letter, $length - strlen( $password ) - strlen( $alphabet ) );
        $alphabet  = str_shuffle( $alphabet );

        // make some of the alphabets to upper case
        $divide = mt_rand( 1, strlen( $alphabet ) - 1 );
        $upper = strtoupper( substr( $alphabet, 0, $divide ) );
        $lower = substr( $alphabet, $divide );

        // put together and shuffle the password.
        $password = $password . $lower . $upper;
        $password = str_shuffle( $password );
        return $password;
    }
    public static function password4( $length=4, $all=false )
    {
        $letter = '23456789aiuebcdfghjkmnpqrstvwxyz';
        $symbol = '-_~!@#$%^&*()_+=';
        if( $all ) $letter .= $symbol;
        $password = '';
        for( $i = 0; $i < $length; $i ++ ) {
            $char =  $letter[ mt_rand( 0, strlen( $letter ) - 1 ) ];
            $password .= (mt_rand(0,2)>1) ? strtoupper( $char ) : strtolower( $char );
        }
        return $password;
    }
}
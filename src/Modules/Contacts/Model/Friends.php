<?php
namespace Modules\Contacts\Model;

use \WScore\DataMapper\Model\Model;

/**
 * Class Friends
 * @package Modules\Contacts\Model
 *
 * @namespace Modules-Contacts
 */
class Friends extends Model
{
    protected $table = 'demoFriend';
    
    protected $id_name = 'friend_id';

    const GENDER_MALE   = 'M';
    const GENDER_FEMALE = 'F';
    const GENDER_NONE   = 'N';

    public function __construct()
    {
        parent::__construct();
        $csv = file_get_contents( __DIR__ . '/friends.csv' );
        $this->property->setupCsv( $csv );
        $this->setGenderChoice();
    }

    public function setupTable()
    {
        $table = $this->table;
        $sql = "DROP TABLE IF EXISTS {$table}";
        $this->persistence->query()->dbAccess()->execSQL( $sql );
        $sql = "
            CREATE TABLE {$table} (
              friend_id    SERIAL,
              friend_name  text    NOT NULL,
              gender       char(1) NOT NULL,
              friend_bday  date,
              new_dt_friend   datetime,
              mod_dt_friend   datetime,
              constraint friend_pkey PRIMARY KEY (
                friend_id
              )
            )
        ";
        $this->persistence->query()->dbAccess()->execSQL( $sql );
    }

    /**
     * @param int $idx
     * @return array
     */
    function getFriendData( $idx=1 )
    {
        $gender = array( 'M', 'F' );
        $gender = $gender[ $idx % 2 ];
        $date   = new \DateTime( '1989-02-01' );
        $date->add( new \DateInterval( "P{$idx}D" ) );
        $data = array(
            'friend_name' => 'friend #' . $idx,
            'gender'      => $gender,
            'friend_bday' => $date->format( 'Y-m-d' ),
        );
        return $data;
    }

    public function setGenderChoice( $all=false )
    {
        $this->property->setProperty( 'gender', 'choice', array(
            array( self::GENDER_FEMALE, 'female' ),
            array( self::GENDER_MALE, 'male' ),
        ) );
        if( $all ) {
            $choice = $this->property->getProperty( 'gender', 'choice' );
            $choice[] = array( self::GENDER_NONE, 'not sure' );
            $this->property->setProperty( 'gender', 'choice', $choice );
        }
    }
}
<?php
namespace App\Contacts\Model;

use \WScore\DataMapper\Model;

/**
 * Class Contacts
 * @package App\Contacts\Model
 *
 * @singleton
 */
class Contacts extends Model
{
    protected $table = 'demoContact';
    
    protected $id_name = 'contact_id';

    const TYPE_TELEPHONE  = '1';
    const TYPE_EMAIL      = '2';
    const TYPE_SOCIAL     = '3';

    public function __construct()
    {
        parent::__construct();
        $csv = file_get_contents( __DIR__ . '/contacts.csv' );
        $this->property->prepare( $csv );
        $this->property->selectors[ 'type' ][ 'choice' ] = array(
            array( self::TYPE_TELEPHONE, 'telephone' ),
            array( self::TYPE_EMAIL,     'e-mails' ),
            array( self::TYPE_SOCIAL,    'social' ),
        );
    }

    public function setupTable()
    {
        $table = $this->table;
        $sql = "DROP TABLE IF EXISTS {$table}";
        $this->persistence->query()->dbAccess()->execSQL( $sql );
        $sql = "
            CREATE TABLE {$table} (
              contact_id       SERIAL,
              friend_id        int,
              info     text,
              type     text,
              new_dt_contact   datetime,
              mod_dt_contact   datetime,
              constraint contact_id PRIMARY KEY (
                contact_id
              )
            )
        ";
        $this->persistence->query()->dbAccess()->execSQL( $sql );
    }

    /**
     * @param int $idx
     * @return array
     */
    static function makeContact( $idx=0 )
    {
        $rel  = array( '1', '2', '3', '4' );
        $rel  = $rel[ $idx % 4 ];
        $type = array( '1', '2', '3' );
        $type = $type[ $idx % 3 ];
        $values = array(
            'friend_id' => $rel, 
            'info' => 'my contact',
            'type' => $type,
        );
        if( $idx > 0 ) {
            $values[ 'info' ] .= '#' . $idx;
        }
        return $values;
    }
}
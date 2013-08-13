<?php
namespace Modules\Contacts\Model;

use \WScore\DataMapper\Model\Model;

/**
 * Class Fr2tg
 * @package Modules\Contacts\Model
 *
 * @namespace Modules-Contacts
 */
class Fr2tg extends Model
{
    protected $table = 'demoFr2tg';
    
    protected $id_name = 'fr2tg_id';

    public function __construct()
    {
        parent::__construct();
        $csv = file_get_contents( __DIR__ . '/fr2tg.csv' );
        $this->property->setupCsv( $csv );
    }

    public function setupTable()
    {
        $table = $this->table;
        $sql = "DROP TABLE IF EXISTS {$table}";
        $this->persistence->query()->dbAccess()->execSQL( $sql );
        $sql = "
            CREATE TABLE {$table} (
              fr2tg_id          SERIAL,
              friend_id         int,
              tag_code        Varchar(64),
              created_at        datetime,
              updated_at        datetime,
              constraint fr2tg_pkey PRIMARY KEY (
                fr2tg_id
              ),
              constraint fr2gr_joins UNIQUE (
                friend_id, tag_code
              )
            )
        ";
        $this->persistence->query()->dbAccess()->execSQL( $sql );
    }

    /**
     * @param int $idx
     * @return array
     */
    static function makeFr2tg( $idx=0 )
    {
        $friend_id = ( $idx % 3 ) + 1;
        $tags      = array( 'demo', 'test' );
        $tags      = $tags[ $idx % 2 ];
        $values = array(
            'friend_id' => $friend_id,
            'tag_code'  => $tags,
        );
        return $values;
    }
}
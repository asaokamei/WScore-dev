<?php
namespace App\Contacts\Model;

use \WScore\DataMapper\Model;

/**
 * Class Tags
 * @package App\Contacts\Model
 *
 * @namespace App-Contacts
 */
class Tags extends Model
{
    protected $table = 'demoTag';

    protected $id_name = 'tag_code';

    public function __construct()
    {
        parent::__construct();
        $csv = file_get_contents( __DIR__ . '/tags.csv' );
        $this->property->prepare( $csv );
    }

    public function setupTable()
    {
        $table = $this->table;
        $sql = "DROP TABLE IF EXISTS {$table}";
        $this->persistence->query()->dbAccess()->execSQL( $sql );
        $sql = "
            CREATE TABLE {$table} (
              tag_code   varchar(64) NOT NULL,
              name       varchar(128) NOT NULL DEFAULT '',
              created_at datetime,
              updated_at datetime,
              constraint tags_pkey PRIMARY KEY (
                tag_code
              )
            )
        ";
        $this->persistence->query()->dbAccess()->execSQL( $sql );
    }

    /**
     * @param int $idx
     * @return array
     */
    static function makeTag( $idx=0 )
    {
        $tags = array(
            array( 'tag_code' => 'demo', 'name' => 'demonstration'),
            array( 'tag_code' => 'test', 'name' => 'testing'),
            array( 'tag_code' => 'more', 'name' => 'more tags'),
        );
        if( isset( $tags[ $idx ] ) ) {
            $values = $tags[ $idx ];
        } else {
            $values = $tags[2];
            $values[ 'tag_code' ] .= $idx;
            $values[ 'name' ]      = "more{$idx} ". $tags[2]['name'];
        }
        return $values;
    }

    /**
     * @param array $data
     * @return string
     */
    public function insert( $data )
    {
        return $this->persistence->insertValue( $data );
    }
}

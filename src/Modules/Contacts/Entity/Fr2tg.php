<?php
namespace Modules\Contacts\Entity;

use \WScore\DataMapper\Entity\EntityAbstract;

class Fr2tg extends EntityAbstract
{
    static $_modelName = '\Modules\Contacts\Model\Fr2tg';
    public $fr2tg_id;
    public $friend_id;
    public $tag_code;
    public $created_at;
    public $updated_at;
}

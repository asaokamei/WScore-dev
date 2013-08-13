<?php
namespace Modules\Contacts\Entity;

use \WScore\DataMapper\Entity\EntityAbstract;

class Tag extends EntityAbstract
{
    static $_modelName = '\Modules\Contacts\Model\Tags';

    public $tag_code;
    public $name;
    public $created_at;
    public $updated_at;
}
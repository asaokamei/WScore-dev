<?php
namespace Modules\Contacts\Entity;

use \WScore\DataMapper\Entity\EntityAbstract;

class Contact extends EntityAbstract
{
    static $_modelName = '\Modules\Contacts\Model\Contacts';
    public $contact_id;
    public $friend_id;
    public $info;
    public $type;
    public $new_dt_contact;
    public $mod_dt_contact;
    public $friend;
}

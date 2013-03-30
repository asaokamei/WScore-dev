<?php
namespace App\Contacts\Entity;

use \WScore\DataMapper\Entity\EntityAbstract;

class Friend extends EntityAbstract
{
    static $_modelName = '\App\Contacts\Model\Friends';
    
    public $friend_id;
    public $friend_name;
    public $gender;
    public $friend_bday;
    public $friend_tel;
    public $new_dt_friend;
    public $mod_dt_friend;
    public $contacts;
    public $tags;
}
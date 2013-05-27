<?php
namespace App\Tasks\Entity;

use \WScore\DataMapper\Entity\EntityAbstract;

/**
 * Class Task
 *
 * @package App\Tasks\Entity
 *
 * @namespace App-Tasks
 */
class Task extends EntityAbstract
{
    const STATUS_ACTIVE = '1';
    const STATUS_DONE   = '9';

    public static $_modelName = '\App\Tasks\Model\Tasks';

    public $task_id = null;

    public $memo = '';

    public $done_by = '';

    public $status = self::STATUS_ACTIVE;

    public $created_at;

    public $updated_at;

    /**
     * @return bool
     */
    public function isDone() {
        return $this->status == self::STATUS_DONE;
    }

    /**
     *
     */
    public function setDone() {
        $this->status = self::STATUS_DONE;
    }
}


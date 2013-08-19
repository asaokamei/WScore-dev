<?php
namespace Modules\Tasks\Core;

use \Modules\Tasks\Core\Task;
use \WScore\DataMapper\Model\Model;

/**
 * Class Tasks
 *
 * @package Modules\Tasks\Core
 * 
 * @namespace Modules-Tasks
 */
class TaskModel extends Model
{
    /** @var string     name of database table     */
    protected $table = 'task';

    /** @var string     name of primary key        */
    protected $id_name = 'task_id';

    // +----------------------------------------------------------------------+
    /**
     */
    public function __construct()
    {
        parent::__construct();
        $csv = file_get_contents( __DIR__ . '/tasks.csv' );
        $this->property->setupCsv( $csv );
        $this->property->setProperty( 'status', 'choice', array(
            array( Task::STATUS_ACTIVE, 'active' ),
            array( Task::STATUS_DONE,   'done' ),
        ) );
    }

    public function getCreateSql() 
    {
        $sql = "
        CREATE TABLE {$this->table} (
          task_id    INTEGER PRIMARY KEY AUTOINCREMENT,
          memo       varchar(2048) NOT NULL DEFAULT '',
          done_by    date,
          status     char(1) NOT NULL DEFAULT '1',
          created_at text,
          updated_at text
        );
        ";
        return $sql;
    }
    public function getClearSql() {
        $sql = "DROP TABLE IF EXISTS {$this->table}";
        return $sql;
    }
    public function getSampleTasks( $idx=1 ) 
    {
        $memo = array(
            1 => 'set done this task',
            2 => 'modify this task',
            3 => 'add a new task',
            4 => 'try validation? set all blank and update/insert a task. ',
            5 => 'delete all finished tasks and setup the task list',
        );
        $task = array(
            'memo' => 'task #' . $idx . ' ' . $memo[ $idx ],
            'status' => task::STATUS_ACTIVE,
            'done_by' => sprintf( '2012-11-%02d', $idx + 1 ),
        );
        return $task;
    }
}
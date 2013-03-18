<?php
namespace App\Tasks\Model;

use \App\Tasks\Entity\Task;
use \WScore\DataMapper\Model;

class tasks extends Model
{
    /** @var string     name of database table     */
    protected $table = 'task';

    /** @var string     name of primary key        */
    protected $id_name = 'task_id';

    public $recordClassName = '\App\Tasks\Entity\Task';

    // +----------------------------------------------------------------------+
    /**
     */
    public function __construct()
    {
        parent::__construct();
        $csv = file_get_contents( __DIR__ . '/tasks.csv' );
        $this->property->prepare( $csv );
        $this->property->selectors[ 'status' ][ 'choice' ] = array(
            array( Task::STATUS_ACTIVE, 'active' ),
            array( Task::STATUS_DONE,   'done' ),
        );
    }

    public function getCreateSql() 
    {
        $sql = "
        CREATE TABLE {$this->table} (
          task_id   SERIAL,
          memo text NOT NULL DEFAULT '',
          done_by date,
          status char(1) NOT NULL DEFAULT '1',
          new_dt_task text,
          mod_dt_task text
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
            'task_memo' => 'task #' . $idx . ' ' . $memo[ $idx ],
            'task_status' => task::STATUS_ACTIVE,
            'task_date' => sprintf( '2012-11-%02d', $idx + 1 ),
        );
        return $task;
    }
}
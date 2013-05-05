<?php
namespace App\Tasks\Page;

class Setup
{
    /**
     * @Inject
     * @var \App\Tasks\Model\Tasks
     */
    public $tasks;
    
    public function onGet( $match )
    {
    }
    
    public function onPut( $match )
    {
        $sql = $this->tasks->getClearSql();
        $this->tasks->dbAccess()->execSql( $sql );
        $sql = $this->tasks->getCreateSql();
        $this->tasks->dbAccess()->execSql( $sql );
        for( $i = 1; $i <= 5; $i++ ) {
            $task = $this->tasks->getSampleTasks($i);
            $this->tasks->insert( $task );
        }
    }
}
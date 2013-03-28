<?php

use \App\Tasks\Entity\Task;

/** @var $this \WScore\Template\TemplateInterface */

if( !$tasks = $this->get( 'tasks' ) ) {
    echo '<p>not ready; more tasks to come... </p>';
    return;
}
?>
<h1>Contacts List</h1>
<?php

use \Modules\Tasks\Entity\Task;

/** @var $this \WScore\Template\TemplateInterface */

if( !$tasks = $this->get( 'tasks' ) ) {
    echo '<p>not ready; more tasks to come... </p>';
    return;
}
?>
<h1>Task List</h1>
<!-- HtmlTest: Needle=Tasks/View/index -->
<style>
    form {margin: 0;}
</style>
<table class="table">
    <thead>
    <tr>
        <th>task to do</th>
        <th>done by</th>
        <th>done</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach( $tasks as $task ) {

        /** @var $task \WScore\DataMapper\Role\DataIO */
        $task->setHtmlType( 'html' );
        // create memo.
        $memo = $task->popHtml( 'memo' );
        if( $task->get( 'status' ) == Task::STATUS_ACTIVE ) {
            $memo = "<strong>{$memo}</strong>";
        }
        $edit = $this->get( 'appRoot' ) . $task->getId();
        $memo = "<!--suppress HtmlUnknownTarget --><a href=\"{$edit}\" >{$memo}</a>";
        // create done button.
        $doneUrl = $this->get( 'appRoot' ) . 'done/'.$task->getId();
        if( $task->get( 'status' ) == Task::STATUS_ACTIVE ) {
            $classes  = 'btn btn-small btn-primary';
            $doneUrl .= '?_method=put';
        } else {
            $classes = 'btn btn-small';
            $doneUrl .= '?_method=delete';
        }
        $done = "<!--suppress HtmlUnknownTarget --><form action=\"{$doneUrl}\" method='post'><input type='submit' value='done' class='{$classes}'></form>";
        ?>
        <tr>
            <td><?php echo $memo; ?></td>
            <td><?php echo $task->popHtml( 'done_by' ); ?></td>
            <td><?php echo $done; ?></td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>


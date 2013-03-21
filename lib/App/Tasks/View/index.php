<h1>Task List</h1>
<?php

/** @var $this \WScore\Template\TemplateInterface */

if( !$tasks = $this->get( 'tasks' ) ) {
    echo '<p>not ready; more tasks to come... </p>';
    return;
}
?>
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
        ?>
        <tr>
            <td><?php echo $task->popHtml( 'memo' ); ?></td>
            <td><?php echo $task->popHtml( 'done_by' ); ?></td>
            <td><?php echo $task->popHtml( 'status' ); ?></td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>


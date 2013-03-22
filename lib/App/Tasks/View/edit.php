<?php

/** @var $this \WScore\Template\TemplateInterface */

?>
<h1>Edit Task #<?php echo $this->id; ?></h1>
<?php
/** @var $task \WScore\DataMapper\Role\DataIO */
$task = $this->get( 'task' );
$task->setHtmlType( 'edit' );

?>
<form name="edit" action="" method="post">
    <dl>
        <dt>task memo</dt>
        <dd><?php echo $task->popHtml( 'memo' )->class_( 'span5' ); ?></dd>
        <dt>done by</dt>
        <dd><?php echo $task->popHtml( 'done_by' )->class_( false ); ?></dd>
        <dt>status</dt>
        <dd><?php echo $task->popHtml( 'status' ); ?></dd>
    </dl>
    <input type="hidden" name="_method" value="put">
    <button type="submit" class="btn btn-primary">save</button>
    <a href="<?php echo $this->get( 'appRoot' ); ?>" class="btn">cancel</a>
</form>
<p>not ready; more tasks to come... </p>
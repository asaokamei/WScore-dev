<?php

/** @var $this \WScore\Template\TemplateInterface */

/** @var $task \WScore\DataMapper\Role\DataIO */
$task = $this->get( 'task' );
$task->setHtmlType( 'edit' );

if( $this->get( 'onMethod' ) == 'onPost' ) {
    $title = 'Re-Enter New Task';
} else {
    $title = 'New Task';
}

$view = $this;
/**
 * @param \WScore\DataMapper\Role\DataIO $task
 * @param string $key
 * @return string
 */
function error( $task, $key ) {
    if( !$task->isError( $key ) ) return '';
    return '<br /><p class="text-error">'. $task->getError( $key ) . '</p>';
}

?>
<h1><?php echo $title; ?></h1>
<form name="edit" action="" method="post">
    <dl>
        <dt>task memo</dt>
        <dd><?php echo $task->popHtml( 'memo' )->class_( 'span5' ); ?>
            <?php echo error( $task, 'memo' ); ?>
        </dd>
        <dt>done by</dt>
        <dd><?php echo $task->popHtml( 'done_by' )->class_( false ); ?>
            <?php echo error( $task, 'done_by' ); ?>
        </dd>
        <dt>status</dt>
        <dd><?php echo $task->popHtml( 'status' ); ?>
            <?php echo error( $task, 'status' ); ?>
        </dd>
    </dl>
    <button type="submit" class="btn btn-primary">save</button>
    <a href="<?php echo $this->get( 'appRoot' ); ?>" class="btn">cancel</a>
</form>

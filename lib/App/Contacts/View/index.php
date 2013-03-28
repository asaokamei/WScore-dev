<?php

use \App\Tasks\Entity\Task;

/** @var $this \WScore\Template\TemplateInterface */

if( !$tasks = $this->get( 'friends' ) ) {
    echo '<p>not ready; more tasks to come... </p>';
    return;
}

$method     = $this->get( 'onMethod' );
$htmlType   = $this->get( 'htmlType' );
$nextMethod = $this->get( 'nextMethod' );
$button     = $this->get( 'button' );
$cancel     = $this->get( 'cancel' );

?>
<h1>Contacts List</h1>
<form name="friend" method="post" action="">
<table class="table">
    <thead>
    <tr>
        <th>&nbsp;</th>
        <th>name</th>
        <th>gender</th>
        <th>tags</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <?php
    foreach( $this->arr( 'friends' ) as $friend ) {
        /** @var $friend \WScore\Cena\Role\CenaIO */
        $detailUrl = $this->get( 'appRoot' ) . $friend->getId();
        $friend->setHtmlType( $htmlType );
        ?>
    <tbody>
    <tr>
        <td></td>
        <td><?php echo $friend->popHtml( 'friend_name' ); ?></td>
        <td><?php echo $friend->popHtml( 'gender' ); ?></td>
        <td>...</td>
        <td><a href="<?php echo $detailUrl; ?>" class="btn btn-mini">&gt;&gt;</a></td>
    </tr>
    </tbody>
    <?php } ?>
</table>
    <button name="submit" class="btn btn-primary"><?php echo $button; ?></button>
    <input type="hidden" name="_method" value="<?php echo $nextMethod; ?>"/>
    <?php if( $cancel ) echo '<a href="" class="btn">cancel</a>'; ?>
</form>

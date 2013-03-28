<?php

use \App\Tasks\Entity\Task;

/** @var $this \WScore\Template\TemplateInterface */

if( !$tasks = $this->get( 'friends' ) ) {
    echo '<p>not ready; more tasks to come... </p>';
    return;
}

?>
<h1>Contacts List</h1>
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
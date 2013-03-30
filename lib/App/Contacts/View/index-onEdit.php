<?php

use \App\Tasks\Entity\Task;

/** @var $this \WScore\Template\TemplateInterface */
/** @var $friends \WScore\Cena\Role\CenaIO[] */
$friends = $this->arr( 'friends' );

$sel = $friends[0]->form( 'friend_name' );
$sel->attributes[ 'class' ] = 'span3';

$sel = $friends[0]->form( 'gender' );
$sel->attributes[ 'class' ] = 'span2';
$sel->style = 'select';

?>
<form name="friend" method="post" action="">
<table class="table">
    <thead>
    <tr>
        <th>&nbsp;</th>
        <th>name</th>
        <th>gender</th>
        <th>tags</th>
    </tr>
    </thead>
    <?php
    $tagList = $this->get( 'tagList' );
    foreach( $friends as $friend ) {
        /** @var $friend \WScore\Cena\Role\CenaIO */
        $friend->setHtmlType( 'form' );
        ?>
    <tbody>
    <tr>
        <td></td>
        <td><?php echo $friend->popHtml( 'friend_name' ); ?></td>
        <td><?php echo $friend->popHtml( 'gender' ); ?></td>
        <td><?php echo $friend->popLinkSelect( 'tags', $tagList, 'name', 'select' )->style('height:auto'); ?></td>
    </tr>
    </tbody>
    <?php } ?>
</table>
    <button name="submit" class="btn btn-primary">Save Changes</button>
    <input type="hidden" name="_method" value="put"/>
    <a href="" class="btn">cancel</a>
</form>

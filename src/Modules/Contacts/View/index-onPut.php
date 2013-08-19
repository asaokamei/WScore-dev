<?php

/** @var $this \WScore\Template\TemplateInterface */
/** @var $friends \Modules\Contacts\Entity\Friend[] */
/** @var $role \WScore\Cena\Role\CenaIO */

$friends = $this->arr( 'friends' );
$role    = $this->get( 'CenaIo' );

$role->register( $friends[0] );
$sel = $role->form( 'friend_name' );
$sel->attributes[ 'class' ] = 'span3';

$sel = $role->form( 'gender' );
$sel->attributes[ 'class' ] = 'span2';
$sel->style = 'select';

$error = function( $role, $name ) {
    if( $error = $role->getError( $name ) ) {
        return "<br /><span class=\"text-error\">{$error}</span>";
    }
    return '';
}

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
        $role->register( $friend );
        $role->setHtmlType( 'form' );
        ?>
    <tbody>
    <tr>
        <td></td>
        <td><?php echo $role->popHtml( 'friend_name' ); echo $error( $role, 'friend_name' ); ?></td>
        <td><?php echo $role->popHtml( 'gender' ); echo $error( $role, 'gender' ); ?></td>
        <td><?php echo $role->popLinkSelect( 'tags', $tagList, 'name', 'select' )->size('1'); ?>
        <?php echo $role->popEmptyLink( 'tags' ); ?>
        </td>
    </tr>
    </tbody>
    <?php } ?>
</table>
    <button name="submit" class="btn btn-primary">Save Changes</button>
    <input type="hidden" name="_method" value="put"/>
    <a href="" class="btn">cancel</a>
</form>

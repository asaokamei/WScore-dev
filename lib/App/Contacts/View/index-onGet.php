<?php

use \App\Tasks\Entity\Task;

/** @var $this \WScore\Template\TemplateInterface */

?>
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
        $friend->setHtmlType( 'html' );
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
    <?php
    $appRoot   = $this->get( 'appRoot' );
    $pageUrls = $this->get( 'paginate' )->setupUrls();
    /** @var $pager \WScore\Web\View\PaginateBootstrap */
    $pager    = $this->get( 'pageView' )->setUrls( $pageUrls );
    echo $pager->bootstrap( $pageUrls );
    ?>    <button name="submit" class="btn btn-primary">Edit Contacts</button>
    <input type="hidden" name="_method" value="edit"/>
</form>

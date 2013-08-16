<?php

use \App\Tasks\Entity\Task;

/** @var $this \Demo\Classes\Template */

?>
<form name="friend" method="post" action="">
    <?php
    $appRoot   = $this->get( 'appRoot' );
    $pageUrls = $this->get( 'paginate' )->setupUrls();
    /** @var $pager \WScore\Web\View\Bootstrap2\Pagination */
    $pager    = $this->pageView->setUrls( $pageUrls );
    echo $pager->bootstrap( $pageUrls );
    ?>
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
        $name = $friend->popHtml( 'friend_name' );
        $name = "<a href=\"{$detailUrl}\">{$name}</a>";
        $tags = $friend->retrieve()->tags;
        if( $tags && !empty( $tags ) ) {
            /** @var $tags \WScore\DataMapper\Entity\Collection */
            $tags = $tags->pack( 'name' );
            $tags = implode( ', ', $tags );
        } else {
            $tags = '...';
        }
        ?>
    <tbody>
    <tr>
        <td></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $friend->popHtml( 'gender' ); ?></td>
        <td><?php echo $tags; ?></td>
        <td><a href="<?php echo $detailUrl; ?>" class="btn btn-mini">&gt;&gt;</a></td>
    </tr>
    </tbody>
    <?php } ?>
</table>
    <button name="submit" class="btn btn-primary">Edit Contacts</button>
    <input type="hidden" name="_method" value="edit"/>
</form>

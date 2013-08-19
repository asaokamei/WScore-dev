<?php

/** @var $this \Demo\Classes\Template */

?>
<form name="friend" method="post" action="">
    <?php
    $requestRoot   = $this->get( 'requestRoot' );
    $pageUrls = $this->get( 'paginate' )->setupUrls();
    /** @var $pager \WScore\Web\View\Bootstrap2\Pagination */
    $pager    = $this->pageView->setUrls( $pageUrls );
    echo $pager->draw();
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
    /** @var $role \WScore\Cena\Role\CenaIO */
    /** @var $friend \WScore\DataMapper\Entity\EntityInterface */
    $role = $this->get( 'CenaIo' );
    $role->setHtmlType( 'html' );
    foreach( $this->arr( 'friends' ) as $friend )
    {
        $role->register( $friend );
        $detailUrl = $requestRoot . $friend->getId();
        $name = $role->popHtml( 'friend_name' );
        $name = "<a href=\"{$detailUrl}\">{$name}</a>";
        $tags = $friend->tags;
        if( $tags && !empty( $tags ) ) {
            /** @var $tags \WScore\DataMapper\Entity\Collection */
            $tags = $tags->pack( 'name' );
            $tags = implode( ', ', $tags );
        } else {
            $tags = '...';
        }
        /** @var $tags string */
        ?>
    <tbody>
    <tr>
        <td></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $role->popHtml( 'gender' ); ?></td>
        <td><?php echo $tags; ?></td>
        <td><a href="<?php echo $detailUrl; ?>" class="btn btn-mini">&gt;&gt;</a></td>
    </tr>
    </tbody>
    <?php } ?>
</table>
    <button name="submit" class="btn btn-primary">Edit Contacts</button>
    <input type="hidden" name="_method" value="edit"/>
</form>

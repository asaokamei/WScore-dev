<h1>Tags List</h1>
<?php

/** @var $this \WScore\Template\TemplateInterface */

if( !$tags = $this->get( 'tags' ) ) {
    echo '<p>no tags information... </p>';
    return;
}

$onMethod     = $this->get( 'onMethod' );
if( $onMethod === 'onEdit' ) {
    $method   = 'post';
    $button   = 'save changes';
    $htmlType = 'form';
    $subBut   = '<a href="" class="btn">cancel</a>';
} else {
    $method   = 'edit';
    $button   = 'edit tags';
    $htmlType = 'html';
    $subBut   = '<a href="' . $this->get( 'appRoot' ) . '" class="btn">back to list</a>';
}

?>
<form name="tags" method="post" action="">
    <dl class="dl-horizontal">
        <dt>...tag code...</dt>
        <dd><strong>...tag name...</strong></dd>
        <?php
        /** @var $t \WScore\Cena\Role\CenaIO */
        foreach( $tags as $t ) {
            $code = $t->popHtml( 'tag_code' );
            $name = $t->popHtml( 'name', $htmlType );
            echo "<dt>{$code}</dt>";
            echo "<dd>{$name}</dd>";
        }
        if( $new = $this->get( 'new' ) ) {
            $code = $new->popHtml( 'tag_code', 'form' )->class_( 'span1');
            $name = $new->popHtml( 'name', 'form' );
            echo "</dl><h4>add new tag</h4><dl class=\"dl-horizontal\">";
            echo "<dt>{$code}</dt>";
            echo "<dd>{$name}</dd>";
        }
        ?>
    </dl>
    <input type="hidden" name="_method" value="<?php echo $method; ?>">
    <button type="submit" class="btn btn-primary"><?php echo $button; ?></button>
    <?php if( $subBut ) echo $subBut; ?>
</form>

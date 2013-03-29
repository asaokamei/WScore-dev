<?php

/** @var $this \WScore\Template\TemplateInterface */
/** @var $friend \WScore\Cena\Role\CenaIO */
if( !$friend = $this->get( 'friends' ) ) {
    echo '<p>no contact information... </p>';
    return;
}

$method     = $this->get( 'onMethod' );
$includeForm = '/edit-' . $method . '.php';

?>
<h1>Info: `<?php echo $friend->popHtml( 'friend_name' ); ?>`</h1>
<h3>Basic Info</h3>
<dl class="dl-horizontal">
    <dt>name</dt>
    <dd><?php echo $friend->popHtml( 'friend_name' ); ?></dd>
    <dt>gender</dt>
    <dd><?php echo $friend->popHtml( 'gender' ); ?></dd>
    <dt>birthday</dt>
    <dd><?php echo $friend->popHtml( 'friend_bday' ); ?></dd>
</dl>
<h3>Tags</h3>
<h3>Contacts</h3>
<pre>
<?php
    /** @var $contacts \App\Contacts\Entity\Contact[] */
    $contacts = $friend->retrieve()->contacts;
    $cByType  = array();
    foreach( $contacts as $contact ) {
        $type = $contact->type;
        $cByType[ $type ][] = $contact;
    }
    foreach( $cByType as $byType => $list ) {
        print_r( $list );
    }
    ?>
    
</pre>

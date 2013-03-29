<?php

/** @var $this \WScore\Template\TemplateInterface */
/** @var $friend \WScore\Cena\Role\CenaIO */
if( !$friend = $this->get( 'friend' ) ) {
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
<dl class="dl-horizontal">
<?php
    /** @var $contacts \WScore\Cena\Role\CenaIO[] */
    $contacts = $this->get( 'contacts' );
    if( !$contacts || empty( $contacts ) ) {
        echo '<dt>no contacts yet...</dt>';
        return;
    }
    $selType  = $contacts[0]->form( 'type' );
    $cByType  = array();
    foreach( $contacts as $contact ) {
        /** @var $cont \App\Contacts\Entity\Contact */
        $cont = $contact->retrieve();
        $type = $cont->type;
        $cByType[ $type ][] = $contact;
    }
    foreach( $cByType as $byType => $contacts ) {
        $name = $selType->popHtml( 'html', $byType );
        echo "<dt>{$name}</dt>";
        foreach( $contacts as $contact ) {
            echo '<dd>'.$contact->popHtml( 'info', 'html' ).'</dd>';
        }
    }
    ?>
</dl>
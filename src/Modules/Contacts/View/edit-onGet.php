<?php

/** @var $this \WScore\Template\TemplateInterface */
/** @var $friend \WScore\Cena\Role\CenaIO */

?>
<dl class="dl-horizontal">
    <dt>name</dt>
    <dd><?php echo $friend->popHtml( 'friend_name' ); ?></dd>
    <dt>gender</dt>
    <dd><?php echo $friend->popHtml( 'gender' ); ?></dd>
    <dt>birthday</dt>
    <dd><?php echo $friend->popHtml( 'friend_bday' ); ?></dd>
    <dt>tags</dt>
    <?php
    // show tags starts
    $tags = $this->get( 'tags' );
    if( !$tags || empty( $tags ) ) {
        echo '<dd>no tags...</dd>';
    } else {
    ?>
    <?php
    foreach( $tags as $tag ) {
        /** @var $tag \WScore\Cena\Role\CenaIO */
        echo '<dd>' . $tag->popHtml( 'name' ) . '</dd>';
    }
    } // show tags ends
    ?>
</dl>
<h3>Contacts</h3>
<dl class="dl-horizontal">
    <?php
    /** @var $contacts \WScore\Cena\Role\CenaIO[] */
    $contacts = $this->get( 'contacts' );
    if( !$contacts || empty( $contacts ) ) {
        echo '<dt>no contacts yet...</dt>';
    }
    else {

        // sort and categorize contacts by type. 
        $selType  = $contacts[0]->form( 'type' );
        $cByType  = array();
        foreach( $contacts as $contact ) {
            /** @var $cont \Modules\Contacts\Entity\Contact */
            $cont = $contact->retrieve();
            $type = $cont->type;
            $cByType[ $type ][] = $contact;
        }
        // display contacts by type. 
        foreach( $cByType as $byType => $contacts ) {
            $name = $selType->popHtml( 'html', $byType );
            echo "<dt>{$name}</dt>";
            foreach( $contacts as $contact ) {
                echo '<dd>'.$contact->popHtml( 'info' ).'</dd>';
            }
        }
    }
    ?>
</dl>
<form name="edit" method="post" action="">
    <input type="hidden" name="_method" value="edit" />
    <button type="submit" class="btn btn-primary">edit contact</button>
    <a href="<?php echo $this->get( 'requestRoot' ); ?>" class="btn">back to list</a>
</form> 
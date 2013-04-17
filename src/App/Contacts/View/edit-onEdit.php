<?php

/** @var $this \WScore\Template\TemplateInterface */
/** @var $friend \WScore\Cena\Role\CenaIO */

$htmlType = 'form';

?>
<form name="edit" method="post" action="">
<dl class="dl-horizontal">
    <dt>name</dt>
    <dd><?php echo $friend->popHtml( 'friend_name', $htmlType )->class_( 'span4' ); ?></dd>
    <dt>gender</dt>
    <dd><?php
        // make ul inline. 
        $sel = $friend->popHtml( 'gender', $htmlType );
        $sel->_get('ul')->class_( 'inline' );
        echo $sel; 
        
        ?></dd>
    <dt>birthday</dt>
    <dd><?php echo $friend->popHtml( 'friend_bday', $htmlType ); ?></dd>
    <dt>tags</dt>
    <?php
    // show tags starts
    $tags = $this->get( 'tagList' );
    $sel  = $friend->popLinkSelect( 'tags', $tags, 'name', 'checkList' );
    $sel->_get('ul')->class_( 'unstyled' );
    echo '<dd>' . $sel . $friend->popEmptyLink( 'tags' ) . '</dd>';
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
            /** @var $cont \App\Contacts\Entity\Contact */
            $type = $contact->retrieve()->type;
            $cByType[ $type ][] = $contact;
        }
        // display contacts by type. 
        foreach( $cByType as $byType => $contacts ) {
            $name = $selType->popHtml( 'html', $byType );
            echo "<dt>{$name}</dt>";
            foreach( $contacts as $contact ) {
                echo '<dd>'; 
                echo $contact->popHtml( 'info', $htmlType )->class_( 'span3' );
                echo ' '.$contact->popDeleteSelect()->class_( 'span1' );
                echo $contact->popHtml( 'type', 'hidden' );
                echo $contact->popLinkHidden( 'friend' );
                echo '</dd>';
            }
        }
    }
    ?>
</dl>
    <button type="submit" class="btn btn-primary">save changes</button>
    <a href="<?php echo $this->get( 'appRoot' ).$friend->getId(); ?>" class="btn">back to detail</a>
</form>
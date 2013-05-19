<?php

/** @var $this \WScore\Template\TemplateInterface */

if( !$tasks = $this->get( 'friends' ) ) {
    echo '<p>no contact information... </p>';
    return;
}

$method     = 'on' . ucwords( $this->get( 'method' ) );
$includeForm = '/index-' . $method . '.php';

?>
<h1>Contacts List</h1>
<?php include( __DIR__ . $includeForm ); ?>

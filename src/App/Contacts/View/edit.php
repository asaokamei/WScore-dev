<?php

/** @var $this \WScore\Template\TemplateInterface */
/** @var $friend \WScore\Cena\Role\CenaIO */
if( !$friend = $this->get( 'friend' ) ) {
    echo '<p>no contact information... </p>';
    return;
}

$method     = $this->get( 'onMethod' );
$includeForm = '/edit-' . $method . '.php';
if( $method === 'onEdit' ) {
    $htmlType = 'form';
} else {
    $htmlType = 'html';
}

?>
<h1>Info: `<?php echo $friend->popHtml( 'friend_name' ); ?>`</h1>
<h3>Basic Info</h3>
<?php include( __DIR__ . $includeForm ); ?>
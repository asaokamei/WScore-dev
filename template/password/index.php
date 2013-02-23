<?php
/** @var $_v \WScore\Template\Template */
$_v->parent( 'password.php' );
?>
<h1>Generate Password</h1>
<div class="row-fluid marketing">
    <p>specify length of password, check to use symbols (!@#$ etc.), <br />and click generate password button. </p>
    <form name="password" method="post" action="password.php">
        <dl class="dl-horizontal">
            <dt>length of password</dt>
            <dd><?php echo $_v->get( 'length' )->class_( 'span4' ); ?>
                &nbsp;<p class="muted">(minimum length of password is 5)</p>
            </dd>
            <dt>use symbols</dt>
            <dd><label><?php echo $_v->get( 'symbol' ); ?> check if you want password to have some symbols. </label></dd>
            <dt>get # of passwords</dt>
            <dd><?php echo $_v->get( 'count' )->class_( 'span4' ); ?></dd>
        </dl>
        <input type="hidden" name="_act" value="generate">
        <input type="submit" name="generate" class="btn btn-primary" value="generate password">
    </form>
</div>
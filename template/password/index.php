<?php
/** @var $_v \WScore\Template\Template */
$_v->parent( 'password.php' );
?>
<h1>Generate Password</h1>
<div class="row-fluid marketing">
    <p>specify length of password, check to use symbols (!@#$ etc.), <br/>and click generate password button. </p>

    <form name="password" method="post" action="index.php">
        <dl class="dl-horizontal">
            <dt>length of password</dt>
            <dd><?php echo $_v->get( 'length' )->class_( 'span4' ); ?>
                &nbsp;<p class="muted">(minimum length of password is 5)</p>
            </dd>
            <dt>use symbols</dt>
            <dd><label><?php echo $_v->get( 'symbol' ); ?> check if you want password to have some symbols. </label>
            </dd>
            <dt>get # of passwords</dt>
            <dd><?php echo $_v->get( 'count' )->class_( 'span4' ); ?></dd>
        </dl>
        <input type="hidden" name="_act" value="generate">
        <input type="submit" name="generate" class="btn btn-primary" value="generate password">
    </form>
    <?php
    if( $_v->arr( 'passwords' ) ) : ?>
        <table class="table">
            <tr>
                <th>password</th>
                <th>crypt</th>
                <th>md5</th>
            </tr>
            <?php foreach( $_v->arr( 'passwords' ) as $words ) : ?>
            <tr>
                <td><?php echo $words[ 'password' ]; ?></td>
                <td><?php echo $words[ 'crypt' ]; ?></td>
                <td><?php echo $words[ 'md5' ]; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
</div>
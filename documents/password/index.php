<?php
/** @var $this \WScore\Template\TemplateInterface */
?>
<h1>Generate Password</h1>
<!-- HtmlTest: Needle=documents/password/index -->
<div class="row-fluid marketing">
    <p>specify length of password, check to use symbols (!@#$ etc.), <br/>and click generate password button. </p>

    <form name="password" method="post" action="index.php">
        <dl class="dl-horizontal">
            <dt>length of password</dt>
            <dd><?php echo $this->get( 'length' )->class_( 'span4' ); ?>
                &nbsp;<p class="muted">(minimum length of password is 5)</p>
            </dd>
            <dt>use symbols</dt>
            <dd><label><?php echo $this->get( 'symbol' ); ?> check if you want password to have some symbols. </label>
            </dd>
            <dt>get # of passwords</dt>
            <dd><?php echo $this->get( 'count' )->class_( 'span4' ); ?></dd>
        </dl>
        <input type="hidden" name="_act" value="generate">
        <input type="submit" name="generate" class="btn btn-primary" value="generate password">
    </form>
    <?php
    if( $this->arr( 'passwords' ) ) : ?>
        <table class="table">
            <tr>
                <th>password</th>
                <th>crypt</th>
                <th>md5</th>
            </tr>
            <?php foreach( $this->arr( 'passwords' ) as $words ) : ?>
            <tr>
                <td><?php echo $words[ 'password' ]; ?></td>
                <td><?php echo $words[ 'crypt' ]; ?></td>
                <td><?php echo $words[ 'md5' ]; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
</div>
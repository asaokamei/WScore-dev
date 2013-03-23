<?php
/** @var $this \WScore\Template\TemplateInterface */
?>
<!-- HtmlTest: matchStart -->
<h1>Generate Password</h1>
<!-- HtmlTest: Needle=Pwd/View/generate -->
<div class="row-fluid marketing">
    <p>specify length of password, check to use symbols (!@#$ etc.), <br/>and click generate password button. </p>

    <form name="password" method="post" action="">
        <dl class="dl-horizontal">
            <!-- HtmlTest: matchEnd -->
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
        <!-- HtmlTest: matchStart -->
        <input type="hidden" name="_act" value="generate">
        <input type="submit" name="generate" class="btn btn-primary" value="generate password">
    </form>
    <!-- HtmlTest: matchEnd -->
    <?php
    if( $password = $this->arr( 'passwords' ) ) : ?>
        <!-- HtmlTest: NumberOfPasswords: <?php echo count( $password ) ?> -->
        <table class="table">
            <tr>
                <th>password</th>
                <th>crypt</th>
                <th>md5</th>
            </tr>
            <?php foreach( $password as $words ) : ?>
            <tr>
                <td><?php echo $words[ 'password' ]; ?></td>
                <td><?php echo $words[ 'crypt' ]; ?></td>
                <td><?php echo $words[ 'md5' ]; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
</div>
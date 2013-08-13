<h1>Setup Task Database</h1>
<!-- HtmlTest: Needle=Tasks/View/setup -->
<?php

/** @var $this \WScore\Template\TemplateInterface */

if( $this->get( 'method' ) === 'get' ) {

    ?>
    <form name="setup" action="" method="post">
        <p>check the checkbox below, and click SetUp button. </p>
        <p>all the task will be replaced. </p>
        <label><input type="checkbox" name="_method" value="put" /> check this box and click initialize button</label>
        <button type="submit" class="btn btn-primary">SetUp</button>
    </form>
<?php

} else {
    
    ?>
    <form name="setup" action="<?php echo $this->get('appURL'); ?>" method="get">
        <p>set up done. </p>
        <p>click list tasks to show all new tasks. </p>
        <button type="submit" class="btn btn-primary">List Tasks</button>
    </form>
<?php

}

?>
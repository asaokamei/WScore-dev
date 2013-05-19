<?php
namespace Demo;

use WScore\Web\Module\AppLoader;
use WScore\DiContainer\String as rootDirectory;
use WScore\Web\Respond\ResponsePage;
use WScore\Template\TemplateInterface;

class Setup extends ResponsePage
{
    /**
     * @Inject
     * @var rootDirectory
     */
    public $root;

    /**
     * @Inject
     * @var TemplateInterface
     */
    public $template;
    
    public function respond( $match=array() )
    {
        $template_root = $this->root . '/documents';
        $this->template->setRoot( $template_root );
        $this->template->setParent( 'layout.php' );

        $this->template->set( 'baseUrl',  $this->retrieveRequest()->baseURL );
        $this->template->set( 'pathInfo', $this->retrieveRequest()->pathInfo );
        return;
    }
}

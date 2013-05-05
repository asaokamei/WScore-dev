<?php
namespace Demo;

use WScore\Web\Module\AppLoader;
use WScore\DiContainer\String as rootDirectory;

class Setup extends AppLoader
{
    /**
     * @Inject
     * @var rootDirectory
     */
    public $root;
    
    public function load( $pathInfo )
    {
        $template_root = $this->root . '/documents';
        $this->template->setRoot( $template_root );
        $this->template->setParent( 'layout.php' );

        $this->template->set( 'baseUrl',  $this->front->request->getBaseUrl() );
        $this->template->set( 'pathInfo', $this->front->request->getPathInfo() );
        return;
    }
}

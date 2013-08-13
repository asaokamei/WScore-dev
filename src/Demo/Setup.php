<?php
namespace Demo;

use WScore\Response\ResponsibleInterface;
use WScore\Response\ResponsibleTrait;
use WScore\DiContainer\Types\String as rootDirectory;
use WScore\Template\TemplateInterface;

class Setup implements ResponsibleInterface
{
    use ResponsibleTrait;

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
        /** @var \Demo\Web $root */
        $root = $this->getRoot();
        /** @var \WScore\Web\WebRequest $request */
        $request = $root->getRequest();

        $this->template->setRoot( $template_root );
        $this->template->setParent( 'layout.php' );
        $this->template->set( 'baseUrl',  $request->baseURL );
        $this->template->set( 'pathInfo', $request->pathInfo );

        return;
    }
}

<?php
namespace Demo;

use WScore\Web\Module\AppLoader;

class Setup extends AppLoader
{
    public function load( $pathInfo )
    {
        $this->template->set( 'baseUrl',  $this->front->request->getBaseUrl() );
        $this->template->set( 'pathInfo', $this->front->request->getPathInfo() );
        return;
    }
}

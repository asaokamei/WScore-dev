<?php
namespace App\Site;

use WScore\Web\Loader\LoaderAbstract;

class AppSetter extends LoaderAbstract
{
    /**
     * Loads response if pathinfo matches with routes.
     *
     * @param string $pathInfo
     * @return null|string
     */
    public function load( $pathInfo )
    {
        /** @var $app \App\App */
        $app = $this->front;
        $baseUrl = $app->baseUrl;
        $app->template->set( 'baseUrl', $baseUrl );
    }

}

<?php
namespace App\Site\Classes;

use WScore\Template\PhpTemplate;

class Template extends PhpTemplate
{
    /**
     * @Inject
     * @var \WScore\Web\Http\Request
     */
    public $request;

    /**
     * @Inject
     * @var \WScore\Web\View\PaginateBootstrap
     */
    public $pageView;

    public function __construct()
    {
        $this->set( 'baseUrl', $this->request->getBaseUrl() );
    }
}
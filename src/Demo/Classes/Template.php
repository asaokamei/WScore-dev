<?php
namespace Demo\Classes;

use WScore\Template\PhpTemplate;

class Template extends PhpTemplate
{
    /**
     * @Inject
     * @var \WScore\Http\Request
     */
    public $request;

    /**
     * @Inject
     * @var \WScore\Web\View\PaginateBootstrap
     */
    public $pageView;

    /**
     * @Inject
     * @var \WScore\Web\View\ScoreMenu
     */
    public $score;
    
    /**
     * @Inject
     * @var \WScore\Web\View\NavBarBootstrap
     */
    public $menu;
    
    public function __construct()
    {
        $this->set( 'baseUrl', $this->request->getBaseUrl() );
    }
}
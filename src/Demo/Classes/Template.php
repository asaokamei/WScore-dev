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
     * @var \WScore\Web\View\Bootstrap2\Pagination
     */
    public $pageView;

    /**
     * @Inject
     * @var \WScore\Web\View\ScoreMenu
     */
    public $score;
    
    /**
     * @Inject
     * @var \WScore\Web\View\Bootstrap2\NavBar
     */
    public $menu;
    
    public function __construct()
    {
        $this->set( 'baseUrl', $this->request->getBaseUrl() );
    }
}
<?php
namespace App\Site\Loader;

class Logger extends \WScore\Web\Loader\Renderer
{
    /**
     * @Inject
     * @var \WScore\DbAccess\Profile
     */
    public $profile;
    
    public function load( $pathInfo )
    {
        $this->profile->logProfile();
        return;
    }
}

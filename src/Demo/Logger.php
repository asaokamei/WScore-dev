<?php
namespace Demo;

use WScore\Web\Module\AppLoader;

class Logger extends AppLoader
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

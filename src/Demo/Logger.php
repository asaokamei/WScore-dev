<?php
namespace Demo;

use WScore\Response\ModuleInterface;
use WScore\Response\ModuleTrait;

class Logger implements ModuleInterface
{
    use ModuleTrait;

    /**
     * @Inject
     * @var \WScore\DbAccess\Profile
     */
    public $profile;

    public function respond( $match=array() )
    {
        $this->profile->logProfile();
        return;
    }
}

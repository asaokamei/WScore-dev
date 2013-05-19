<?php
namespace Demo;

use WScore\Web\Module\AppLoader;
use WScore\Web\Respond\Dispatch;

class Logger extends Dispatch
{
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

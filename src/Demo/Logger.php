<?php
namespace Demo;

use WScore\Response\ResponsibleInterface;
use WScore\Response\ResponsibleTrait;

class Logger implements ResponsibleInterface
{
    use ResponsibleTrait;

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

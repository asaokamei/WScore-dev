<?php
namespace App\Tasks\Page;

class Index
{
    public function onGet( $match )
    {
        return 'Tasks';
    }
}
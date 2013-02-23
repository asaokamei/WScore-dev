<?php
namespace App\Site\Page\Password;

class Index
{
    public function onGet( $match )
    {
        $data[ 'class' ]  = 'me:'.get_called_class();
        return $data;
    }
}
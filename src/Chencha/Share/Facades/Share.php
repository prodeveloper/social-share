<?php namespace Chencha\Share\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Share
 * @method \Chencha\Share\Share load($url, $title = '', $media = '')
 * @package Chencha\Share\Facades
 */
class Share extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'share';
    }

}

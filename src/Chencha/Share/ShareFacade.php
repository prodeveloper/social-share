<?php

namespace Thegr8dev\Share\Chencha\Share;

use Illuminate\Support\Facades\Facade;

class ShareFacade extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'share'; }

}
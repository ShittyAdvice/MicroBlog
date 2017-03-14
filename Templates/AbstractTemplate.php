<?php

namespace Microizer\Plugins\MicroBlog\Templates;

use Illuminate\View\View;
use Microizer\View\Templates\AbstractTemplate as Base;

abstract class AbstractTemplate extends Base
{
	protected $packageName = 'microblog';
	protected $title;

	public function getTitle()
	{
		return $this->title;
	}
}

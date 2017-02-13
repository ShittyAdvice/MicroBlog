<?php

namespace ShittyAdvice\MicroBlog\Templates;

use Illuminate\View\View;

abstract class AbstractTemplate
{
	protected $view;
	protected $title;

	abstract public function prepare(View $view, array $parameters);

	public function getView()
	{
		return $this->view;
	}

	public function getTitle()
	{
		return $this->title;
	}
}

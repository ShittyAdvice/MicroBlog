<?php

namespace Microizer\Plugins\Microblog\Http\Controllers;

use Illuminate\Http\Request;
use Microizer\Http\Controllers\Controller;
use Microizer\Plugins\Microblog\Templates\BlogTemplate;
use Microizer\Plugins\Microblog\Templates\BlogPostTemplate;

class BlogController extends Controller {


	public function getBlogPost($slug)
	{
		$page = $this->preparePage(BlogPostTemplate::class, compact('slug')); //Post::whereSlug('example-post-one')->firstOrFail();
		return view('page', compact('page'));
	}
	public function getBlog()
	{
		$page = $this->preparePage(BlogTemplate::class);
		return view('page', compact('page'));
	}

	private function preparePage($template, array $parameters = [])
	{
		$page = new \stdClass();
		$template = app($template);
		if(!view()->exists($template->getView()))
		{
			dd($template->getView());
			throw new \Exception("View does not exist");
			return;
		}
		$template->prepare($view = view($template->getView()), $parameters);
		$page->title = $template->getTitle();
		$page->view = $view;
		return $page;
	}
}

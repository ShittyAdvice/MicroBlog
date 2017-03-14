<?php

namespace Microizer\Plugins\MicroBlog\Templates;

use Carbon\Carbon;
use Illuminate\View\View;
use Microizer\Plugins\MicroBlog\Models\Post;

class BlogTemplate extends AbstractTemplate
{
	protected $view = 'index';
	protected $title = 'Blog';

	public function prepare(View $view, array $parameters)
	{
		$posts = Post
			::with('author')
			->where('published_at' , '<', Carbon::now())
			->orderBy('published_at', 'desc')
			->paginate(10);
		$view->with('posts', $posts);
	}
}

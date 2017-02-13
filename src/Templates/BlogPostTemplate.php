<?php

namespace ShittyAdvice\MicroBlog\Templates;

use ShittyAdvice\MicroBlog\Models\Post;
use Carbon\Carbon;
use Illuminate\View\View;

class BlogPostTemplate extends AbstractTemplate
{
	protected $view = 'blog::post';

	protected $title = 'Blog - No Title';

	protected $posts;

	public function __construct(Post $posts)
	{
		$this->posts = $posts;
	}

	public function prepare(View $view, array $parameters)
	{
		$post = $this->posts->whereSlug($parameters['slug'])->first();
		$this->title = 'Blog - ' . $post->title;
		$view->with('post', $post);
	}
}

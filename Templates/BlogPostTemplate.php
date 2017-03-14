<?php
namespace Microizer\Plugins\MicroBlog\Templates;

use Carbon\Carbon;
use Illuminate\View\View;
use Microizer\Plugins\MicroBlog\Models\Post;

class BlogPostTemplate extends AbstractTemplate
{
	protected $title = 'Blog - No Title';
	protected $view = 'post';

	public function prepare(View $view, array $parameters)
	{
		$post = Post::whereSlug($parameters['slug'])->first();
		$this->title = $post->title . ' - Blog';
		$view->with('post', $post);
	}
}

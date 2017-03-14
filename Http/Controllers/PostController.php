<?php

namespace Microizer\Plugins\Microblog\Http\Controllers;

use Illuminate\Http\Request;
use Microizer\Http\Controllers\Controller;
use Microizer\Plugins\Microblog\Models\Post;

use Microizer\Plugins\Microblog\Http\Requests\StorePostRequest;
use Microizer\Plugins\Microblog\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
	protected $posts;
	public function __construct(Post $posts)
	{
		$this->posts = $posts;
		$this->middleware('web');
		$this->middleware('auth')->except('getBlogPost', 'getBlog');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$posts = $this->posts->with('author')->orderBy('published_at', 'desc')->paginate(10);
		return view('microblog::backend.index', compact('posts'));
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Post $post)
	{
		return view('microblog::backend.form', compact('post'));
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \ShittyAdvice\MicroBlog\Requests\StorePostRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StorePostRequest $request)
	{
		$this->posts->create(['author_id' => auth()->user()->id] + $request->all());
		return redirect(route('backend.blog.index'))->with('status', 'Post has been created.');
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Post $post)
	{
		return view('microblog::backend.form', compact('post'));
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \ShittyAdvice\MicroBlog\Requests\UpdatePostRequest  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdatePostRequest $request, Post $post)
	{
		$post->fill($request->all())->save();
		return redirect(route('backend.blog.posts.edit', $post->id))->with('status', 'Post has been updated.');
	}
	public function confirm(Post $post)
	{
		return view('microblog::backend.confirm', compact('post'));
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Post $post)
	{
		$post->delete();
		return redirect(route('backend.blog.index'))->with('status', 'Post has been deleted.');
	}
}

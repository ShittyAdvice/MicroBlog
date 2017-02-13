<?php

namespace ShittyAdvice\MicroBlog\Controllers;

use Illuminate\Http\Request;
use ShittyAdvice\MicroBlog\Requests\StorePostRequest;
use ShittyAdvice\MicroBlog\Requests\UpdatePostRequest;
use ShittyAdvice\MicroBlog\Models\Post;
use ShittyAdvice\MicroBlog\Templates\BlogTemplate;
use ShittyAdvice\MicroBlog\Templates\BlogPostTemplate;

//use Microizer\Http\Requests; MOVE TO PACKAGE

class BlogController extends Controller
{
    protected $posts;

    public function __construct(Post $posts)
    {
        $this->posts = $posts;
        $this->middleware(['web', 'auth'])->except('getBlogPost', 'getBlog');
    }

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
            throw new \Exception("View does not exist");
			return;
		}
        $template->prepare($view = view($template->getView()), $parameters);

        $page->title = $template->getTitle();
		$page->view = $view;

        return $page;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->posts->with('author')->orderBy('published_at', 'desc')->paginate(10);

        return view('backend.blog.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('backend.blog.form', compact('post'));
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->posts->findOrFail($id);

        return view('backend.blog.form', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \ShittyAdvice\MicroBlog\Requests\UpdatePostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = $this->posts->findOrFail($id);

        $post->fill($request->all())->save();

        return redirect(route('backend.blog.edit', $post->id))->with('status', 'Post has been updated.');
    }

    public function confirm($id)
    {
        $post = $this->posts->findOrFail($id);
        return view('backend.blog.confirm', compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->posts->findOrFail($id);
        $post->delete();

        return redirect(route('backend.blog.index'))->with('status', 'Post has been deleted.');
    }
}

<div class="row">
	@if($posts->count() == 0)
		<h1>No posts have been published yet.</h1>
	@endif
	@foreach($posts as $post)
		<div class="col-md-6">
			<h2><a href="{{ route('blog.post', $post->slug) }}">{{ $post->title }}</a></h2>

			<p>
				Posted by {{ $post->author->name }} on {{ $post->published_at }}
			</p>

			{!! $post->excerpt or $post->body !!}
		</div>
	@endforeach
</div>

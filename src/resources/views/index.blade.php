<div class="row">
	<div class="col-md-12" style="background:red;height:320px;"></div>
</div>

<div class="row">
	@foreach($posts as $post)
		<div class="col-md-4">
			<h2><a href="{{ route('blog.post', $post->slug) }}">{{ $post->title }}</a></h2>

			<p>
				Posted by {{ $post->author->name }} on {{ $post->published_at }}
			</p>

			{!! $post->excerpt or $post->body !!}
		</div>
	@endforeach
</div>

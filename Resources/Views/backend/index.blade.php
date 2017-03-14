@extends('layouts.backend')

@section('title', 'Posts')

@section('heading', 'All Posts')

@section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="white-box">
			@include('partials.status')
			<a href="{{ route('backend.blog.posts.create') }}" class="btn btn-primary">Create New Blog Post</a>
			<table class="table">
				<thead>
					<tr>
						<th>Title</th>
						<th>Slug</th>
						<th>Author</th>
						<th>Published</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					@foreach($posts as $post)
						<tr class="{{ $post->published_highlight }}">
							<td><a href="{{ route('backend.blog.posts.edit', $post->id) }}" >{{ $post->title }}</a></td>
							<td>{{ $post->slug }}</td>
							<td>{{ $post->author->name }}</td>
							<td>{{ $post->published_date }}</td>

							<td><a href="{{ route('backend.blog.posts.edit', $post->id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i></a></td>
							<td><a href="{{ route('backend.blog.posts.confirm', $post->id) }}" data-toggle="tooltip" data-original-title="Remove"> <i class="fa fa-close text-danger"></i> </a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{!! $posts->render() !!}
		</div>
	</div>
</div>
@endsection

@section('footer')

@endsection

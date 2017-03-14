@extends('layouts.backend')

@section('title', 'Delete ' . $post->title)

@section('heading', 'Warning')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="white-box">
			{!! Form::open(['method' => 'delete', 'route' => ['backend.blog.posts.destroy', $post->id]]) !!}
			<div class="alert alert-danger">
				<strong>Warning!</strong> You are about to delete the post <strong>'{{ $post->title }}'</strong>. This action cannot be undone. Are you sure you want to continue?
			</div>
			{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
			<a href="{{ route('backend.blog.posts.index') }}" class="btn btn-success"><strong>Cancel</strong></a>
		</div>
	</div>
</div>
@endsection

@section('footer')

@endsection

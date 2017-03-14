@extends('layouts.backend')

@section('title', $post->exists ? 'Editing ' . $post->name : 'Create New Blog Post')

@section('heading', $post->exists ? 'Editing ' . $post->name : 'Create New Blog Post')


@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="white-box">
			@include('partials.status')

			{!! Form::model($post, [
				'method' => $post->exists ? 'put' : 'post',
				'route' => $post->exists ? ['backend.blog.posts.update', $post->id] : ['backend.blog.posts.store']
			]) !!}
			<div class="form-group">
				{!! Form::label('title') !!}
				{!! Form::text('title', null, ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('slug') !!}
				{!! Form::text('slug', null, ['class' => 'form-control']) !!}
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					{!! Form::label('published_at') !!}
				</div>
				<div class="col-md-4">
					<div class="input-group">
						<span class="input-group-addon bg-info b-0 text-white"><i class="icon-calender"></i></span>
						{!! Form::text('published_at', null, ['class' => 'form-control']) !!}
						<span class="pointer input-group-addon bg-danger b-0 text-white " onclick="$('#published_at').val('')"><i class="fa fa-trash"></i></span>
					</div>
				</div>
			</div>

			<div class="form-group">
				{!! Form::label('excerpt') !!}
				{!! Form::textarea('excerpt', null, ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('body') !!}
				{!! Form::textarea('body', null, ['class' => 'form-control']) !!}
			</div>

			{!! Form::submit($post->exists ? 'Save Post' : 'Create Post', ['class' => 'btn btn-primary']) !!}

			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection

@section('footer')
<link href="{{ assetPath('bower_components/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ assetPath('bower_components/tinymce/tinymce.min.js') }}"></script>
<script src="{{ assetPath('bower_components/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
<script>

function wysiwygInit(selector, options){
	var defaultOptions = {
		selector: selector,
		theme: "modern",
		height:300,
		plugins: [
			"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
			"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
			"save table contextmenu directionality emoticons template paste textcolor"
		],
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
	};
	$.extend(defaultOptions, options);
	tinymce.init(defaultOptions);

}


$(document).ready(function () {
	$('#published_at').datetimepicker({
		value: "{{ old('published_at', $post->published_at) }}",
		allowBlank: true,
	});

	$('#published_at').on('focus', function(){
		if(this.value == '')
			return;
		$('#published_at').datetimepicker('update', new Date());
	});

	wysiwygInit('#excerpt', {height:150});
	wysiwygInit('#body');

	$('#title').on('blur', function(){
		var slugElement = $('#slug');

		if(slugElement.val()){
			return;
		}

		slugElement.val(this.value.toLowerCase().replace(/[^a-z0-9-]+/g, '-').replace(/^-+|-+$/g,''));
	});

});
</script>
@endsection

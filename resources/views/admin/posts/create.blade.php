@extends('admin.layouts.app')

@section('content')

	<!-- Content Header (Page header) -->
	<section class="content-header">					
		<div class="container-fluid my-2">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Create Post</h1>
				</div>
				<div class="col-sm-6 text-right">
					<a href="{{ route('posts.index') }}" class="btn btn-primary">Back</a>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="container-fluid">
			<form name="addForm" id="addForm" method="post" action="" enctype="multipart/form-data">
				<div class="card">
					<div class="card-body">								
						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label for="name">Title</label>
									<input type="text" name="title" id="title" class="form-control" placeholder="Enter Title...">	
									<p></p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="name">Category</label>
									<select name="category" id="category" class="form-control" >
									<option value="">Select Category...</option>
									@foreach($categories as $category)
										<option value="{{ $category->id }}">{{ $category->name }}</option>
									@endforeach
									</select>	
									<p></p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="name">Image</label>
									<input type="file" name="featured_image" id="featured_image" class="form-control">	
									<p></p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="email">Description</label>
									<textarea name="description" id="description" class="form-control" placeholder="Enter Description..."></textarea>	
								</div>
								<p></p>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="tags">Tags</label><br />
									@foreach($tags as $tag)
										{{ $tag->name }} <input type="checkbox" name="tags[]" class="" value="{{ $tag->id }}" />
									@endforeach
								</div>
								<p></p>
							</div>	
							<div class="col-md-6">
								<div class="mb-3">
									<label for="email">Active</label>
									<input type="checkbox" name="is_active" id="is_active" class="" checked />	
								</div>
								<p></p>
							</div>								
						</div>
					</div>							
				</div>
				<div class="pb-5 pt-3">
					<button type="submit" class="btn btn-primary">Submit</button>
					<a href="{{ route('posts.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
				</div>
			<form>
		</div>
		<!-- /.card -->
	</section>
	<!-- /.content -->


@endsection




@section('customJs')

<script>
$('#addForm').submit(function(event){
	
	event.preventDefault();
	
	//var element = $(this);

	$.ajax({
		url : '{{ route("posts.store") }}', 
		type: 'POST',
		data: new FormData(this),
	  //data: element.serializeArray(),
		dataType: 'json',
		processData: false,
        contentType: false,
		success: function(response){

			//console.log(response);

			$("button[type=submit]").prop('disabled',false);

			if(response['status']==true){
				
				window.location.href = "{{ route('posts.index') }}";

				$('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
				$('#slug').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
				
			} else {
				
				var errors = response['errors'];
			
				if(errors['name']){
					$('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
				} else {
					$('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
				}

				if(errors['slug']){
					$('#slug').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['slug'])
				} else {
					$('#slug').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
				}
			}
			

		}, error: function(jqXHR,exception){
			console.log("Something went wrong");
		}
	});

});

/*
$('#name').change(function(){
	$.ajax({
		url : '{{ route("getSlug") }}',
		type: 'get',
		data: { 'title': $(this).val() },
		dataType: 'json',
		success: function(response){
			//console.log(response);
			if(response['status'] == true){
				$('#slug').val(response['slug']);
			}
		}, error: function(jqXHR,exception){
			console.log("Something went wrong2");
		}
	});
});
*/
</script>

@endsection
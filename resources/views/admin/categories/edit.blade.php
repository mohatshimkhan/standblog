@extends('admin.layouts.app')

@section('content')

	<!-- Content Header (Page header) -->
	<section class="content-header">					
		<div class="container-fluid my-2">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Edit Category</h1>
				</div>
				<div class="col-sm-6 text-right">
					<a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="container-fluid">
			<form name="editCategoryForm" id="editCategoryForm" method="post" action="">
				<div class="card">
					<div class="card-body">								
						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label for="name">Name</label>
									<input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ $category->name }}">	
									<p></p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="email">Slug</label>
									<input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" value="{{ $category->slug }}" readonly>	
									<p></p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="email">Description</label>
									<textarea name="description" id="description" class="form-control" placeholder="Description">{{ $category->description }}</textarea>
								</div>
								<p></p>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="email">Active</label>
									<select name="is_active" id="is_active" class="form-control">
									<!--<option value="1" @if($category->is_active=='1') {{ 'selected'; }} @endif>Yes</option>
									<option value="0" @if($category->is_active=='0') {{ 'selected'; }} @endif>No</option>-->
									<option value="1" {{ ($category->is_active=='1') ? 'selected' : '' }} >Yes</option>
									<option value="0" {{ ($category->is_active=='0') ? 'selected' : '' }} >No</option>
									</select>	
								</div>
								<p></p>
							</div>									
						</div>
					</div>							
				</div>

				<div class="pb-5 pt-3">
					<button type="submit" class="btn btn-primary">Update</button>
					<a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
				</div>
			<form>
		</div>
		<!-- /.card -->
	</section>
	<!-- /.content -->

@endsection


@section('customJs')

<script>

$('#editCategoryForm').submit(function(event){
	
	event.preventDefault();
	
	var element = $(this);

	$("button[type=submit]").prop('disabled',true);

	$.ajax({
		url : '{{ route("categories.update", [$category->id]) }}',
		type: 'PUT',
		data: element.serializeArray(),
		dataType: 'json',
		success: function(response){
			//console.log(response);
			
			$("button[type=submit]").prop('disabled',false);

			if(response['status']==true){
				
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

</script>
@endsection
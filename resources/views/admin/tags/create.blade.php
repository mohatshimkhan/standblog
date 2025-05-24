@extends('admin.layouts.app')

@section('content')

	<!-- Content Header (Page header) -->
	<section class="content-header">					
		<div class="container-fluid my-2">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Create Tag</h1>
				</div>
				<div class="col-sm-6 text-right">
					<a href="{{ route('tags.index') }}" class="btn btn-primary">Back</a>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="container-fluid">
			<form name="addForm" id="addForm" method="post" action="">
				<div class="card">
					<div class="card-body">								
						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label for="name">Name</label>
									<input type="text" name="name" id="name" class="form-control" placeholder="Name">	
									<p></p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="email">Slug</label>
									<input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" readonly>	
									<p></p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="email">Description</label>
									<textarea name="description" id="description" class="form-control" placeholder="Description"></textarea>	
								</div>
								<p></p>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="email">Active</label>
									<select name="is_active" id="is_active" class="form-control">
									<option value="1">Yes</option>
									<option value="0">No</option>
									</select>	
								</div>
								<p></p>
							</div>									
						</div>
					</div>							
				</div>
				<div class="pb-5 pt-3">
					<button type="submit" class="btn btn-primary">Create</button>
					<a href="{{ route('tags.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
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
	
	var element = $(this);

	$.ajax({
		url : '{{ route("tags.store") }}',
		type: 'post',
		data: element.serializeArray(),
		dataType: 'json',
		success: function(response){

			//console.log(response);

			$("button[type=submit]").prop('disabled',false);

			if(response['status']==true){
				
				window.location.href = "{{ route('tags.index') }}";

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
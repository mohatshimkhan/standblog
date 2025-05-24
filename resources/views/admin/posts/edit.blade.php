@extends('admin.layouts.app')

@section('content')

	<!-- Content Header (Page header) -->
	<section class="content-header">					
		<div class="container-fluid my-2">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Edit Post</h1>
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
			<form name="editForm" id="editForm" method="post" action="" enctype="multipart/form-data">
				<div class="card">
					<div class="card-body">								
						<div class="row">
							<input type="hidden" name="_method" value="PUT">
						<!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
							<div class="col-md-6">
								<div class="mb-3">
									<label for="name">Title</label>
									<input type="text" name="title_edit" id="title_edit" class="form-control" placeholder="Enter Title ..." value="{{ $post->title }}">	
									<p></p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="name">Category</label>
									<select name="category_edit" id="category_edit" class="form-control">
									<option value="">Select Category...</option>
									@if($categories->isNotEmpty())
										@foreach($categories as $category)
											<option value="{{ $category->id }}" {{ ($post->category_id == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
										@endforeach
									@endif
									</select>	
									<p></p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="name">Image</label>
									<input type="file" name="featured_image_edit" id="featured_image_edit" class="form-control">	
									<p></p>
								</div>
								<input type="hidden" name="old_image_edit" id="old_image_edit" value="{{ $post->image }}">
								<div class="mb-3"><img src="{{ asset('uploads/posts/'.$post->image) }}" class="img-thumbnail"></div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="email">Description</label>
									<textarea name="description_edit" id="description_edit" class="form-control" placeholder="Enter Description...">{{ $post->description }}</textarea>	
								</div>
								<p></p>
							</div>
							<div class="col-md-6">
							<!--@foreach($post->tags as $t)
	                                {{ $t->id }}
	                            @endforeach-->
								<div class="mb-3">
									<label for="tags">Tags</label><br />
									@foreach($tags as $tag)
										{{ $tag->name }} 
										<input type="checkbox" name="tags_edit[]" class="" value="{{ $tag->id }}"
											@foreach($post->tags as $t)
                                                @if($tag->id == $t->id) checked @endif
                                            @endforeach
										/>
									@endforeach
								</div>
								<p></p>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="email">Active</label>
									<input type="checkbox" name="is_active_edit" id="is_active_edit" class="" {{ ($post->is_active == 1) ? 'checked' : '' }} />	
								</div>
								<p></p>
							</div>									
						</div>
					</div>							
				</div>

				<div class="pb-5 pt-3">
					<button type="submit" class="btn btn-primary">Update</button>
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

$('#editForm').submit(function(event){
	
	event.preventDefault();
	
	//var element = $(this);

	$("button[type=submit]").prop('disabled',true);

	$.ajax({
		url : '{{ route("posts.update", [$post->id]) }}',
		type: 'POST',
		data: new FormData(this),
		//data: $(this).serializeArray(),
		dataType: 'json',
		processData: false,
        contentType: false,
		success: function(response){
			
			console.log(response);
			
			$("button[type=submit]").prop('disabled',false);

		  /*if(response['status']==true){
				
				$('#title_edit').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
				$('#category_edit').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
				
			} else {
				
				var errors = response['errors'];
			
				if(errors['title']){
					$('#title_edit').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
				} else {
					$('#title_edit').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
				}

				if(errors['category']){
					$('#category_edit').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['slug'])
				} else {
					$('#category_edit').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
				}
			}*/

		}, error: function(xhr, status, error){
			//var err = JSON.parse(jqXHR.responseText);
			console.log("Something went wrong: "+error);
		}
	  /*error: function(XMLHttpRequest, textStatus, errorThrown) {
		    console.log("Error Thrown: " + errorThrown);
		    console.log("Text Status: " + textStatus);
		    console.log("XMLHttpRequest: " + XMLHttpRequest);
		    //console.warn(XMLHttpRequest.responseText)
		}*/
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
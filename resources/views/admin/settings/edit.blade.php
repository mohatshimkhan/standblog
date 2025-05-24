@extends('admin.layouts.app')

@section('content')

	<!-- Content Header (Page header) -->
	<section class="content-header">					
		<div class="container-fluid my-2">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Edit Settings</h1>
				</div>
				<div class="col-sm-6 text-right">
					<a href="{{ route('sitesettings.index') }}" class="btn btn-primary">Back</a>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="container-fluid">
			<form name="editForm" id="editForm" method="post" action="">
				<div class="card">
					<div class="card-body">								
						<div class="row">
							<div class="col-md-12">
								<div class="mb-3">
									<label for="name">Title</label>
									<textarea name="site_title" id="site_title" class="form-control textarea" placeholder="Title">{{ $siteSetting->site_title }}</textarea>	
									<p></p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="email">Email</label>
									<input type="text" name="email" id="email" class="form-control" placeholder="Email" value="{{ $siteSetting->email }}">	
									<p></p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="phone">Phone No.</label>
									<input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone" value="{{ $siteSetting->phone_number }}">	
									<p></p>
								</div>
							</div>
							<div class="col-md-12">
								<div class="mb-3">
									<label for="email">Address</label>
									<textarea name="address" id="address" class="form-control" placeholder="Address">{{ $siteSetting->address }}</textarea>
								</div>
								<p></p>
							</div>


							<div class="col-md-6">
								<div class="mb-3">
									<label for="name">CTA Title</label>
									<input type="text" name="cta_title" id="cta_title" class="form-control" placeholder="Title" value="{{ $siteSetting->cta_title }}">	
									<p></p>
								</div>
							</div>

							<div class="col-md-6">
								<div class="mb-3">
									<label for="name">CTA Description</label>
									<input type="text" name="cta_description" id="cta_description" class="form-control" placeholder="Descriptions" value="{{ $siteSetting->cta_description }}">	
									<p></p>
								</div>
							</div>

							<div class="col-md-12">
								<div class="mb-3">
									<label for="email">About Us</label>
									<textarea name="about_us_description" id="about_us_description" class="form-control textarea" placeholder="Address">{{ $siteSetting->about_us_description }}</textarea>
								</div>
								<p></p>
							</div>

							<div class="col-md-12">
								<div class="mb-3">
									<label for="name">Facebook</label>
									<input type="text" name="facebook_url" id="facebook_url" class="form-control" placeholder="Facebook" value="{{ $siteSetting->facebook_url }}">	
									<p></p>
								</div>
							</div>
							<div class="col-md-12">
								<div class="mb-3">
									<label for="name">Twitter</label>
									<input type="text" name="twitter_url" id="twitter_url" class="form-control" placeholder="Twitter" value="{{ $siteSetting->twitter_url }}">	
									<p></p>
								</div>
							</div>
							<div class="col-md-12">
								<div class="mb-3">
									<label for="name">Instagram</label>
									<input type="text" name="instagram_url" id="instagram_url" class="form-control" placeholder="Instagram" value="{{ $siteSetting->instagram_url }}">	
									<p></p>
								</div>
							</div>	

							<div class="col-md-12">
								<div class="mb-3">
									<label for="name">Behance</label>
									<input type="text" name="behance_url" id="behance_url" class="form-control" placeholder="Behance" value="{{ $siteSetting->behance_url }}">	
									<p></p>
								</div>
							</div>

							<div class="col-md-12">
								<div class="mb-3">
									<label for="name">Linkedin</label>
									<input type="text" name="linkedin_url" id="linkedin_url" class="form-control" placeholder="Behance" value="{{ $siteSetting->behance_url }}">	
									<p></p>
								</div>
							</div>	

							<div class="col-md-12">
								<div class="mb-3">
									<label for="name">Dribble</label>
									<input type="text" name="dribble_url" id="dribble_url" class="form-control" placeholder="Dribble" value="{{ $siteSetting->dribble_url }}">	
									<p></p>
								</div>
							</div>	
							
							<div class="col-md-12">
								<div class="mb-3">
									<label for="footer">Footer Text</label>
									<textarea name="footer_text" id="footer_text" class="form-control textarea" placeholder="Address">{{ $siteSetting->footer_text }}</textarea>
								</div>
								<p></p>
							</div>

						</div>
					</div>							
				</div>

				<div class="pb-5 pt-3">
					<button type="submit" class="btn btn-primary">Update</button>
					<a href="{{ route('sitesettings.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
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
	
	var element = $(this);

	$("button[type=submit]").prop('disabled',true);

	$.ajax({
		url : '{{ route("sitesettings.update", [$siteSetting->id]) }}',
		type: 'PUT',
		data: element.serializeArray(),
		dataType: 'json',
		success: function(response){
			//console.log(response);
			
			$("button[type=submit]").prop('disabled',false);

			if(response['status']==true){
				
				$('#site_title').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
				$('#email').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
				
			} else {
				
				var errors = response['errors'];
			
				if(errors['site_title']){
					$('#site_title').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['site_title']);
				} else {
					$('#site_title').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
				}

				if(errors['email']){
					$('#email').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['slug'])
				} else {
					$('#email').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
				}
			}
			
		}, error: function(jqXHR,exception){
			console.log("Something went wrong");
		}
	});

});

</script>
@endsection
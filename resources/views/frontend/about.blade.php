@extends('frontend.layouts.app')

@section('content')
    
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="heading-page header-text">
      <section class="page-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="text-content">
                <h4>about us</h4>
                <h2>more about us!</h2>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    
    <!-- Banner Ends Here -->


    <section class="about-us">
      <div class="container">
      	
        <div class="row">
          <div class="col-lg-12">
            <img src="{{ asset('frontend/assets/images/about-us.jpg') }}" alt="">
            <p>{!! $siteSettings->about_us_description  !!}</p>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <ul class="social-icons">
              <li><a href="{!! $siteSettings->facebook_url  !!}"><i class="fa fa-facebook"></i></a></li>
              <li><a href="{!! $siteSettings->twitter_url  !!}"><i class="fa fa-twitter"></i></a></li>
              <li><a href="{!! $siteSettings->behance_url  !!}"><i class="fa fa-behance"></i></a></li>
              <li><a href="{!! $siteSettings->linkedin_url  !!}"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
        
      </div>
    </section>


@endsection
@extends('layouts.master')
@section('title','404')
@section('body')

<div class="page-banner-wrap text-center bg-cover" style="background-image: url('{{url('/')}}/rr_assets/img/page-banner.jpg')">
    <div class="container">
        <div class="page-heading text-white">
            <h1>404</h1>
        </div>
        <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">404</li>
            </ol>
        </nav>
    </div>
</div>

<section class="error-404-wrapper section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="error-content">
                    <img class="mb-5" src="{{url('/')}}/rr_assets/img/404.png" alt="">
                    <h2>Oops! this page is not found.</h2>
                    <p>Sorry but the page you're looking for may broken or not created</p>
                    <a href="{{url('/')}}" class="theme-btn mt-30"><i class="fal fa-long-arrow-left me-1"></i> Go Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
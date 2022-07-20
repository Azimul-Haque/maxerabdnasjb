@extends('layouts.index')
@section('title') Terms & Conditions | BJS & Bar Exam @endsection

@section('third_party_stylesheets')

@endsection

@section('content')

<section id="hero-area" class="header-area header-eight">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-12 col-12">
        <div class="header-content">
          <h1>Best online platform to gear up your BJS & Bar Council Exam preparation!</h1>
          <p>
            BJS & BAR EXAM is a dedicated online platform to take the best preparation for the Bangladesh Judicial Service (BJS) Exam and Bar Council Exam.
          </p>
          <div class="button">
            <a href="javascript:void(0)" class="btn primary-btn">Get Started</a>
            <a href="https://www.youtube.com/watch?v=r44RKWyfcFw&fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM"
              class="glightbox video-button">
              <span class="btn icon-btn rounded-full">
                <i class="lni lni-play"></i>
              </span>
              <span class="text">Watch Intro</span>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-12">
        <div class="header-image">
          <img src="{{ asset('/') }}images/header/home.png" alt="#" />
        </div>
      </div>
    </div>
  </div>
</section>
    
@endsection

@section('third_party_scripts')

@endsection
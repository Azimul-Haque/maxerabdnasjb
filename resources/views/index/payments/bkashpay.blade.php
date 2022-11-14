@extends('layouts.index')
@section('title') bKash Payment Gateway | BJS & Bar Exam @endsection

<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script id="myScript" src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

@section('third_party_stylesheets')
<style>
    .swal-container, .swal2-container {
        z-index: 2000;
    }
    .overlay{
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 999;
        background: rgba(224,34,95,0.3) url("/images/Spinner-1s-200px.gif") center no-repeat;
    }
    body{
        text-align: center;
    }
    /* Turn off scrollbar when body element has the loading class */
    body.loading{
        overflow: hidden;   
    }
    /* Make spinner image visible when body element has the loading class */
    body.loading .overlay{
        display: block;
    }
    /*body{
        background-color:#dce3f0;
    }*/

    /*.height{
        
        height:100vh;
    }*/

    .card{
        
        width:300px;
        height:150px;
    }

    .image{
        position:absolute;
        right:12px;
        top:10px;
    }

    .main-heading{
        
        font-size:40px;
        color:red !important;
    }

    .ratings i{
        
        color:orange;
        
    }

    .user-ratings h6{
        margin-top:2px;
    }

    .colors{
        display:flex;
        margin-top:2px;
    }

    .colors span{
        width:15px;
        height:15px;
        border-radius:50%;
        cursor:pointer;
        display:flex;
        margin-right:6px;
    }

    .colors span:nth-child(1) {
        
        background-color:red;
        
    }

    .colors span:nth-child(2) {
        
        background-color:blue;
        
    }

    .colors span:nth-child(3) {
        
        background-color:yellow;
        
    }

    .colors span:nth-child(4) {
        
        background-color:purple;
        
    }

    .btn-danger{
        height:48px;
        font-size:18px;
    }
</style>
@endsection

@section('content')
<section style="padding-top: 150px; padding-bottom: 50px; background-color: var(--light-3);">
      <div class="section-title-five">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="content">
                <h6>পেমেন্ট সম্পন্ন করুন</h6>
                <h2 class="fw-bold">৳ {{ bangla($amount) }}</h2>
                <div style="border: 2px solid #ddd; padding: 0px; width: 100%; padding: 20px;" >
                    <div class="overlay"></div>
                    <img class="img-responsive" style="max-width: 250px; margin: 10px 0 10px 0px;" src="{{ asset('images/bkash-trns.png') }}"><br/>
                    <button class="btn btn-danger btn-lg" id="bKash_button" onclick="BkashPayment()">

                        বিকাশ পেমেন্ট করুন
                    </button>
                    <br/><br/>
                    <small>
                        <a href="{{ route('index.terms-and-conditions') }}" target="_blank">Terms & Conditions</a>, <a href="{{ route('index.privacy-policy') }}" target="_blank">Privacy Policy</a> & <a href="{{ route('index.refund-policy') }}" target="_blank">Refund Policy</a>
                    </small>
                </div>
              </div>
            </div>
          </div>
          <!-- row -->
        </div>
        <!-- container -->
      </div>
</section>
@endsection

@section('third_party_scripts')

@endsection

@include('index.payments.bkashscript')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

{{-- <script id="myScript"
        src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js"></script> --}}

{{--    This Commented Script for Live Production --}}
<script id="myScript" src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


{{-- <button class="btn btn-success" id="bKash_button" onclick="BkashPayment()">
    Pay with bKash
</button> --}}

<style>
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
</style>
<div class="overlay"></div>

<div class="height d-flex justify-content-center align-items-center">
    
    <div class="card p-3">
        
        <div class="d-flex justify-content-between align-items-center ">
            <div class="mt-2">
                <h4 class="text-uppercase">টেস্ট প্রোডাক্ট ১</h4>
                <div class="mt-5">
                    <h5 class="text-uppercase mb-0">বিবরণ ১</h5>
                    <h1 class="main-heading mt-0">বিবরণ ১</h1>
                    <div class="d-flex flex-row user-ratings">
                        <div class="ratings">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        </div>
                        <h6 class="text-muted ml-1">4/5</h6>
                    </div>
                </div>
            </div>
            <div class="image">
                <img src="https://i.imgur.com/MGorDUi.png" width="130">
            </div>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
            <big>৳ ২.০০</big>
            <div class="colors">
                
            </div>
            
        </div>
        
        <button class="btn btn-danger" id="bKash_button" onclick="BkashPayment()" style="background: url({{ asset('images/bkash.gif') }}); background-size: 100%; background-size: 280px auto; background-repeat: no-repeat;">
        </button>
    </div>

    <div style="width:20px"></div>

    <div class="card p-3">
    
        <div class="d-flex justify-content-between align-items-center ">
            <div class="mt-2">
                <h4 class="text-uppercase">টেস্ট প্রোডাক্ট ২</h4>
                <div class="mt-5">
                    <h5 class="text-uppercase mb-0">বিবরণ ২</h5>
                    <h1 class="main-heading mt-0">বিবরণ ২</h1>
                    <div class="d-flex flex-row user-ratings">
                        <div class="ratings">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <h6 class="text-muted ml-1">4/5</h6>
                    </div>
                </div>
            </div>
            <div class="image">
                <img src="https://i.imgur.com/MGorDUi.png" width="130">
            </div>
        </div>
    
        <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
            <big>৳ ২.০০</big>
            <div class="colors">
    
            </div>
    
        </div>
    
        <button class="btn btn-danger" id="bKash_button" onclick="BkashPayment()">
                <img src="{{ asset('images/bkash.gif') }}" style="height: 40px; width: auto;">
        </button>
    </div>
</div>


@include('bkash.bkash-script')

<style type="text/css">
        body{
            background-color:#dce3f0;
        }

        .height{
            
            height:100vh;
        }

        .card{
            
            width:300px;
            height:320px;
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
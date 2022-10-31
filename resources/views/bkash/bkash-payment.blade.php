<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

{{-- <script id="myScript"
        src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js"></script> --}}

{{--    This Commented Script for Live Production --}}
<script id="myScript" src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>


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
        
        <button class="btn btn-danger" id="bKash_button" onclick="BkashPayment()">বিকাশ করুন</button>
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
    
        <button class="btn btn-danger" id="bKash_button" onclick="BkashPayment()">বিকাশ করুন</button>
    </div>
</div>


@include('bkash.bkash-script')
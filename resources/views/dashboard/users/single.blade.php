@extends('layouts.app')
@section('title') ড্যাশবোর্ড | একক | {{ $user->name }} @endsection

@section('third_party_stylesheets')
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
  <style type="text/css">
    #img-upload{
        width: 200px;
        height: auto;
    }
  </style>
@endsection

@section('content')
	@section('page-header') {{ $user->name }} @endsection
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-coins"></i></span>

            <div class="info-box-content">
              <small>
                <span class="info-box-text">আজকের অর্থ গ্রহণঃ <b>৳ </b></span>
                <span class="info-box-text">{{ bangla(date('F Y')) }} মাসে মোট অর্থ গ্রহণঃ <b>৳ </b></span>
                <span class="info-box-text">সর্বমোট অর্থ গ্রহণঃ <b>৳ </b></span>
              </small>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-receipt"></i></span>

            <div class="info-box-content">
              <small>
                <span class="info-box-text">আজকের ব্যয়ঃ <b>৳ </b></span>
                <span class="info-box-text">{{ bangla(date('F Y')) }} মাসে মোট অর্থ ব্যয়ঃ <b>৳ </b></span>
                <span class="info-box-text">সর্বমোট অর্থ ব্যয়ঃ <b>৳ </b></span>
                </small>
              {{-- <span class="info-box-number"></span> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-balance-scale-right"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">সর্বমোট ব্যালেন্স</span>
              <span class="info-box-number">৳ </span>
            </div>
          </div>
        </div>
      </div>

      <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
          <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active">প্রদানকৃত অর্থের তালিকা</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard.users.singleother', $user->id) }}">ব্যয়ের তালিকা</a>
            </li>
          </ul>
        </div>
        <div class="card-body p-0">
    
        </div>
        <!-- /.card -->
      </div>
    </div>
@endsection

@section('third_party_scripts')
  
@endsection
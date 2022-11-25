@extends('layouts.app')
@section('title') ড্যাশবোর্ড @endsection

@section('third_party_stylesheets')

@endsection

@section('content')
	@section('page-header') ড্যাশবোর্ড @endsection
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h4>{{ $totalpayment }}<sup style="font-size: 20px">৳</sup></h4>

                <p>মোট আয়</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="" class="small-box-footer">আয় পাতা <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h4>{{ $totalmonthlypayment->totalamount ? $totalmonthlypayment->totalamount : 0 }}<sup style="font-size: 20px">৳</sup></h4>

                <p>মাসিক আয় ({{ date('F Y') }})</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ route('dashboard.expense.index') }}" class="small-box-footer">মাসিক আয় পাতা <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h4>{{ 0 }}</h4>

                <p>মোট পরীক্ষার্থী</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('dashboard.sites') }}" class="small-box-footer">পরীক্ষার্থী পাতা <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h4>{{ $totalusers }}</h4>

                <p>মোট ব্যবহারকারী</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('dashboard.users') }}" class="small-box-footer">ব্যবহারকারীগণ <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <a href="{{ route('dashboard.deposit.getlist', [date('Y-m-d'), 'All']) }}" class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-coins"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">দৈনিক জমা</span>
                <span class="info-box-number">৳ {{ 0 }}</span>
              </div>
            </a>
          </div>
          <div class="col-md-6">
            <a href="{{ route('dashboard.expenses.getlist', [date('Y-m-d'), 'All']) }}" class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-hand-holding-usd"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">দৈনিক খরচ</span>
                <span class="info-box-number">৳ {{ 0 }}</span>
              </div>
            </a>
          </div>
        </div>
    </div>
@endsection

@section('third_party_scripts')

@endsection
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
          <table class="table">
            <tbody>
              {{-- <tr>
                <td>1.</td>
                <td>Update software</td>
                <td>
                  <div class="progress progress-xs">
                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                  </div>
                </td>
                <td><span class="badge bg-danger">55%</span></td>
              </tr> --}}
              @foreach($balances as $balance)
                <tr>
                  <td style="line-height: 1;">
                    <span class="badge bg-success"><big>জমাঃ ৳ </big></span><br/>
                    <small>
                        
                        </span> {{ date('F d, Y h:i A', strtotime($balance->created_at)) }}
                    </small> 
                  </td>
                  <td align="right" width="40%">
                    @if(Auth::user()->role == 'admin')
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteBalanceModal{{ $balance->id }}">
                          <i class="fas fa-trash-alt"></i>
                      </button>
                    @endif
                  </td>
                    @if(Auth::user()->role == 'admin')
                      {{-- Delete Balance Modal Code --}}
                      {{-- Delete Balance Modal Code --}}
                      <!-- Modal -->
                      <div class="modal fade" id="deleteBalanceModal{{ $balance->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteBalanceModalLabel" aria-hidden="true" data-backdrop="static">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-danger">
                              <h5 class="modal-title" id="deleteBalanceModalLabel">অর্থ ডিলেট</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              আপনি কি নিশ্চিতভাবে এই অর্থ ডিলেট করতে চান?<br/>
                              <center><big><b>৳ {{ $balance->amount }}</b></big><br/>
                                  <small><i class="fas fa-user"></i> {{ $balance->user->name }}, <i class="fas fa-calendar-alt"></i> {{ date('F d, Y', strtotime($balance->created_at)) }}</small>
                              </center>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                              <a href="{{ route('dashboard.balance.delete', $balance->id) }}" class="btn btn-danger">ডিলেট করুন</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      {{-- Delete Balance Modal Code --}}
                      {{-- Delete Balance Modal Code --}}
                    @endif
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card -->
      </div>
      <small>{{ $balances->onEachSide(1)->links() }}</small>
    </div>
@endsection

@section('third_party_scripts')
  
@endsection
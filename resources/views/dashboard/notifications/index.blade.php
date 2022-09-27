@extends('layouts.app')
@section('title') ড্যাশবোর্ড | নোটিফিকেশন @endsection

@section('third_party_stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">
@endsection

@section('content')
	@section('page-header') নোটিফিকেশন @endsection
    <div class="container-fluid">
  		<div class="row">
        <div class="col-md-9">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">নোটিফিকেশন তালিকা</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#newNotifModal" title="" rel="tooltip" data-original-title="নতুন নোটিফিকেশন">
                      <i class="fas fa-bell"></i> নতুন নোটিফিকেশন
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>ধরন</th>
                        <th>নোটিফিকেশন</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($notifications as $notification)
                        <tr>
                          <td>{{ $notification->type }}</td>
                          <td>{{ $notification->headings }}<br/>{{ $notification->message }}</td>
                          
                          <td align="right">
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $notification->id }}">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          </td>
                              {{-- Delete Modal Code --}}
                              {{-- Delete Modal Code --}}
                              <!-- Modal -->
                              <div class="modal fade" id="deleteModal{{ $notification->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                      <h5 class="modal-title" id="deleteModalLabel">মেসেজ ডিলেট</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      আপনি কি নিশ্চিতভাবে এই প্যাকেজটি ডিলেট করতে চান?<br/><br/>
                                      <b>{{ $notification->user->name }}</b><br/>
                                      {{ $notification->message }}
                                      
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                                      <a href="{{ route('dashboard.messages.delete', $notification->id) }}" class="btn btn-danger">ডিলেট করুন</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              {{-- Delete Modal Code --}}
                              {{-- Delete Modal Code --}}
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
        </div>  
        <div class="col-md-3"></div>  
      </div>
    {{ $notifications->links() }}<br/><br/>
    </div>

    {{-- New Notif Modal Code --}}
    {{-- New Notif Modal Code --}}
    <!-- Modal -->
    <div class="modal fade" id="newNotifModal" tabindex="-1" role="dialog" aria-labelledby="newNotifModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h5 class="modal-title" id="newNotifModalLabel">নতুন ক্যাটাগরি যোগ</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="post" action="{{ route('dashboard.notifications.send') }}">
                <div class="modal-body">
                      @csrf
                      <div class="input-group mb-3">
                        <select name="role" class="form-control" required>
                          <option disabled="" value="">ধরন নির্ধারণ করুন</option>
                          <option value="প্রিমিয়াম ব্যবহারকারী">এডমিন</option>
                          <option value="সব ব্যবহারকারী">ম্যানেজার</option>
                        </select>
                          <div class="input-group-append">
                              <div class="input-group-text"><span class="fas fa-wrench"></span></div>
                          </div>
                      </div>
                      <div class="input-group mb-3">
                          <input type="text"
                                 name="headings"
                                 class="form-control"
                                 placeholder="হেডিংস" required>
                          <div class="input-group-append">
                              <div class="input-group-text"><span class="fas fa-file-alt"></span></div>
                          </div>
                      </div>
                      <div class="input-group mb-3">
                          <input type="text"
                                 name="message"
                                 class="form-control"
                                 placeholder="মেসেজ" required>
                          <div class="input-group-append">
                              <div class="input-group-text"><span class="fas fa-spa"></span></div>
                          </div>
                      </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                  <button type="submit" class="btn btn-warning">দাখিল করুন</button>
                </div>
            </form>
          </div>
        </div>
      </div>
      {{-- New Notif Modal Code --}}
      {{-- New Notif Modal Code --}}
@endsection

@section('third_party_scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        // $('#adduserrole').change(function () {
        //     if($('#adduserrole').val() == 'accountant') {
        //         $('#ifaccountant').hide();
        //     } else {
        //         $('#ifaccountant').show();
        //     }
        // });
    </script>
@endsection
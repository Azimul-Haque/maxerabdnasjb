@extends('layouts.app')
@section('title') ড্যাশবোর্ড | মেসেজসমূহ @endsection

@section('third_party_stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">
@endsection

@section('content')
	@section('page-header') মেসেজসমূহ @endsection
    <div class="container-fluid">
		<div class="card">
          <div class="card-header">
            <h3 class="card-title">মেসেজসমূহ তালিকা</h3>

            <div class="card-tools">
            	{{-- <button type="button" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#addPackageModal" title="" rel="tooltip" data-original-title="মেসেজসমূহ যোগ করুন">
            		<i class="fas fa-clipboard-check"></i> নতুন মেসেজসমূহ
            	</button> --}}
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table">
              <thead>
                <tr>
                  <th>নাম</th>
                  <th>যোগাযোগ</th>
                  <th>প্যাকেজ</th>
                  <th>মেসেজ</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($messages as $message)
                	<tr>
                    <td>{{ $message->user->name }}</td>
                    <td>{{ $message->user->mobile }}</td>
                    <td>{{ $message->user->payments->count() }} বার কিনেছেন</td>
                    <td>{{ $message->message }}</td>
                		
                		<td align="right" width="40%">
                			<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $message->id }}">
                				<i class="fas fa-trash-alt"></i>
                			</button>
                		</td>
                        {{-- Delete Modal Code --}}
                        {{-- Delete Modal Code --}}
                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true" data-backdrop="static">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-danger">
                                <h5 class="modal-title" id="deleteModalLabel">মেসেজ ডিলেট</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                আপনি কি নিশ্চিতভাবে এই প্যাকেজটি ডিলেট করতে চান?<br/>
                                <center>
                                    <big><b>{{ $message->user->name }}</b></big><br/>
                                    <span>৳ {{ $message->message }}</span>
                                </center>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                                <a href="{{ route('dashboard.users.delete', $message->id) }}" class="btn btn-danger">ডিলেট করুন</a>
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
@extends('layouts.app')
@section('title') ড্যাশবোর্ড | নোটিফিকেশন @endsection

@section('third_party_stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">
@endsection

@section('content')
	@section('page-header') নোটিফিকেশন @endsection
    <div class="container-fluid">
		<div class="card">
          <div class="card-header">
            <h3 class="card-title">নোটিফিকেশন তালিকা</h3>

            <div class="card-tools">
            	{{-- <button type="button" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#addPackageModal" title="" rel="tooltip" data-original-title="নোটিফিকেশন যোগ করুন">
            		<i class="fas fa-clipboard-check"></i> নতুন নোটিফিকেশন
            	</button> --}}
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
                    <td>{{ $notification->user->mobile }}</td>
                    <td>{{ $notification->user->payments->count() }} বার কিনেছেন</td>
                    <td>{{ $notification->message }}</td>
                		
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
        {{ $notifications->links() }}<br/><br/>
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
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
                @foreach($packages as $package)
                	<tr>
                		<td>
                			{{ $package->name }}
                      <span class="badge bg-info"><strike>৳ {{ $package->strike_price }}</strike></span>
                      <span class="badge bg-success">৳ {{ $package->price }}</span>
                      @if($package->status == 1)
                        <span class="badge bg-primary">Active</span>
                      @endif
                      @if($package->suggested == 1)
                        <span class="badge bg-warning"><i class="fas fa-bolt"></i></span>
                      @endif
                			<br/>
                			<small class="text-black-50">{{ $package->tagline }}</small> 
                		</td>
                		<td align="right" width="40%">
                			<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePackageModal{{ $package->id }}">
                				<i class="fas fa-trash-alt"></i>
                			</button>
                		</td>
                        {{-- Delete Package Modal Code --}}
                        {{-- Delete Package Modal Code --}}
                        <!-- Modal -->
                        <div class="modal fade" id="deletePackageModal{{ $package->id }}" tabindex="-1" role="dialog" aria-labelledby="deletePackageModalLabel" aria-hidden="true" data-backdrop="static">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-danger">
                                <h5 class="modal-title" id="deletePackageModalLabel">প্যাকেজ ডিলেট</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                আপনি কি নিশ্চিতভাবে এই প্যাকেজটি ডিলেট করতে চান?<br/>
                                <center>
                                    <big><b>{{ $package->name }}</b></big><br/>
                                    <span>৳ {{ $package->price }}</span>
                                </center>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                                <a href="{{ route('dashboard.users.delete', $package->id) }}" class="btn btn-danger">ডিলেট করুন</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- Delete Package Modal Code --}}
                        {{-- Delete Package Modal Code --}}
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
@extends('layouts.app')
@section('title') ড্যাশবোর্ড | ব্যবহারকারীগণ @endsection

@section('third_party_stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
	@section('page-header') ব্যবহারকারীগণ @endsection
    <div class="container-fluid">
		<div class="card">
          <div class="card-header">
            <h3 class="card-title">ব্যবহারকারীগণ</h3>

            <div class="card-tools">
            	<button type="button" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#addUserModal">
            		<i class="fas fa-user-plus"></i> নতুন
            	</button>
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
                @foreach($users as $user)
                	<tr>
                		<td>
                			<a href="{{ route('dashboard.users.single', $user->id) }}">{{ $user->name }}</a>
                      <small>({{ $user->payments->count() }} বার প্যাকেজ কিনেছেন)</small>
                			<br/>
                            {{-- {{ $user->balances2 }} --}}
                			<small class="text-black-50">{{ $user->mobile }}</small> 
                			<span class="badge @if($user->role == 'admin') bg-success @else bg-info @endif">{{ ucfirst($user->role) }}</span>
                		</td>
                		<td align="right" width="40%">
                      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#notifModal{{ $user->id }}">
                        <i class="fas fa-bell"></i>
                      </button>
                      {{-- Notif Modal Code --}}
                      {{-- Notif Modal Code --}}
                      <!-- Modal -->
                      <div class="modal fade" id="notifModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="notifModalLabel" aria-hidden="true" data-backdrop="static">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-warning">
                              <h5 class="modal-title" id="notifModalLabel">নোটিফিকেশন পাঠান</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form method="post" action="{{ route('dashboard.users.singlenotification', $user->id) }}">
                              <div class="modal-body">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="text"
                                               name="message"
                                               class="form-control"
                                               placeholder="মেসেজ" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text"><span class="fas fa-spa"></span></div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text"
                                               name="headings"
                                               class="form-control"
                                               placeholder="হেডিংস" required>
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
                      {{-- Notif Modal Code --}}
                      {{-- Notif Modal Code --}}
                			<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editUserModal{{ $user->id }}">
                				<i class="fas fa-user-edit"></i>
                			</button>
            			    {{-- Edit User Modal Code --}}
            			    {{-- Edit User Modal Code --}}
            			    <!-- Modal -->
            			    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true" data-backdrop="static">
            			      <div class="modal-dialog" role="document">
            			        <div class="modal-content">
            			          <div class="modal-header bg-primary">
            			            <h5 class="modal-title" id="editUserModalLabel">ব্যবহারকারী তথ্য হালনাগাদ</h5>
            			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            			              <span aria-hidden="true">&times;</span>
            			            </button>
            			          </div>
            			          <form method="post" action="{{ route('dashboard.users.update', $user->id) }}">
            				          <div class="modal-body">
            				            
            				                @csrf

            				                <div class="input-group mb-3">
            				                    <input type="text"
            				                           name="name"
            				                           class="form-control"
            				                           value="{{ $user->name }}"
            				                           placeholder="নাম" required>
            				                    <div class="input-group-append">
            				                        <div class="input-group-text"><span class="fas fa-user"></span></div>
            				                    </div>
            				                </div>

            				                <div class="input-group mb-3">
            				                    <input type="text"
            				                           name="mobile"
            				                           value="{{ $user->mobile }}"
            				                           autocomplete="off"
            				                           class="form-control"
            				                           placeholder="মোবাইল নম্বর (১১ ডিজিট)" required>
            				                    <div class="input-group-append">
            				                        <div class="input-group-text"><span class="fas fa-phone"></span></div>
            				                    </div>
            				                </div>

            				                <div class="input-group mb-3">
            				                	<select name="role" class="form-control" required>
            				                		<option disabled="" value="">ধরন নির্ধারণ করুন</option>
            				                		<option value="admin" @if($user->role == 'admin') selected="" @endif>এডমিন</option>
              													<option value="manager" @if($user->role == 'manager') selected="" @endif>ম্যানেজার</option>
              													<option value="user" @if($user->role == 'user') selected="" @endif>ব্যবহারকারী</option>
              													{{-- <option value="accountant" @if($user->role == 'accountant') selected="" @endif>একাউন্টেন্ট</option> --}}
            				                	</select>
            				                    <div class="input-group-append">
            				                        <div class="input-group-text"><span class="fas fa-user-secret"></span></div>
            				                    </div>
            				                </div>

                                    <div class="input-group mb-3">
                                        <input type="text"
                                               name="packageexpirydate"
                                               id="packageexpirydate{{ $user->id }}" 
                                               value="{{ date('F d, Y', strtotime($user->package_expiry_date)) }}"
                                               autocomplete="off"
                                               class="form-control"
                                               placeholder="প্যাকেজের মেয়াদ বৃদ্ধি" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text"><span class="fas fa-calendar-check"></span></div>
                                        </div>
                                    </div>

            				                <div class="input-group mb-3">
            				                    <input type="password"
            				                           name="password"
            				                           class="form-control"
            				                           autocomplete="new-password"
            				                           placeholder="পাসওয়ার্ড (ঐচ্ছিক)">
            				                    <div class="input-group-append">
            				                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
            				                    </div>
            				                </div>
            				            
            				          </div>
            				          <div class="modal-footer">
            				            <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
            				            <button type="submit" class="btn btn-primary">দাখিল করুন</button>
            				          </div>
            			          </form>
            			        </div>
            			      </div>
            			    </div>
            			    {{-- Edit User Modal Code --}}
            			    {{-- Edit User Modal Code --}}

                			<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteUserModal{{ $user->id }}">
                				<i class="fas fa-user-minus"></i>
                			</button>
                		</td>
                        {{-- Delete User Modal Code --}}
                        {{-- Delete User Modal Code --}}
                        <!-- Modal -->
                        <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true" data-backdrop="static">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-danger">
                                <h5 class="modal-title" id="deleteUserModalLabel">ব্যবহারকারী ডিলেট</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                আপনি কি নিশ্চিতভাবে এই ব্যবহারকারীকে ডিলেট করতে চান?<br/>
                                <center>
                                    <big><b>{{ $user->name }}</b></big><br/>
                                    <small><i class="fas fa-phone"></i> {{ $user->mobile }}</small>
                                </center>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                                <a href="{{ route('dashboard.users.delete', $user->id) }}" class="btn btn-danger">ডিলেট করুন</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- Delete User Modal Code --}}
                        {{-- Delete User Modal Code --}}
                	</tr>
                  <script type="text/javascript" src="{{ asset('js/jquery-for-dp.min.js') }}"></script>
                  <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
                  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
                  <script>
                    $("#packageexpirydate{{ $user->id }}").datepicker({
                      format: 'MM dd, yyyy',
                      todayHighlight: true,
                      autoclose: true,
                    });
                  </script>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        {{ $users->links() }}
    </div>

    {{-- Add User Modal Code --}}
    {{-- Add User Modal Code --}}
    <!-- Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-success">
            <h5 class="modal-title" id="addUserModalLabel">নতুন ব্যবহারকারী যোগ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{ route('dashboard.users.store') }}">
	          <div class="modal-body">
	            
	                @csrf

	                <div class="input-group mb-3">
	                    <input type="text"
	                           name="name"
	                           class="form-control"
	                           value="{{ old('name') }}"
	                           placeholder="নাম" required>
	                    <div class="input-group-append">
	                        <div class="input-group-text"><span class="fas fa-user"></span></div>
	                    </div>
	                </div>

	                <div class="input-group mb-3">
	                    <input type="text"
	                           name="mobile"
	                           value="{{ old('mobile') }}"
	                           autocomplete="off"
	                           class="form-control"
	                           placeholder="মোবাইল নম্বর (১১ ডিজিট)" required>
	                    <div class="input-group-append">
	                        <div class="input-group-text"><span class="fas fa-phone"></span></div>
	                    </div>
	                </div>

	                <div class="input-group mb-3">
	                	<select name="role" id="adduserrole" class="form-control" required>
	                		<option selected="" disabled="" value="">ধরন</option>
	                		<option value="admin">এডমিন</option>
							<option value="manager">ম্যানেজার</option>
	                		<option value="user">ব্যবহারকারী</option>
							{{-- <option value="accountant">একাউন্টেন্ট</option> --}}
	                	</select>
	                    <div class="input-group-append">
	                        <div class="input-group-text"><span class="fas fa-user-secret"></span></div>
	                    </div>
	                </div>


	                <div class="input-group mb-3">
	                    <input type="password"
	                           name="password"
	                           class="form-control"
	                           autocomplete="off"
	                           placeholder="পাসওয়ার্ড" required>
	                    <div class="input-group-append">
	                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
	                    </div>
	                </div>
	            
	          </div>
	          <div class="modal-footer">
	            <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
	            <button type="submit" class="btn btn-success">দাখিল করুন</button>
	          </div>
          </form>
        </div>
      </div>
    </div>
    {{-- Add User Modal Code --}}
    {{-- Add User Modal Code --}}
@endsection

@section('third_party_scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $('#adduserrole').change(function () {
            if($('#adduserrole').val() == 'accountant') {
                $('#ifaccountant').hide();
            } else {
                $('#ifaccountant').show();
            }
        });
    </script>
@endsection
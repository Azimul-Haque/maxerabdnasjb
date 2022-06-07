@extends('layouts.app')
@section('title') ড্যাশবোর্ড | প্রশ্নব্যাংক @endsection

@section('third_party_stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">
@endsection

@section('content')
    @section('page-header') প্রশ্নব্যাংক @endsection
    <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">প্রশ্নব্যাংক</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#addQuesitonModal">
                    <i class="fas fa-plus-circle"></i> নতুন প্রশ্ন যোগ
                </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Options</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($questions as $question)
                    <tr>
                        <td>
                            {{ $question->question }}<br/>
                            <span class="badge bg-success">{{ $question->topic->name }}</span>
                        </td>
                        <td>{{ $question->answer }}</td>
                        <td>{{ $question->opntion1 }}, {{ $question->opntion2 }}, {{ $question->opntion3 }}</td>
                        {{-- <td>
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                            </div>
                        </td> --}}
                    
                        <td align="right" width="40%">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editQuestionModal{{ $question->id }}">
                                <i class="fas fa-user-edit"></i>
                            </button>
                            {{-- Edit Question Modal Code --}}
                            {{-- Edit Question Modal Code --}}
                            <!-- Modal -->
                            <div class="modal fade" id="editQuestionModal{{ $question->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                    <h5 class="modal-title" id="editUserModalLabel">প্রশ্ন হালনাগাদ</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form method="post" action="{{ route('dashboard.users.update', $question->id) }}">
                                        <div class="modal-body">
                                        
                                            @csrf

                                            <div class="input-group mb-3">
                                                <input type="text"
                                                        name="name"
                                                        class="form-control"
                                                        value="{{ $question->name }}"
                                                        placeholder="নাম" required>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><span class="fas fa-user"></span></div>
                                                </div>
                                            </div>

                                            <div class="input-group mb-3">
                                                <input type="text"
                                                        name="mobile"
                                                        value="{{ $question->mobile }}"
                                                        autocomplete="off"
                                                        class="form-control"
                                                        placeholder="মোবাইল নম্বর (১১ ডিজিট)" required>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><span class="fas fa-phone"></span></div>
                                                </div>
                                            </div>

                                            {{-- <div class="input-group mb-3">
                                                <select name="role" class="form-control" required>
                                                    <option disabled="" value="">ধরন নির্ধারণ করুন</option>
                                                    <option value="admin" @if($question->role == 'admin') selected="" @endif>এডমিন</option>
                                                    <option value="manager" @if($question->role == 'manager') selected="" @endif>ম্যানেজার</option>
                                                    <option value="user" @if($question->role == 'user') selected="" @endif>ব্যবহারকারী</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><span class="fas fa-user-secret"></span></div>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                                        <button type="submit" class="btn btn-primary">দাখিল করুন</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            {{-- Edit Question Modal Code --}}
                            {{-- Edit Question Modal Code --}}

                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteUserModal{{ $question->id }}">
                                <i class="fas fa-user-minus"></i>
                            </button>
                        </td>
                        {{-- Delete Question Modal Code --}}
                        {{-- Delete Question Modal Code --}}
                        <!-- Modal -->
                        <div class="modal fade" id="deleteUserModal{{ $question->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true" data-backdrop="static">
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
                                    <big><b>{{ $question->name }}</b></big><br/>
                                    <small><i class="fas fa-phone"></i> {{ $question->mobile }}</small>
                                </center>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                                <a href="{{ route('dashboard.users.delete', $question->id) }}" class="btn btn-danger">ডিলেট করুন</a>
                                </div>
                            </div>
                            </div>
                        </div>
                        {{-- Delete Question Modal Code --}}
                        {{-- Delete Question Modal Code --}}
                    </tr>
                @endforeach
                </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        {{ $questions->links() }}
    </div>

    {{-- Add Question Modal Code --}}
    {{-- Add Question Modal Code --}}
    <!-- Modal -->
    <div class="modal fade" id="addQuesitonModal" tabindex="-1" role="dialog" aria-labelledby="addQuesitonModalLabel" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header bg-success">
            <h5 class="modal-title" id="addQuesitonModalLabel">নতুন ব্যবহারকারী যোগ</h5>
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
    {{-- Add Question Modal Code --}}
    {{-- Add Question Modal Code --}}
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
@extends('layouts.app')
@section('title') ড্যাশবোর্ড | প্রশ্নব্যাংক @endsection

@section('third_party_stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">
@endsection

@section('content')
    @section('page-header') প্রশ্নব্যাংক @endsection
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
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
                                  <td>{{ $question->option1 }}, {{ $question->option2 }}, {{ $question->option3 }}</td>
                                  {{-- <td>
                                      <div class="progress progress-xs">
                                          <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                      </div>
                                  </td> --}}
                              
                                  <td>
                                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editQuestionModal{{ $question->id }}">
                                          <i class="far fa-edit"></i>
                                      </button>
                                      {{-- Edit Question Modal Code --}}
                                      {{-- Edit Question Modal Code --}}
                                      <!-- Modal -->
                                      <div class="modal fade" id="editQuestionModal{{ $question->id }}" tabindex="-1" role="dialog" aria-labelledby="editQuestionModalLabel" aria-hidden="true" data-backdrop="static">
                                          <div class="modal-dialog modal-lg" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header bg-success">
                                                <h5 class="modal-title" id="editQuestionModalLabel">প্রশ্ন হালনাগাদ</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <form method="post" action="{{ route('dashboard.questions.update', $question->id) }}" enctype='multipart/form-data'>
                                                <div class="modal-body">
                                                      @csrf
                                                      <div class="input-group mb-3">
                                                          <input type="text" name="question" class="form-control" value="{{ $question->question }}" placeholder="প্রশ্ন" required>
                                                          <div class="input-group-append">
                                                              <div class="input-group-text"><span class="far fa-question-circle"></span></div>
                                                          </div>
                                                      </div>
                                                      <div class="input-group mb-3">
                                                          <input type="text" name="answer" value="{{ $question->answer }}" class="form-control" placeholder="সঠিক উত্তর" required>
                                                          <div class="input-group-append">
                                                              <div class="input-group-text"><span class="far fa-check-circle"></span></div>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-md-4">
                                                              <input type="text" name="option1" value="{{ $question->option1 }}" class="form-control mb-3" placeholder="অপশন ১" required>
                                                          </div>
                                                          <div class="col-md-4">
                                                              <input type="text" name="option2" value="{{ $question->option2 }}" class="form-control mb-3" placeholder="অপশন ২" required>
                                                          </div>
                                                          <div class="col-md-4">
                                                              <input type="text" name="option3" value="{{ $question->option3 }}" class="form-control mb-3" placeholder="অপশন ৩" required>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-md-6">
                                                              <div class="input-group mb-3">
                                                                  <select name="difficulty" class="form-control" required>
                                                                      <option selected="" disabled="" value="">ডিফিকাল্টি লেভেল</option>
                                                                      <option value="1" @if($question->difficulty = 1) selected @endif>সহজ</option>
                                                                      <option value="2" @if($question->difficulty = 2) selected @endif>মধ্যম</option>
                                                                      <option value="3" @if($question->difficulty = 3) selected @endif>কঠিন</option>
                                                                  </select>
                                                                  <div class="input-group-append">
                                                                      <div class="input-group-text"><span class="fas fa-star-half-alt"></span></div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div class="col-md-6">
                                                              <div class="input-group mb-3">
                                                                  <select name="topic_id" class="form-control" required>
                                                                      <option selected="" disabled="" value="">টপিক (বিষয়)</option>
                                                                      @foreach ($topics as $topic)
                                                                          <option value="{{ $topic->id }}" @if($question->topic_id = $topic->id) selected @endif>{{ $topic->name }}</option>
                                                                      @endforeach
                                                                  </select>
                                                                  <div class="input-group-append">
                                                                      <div class="input-group-text"><span class="fas fa-bookmark"></span></div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div class="col-md-6">
                                                              <div class="form-group ">
                                                                  <label for="image">ছবি (প্রয়োজনে) {{ $question->questionimage ? $question->questionimage->image : '' }}</label>
                                                                  <input type="file" id="image{{ $question->id }}" name="image" accept="image/*">
                                                              </div>
                                                              <center>
                                                                  <?php
                                                                    // if($question->questionimage->image) {
                                                                    //     $currentimage = asset('images/questions/' . $question->questionimage->image);
                                                                    // } else {
                                                                    //     $currentimage = asset('images/placeholder.png');
                                                                    // }
                                                                  ?>
                                                                  <img src="asset('images/placeholder.png')" id='img-upload{{ $question->id }}' style="width: 250px; height: auto;" class="img-responsive" />
                                                              </center>
                                                          </div>
                                                          <div class="col-md-6">
                                                              <label for="explanation">ব্যাখ্যা (প্রয়োজনে)</label><br/>
                                                              <textarea class="form-control" name="explanation" id="explanation" placeholder="ব্যাখ্যা" style="width: 100%; height: 220px;"></textarea>
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
                                      {{-- Edit Question Modal Code --}}
                                      {{-- Edit Question Modal Code --}}
          
                                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteQuestionModal{{ $question->id }}">
                                          <i class="far fa-trash-alt"></i>
                                      </button>
                                  </td>
                                  {{-- Delete Question Modal Code --}}
                                  {{-- Delete Question Modal Code --}}
                                  <!-- Modal -->
                                  <div class="modal fade" id="deleteQuestionModal{{ $question->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteQuestionModalLabel" aria-hidden="true" data-backdrop="static">
                                      <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header bg-danger">
                                          <h5 class="modal-title" id="deleteQuestionModalLabel">প্রশ্ন ডিলেট</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                          </div>
                                          <div class="modal-body">
                                            আপনি কি নিশ্চিতভাবে এই প্রশ্নটি ডিলেট করতে চান?<br/><br/>
                                            <center>
                                                <big><b>{{ $question->question }}</b></big>
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
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">টপিকসমূহ</h3>
          
                      <div class="card-tools">
                          <button type="button" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#addTopicModal">
                              <i class="fas fa-plus-circle"></i> নতুন টপিক
                          </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>Topic</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                          @foreach($topics as $topic)
                              <tr>
                                  <td>
                                      {{ $topic->name }}<br/>
                                  </td>
                              
                                  <td align="right" width="40%">
                                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editTopicModal{{ $topic->id }}">
                                          <i class="far fa-edit"></i>
                                      </button>
                                      {{-- Edit Topic Modal Code --}}
                                      {{-- Edit Topic Modal Code --}}
                                      <!-- Modal -->
                                      <div class="modal fade" id="editTopicModal{{ $topic->id }}" tabindex="-1" role="dialog" aria-labelledby="editTopicModalLabel" aria-hidden="true" data-backdrop="static">
                                          <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header bg-warning">
                                              <h5 class="modal-title" id="editTopicModalLabel">টপিক হালনাগাদ</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                              </div>
                                              <form method="post" action="{{ route('dashboard.questions.topic.update', $topic->id) }}">
                                                  <div class="modal-body">
                                                      @csrf
                                                      <div class="input-group mb-3">
                                                          <input type="text"
                                                                  name="name"
                                                                  class="form-control"
                                                                  value="{{ $topic->name }}"
                                                                  placeholder="নাম" required>
                                                          <div class="input-group-append">
                                                              <div class="input-group-text"><span class="far fa-bookmark"></span></div>
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
                                      {{-- Edit Topic Modal Code --}}
                                      {{-- Edit Topic Modal Code --}}
          
                                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteTopicModal{{ $topic->id }}" disabled>
                                          <i class="far fa-trash-alt"></i>
                                      </button>
                                  </td>
                                  {{-- Delete Topic Modal Code --}}
                                  {{-- Delete Topic Modal Code --}}
                                  <!-- Modal -->
                                  <div class="modal fade" id="deleteTopicModal{{ $topic->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteTopicModalLabel" aria-hidden="true" data-backdrop="static">
                                      <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header bg-danger">
                                          <h5 class="modal-title" id="deleteTopicModalLabel">টপিক ডিলেট</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                          </div>
                                          <div class="modal-body">
                                          আপনি কি নিশ্চিতভাবে এই টপিকটি ডিলেট করতে চান?<br/>
                                          <center>
                                              <big><b>{{ $topic->name }}</b></big><br/>
                                          </center>
                                          </div>
                                          <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                                          <a href="{{ route('dashboard.questions.topic.delete', $topic->id) }}" class="btn btn-danger">ডিলেট করুন</a>
                                          </div>
                                      </div>
                                      </div>
                                  </div>
                                  {{-- Delete Topic Modal Code --}}
                                  {{-- Delete Topic Modal Code --}}
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
            </div>
        </div>

    {{-- Add Question Modal Code --}}
    {{-- Add Question Modal Code --}}
    <!-- Modal -->
    <div class="modal fade" id="addQuesitonModal" tabindex="-1" role="dialog" aria-labelledby="addQuesitonModalLabel" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header bg-success">
            <h5 class="modal-title" id="addQuesitonModalLabel">নতুন প্রশ্ন যোগ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{ route('dashboard.questions.store') }}" enctype='multipart/form-data'>
              <div class="modal-body">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="question" class="form-control" value="{{ old('question') }}" placeholder="প্রশ্ন" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="far fa-question-circle"></span></div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="answer" value="{{ old('answer') }}" class="form-control" placeholder="সঠিক উত্তর" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="far fa-check-circle"></span></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="option1" value="{{ old('option1') }}" class="form-control mb-3" placeholder="অপশন ১" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="option2" value="{{ old('option2') }}" class="form-control mb-3" placeholder="অপশন ২" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="option3" value="{{ old('option3') }}" class="form-control mb-3" placeholder="অপশন ৩" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <select name="difficulty" class="form-control" required>
                                    <option selected="" disabled="" value="">ডিফিকাল্টি লেভেল</option>
                                    <option value="1">সহজ</option>
                                    <option value="2">মধ্যম</option>
                                    <option value="3">কঠিন</option>
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text"><span class="fas fa-star-half-alt"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <select name="topic_id" class="form-control" required>
                                    <option selected="" disabled="" value="">টপিক (বিষয়)</option>
                                    @foreach ($topics as $topic)
                                        <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text"><span class="fas fa-bookmark"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="image">ছবি (প্রয়োজনে)</label>
                                <input type="file" id="image" name="image" accept="image/*">
                            </div>
                            <center>
                                <img src="{{ asset('images/placeholder.png')}}" id='img-upload' style="width: 250px; height: auto;" class="img-responsive" />
                            </center>
                        </div>
                        <div class="col-md-6">
                            <label for="explanation">ব্যাখ্যা (প্রয়োজনে)</label><br/>
                            <textarea class="form-control" name="explanation" id="explanation" placeholder="ব্যাখ্যা" style="width: 100%; height: 220px;"></textarea>
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

{{-- Add Question Modal Code --}}
{{-- Add Question Modal Code --}}
<!-- Modal -->
<div class="modal fade" id="addTopicModal" tabindex="-1" role="dialog" aria-labelledby="addTopicModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title" id="addQuesitonModalLabel">নতুন টপিক যোগ</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" action="{{ route('dashboard.questions.topic.store') }}">
            <div class="modal-body">
                  @csrf
                  <div class="input-group mb-3">
                      <input type="text"
                             name="name"
                             class="form-control"
                             value="{{ old('name') }}"
                             placeholder="নাম" required>
                      <div class="input-group-append">
                          <div class="input-group-text"><span class="far fa-bookmark"></span></div>
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
  {{-- Add Question Modal Code --}}
  {{-- Add Question Modal Code --}}
@endsection

@section('third_party_scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
    $(document).ready( function() {
      $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
      });

      $('.btn-file :file').on('fileselect', function(event, label) {
          var input = $(this).parents('.input-group').find(':text'),
              log = label;
          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }
      });
      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#img-upload').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }
      $("#image").change(function(){
          readURL(this);
          var filesize = parseInt((this.files[0].size)/1024);
          if(filesize > 10000) {
            $("#image").val('');
            // toastr.warning('File size is: '+filesize+' Kb. try uploading less than 300Kb', 'WARNING').css('width', '400px;');
            Toast.fire({
                icon: 'warning',
                title: 'File size is: '+filesize+' Kb. try uploading less than 300Kb'
            })
            setTimeout(function() {
            $("#img-upload").attr('src', '{{ asset('images/placeholder.png') }}');
            }, 1000);
          }
      });

    });
</script>
@endsection
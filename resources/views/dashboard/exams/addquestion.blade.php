@extends('layouts.app')
@section('title') ড্যাশবোর্ড | পরীক্ষা | {{ $exam->name }}@endsection

@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">
@endsection

@section('content')
    @section('page-header') {{ $exam->name }} @endsection
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">প্রশ্নসমূহ</h3>
          
                      <div class="card-tools">
                          <button type="button" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#addExamQuestionModal">
                              <i class="fas fa-tasks"></i> প্রশ্ন হালনাগাদ করুন
                          </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table" id="myTable">
                          <thead>
                              <tr>
                                  <th>প্রশ্ন</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                          @foreach($examquestions as $examquestion)
                              <tr>
                                  <td>
                                      {{ $examquestion->question->question }}<br/>
                                      <span class="badge bg-success">{{ $examquestion->question->topic->name }}</span>
                                  </td>
                              
                                  <td align="right" width="40%">
                                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editCategoryModal{{ $examquestion->id }}">
                                          <i class="far fa-edit"></i>
                                      </button>
          
                                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCategoryModal{{ $examquestion->id }}" disabled>
                                          <i class="far fa-trash-alt"></i>
                                      </button>
                                  </td>
                                  {{-- Remove Exam Question Modal Code --}}
                                  {{-- Remove Exam Question Modal Code --}}
                                  <!-- Modal -->
                                  <div class="modal fade" id="deleteCategoryModal{{ $examquestion->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true" data-backdrop="static">
                                      <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header bg-danger">
                                          <h5 class="modal-title" id="deleteCategoryModalLabel">প্রশ্ন অপসারণ</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                          </div>
                                          <div class="modal-body">
                                          আপনি কি নিশ্চিতভাবে এই প্রশ্নটি অপসারণ করতে চান?<br/>
                                          <center>
                                              <big><b>{{ $examquestion->question->question }}</b></big><br/>
                                          </center>
                                          </div>
                                          <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                                          <a href="{{ route('dashboard.exams.category.delete', $examquestion->id) }}" class="btn btn-danger">ডিলেট করুন</a>
                                          </div>
                                      </div>
                                      </div>
                                  </div>
                                  {{-- Remove Exam Question Modal Code --}}
                                  {{-- Remove Exam Question Modal Code --}}
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">স্বয়ংক্রিয় প্রশ্ন প্রণয়ন</h3>
          
                      <div class="card-tools">
                          <button type="button" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#automaticQuestionSetModal">
                              <i class="fas fa-plus-circle"></i> প্রশ্ন প্রণয়ন
                          </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      বিষয়ভিত্তিক মান বণ্টন
                    </div>
                    <!-- /.card-body -->
                  </div>   
            </div>
        </div>
    </div>

    {{-- Add Exam Question Modal Code --}}
    {{-- Add Exam Question Modal Code --}}
    <!-- Modal -->
    <div class="modal fade" id="addExamQuestionModal" tabindex="-1" role="dialog" aria-labelledby="addExamQuestionModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                <h5 class="modal-title" id="addExamQuestionModalLabel">
                    প্রশ্ন হালনাগাদ
                    <span id="questionupdatingnumber"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form method="post" id="addquestionform" action="{{ route('dashboard.exams.question.store') }}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                        <input type="hidden" id="hiddencheckarray" name="hiddencheckarray">
                        <table class="table table-condensed" id="datatablemodal">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>প্রশ্ন</th>
                                    <th>উত্তর</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                <tr>
                                    <td>
                                        <div class="icheck-primary icheck-inline" style="float: left;">
                                            <input type="checkbox" onchange="checkboxquestion({{ $question->id }})" id="check{{ $question->id }}" name="questioncheck[]" value="{{ $question->id }}" 
                                            {{-- @if(in_array($site->id, explode(',', $user->sites))) checked="" @endif --}}
                                            />
                                            <label for="check{{ $question->id }}"> </label>
                                        </div>
                                    </td>
                                    <td>{{ $question->question }}</td>
                                    <td>{{ $question->answer }}</td>
                                </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                    <button type="submit" class="btn btn-success">দাখিল করুন</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Add Exam Question Modal Code --}}
    {{-- Add Exam Question Modal Code --}}
@endsection

@section('third_party_scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/underscore@1.13.4/underscore-umd-min.js"></script>
<script>
    $("#datatablemodal").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false, info: false, "pageLength": 10,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    });

    function checkboxquestion(id) {
        console.log("hi");
        if($(this).is(':checked')){
            var hiddencheckarray = $('#hiddencheckarray').val();
            console.log(hiddencheckarray);
            var updatedvalue = hiddencheckarray + (!hiddencheckarray ? '' : ', ') + id;
            $('#hiddencheckarray').val(updatedvalue);
            console.log(updatedvalue);
            var array = updatedvalue.split(',');
            $('#questionupdatingnumber').text('প্রশ্ন সংখ্যাঃ ' + array.length);
        } else if($(this).is('not:checked')){
            var hiddencheckarray = $('#hiddencheckarray').val();
            var array = hiddencheckarray.split(',');
            var updatedarray = _.without(array, id);
            console.log(updatedarray);
            // var updatedvalue = hiddencheckarray + (!hiddencheckarray ? '' : ', ') + id;
            // $('#hiddencheckarray').val(updatedvalue);
            // console.log(updatedvalue);
            
            // $('#questionupdatingnumber').text('প্রশ্ন সংখ্যাঃ ' + array.length);
        }
    }
    
    
  </script>

@endsection
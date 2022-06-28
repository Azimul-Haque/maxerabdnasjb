@extends('layouts.app')
@section('title') ড্যাশবোর্ড | কোর্স | {{ $course->name }}@endsection

@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">
@endsection

@section('content')
    @section('page-header') {{ $course->name }} @endsection
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">পরীক্ষাসমূহ ({{ $courseexams->count() }} টি প্রশ্ন)</h3>
          
                      <div class="card-tools">
                          <button type="button" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#addExamModal">
                              <i class="fas fa-tasks"></i> পরীক্ষা হালনাগাদ করুন
                          </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table" id="datatable">
                          <thead>
                              <tr>
                                  <th>পরীক্ষা</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                          @foreach($courseexams as $courseexam)
                              <tr>
                                  <td>
                                      {{ $courseexam->exam->name }}<br/>
                                      {{-- <span class="badge bg-success">{{ $courseexam->question->topic->name }}</span> --}}
                                  </td>
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
            </div>
        </div>
    </div>

    {{-- Add Exam Question Modal Code --}}
    {{-- Add Exam Question Modal Code --}}
    <!-- Modal -->
    <div class="modal fade" id="addExamModal" tabindex="-1" role="dialog" aria-labelledby="addExamModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="addExamModalLabel">
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
                        @php
                            $courseexamidarray = [];
                            foreach ($courseexams as $courseexam) {
                                $courseexamidarray[] = $courseexam->question_id;
                            }
                            $questionchecktext = implode(",", $courseexamidarray);
                        @endphp
                        <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                        <input type="hidden" id="hiddencheckarray" name="hiddencheckarray" value="{{ $questionchecktext }}">
                        <table class="table table-condensed" id="datatablemodal">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>প্রশ্ন</th>
                                    <th>টপিক</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                <tr>
                                    <td>
                                        <div class="icheck-primary icheck-inline" style="float: left;">
                                            <input type="checkbox" onchange="checkboxquestion({{ $question->id }})" id="check{{ $question->id }}" name="questioncheck[]" value="{{ $question->id }}" 
                                            @if(in_array($question->id, $courseexamidarray)) checked="" @endif
                                            />
                                            <label for="check{{ $question->id }}"> </label>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $question->question }}
                                    </td>
                                    <td><span class="badge bg-success">{{ $question->topic->name }}</span></td>
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
    
    {{-- Auto Question Set Modal Code --}}
    {{-- Auto Question Set Modal Code --}}
    <!-- Modal -->
    <div class="modal fade" id="automaticQuestionSetModal" tabindex="-1" role="dialog" aria-labelledby="automaticQuestionSetModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                <h5 class="modal-title" id="automaticQuestionSetModalLabel">
                    স্বয়ংক্রিয় প্রশ্ন প্রণয়ন
                    <span id="questionupdatingnumber"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form method="post" id="addautoquestionform" action="{{ route('dashboard.exams.question.auto') }}">
                    <div class="modal-body p-0">
                        @csrf
                        <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                        <table class="table">
                            <tbody>
                                @foreach ($topics as $topic)
                                    <tr>
                                        <td width="50%">{{ $topic->name }}</td>
                                        <td>
                                            <input type="hidden" name="topic{{ $topic->id }}" value="{{ $topic->id }}">
                                            <input type="number" name="quantity{{ $topic->id }}" min="0" class="form-control" value="" placeholder="প্রশ্নের পরিমাণ">
                                        </td>
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
    {{-- Auto Question Set Modal Code --}}
    {{-- Auto Question Set Modal Code --}}
@endsection

@section('third_party_scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/underscore@1.13.4/underscore-umd-min.js"></script>
<script>
    $("#datatable").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false, info: false, "pageLength": 10,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    });
    $("#datatablemodal").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false, info: false, "pageLength": 10,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    });

    function checkboxquestion(id) {
        if($('#check' + id)[0].checked){
            var hiddencheckarray = $('#hiddencheckarray').val();
            // console.log(hiddencheckarray);
            var updatedvalue = hiddencheckarray + (!hiddencheckarray ? '' : ',') + id;
            $('#hiddencheckarray').val(updatedvalue);
            console.log(updatedvalue);
            var array = updatedvalue.split(',');
            $('#questionupdatingnumber').text('প্রশ্ন সংখ্যাঃ ' + array.length);
        } else {
            var hiddencheckarray = $('#hiddencheckarray').val();
            var uncheckedarray = hiddencheckarray.split(',');
            var updatedarray = _.without(uncheckedarray, id.toString());
            // console.log(updatedarray);
            var newupdatedvalue = '';
            for(var i=0; i<updatedarray.length; i++) {
                newupdatedvalue = newupdatedvalue + (!newupdatedvalue ? '' : ',') + updatedarray[i];
            };
            $('#hiddencheckarray').val(newupdatedvalue);
            console.log(newupdatedvalue);
            $('#questionupdatingnumber').text('প্রশ্ন সংখ্যাঃ ' + updatedarray.length);
        }
    }
    
    
  </script>

@endsection
@extends('layouts.app')
@section('title') ড্যাশবোর্ড | পরীক্ষা | {{ $exam->name }}@endsection

@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker.min.css') }}">

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/jquery-for-dp.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
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
                          <button type="button" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#addTopicModal">
                              <i class="fas fa-plus-circle"></i> নতুন প্রশ্ন যোগ করুন
                          </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table">
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
                          <button type="button" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#addTopicModal">
                              <i class="fas fa-plus-circle"></i> প্রশ্ন প্রণয়ন
                          </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      
                    </div>
                    <!-- /.card-body -->
                  </div>   
            </div>
        </div>
    </div>
@endsection

@section('third_party_scripts')
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

{{-- <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $("[rel='tooltip']").tooltip();
    });
    $("#available_from").datepicker({
      format: 'MM dd, yyyy',
      todayHighlight: true,
      autoclose: true,
      container:'#addExamModal',
    });
    $("#available_to").datepicker({
      format: 'MM dd, yyyy',
      todayHighlight: true,
      autoclose: true,
      container:'#addExamModal',
    });
    // ClassicEditor
    //     .create( document.querySelector( '.summernote' ) )
    //     .then( editor => {
    //             console.log( editor );
    //     } )
    //     .catch( error => {
    //             console.error( error );
    //     } );
</script>
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
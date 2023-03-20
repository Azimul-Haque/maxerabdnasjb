@extends('layouts.app')
@section('title') ড্যাশবোর্ড | পরীক্ষা | {{ $exam->name }} @endsection

@section('third_party_stylesheets')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('css/select2-bootstrap4.min.css') }}" rel="stylesheet" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/select2.full.min.js') }}"></script>
<style type="text/css">
  .select2-selection__choice{
      background-color: rgba(0, 123, 255) !important;
  }
</style>
@endsection

@section('content')
    @section('page-header') {{ $exam->name }} / প্রশ্নব্যাংক থেকে বাছাই করুন @endsection
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">প্রশ্নব্যাংক (মোটঃ {{ $totalquestions }})</h3>
          
                      <div class="card-tools">
                          <form class="form-inline form-group-lg" action="">
                            <div class="form-group">
                              <input type="search-param" class="form-control form-control-sm" placeholder="প্রশ্ন খুঁজুন" id="search-param" required>
                            </div>
                            <button type="button" id="search-button" class="btn btn-default btn-sm" style="margin-left: 5px;">
                              <i class="fas fa-search"></i> খুঁজুন
                            </button>
                          </form>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>Question</th>
                                  <th>Answer</th>
                                  <th width="25%">Options</th>
                              </tr>
                          </thead>
                          <tbody>
                          @foreach($questions as $question)
                              <tr>
                                  <td>
                                      {{ $question->question }}<br/>
                                      <span class="badge bg-success">{{ $question->topic->name }}</span>
                                      <span class="badge bg-info">{{ $question->difficulty == 1 ? 'সহজ' : ($question->difficulty == 2 ? 'মধ্যম' : 'কঠিন') }}</span>
                                      @foreach($question->tags as $tag)
                                        <span class="badge bg-primary">{{ $tag->name }}</span>
                                      @endforeach
                                  </td>
                                  <td>{{ $question->answer }}</td>
                                  <td>{{ $question->option1 }}, {{ $question->option2 }}, {{ $question->option3 }}, {{ $question->option4 }}</td>
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
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>Topic</th>
                              </tr>
                          </thead>
                          <tbody>
                          @foreach($topics as $topic)
                              <tr>
                                  <td>
                                    <a href="{{ route('dashboard.exams.add.question.topic', [$exam->id, $topic->id]) }}">
                                      {{ $topic->name }} <small>({{ $topic->questions->count() }} টি প্রশ্ন)</small>
                                      <span class="badge bg-primary"><i class="fas fa-bolt"></i> {{ $topic->participation }}</span>
                                    </a>
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
@endsection

@section('third_party_scripts')
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $('.multiple-select').select2({
      // theme: 'bootstrap4',
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
      $(document).on('click', '#search-button', function() {
        if($('#search-param').val() != '') {
          var urltocall = '{{ route('dashboard.questions') }}' +  '/' + $('#search-param').val();
          location.href= urltocall;
        } else {
          $('#search-param').css({ "border": '#FF0000 2px solid'});
          Toast.fire({
              icon: 'warning',
              title: 'কিছু লিখে খুঁজুন!'
          })
        }
      });
      $("#search-param").keyup(function(e) {
        if(e.which == 13) {
          if($('#search-param').val() != '') {
            var urltocall = '{{ route('dashboard.questions') }}' +  '/' + $('#search-param').val();
            location.href= urltocall;
          } else {
            $('#search-param').css({ "border": '#FF0000 2px solid'});
            Toast.fire({
                icon: 'warning',
                title: 'কিছু লিখে খুঁজুন!'
            })
          }
        }
      });
    });
</script>
@endsection
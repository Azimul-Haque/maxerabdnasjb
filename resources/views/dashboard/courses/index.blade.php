@extends('layouts.app')
@section('title') ড্যাশবোর্ড | কোর্সসমূহ @endsection

@section('third_party_stylesheets')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection

@section('content')
    @section('page-header') কোর্সসমূহ @endsection
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">কোর্সসমূহ (মোটঃ {{ $totalcourses }})</h3>
          
                      <div class="card-tools">
                          <button type="button" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#addCourseModal">
                              <i class="fas fa-plus-circle"></i> নতুন কোর্স যোগ
                          </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>Course</th>
                                  <th>Status</th>
                                  <th>Exams</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                          @foreach($courses as $course)
                              <tr>
                                  <td>
                                      {{ $course->name }}
                                  </td>
                                  <td>@if($course->status == 1) <span class="badge badge-primary">Active</span> @endif</td>
                                  <td>
                                    মোট পরীক্ষাঃ @if($course->courseexams->count() > 0) 222 @else 444 @endif
                                  </td>
                                  <td>
                                    <a href="{{ route('dashboard.courses.add.exam', $course->id) }}" class="btn btn-warning btn-sm" rel="tooltip" title="পরীক্ষা যোগ করুন">
                                        <i class="fas fa-folder-plus"></i>
                                    </a>
                                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editCourseModal{{ $course->id }}">
                                          <i class="far fa-edit"></i>
                                      </button>
                                      {{-- Edit Course Modal Code --}}
                                      {{-- Edit Course Modal Code --}}
                                      <!-- Modal -->
                                      <div class="modal fade" id="editCourseModal{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="editCourseModalLabel" aria-hidden="true" data-backdrop="static">
                                          <div class="modal-dialog modal-lg" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header bg-success">
                                                <h5 class="modal-title" id="editCourseModalLabel">কোর্স হালনাগাদ</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <form method="post" action="{{ route('dashboard.courses.update', $course->id) }}" enctype='multipart/form-data'>
                                                <div class="modal-body">
                                                      @csrf
                                                      <div class="input-group mb-3">
                                                          <input type="text" name="name" class="form-control" value="{{ $course->name }}" placeholder="কোর্সের নাম" required>
                                                          <div class="input-group-append">
                                                              <div class="input-group-text"><span class="fas fa-layer-group"></span></div>
                                                          </div>
                                                      </div>
                                                      <div class="input-group mb-3">
                                                        <select name="status" class="form-control" required>
                                                            <option selected="" disabled="" value="">স্ট্যাটাস</option>
                                                            <option value="1" @if($course->status == 1) selected @endif>Active</option>
                                                            <option value="0" @if($course->status == 0) selected @endif>In-active</option>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text"><span class="fas fa-star-half-alt"></span></div>
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
                                        {{-- Edit Course Modal Code --}}
                                        {{-- Edit Course Modal Code --}}
        
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCourseModal{{ $course->id }}">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                  </td>
                                  {{-- Delete Course Modal Code --}}
                                  {{-- Delete Course Modal Code --}}
                                  <!-- Modal -->
                                  <div class="modal fade" id="deleteCourseModal{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCourseModalLabel" aria-hidden="true" data-backdrop="static">
                                      <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header bg-danger">
                                          <h5 class="modal-title" id="deleteCourseModalLabel">কোর্স ডিলেট</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                          </div>
                                          <div class="modal-body">
                                            আপনি কি নিশ্চিতভাবে এই কোর্সটি ডিলেট করতে চান?<br/><br/>
                                            <center>
                                                <big><b>{{ $course->name }}</b></big>
                                            </center>
                                          </div>
                                          <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                                          <a href="{{ route('dashboard.courses.delete', $course->id) }}" class="btn btn-danger">ডিলেট করুন</a>
                                          </div>
                                      </div>
                                      </div>
                                  </div>
                                  {{-- Delete Course Modal Code --}}
                                  {{-- Delete Course Modal Code --}}
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  {{ $courses->links() }}
            </div>
        </div>

    {{-- Add Course Modal Code --}}
    {{-- Add Course Modal Code --}}
    <!-- Modal -->
    <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header bg-success">
            <h5 class="modal-title" id="addCourseModalLabel">নতুন কোর্স যোগ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{ route('dashboard.courses.store') }}" enctype='multipart/form-data'>
              <div class="modal-body">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="কোর্সের নাম" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-layer-group"></span></div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select name="status" class="form-control" required>
                            <option selected="" disabled="" value="">স্ট্যাটাস</option>
                            <option value="1">Active</option>
                            <option value="0">In-active</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-star-half-alt"></span></div>
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
    {{-- Add Course Modal Code --}}
    {{-- Add Course Modal Code --}}
@endsection

@section('third_party_scripts')
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
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
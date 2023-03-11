@extends('layouts.app')
@section('title') ড্যাশবোর্ড | লেকচার ম্যাটেরিয়ালস @endsection

@section('third_party_stylesheets')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('css/select2-bootstrap4.min.css') }}" rel="stylesheet" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/select2.full.min.js') }}"></script>
<style type="text/css">
  .select2-selection__choice{
      background-color: rgba(0, 123, 255) !important;
  }
  /*.cke_dialog
  {
      z-index: 10055 !important;
  }*/
  .ck.ck-balloon-panel {
          z-index: 1050 !important;
      }
  .ck-editor__editable_inline {
      min-height: 400px;
  }
</style>

{{-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" /> --}}
@endsection

@section('content')
    @section('page-header') লেকচার ম্যাটেরিয়ালস @endsection
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">লেকচার ম্যাটেরিয়ালস (মোটঃ {{ $totalmaterials }})</h3>
          
                      <div class="card-tools">
                          <button type="button" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#addMaterialModal">
                              <i class="fas fa-plus-circle"></i> নতুন ম্যাটেরিয়াল যোগ
                          </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>Title</th>
                                  <th>Author</th>
                                  <th>Type</th>
                                  <th width="10%">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                          @foreach($materials as $material)
                              <tr>
                                  <td>
                                      {{ $material->question }}<br/>
                                      <span class="badge bg-success">{{ $material->topic->name }}</span>
                                      <span class="badge bg-info">{{ $material->difficulty == 1 ? 'সহজ' : ($material->difficulty == 2 ? 'মধ্যম' : 'কঠিন') }}</span>
                                      
                                  </td>
                                  <td>{{ $material->answer }}</td>
                                  <td>{{ $material->option1 }}, {{ $material->option2 }}, {{ $material->option3 }}, {{ $material->option4 }}</td>
                                  {{-- <td>
                                      <div class="progress progress-xs">
                                          <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                      </div>
                                  </td> --}}
                              
                                  <td>
                                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editMaterialModal{{ $material->id }}">
                                          <i class="far fa-edit"></i>
                                      </button>
                                      {{-- Edit Material Modal Code --}}
                                      {{-- Edit Material Modal Code --}}
                                      <!-- Modal -->
                                      <div class="modal fade" id="editMaterialModal{{ $material->id }}" tabindex="-1" role="dialog" aria-labelledby="editMaterialModalLabel" aria-hidden="true" data-backdrop="static">
                                          <div class="modal-dialog modal-lg" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header bg-success">
                                                <h5 class="modal-title" id="editMaterialModalLabel">ম্যাটেরিয়াল হালনাগাদ</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <form method="post" action="{{ route('dashboard.materials.update', $material->id) }}" enctype='multipart/form-data'>
                                                <div class="modal-body">
                                                      @csrf
                                                      <div class="input-group mb-3">
                                                          <input type="text" name="question" class="form-control" value="{{ $material->question }}" placeholder="ম্যাটেরিয়াল" required>
                                                          <div class="input-group-append">
                                                              <div class="input-group-text"><span class="far fa-question-circle"></span></div>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-md-6">
                                                              <input type="text" name="option1" value="{{ $material->option1 }}" class="form-control mb-3" placeholder="অপশন ১" required>
                                                          </div>
                                                          <div class="col-md-6">
                                                              <input type="text" name="option2" value="{{ $material->option2 }}" class="form-control mb-3" placeholder="অপশন ২" required>
                                                          </div>
                                                          <div class="col-md-6">
                                                              <input type="text" name="option3" value="{{ $material->option3 }}" class="form-control mb-3" placeholder="অপশন ৩" required>
                                                          </div>
                                                          <div class="col-md-6">
                                                              <input type="text" name="option4" value="{{ $material->option4 }}" class="form-control mb-3" placeholder="অপশন ৪" required>
                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                        <div class="col-md-6">
                                                          <div class="input-group mb-3">
                                                              <select name="answer" class="form-control" required>
                                                                  <option selected="" disabled="" value="">সঠিক উত্তর</option>
                                                                  <option value="1" @if($material->answer == 1) selected @endif>অপশন ১</option>
                                                                  <option value="2" @if($material->answer == 2) selected @endif>অপশন ২</option>
                                                                  <option value="3" @if($material->answer == 3) selected @endif>অপশন ৩</option>
                                                                  <option value="4" @if($material->answer == 4) selected @endif>অপশন ৪</option>
                                                              </select>
                                                              <div class="input-group-append">
                                                                  <div class="input-group-text"><span class="far fa-check-circle"></span></div>
                                                              </div>
                                                          </div>
                                                        </div>
                                                        
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-md-6">
                                                              <div class="input-group mb-3">
                                                                  <select name="difficulty" class="form-control" required>
                                                                      <option selected="" disabled="" value="">ডিফিকাল্টি লেভেল</option>
                                                                      <option value="1" @if($material->difficulty == 1) selected @endif>সহজ</option>
                                                                      <option value="2" @if($material->difficulty == 2) selected @endif>মধ্যম</option>
                                                                      <option value="3" @if($material->difficulty == 3) selected @endif>কঠিন</option>
                                                                  </select>
                                                                  <div class="input-group-append">
                                                                      <div class="input-group-text"><span class="fas fa-star-half-alt"></span></div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div class="col-md-6">
                                                              <label for="explanation">ব্যাখ্যা (প্রয়োজনে)</label><br/>
                                                              <textarea class="form-control summernote" name="explanation" id="explanation" placeholder="ব্যাখ্যা" style="width: 100%; height: 220px;">{{ $material->questionexplanation ? $material->questionexplanation->explanation : '' }}</textarea>
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
                                      {{-- Edit Material Modal Code --}}
                                      {{-- Edit Material Modal Code --}}
          
                                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteMaterialModal{{ $material->id }}" disabled>
                                          <i class="far fa-trash-alt"></i>
                                      </button>
                                  </td>
                                  {{-- Delete Material Modal Code --}}
                                  {{-- Delete Material Modal Code --}}
                                  <!-- Modal -->
                                  <div class="modal fade" id="deleteMaterialModal{{ $material->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteMaterialModalLabel" aria-hidden="true" data-backdrop="static">
                                      <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header bg-danger">
                                          <h5 class="modal-title" id="deleteMaterialModalLabel">ম্যাটেরিয়াল ডিলেট</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                          </div>
                                          <div class="modal-body">
                                            আপনি কি নিশ্চিতভাবে এই ম্যাটেরিয়ালটি ডিলেট করতে চান?<br/><br/>
                                            <center>
                                                <big><b>{{ $material->title }}</b></big>
                                            </center>
                                          </div>
                                          <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                                          <a href="{{ route('dashboard.materials.delete', $material->id) }}" class="btn btn-danger">ডিলেট করুন</a>
                                          </div>
                                      </div>
                                      </div>
                                  </div>
                                  {{-- Delete Material Modal Code --}}
                                  {{-- Delete Material Modal Code --}}
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  {{ $materials->links() }}
            </div>
        </div>

    {{-- Add Question Modal Code --}}
    {{-- Add Question Modal Code --}}
    <!-- Modal -->
    <div class="modal fade" id="addMaterialModal" role="dialog" data-focus="false" aria-labelledby="addMaterialModalLabel" data-backdrop="static">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header bg-success">
            <h5 class="modal-title" id="addMaterialModalLabel">নতুন ম্যাটেরিয়াল যোগ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{ route('dashboard.materials.store') }}" enctype='multipart/form-data'>
              <div class="modal-body">
                    @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="ম্যাটেরিয়াল টাইটেল" required>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-question-circle"></span></div>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="input-group mb-3">
                            <select name="status" class="form-control" required>
                                <option selected="" disabled="" value="">স্ট্যাটাস</option>
                                <option value="0">ইন-একটিভ</option>
                                <option value="1" selected>একটিভ</option>
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-file-alt"></span></div>
                            </div>
                        </div>    
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="text" name="author" class="form-control" value="{{ old('author') }}" placeholder="লেখক" required>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-user"></span></div>
                            </div>
                        </div>    
                      </div>
                      <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="text" name="author_desc" class="form-control" value="{{ old('author_desc') }}" placeholder="লেখকের ডেসিগনেশন" required>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-user-tie"></span></div>
                            </div>
                        </div>    
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="input-group mb-3">
                            <select name="type" class="form-control" required>
                                <option selected="" disabled="" value="">ধরন বাছাই করুন</option>
                                <option value="1">শুধু আর্টিকেল</option>
                                <option value="2">ভিডিও</option>
                                <option value="3">অডিও</option>
                                <option value="4">পিডিএফ</option>
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-file-alt"></span></div>
                            </div>
                        </div>    
                      </div>
                      <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="text" name="url" class="form-control" value="{{ old('url') }}" placeholder="ইউআরএর (যদি থাকে)">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-link"></span></div>
                            </div>
                        </div>    
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                          {{-- <div class="ckeditor"></div> --}}
                          <textarea class="ckeditor" name="content"></textarea>
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
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script> --}}

{{-- <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="https://cdn.ckeditor.com/ckeditor5/12.3.1/classic/ckeditor.js"></script>
{{-- <script type="text/javascript" src="cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    // $('.multiple-select').select2({
    //   // theme: 'bootstrap4',
    // });
    ClassicEditor
        .create( document.querySelector( '.ckeditor' ), {
          placeholder: 'কন্টেন্ট লিখুন...',
        } )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );
</script>
<script type="text/javascript">
  // $(document).ready(function() {
  //   $('#summernote').summernote();
  // });

  // $('#myModal').on('shown.bs.modal', function() {
  //   $('#summernote').summernote();
  // })

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
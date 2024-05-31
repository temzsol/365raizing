@extends('layouts.masteradmin')
@section('body')
<div class="page-content">
<div class="row">
    <div class="col-12">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div class="card">
            <div class="card-body">
                @if(isset($job))
                <form method="post" enctype="multipart/form-data" action="{{url('admin/jobs/'.$job->id)}}">
                    @method('PUT')
                @else
                <form method="post" action="{{url('admin/jobs')}}" enctype="multipart/form-data" id="form-validation">
                @endif
                @csrf
                <h4 class="card-title">{{$page_title}}</h4>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">postion<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($job)?$job->postion:''}}" id="postion" name="postion">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-password-input" class="col-md-2 col-form-label">Description<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <textarea class="form-control summernote" name="profiledescription">{{isset($job)?$job->profiledescription:''}}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-search-input" class="col-md-2 col-form-label">Experience<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($job)?$job->experience:''}}" id="disignation" name="experience">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-search-input" class="col-md-2 col-form-label">Industry Type<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($job)?$job->industry_type:''}}" id="industry_type" name="industry_type">
                    </div>
                </div>
               
                
                
                <div class="mb-3 row">
                    <label for="example-password-input" class="col-md-2 col-form-label">Vaccancy<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($job)?$job->vaccancy:''}}" id="vaccancy" name="vaccancy">
                    </div>
                </div>
               
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">Status</label>
                    <div class="col-md-10">
                        <select class="form-select" name="status">
                            <option @if(isset($job) && $job->status=='1') selected="selected" @endif value="1">Active</option>
                            <option @if(isset($job) && $job->status=='0') selected="selected" @endif value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label"></label>
                    <div class="col-md-10">
                       <button type="submit" class="btn btn-primary" >Submit</button>
                        <a href="{{url('/admin/dashboard')}}" type="submit"class="btn btn-success">Home</a>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
</div>

@endsection

@push('footer-section-code')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $('.summernote').summernote({
      placeholder: 'Hello stand alone ui',
      tabsize: 2,
      height: 120,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });
  </script>
  
<script>
    var id = $('#gid').val();
    if(id!='' && id!= null)
    {
        $('#image_upload').hide();
    }
    else{

        $('#image_upload').show();
    }

function hideimage(){
    $('#image_upload').show();
    $('#image_hide').hide();
}
    </script>




<script>
    $("#form-validation").validate({
            rules:{
                postion:{
                    required: true,
                    maxlength: 255
                },
                profiledescription:{
                    required: true,
                    minlength: 100
                },
                
                experience:{
                    required:true
                },
                industry_type:{
                    required:true
                },
                vaccancy:{
                    required:true
                }

            },
            postion:{
                project_name:{
                    required:"Please Enter Position",
                    maxlength:"Text not morethen 255"
                },
                profiledescription:{
                    required:"Please Enter Description"
                },
               
                experience:{
                    required:"Please Enter Experience"
                },
                industry_type:{
                    required:"Please Add Project Details"
                },
                vaccancy:{
                    required:"Please Add Project Details"
                    
                }

            }   
        });
    </script>

@endpush


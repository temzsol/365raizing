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
                @if(isset($portfolio))
                <form method="post" enctype="multipart/form-data" action="{{url('admin/portfolios/'.$portfolio->id)}}" id="validation">
                    @method('PUT')
                @else
                <form method="post" action="{{url('admin/portfolios')}}" enctype="multipart/form-data" id="form-validation">
                @endif
                @csrf
                <h4 class="card-title">{{$page_title}}</h4>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">Project Name<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($portfolio)?$portfolio->project_name:''}}" id="project_name" name="project_name">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-search-input" class="col-md-2 col-form-label">Slug</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($portfolio)?$portfolio->slug:''}}" id="disignation" name="slug">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-search-input" class="col-md-2 col-form-label">Category</label>
                    <div class="col-md-10">
                        @php
                        $categories=array('HTML','Wordpress','Php','Laravel')
                         @endphp
                        <select class="form-control" name="categories">
                            <option>Select Category</option>
                            @foreach($categories as $value)
                            <option value="{{$value}}"@if(isset($portfolio) && $portfolio->categories==$value) {{'selected'}} @endif>{{$value}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="example-email-input" class="col-md-2 col-form-label">Image <br/><span class="text-danger">Size: 594 X 410 px</span></label>
                    @if(isset($portfolio))
                    <div class="col-md-10" id="image_hide">
                        <input type="hidden" value="{{isset($portfolio)?$portfolio->id:''}}" id="gid">
                        <img src="{{url('/images/portfolios/'.$portfolio->image)}}" alt="{{isset($portfolio)?$portfolio->project_name:''}}" style="height: 100px;"> <i class="bx bx-window-close text-danger" onClick="hideimage()"></i>
                    </div>
                    @endif
                    <div class="col-md-10" id="image_upload">
                        <input class="form-control" type="file"id="image" name="image">
                    </div>
                </div>
                 <div class="mb-3 row">
                    <label for="example-email-input" class="col-md-2 col-form-label">Banner Image <br/><span class="text-danger">Size: 1349 X 326px </span></label>
                    @if(isset($portfolio))
                    <div class="col-md-10" id="bannerimage_hide">
                        <input type="hidden" value="{{isset($portfolio)?$portfolio->id:''}}" id="bid">
                        <img src="{{url('/images/portfolios/'.$portfolio->banner_image)}}" alt="{{isset($portfolio)?$portfolio->project_name:''}}" style="height: 100px;"> <i class="bx bx-window-close text-danger" onClick="bannerimage()"></i>
                    </div>
                    @endif
                    <div class="col-md-10" id="bannerimage_upload">
                        <input class="form-control" type="file"id="bannerimage" name="banner_image">
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="example-password-input" class="col-md-2 col-form-label">Project Info<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <textarea class="form-control summernote" name="project_info">{{isset($portfolio)?$portfolio->project_info:''}}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-password-input" class="col-md-2 col-form-label">Project Details<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <textarea class="form-control summernote" name="project_details">{{isset($portfolio)?$portfolio->project_details:''}}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-search-input" class="col-md-2 col-form-label">Meta Title</label>
                    <div class="col-md-5" >
                        <input class="form-control" type="text" findindex='1' value="{{isset($portfolio)?$portfolio->meta_title:''}}" id="meta_title-0" name="meta_title"><br>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-password-input" class="col-md-2 col-form-label">Meta Keywords</label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="meta_keywords">{{isset($portfolio)?$portfolio->meta_keywords:''}}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-password-input" class="col-md-2 col-form-label">Meta Description</label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="meta_description">{{isset($portfolio)?$portfolio->meta_description:''}}</textarea>
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">Use Langauage</label>
                    <div class="col-md-10">
                        @if(isset($portfolio))
                        <?php $setlang=explode('|',$portfolio->language_id); ?>
                        @endif
                        @foreach ($languages as $value)
                        <input type="checkbox" value="{{$value->id}}" name="language_id[]" @if(isset($portfolio) && in_array($value->id,$setlang)) {{'checked'}} @endif> {{$value->name}}
                        @endforeach
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">Fetured</label>
                    <div class="col-md-10">
                        <select class="form-select" name="fetured">
                            <option @if(isset($portfolio) && $portfolio->fetured=='1') selected="selected" @endif value="1">Show</option>
                            <option @if(isset($portfolio) && $portfolio->fetured=='0') selected="selected" @endif value="0">Hide</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">Status</label>
                    <div class="col-md-10">
                        <select class="form-select" name="status">
                            <option @if(isset($portfolio) && $portfolio->status=='1') selected="selected" @endif value="1">Active</option>
                            <option @if(isset($portfolio) && $portfolio->status=='0') selected="selected" @endif value="0">Inactive</option>
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

<!--For Banner Image-->
<script>
    var id = $('#bid').val();
    if(id!='' && id!= null)
    {
        $('#bannerimage_upload').hide();
    }
    else{

        $('#bannerimage_upload').show();
    }

function bannerimage(){
    $('#bannerimage_upload').show();
    $('#bannerimage_hide').hide();
}
    </script>




<script>
    $("#form-validation").validate({
            rules:{
                project_name:{
                    required: true,
                    maxlength: 255
                },
                
                
                project_info:{
                    required:true,
                    minlength:255
                }
                project_details:{
                    required:true,
                    minlength:255
                }

            },
            message:{
                project_name:{
                    required:"Please Enter project name",
                    maxlength:"Text not morethen 50"
                },
                
               
                project_info:{
                    required:"Please Add Project Info",
                    maxlength:"Text Minimum 255"
                },
                project_details:{
                    required:"Please Add Project Details",
                    maxlength:"Text Minimum 255"
                }
            }   
        });
    </script>

@endpush


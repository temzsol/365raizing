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
                @if(isset($contents))
                <form method="post" enctype="multipart/form-data" action="{{url('admin/contents/'.$contents->id)}}" id="validation">
                    @method('PUT')
                @else
                <form method="post" action="{{url('admin/contents')}}" enctype="multipart/form-data" id="form-validation">
                @endif
                @csrf
                <h4 class="card-title">{{$page_title}}</h4>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">Page Name<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($contents)?$contents->page_name:''}}" id="page_name" name="page_name">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-search-input" class="col-md-2 col-form-label">Title<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($contents)?$contents->title:''}}" id="title" name="title">
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="example-search-input" class="col-md-2 col-form-label">Short Description</label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="short_description">{{isset($contents)?$contents->short_description:''}}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-search-input" class="col-md-2 col-form-label">Long Description</label>
                    <div class="col-md-10">
                        <textarea class="form-control summernote" name="long_description">{{isset($contents)?$contents->long_description:''}}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-email-input" class="col-md-2 col-form-label">Image<br/><span class="text-danger">As Per Running Image</span></label>
                    @if(isset($contents) && $contents->image!="")
                    <div class="col-md-10" id="image_hide">
                        <input type="hidden" value="{{isset($contents)?$contents->id:''}}" id="gid">
                        <img src="{{url('/images/pages/'.$contents->image)}}" alt="{{isset($contents)?$contents->page_name:''}}" style="height: 100px;"> <i class="bx bx-window-close text-danger" onClick="hideimage()"></i>
                    </div>
                    @endif
                    <div class="col-md-10" id="image_upload">
                        <input class="form-control" type="file"id="image" name="image">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-search-input" class="col-md-2 col-form-label">Image Alt Name</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text"id="image_alt_name" name="image_alt_name" placeholder="Alt Name"value="{{isset($contents)?$contents->image_alt_name:''}}">
                    </div>
                </div>
                
               
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">Status</label>
                    <div class="col-md-5">
                        <select class="form-select" name="status">
                            <option @if(isset($contents) && $contents->status=='1') selected="selected" @endif value="1">Active</option>
                            <option @if(isset($contents) && $contents->status=='0') selected="selected" @endif value="0">Inactive</option>
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
                page_name:{
                    required: true,
                    maxlength: 50
                },
                title:{
                    required: true,
                    maxlength: 255
                }
               

            },
            message:{
                page_name:{
                    required:"Please Enter Page name",
                    maxlength:"Text not morethen 50"
                },
                title:{
                    required:" Please Enter Title",
                    maxlength:"Text not morethen 255"
                }
               
            }   
        });
    </script>

@endpush


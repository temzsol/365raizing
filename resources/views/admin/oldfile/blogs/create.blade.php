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
                @if(isset($blog))
                <form method="post" enctype="multipart/form-data" action="{{url('admin/blogs/'.$blog->id)}}" id="validation">
                    @method('PUT')
                @else
                <form method="post" action="{{url('admin/blogs')}}" enctype="multipart/form-data" id="form-validation">
                @endif
                @csrf
                <h4 class="card-title">{{$page_title}}</h4>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">Title<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($blog)?$blog->title:''}}" id="title" name="title">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-search-input" class="col-md-2 col-form-label">Slug</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($blog)?$blog->slug:''}}" id="disignation" name="slug">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-search-input" class="col-md-2 col-form-label">Blog Category</label>
                    <div class="col-md-10">
                        <select class="form-control" name="cat_id">
                            <option>Select Category</option>
                            @foreach($cat as $value)
                            <option value="{{$value->id}}"@if(isset($blog) && $blog->cat_id==$value->id) {{'selected'}} @endif>{{$value->name}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-search-input" class="col-md-2 col-form-label">Written By<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($blog)?$blog->written_by:Auth::user()->name}}" id="disignation" name="written_by">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-email-input" class="col-md-2 col-form-label">Image<br/><span class="text-danger"> Size: 736 x 400 px </span></label>
                    @if(isset($blog))
                    <div class="col-md-10" id="image_hide">
                        <input type="hidden" value="{{isset($blog)?$blog->id:''}}" id="gid">
                        <img src="{{url('/images/blogs/'.$blog->image)}}" style="height: 100px;" alt="{{isset($blog)?$blog->title:''}}"> <i class="bx bx-window-close text-danger" onClick="hideimage()"></i>
                    </div>
                    @endif
                    <div class="col-md-10" id="image_upload">
                        <input class="form-control" type="file"id="image" name="image">
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="example-password-input" class="col-md-2 col-form-label">Description<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="description"id="summernote">{{isset($blog)?$blog->description:''}}</textarea>
                    </div>
                </div>
                
                
                @if(isset($blog))
                    <span class="repet_section_edit">
                        @foreach($tags as $key=>$value)
                        <div class="mb-3 row repet_section_row">
                            <label for="example-search-input" class="col-md-2 col-form-label">Tags</label>
                             <div class="col-md-5" >
                                 <input class="form-control" type="text" findindex="{{$key}}" value="{{isset($blog)?$value['name']:''}}" id="tags-{{$key}}" name="tags[]"><br>
                             </div>
                             <div class="col-md-5" >
                                 <button class="btn btn-danger remove" type="button">Remove</button>
                             </div>
                         </div>
                         @endforeach
                    </span>
                @else
                <div class="mb-3 row">
                    <label for="example-search-input" class="col-md-2 col-form-label">Tags</label>
                    <div class="col-md-5" >
                        <input class="form-control" type="text" findindex='1' value="{{isset($blog)?$blog->tags:''}}" id="tags-0" name="tags[]"><br>
                    </div>
                </div>
                @endif

                {{-- for append section --}}
                <span class="repet_section"></span>
                <div class="mb-3 row repet_section_row">
                    <label for="example-search-input" class="col-md-2 col-form-label">Tags</label>
                     <div class="col-md-5" >
                         <button onClick="addtags()" class="btn btn-warning" type="button">Add More</button>
                     </div>
                 </div>
                {{-- for appent section End --}}
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">Status</label>
                    <div class="col-md-10">
                        <select class="form-select" name="status">
                            <option @if(isset($blog) && $blog->status=='1') selected="selected" @endif value="1">Active</option>
                            <option @if(isset($blog) && $blog->status=='0') selected="selected" @endif value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="meta_keywords-0" class="col-md-2 col-form-label">Meta Title<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <textarea class="form-control" id="meta_title-0" name="meta_title"required placeholder="Enter Meta Keywords">{{isset($blog)?$blog->meta_title:''}}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="meta_keywords-0" class="col-md-2 col-form-label">Meta Keywords<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <textarea class="form-control" id="meta_keywords-0" name="meta_keywords"required placeholder="Enter Meta Keywords">{{isset($blog)?$blog->meta_keywords:''}}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="meta_description-0" class="col-md-2 col-form-label">Meta Description<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <textarea class="form-control" id="meta_description-0" name="meta_description"required placeholder="Enter Meta Description">{{isset($blog)?$blog->meta_description:''}}</textarea>
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
    $('#summernote').summernote({
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
                title:{
                    required: true,
                    maxlength: 255
                },
                written_by:{
                    required: true,
                    maxlength: 255
                },
                
                description:{
                    required:true,
                    minlength:255
                }

            },
            message:{
                title:{
                    required:"Please Enter title Name",
                    maxlength:"Text not morethen 50"
                },
                written_by:{
                    required:" Please Enter Writter Name",
                    maxlength:"Text not morethen 20"
                },
               
                description:{
                    required:"Please Add Description",
                    maxlength:"Text Minimum 255"
                }
            }   
        });



    function addtags(){
        var index_value=$('#tags-0').attr('findindex');
        index_value=parseInt(index_value)+1;

        var append_section ='<div class="mb-3 row repet_section_row">';
                       append_section +='<label for="example-search-input" class="col-md-2 col-form-label"></label>';
                        append_section +='<div class="col-md-5" >';
                            append_section +='<input class="form-control" type="text" findindex="'+index_value+'" id="tags-'+index_value+'" name="tags[]"><br>';
                        append_section +='</div>';
                        append_section +='<div class="col-md-5" >';
                            append_section +='<button class="btn btn-danger remove" type="button">Remove</button>';
                        append_section +='</div>';
                        append_section +='</div>';
                         $('.repet_section').append(append_section);
                     }
        $(document).on('click','.remove', function(){
        $(this).parents('.repet_section_row').remove();
        });
    </script>

@endpush


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
        @if(isset($page))
        <form method="post" enctype="multipart/form-data" action="{{url('admin/pages/'.$page->id)}}" id="validation">
            @method('PUT')
        @else
        <form method="post" action="{{url('admin/pages')}}" enctype="multipart/form-data" id="form-validation">
        @endif
        @csrf
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">{{$page_title}}</h4>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Page Name<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{isset($page)?$page->page_title:''}}" placeholder="Enter Page Title" id="title" name="page_title" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Page Slug</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{isset($page)?$page->slug:''}}" id="slug" name="slug" placeholder="Enter Slug">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Select Category</label>
                        <div class="col-md-10">
                            <select name="cat_id" class="form-control">
                            @foreach($category as $value)
                            <option value="{{$value->id}}" @if(isset($page) && $page->cat_id==$value->id) {{'selected'}} @endif>{{$value->name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-password-input" class="col-md-2 col-form-label">Short Description<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="short_desc"id="summernote2" placeholder="Short Description" required>{{isset($page)?$page->short_desc:''}}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row" id="image_short_1">
                        <label for="image_short-0" class="col-md-2 col-form-label">Short Image<span>Size: 70 X 70 Px</span> </label>
                        @if(isset($page) && $page->image_short!='' && $page->image_short!= null)
                        <div class="col-md-10" id="short_image_show">
                            <input type="hidden" value="{{isset($page)?$page->id:''}}" id="image_short_id">
                            <img src="{{url('images/pages/'.$page->image_short)}}" alt="{{isset($page)?$page->page_title:''}}" style="height:100px;"><i class="bx bx-window-close text-danger" onclick="short_image()"></i>
                        </div>
                        @endif
                        <div class="col-md-10"id="short_image_upload">
                            <input class="form-control" type="file" name="image_short"  id="image_short-0">
                        </div>
                    </div>
                   
                   
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Banner Title<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{isset($page)?$page->banner_title:''}}" id="banner_title" name="banner_title"required placeholder="Banner Title">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-password-input" class="col-md-2 col-form-label">Banner Description</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="banner_description" placeholder="Banner Description" required>{{isset($page)?$page->banner_description:''}}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-email-input" class="col-md-2 col-form-label">Banner Image<span class="text-danger">*</span></label>
                        @if(isset($page) && $page->banner_image!='' && $page->banner_image!= null)
                        <div class="col-md-10" id="banner_image_hide">
                            <input type="hidden" value="{{isset($page)?$page->id:''}}" id="banner_id">
                            <img src="{{url('/images/banners/'.$page->banner_image)}}" alt="{{isset($page)?$page->page_title:''}}" style="height: 100px;"> <i class="bx bx-window-close text-danger" onClick="hidebannerimage()"></i>
                        </div>
                        @endif
                        <div class="col-md-10" id="banner_image_upload">
                            <input class="form-control" type="file"id="image" name="banner_image">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-search-input" class="col-md-2 col-form-label">Alt Name of banner Image</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{isset($page)?$page->banner_alt_name:''}}" id="banner_alt_name" placeholder="Alt Name of image" name="banner_alt_name" >
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-search-input" class="col-md-2 col-form-label">Secondary Page Title<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{isset($page)?$page->second_page_title:''}}" id="second_page_title" placeholder="Secondary Page Title" name="second_page_title" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-password-input" class="col-md-2 col-form-label">Secondary Description<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="second_description"id="summernote" placeholder="Long Description" required>{{isset($page)?$page->second_description:''}}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-email-input" class="col-md-2 col-form-label">Image</label>
                        @if(isset($page) && $page->image!='' && $page->image!= null)
                        <div class="col-md-10" id="image_hide">
                            <input type="hidden" value="{{isset($page)?$page->id:''}}" id="gid">
                            <img src="{{url('/images/pages/'.$page->image)}}" alt="{{isset($page)?$page->page_title:''}}" style="height: 100px;"> <i class="bx bx-window-close text-danger" onClick="hideimage()"></i>
                        </div>
                        @endif
                        <div class="col-md-10" id="image_upload">
                            <input class="form-control" type="file"id="image" name="image">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-search-input" class="col-md-2 col-form-label">Alt Name of banner Image</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{isset($page)?$page->image_alt_name:''}}" id="image_alt_name" placeholder="Alt Name of image" name="image_alt_name" >
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="meta_title-0" class="col-md-2 col-form-label">Meta title<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="meta_title-0" name="meta_title"required placeholder="Enter Meta Title">{{isset($page)?$page->meta_title:''}}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="meta_keywords-0" class="col-md-2 col-form-label">Meta Keywords<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="meta_keywords-0" name="meta_keywords"required placeholder="Enter Meta Keywords">{{isset($page)?$page->meta_keywords:''}}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="meta_description-0" class="col-md-2 col-form-label">Meta Description<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="meta_description-0" name="meta_description"required placeholder="Enter Meta Description">{{isset($page)?$page->meta_description:''}}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label" for="status">Fetured Status</label>
                        <div class="col-md-10">
                            <select class="form-select" name="fetured_service">
                                <option @if(isset($page) && $page->fetured_service=='1') selected="selected" @endif value="1">Show</option>
                                <option @if(isset($page) && $page->fetured_service=='0') selected="selected" @endif value="0">Hide</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label" for="status">Status</label>
                        <div class="col-md-10">
                            <select class="form-select" name="status">
                                <option @if(isset($page) && $page->status=='1') selected="selected" @endif value="1">Active</option>
                                <option @if(isset($page) && $page->status=='0') selected="selected" @endif value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label"></label>
                        <div class="col-md-10">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                            <a href="{{url('/admin/pages')}}" type="submit"class="btn btn-success">Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div> <!-- end col -->
</div>
</div>

@endsection

@push('footer-section-code')
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
    $('#summernote2').summernote({
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
   // for image upload section
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

// Banner Image
    var bid = $('#banner_id').val();
    if(bid!='' && bid!= null)
    {
        $('#banner_image_upload').hide();
    }
    else{

        $('#banner_image_hide').show();
    }
function hidebannerimage(){
    $('#banner_image_upload').show();
    $('#banner_image_hide').hide();
}

//  For Short Image

var bid = $('#image_short_id').val();
    if(bid!='' && bid!= null)
    {
        $('#short_image_upload').hide();
    }
    else{

        $('#short_image_show').show();
    }
function short_image(){
    $('#short_image_upload').show();
    $('#short_image_show').hide();
}


    </script>
    {{--  For appending Section Faq --}}
<script>
    function add_faq(){
        var faqIndex= $('#input-faq-ques-0').attr('findex');
        faqIndex=parseInt(faqIndex)+1;
        $('#input-faq-ques-0').attr('findex',faqIndex);
        var faq= '<div class="faq append-style">';
            faq +='<div class="mb-3 row">';
                            faq +='<label for="input-faq-ques-'+faqIndex+'" class="col-md-2 col-form-label">Question<span class="text-danger">*</span></label>';
                            faq +='<div class="col-md-10">';
                                faq +='<input class="form-control" findex="'+faqIndex+'" type="text" value="" name="question[]" placeholder="Enter Question" id="input-faq-ques-'+faqIndex+'" required>';
                            faq +='</div>';
                        faq +='</div>';
                        faq +='<div class="mb-3 row">';
                            faq +='<label for="input-faq-ans-'+faqIndex+'" class="col-md-2 col-form-label">Answer<span class="text-danger">*</span></label>';
                            faq +='<div class="col-md-10">';
                                faq +='<input class="form-control" type="text" value="" name="answer[]" placeholder="Enter Answer" id="input-faq-ans-'+faqIndex+'" required>';
                            faq +='</div>';
                        faq +='</div> <button class="btn btn-danger remove"><i class="mdi mdi-close-circle-outline"></i></button>';
                    faq +='</div>';
        $('.append-faq').append(faq);
    }

    $(document).on('click', '.remove', function () {
        $(this).parents('.faq').remove();
    });
</script>
{{--  For appending Section Faq --}}
<script>
        $(document).ready(function(){
        jQuery("#form-validation").validate({
        errorElement:'row',
        rules: {
        // RULES //
        },
        messages: {
        // MESSAGES //
        }
         });
        });
        </script>


@endpush


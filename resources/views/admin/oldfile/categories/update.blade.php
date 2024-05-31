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
        
        <form method="post" enctype="multipart/form-data" action="{{url('admin/categories/'.$category->id)}}" id="validation">
            @method('PUT')
        
        @csrf
            <div class="card">
               
                <center><h2>{{$page_title}}<h2></center>
                         
                <div class="card-body">
                    <div class="faq">
                        <div class="mb-3 row">
                            <label for="question-0" class="col-md-2 col-form-label">Categories Name<span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" findex="1"  name="name" value="{{isset($category)?$category->name:''}}" placeholder="Enter Categories Name" id="name-0" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="question-0" class="col-md-2 col-form-label">Slug<span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" type="text"  name="slug" value="{{isset($category)?$category->slug:''}}" placeholder="Enter slug Name" id="name-0">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="answer-0" class="col-md-2 col-form-label">Category Image<span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" type="file"  name="image" placeholder="Categories Logo" id="image-0" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="answer-0" class="col-md-2 col-form-label">Image Code<span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" type="text"  name="image_code" value="{{isset($category)?$category->image_code:''}}" placeholder="image code" id="image-0" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="answer-0" class="col-md-2 col-form-label">Select Parent Category<span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <select class="form-control" name="parent_category">
                                    @foreach($pcategory as $value)
                                    <option value="0">Parent Category</option>
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                        <label for="meta_title-0" class="col-md-2 col-form-label">Meta title<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="meta_title-0" name="meta_title"required placeholder="Enter Meta Title">{{isset($category)?$category->meta_title:''}}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="meta_keywords-0" class="col-md-2 col-form-label">Meta Keywords<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="meta_keywords-0" name="meta_keywords"required placeholder="Enter Meta Keywords">{{isset($category)?$category->meta_keywords:''}}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="meta_description-0" class="col-md-2 col-form-label">Meta Description<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="meta_description-0" name="meta_description"required placeholder="Enter Meta Description">{{isset($category)?$category->meta_description:''}}</textarea>
                        </div>
                    </div>
                    </div>
                    <div class="append-faq"></div> 
                    <div class="mb-3 row">
                        <label for="example-tel-input" class="col-md-2 col-form-label"></label>
                        <div class="col-md-10">
                           
                            <button type="sumbit" class="btn btn-success">Submit</button>
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


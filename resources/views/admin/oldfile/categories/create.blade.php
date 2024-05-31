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
       
        <form method="post" action="{{url('admin/categories')}}" enctype="multipart/form-data" id="form-validation">
      
        @csrf
            <div class="card">
               
                <center><h2>{{$page_title}}<h2></center>
                         
                <div class="card-body">
                    <div class="faq">
                        <div class="mb-3 row">
                            <label for="question-0" class="col-md-2 col-form-label">Categories Name<span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" findex="1"  name="name[]" placeholder="Enter Categories Name" id="name-0" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="question-0" class="col-md-2 col-form-label">Slug</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text"  name="slug[]" placeholder="Enter slug Name" id="name-0">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="answer-0" class="col-md-2 col-form-label">Category Image</label>
                            <div class="col-md-10">
                                <input class="form-control" type="file"  name="image[]" placeholder="Categories Logo" id="image-0">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="answer-0" class="col-md-2 col-form-label">Image Code</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text"  name="image_code[]" placeholder="image code" id="image-0">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="answer-0" class="col-md-2 col-form-label">Select Parent Category</label>
                            <div class="col-md-10">
                                <select class="form-control" name="parent_category">
                                    @foreach($category as $value)
                                    <option value="0">Parent Category</option>
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
                    </div>
                    <div class="append-faq"></div> 
                    <div class="mb-3 row">
                        <label for="example-tel-input" class="col-md-2 col-form-label"></label>
                        <div class="col-md-10">
                            <button type="button" class="btn btn-primary" onClick="add_faq()" >+Add More</button>
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

    {{--  For appending Section Faq --}}
<script>
    function add_faq(){
        var clientIndex= $('#input-faq-ques-0').attr('findex');
        clientIndex=parseInt(clientIndex)+1;
        $('#input-faq-ques-0').attr('findex',clientIndex);
        var client= '<div class="faq append-style">';
            client +='<div class="mb-3 row">';
                            client +='<label for="input-faq-ques-'+clientIndex+'" class="col-md-2 col-form-label">Client Name<span class="text-danger">*</span></label>';
                            client +='<div class="col-md-10">';
                                client +='<input class="form-control" findex="'+clientIndex+'" type="text" value="" name="name[]" placeholder="Enter Client Name" id="input-client-ques-'+clientIndex+'" required>';
                            client +='</div>';
                        client +='</div>';
                        client +='<div class="mb-3 row">';
                            client +='<label for="question-0" class="col-md-2 col-form-label">Slug</label>';
                            client +='<div class="col-md-10">';
                                client +='<input class="form-control" type="text"  name="slug[]" placeholder="Enter slug" id="name-0">';
                            client +='</div>';
                       client +=' </div>';
                        client +='<div class="mb-3 row">';
                            client +='<label for="input-faq-ans-'+clientIndex+'" class="col-md-2 col-form-label">Logo</label>';
                            client +='<div class="col-md-10">';
                                client +='<input class="form-control" type="file" value="" name="image[]" placeholder="Logo" id="input-faq-ans-'+clientIndex+'">';
                            client +='</div>';
                        client +='</div>';
                        client +='<div class="mb-3 row">';
                            client +='<label for="answer-0" class="col-md-2 col-form-label">Image Code</label>';
                            client +='<div class="col-md-10">';
                                client +='<input class="form-control" type="text"  name="image_code[]" placeholder="image code" id="image-0">';
                            client +='</div>';
                        client +='</div>';
                        client +='<div class="mb-3 row">';
                            client +='<label for="answer-0" class="col-md-2 col-form-label">Select Parent Category</label>';
                            client +='<div class="col-md-10">';
                                client +='<select class="form-control" name="parent_category">';
                                   client +=' @foreach($category as $value)';
                                   client +=' <option value="0">Parent Category</option>';
                                   client +=' <option value="{{$value->id}}">{{$value->name}}</option>';
                                   client +=' @endforeach';
                               client +=' </select>';
                           client +=' </div>';
                       client +=' </div>';
                      client +='<div class="mb-3 row">';
                        client +='<label for="meta_title-0" class="col-md-2 col-form-label">Meta title<span class="text-danger">*</span></label>';
                        client +='<div class="col-md-10">';
                           client +=' <textarea class="form-control" id="meta_title-0" name="meta_title"required placeholder="Enter Meta Title">{{isset($page)?$page->meta_title:''}}</textarea>';
                        client +='</div>';
                    client +='</div>';
                    client +='<div class="mb-3 row">';
                      client +='<label for="meta_keywords-0" class="col-md-2 col-form-label">Meta Keywords<span class="text-danger">*</span></label>';
                      client +='<div class="col-md-10">';
                client +='<textarea class="form-control" id="meta_keywords-0" name="meta_keywords"required placeholder="Enter Meta Keywords">{{isset($page)?$page->meta_keywords:''}}</textarea>';
                       client +='</div>';
                    client +='</div>';
                  client +='<div class="mb-3 row">';
                    client +='<label for="meta_description-0" class="col-md-2 col-form-label">Meta Description<span class="text-danger">*</span></label>';
                   client +='<div class="col-md-10">';
    client +='<textarea class="form-control" id="meta_description-0" name="meta_description"required placeholder="Enter Meta Description">{{isset($page)?$page->meta_description:''}}</textarea>';
                   client +='</div>';
                client +='</div>';
                        
                        
                       client +=' <button class="btn btn-danger remove"><i class="mdi mdi-close-circle-outline"></i></button>';
                    client +='</div>';
        $('.append-faq').append(client);
    }

    $(document).on('click', '.remove', function () {
        $(this).parents('.faq').remove();
    });

// {{--  For appending Section Faq --}}

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


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
        
        <form method="post" action="{{url('admin/faqs')}}" enctype="multipart/form-data" id="form-validation">
        
        @csrf
            <div class="card">
               
                <center><h2>FAQ Section<h2></center>
                         
                <div class="card-body">
                    <div class="faq">
                        <div class="mb-3 row">
                            <label for="question-0" class="col-md-2 col-form-label">Question<span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" findex="1"  name="question[]" placeholder="Enter Question" id="question-0" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="answer-0" class="col-md-2 col-form-label">Answer<span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" type="text"  name="answer[]" placeholder="Enter Answer" id="answer-0" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label" for="status">Fetured Status</label>
                        <div class="col-md-10">
                            <select class="form-select" name="fetured[]">
                                <option @if(isset($page) && $page->fetured=='1') selected="selected" @endif value="1">Show</option>
                                <option @if(isset($page) && $page->fetured=='0') selected="selected" @endif value="0">Hide</option>
                            </select>
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
                        faq +='</div>';
                        faq +='<div class="mb-3 row">';
                        faq +='<label class="col-md-2 col-form-label" for="status">Fetured Status</label>';
                        faq +='<div class="col-md-10">';
                            faq +='<select class="form-select" name="fetured[]">';
                                faq +='<option @if(isset($page) && $page->fetured=='1') selected="selected" @endif value="1">Show</option>';
                                faq +='<option @if(isset($page) && $page->fetured=='0') selected="selected" @endif value="0">Hide</option>';
                            faq +='</select>';
                        faq +='</div>';
                    faq +='</div><button class="btn btn-danger remove"><i class="mdi mdi-close-circle-outline"></i></button>';
                    faq +='</div>';
        $('.append-faq').append(faq);
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


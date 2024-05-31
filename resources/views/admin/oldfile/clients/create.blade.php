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
       
        <form method="post" action="{{url('admin/clients')}}" enctype="multipart/form-data" id="form-validation">
      
        @csrf
            <div class="card">
               
                <center><h2>{{$page_title}}<h2></center>
                         
                <div class="card-body">
                    <div class="faq">
                        <div class="mb-3 row">
                            <label for="question-0" class="col-md-2 col-form-label">Client Name<span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" findex="1"  name="name[]" placeholder="Enter Client Name" id="name-0" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="answer-0" class="col-md-2 col-form-label">Logo<span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" type="file"  name="image[]" placeholder="Client Logo" id="image-0" required>
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
                            client +='<label for="input-faq-ans-'+clientIndex+'" class="col-md-2 col-form-label">Logo<span class="text-danger">*</span></label>';
                            client +='<div class="col-md-10">';
                                client +='<input class="form-control" type="file" value="" name="image[]" placeholder="Logo" id="input-faq-ans-'+clientIndex+'" required>';
                            client +='</div>';
                        client +='</div> <button class="btn btn-danger remove"><i class="mdi mdi-close-circle-outline"></i></button>';
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


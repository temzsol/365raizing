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
        
        <form method="post" enctype="multipart/form-data" action="{{url('admin/clients/'.$client->id)}}" id="validation">
            @method('PUT')
        
        @csrf
            <div class="card">
               
                <center><h2>{{$page_title}}<h2></center>
                         
                <div class="card-body">
                    <div class="faq">
                        <div class="mb-3 row">
                            <label for="question-0" class="col-md-2 col-form-label">Client Name<span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" findex="1"  name="name" placeholder="Client Name" id="question-0" required value="{{isset($client)? $client->name:''}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-email-input" class="col-md-2 col-form-label">Image<br/><span class="text-danger"> Size: 805 x 453 px </span></label>
                            @if(isset($client))
                            <div class="col-md-10" id="image_hide">
                                <img src="{{url('/images/clients/'.$client->image)}}" alt="{{isset($client)? $client->name:''}}" style="height: 100px;"> <i class="bx bx-window-close text-danger" onClick="hideimage()"></i>
                                <input type="hidden" value="{{isset($client)?$client->id:''}}" id="gid">
                            </div>
                            @endif
                            <div class="col-md-10" id="image_upload">
                                <input class="form-control" type="file"id="image" name="image">
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


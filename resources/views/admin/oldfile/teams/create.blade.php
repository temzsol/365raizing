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
                @if(isset($team))
                <form method="post" enctype="multipart/form-data" action="{{url('admin/teams/'.$team->id)}}" id="validation">
                    @method('PUT')
                @else
                <form method="post" action="{{url('admin/teams')}}" enctype="multipart/form-data" id="form-validation">
                @endif
                @csrf
                <h4 class="card-title">{{$page_title}}</h4>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">Name<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($team)?$team->name:''}}" id="name" name="name">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-search-input" class="col-md-2 col-form-label">Disignation<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($team)?$team->designation:''}}" id="disignation" name="designation">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-email-input" class="col-md-2 col-form-label">Image <span class="text-danger">140 X 250 px</span></label>
                    @if(isset($team))
                    <div class="col-md-10" id="image_hide">
                        <input type="hidden" value="{{isset($team)?$team->id:''}}" id="gid">
                        <img src="{{url('/images/teams/'.$team->image)}}" alt="{{$team->image}}" style="height: 100px;"> <i class="bx bx-window-close text-danger" onClick="hideimage()"></i>
                    </div>
                    @endif
                    <div class="col-md-10" id="image_upload">
                        <input class="form-control" type="file"id="image" name="image">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-url-input" class="col-md-2 col-form-label">Linked<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($team)?$team->social_link_1:''}}" placeholder="Enter Linkedin Url" id="" name="social_link_1">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-tel-input" class="col-md-2 col-form-label">Instagram</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($team)?$team->social_link_2:''}}" name="social_link_2" placeholder="Enter Instagram url" id="example-tel-input">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-password-input" class="col-md-2 col-form-label">Description<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="description">{{isset($team)?$team->description:''}}</textarea>
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">Status</label>
                    <div class="col-md-10">
                        <select class="form-select" name="status">
                            <option @if(isset($team) && $team->status=='1') selected="selected" @endif value="1">Active</option>
                            <option @if(isset($team) && $team->status=='0') selected="selected" @endif value="0">Inactive</option>
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
                name:{
                    required: true,
                    maxlength: 50
                },
                designation:{
                    required: true,
                    maxlength: 50
                },
               
                description:{
                    required:true,
                    maxlength:255
                }

            },
            message:{
                name:{
                    required:"Please Enter Team Member Name",
                    maxlength:"Text not morethen 50"
                },
                designation:{
                    required:" Please Enter Digination",
                    maxlength:"Text not morethen 50"
                },
                
                description:{
                    required:"Please Add Description",
                    maxlength:"Text Limit 255"
                }
            }
           
        });



    
    </script>

@endpush


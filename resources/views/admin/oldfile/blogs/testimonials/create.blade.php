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
                @if(isset($testimonial))
                <form method="post" enctype="multipart/form-data" action="{{url('admin/testimonials/'.$testimonial->id)}}" id="validation">
                    @method('PUT')
                @else
                <form method="post" action="{{url('admin/testimonials')}}" enctype="multipart/form-data" id="form-validation">
                @endif
                @csrf
                <h4 class="card-title">{{$page_title}}</h4>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">Name<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($testimonial)?$testimonial->name:''}}" id="name" name="name">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">Designation<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($testimonial)?$testimonial->designation:''}}" id="designation" name="designation">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-password-input" class="col-md-2 col-form-label">Description<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="description">{{isset($testimonial)?$testimonial->description:''}}</textarea>
                    </div>
                </div>
               
                <div class="mb-3 row">
                    <label for="example-email-input" class="col-md-2 col-form-label">Image <span class="text-danger"><br/>Size must be 60 x 60 px,</span></label>
                    @if(isset($testimonial))
                    <div class="col-md-10" id="image_hide">
                        <input type="hidden" value="{{isset($testimonial)?$testimonial->id:''}}" id="gid">
                        <img src="{{url('/images/testimonials/'.$testimonial->image)}}" style="height: 100px;" alt="{{isset($testimonial)?$testimonial->name:''}}"> <i class="bx bx-window-close text-danger" onClick="hideimage()"></i>
                    </div>
                    @endif
                    <div class="col-md-10" id="image_upload">
                        <input class="form-control" type="file"id="image" name="image">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-url-input" class="col-md-2 col-form-label">Star<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <select class="form-select" name="star">
                            @for($i=1; $i<=5;$i++)
                            <option @if(isset($testimonial) && $testimonial->star==$i) selected="selected" @endif value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                
                
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">Status</label>
                    <div class="col-md-10">
                        <select class="form-select" name="status">
                            <option @if(isset($testimonial) && $testimonial->status=='1') selected="selected" @endif value="1">Active</option>
                            <option @if(isset($testimonial) && $testimonial->status=='0') selected="selected" @endif value="0">Inactive</option>
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
                star:{
                    required: true,
                },
                description:{
                    required:true,
                    
                }

            },
            message:{
                name:{
                    required:"Please Enter Team Member Name",
                    maxlength:"Text not morethen 50"
                },
                star:{
                    required:" Please Select Number of Stars",
                    
                },
            
                description:{
                    required:"Please Add Description",
                    
                }
            }
            // This code use when form submit using ajax
            // submitHandler: function(form) {
            //   $.ajaxSetup({
            //   headers: {
            //   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //   }
            //   });
            // }
        });



    
    </script>

@endpush


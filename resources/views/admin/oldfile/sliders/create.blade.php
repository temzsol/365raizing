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
                @if(isset($slider))
                <form method="post" enctype="multipart/form-data" action="{{url('admin/sliders/'.$slider->id)}}" id="validation">
                    @method('PUT')
                @else
                <form method="post" action="{{url('admin/sliders')}}" enctype="multipart/form-data" id="form-validation">
                @endif
                @csrf
                <h4 class="card-title">{{$page_title}}</h4>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">Title<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($slider)?$slider->title:''}}" id="title" name="title">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">Slug</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($slider)?$slider->slug:''}}" id="slug" name="slug">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-password-input" class="col-md-2 col-form-label">Description<span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="description">{{isset($slider)?$slider->description:''}}</textarea>
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="example-email-input" class="col-md-2 col-form-label">Image/Video<br/><span class="text-danger" >Image must be Upload in 350 X 570 px</span></label>
                    @if(isset($slider))
                    @php $ext = pathinfo($slider['image'], PATHINFO_EXTENSION) @endphp
                    @if($ext=='mp4')
                    <div class="col-md-10" id="image_hide">
                        <input type="hidden" value="{{isset($slider)?$slider->id:''}}" id="gid">
                                    <video width="320" height="150" controls>
                                        <source src="{{url('/images/sliders/'.$slider['image'])}}" type="video/mp4">
                                      </video><i class="bx bx-window-close text-danger" onClick="hideimage()"></i>
                    </div>
                     @endif
                     @if($ext!='mp4')
                    <div class="col-md-10" id="image_hide">
                        <input type="hidden" value="{{isset($slider)?$slider->id:''}}" id="gid">
                        <img src="{{url('/images/sliders/'.$slider->image)}}" alt="{{$slider->image}}" style="height: 100px;"> <i class="bx bx-window-close text-danger" onClick="hideimage()"></i>
                    </div>
                    @endif
                    @endif
                    <div class="col-md-10" id="image_upload">
                        <input class="form-control" type="file"id="image" name="image">
                    </div>
                </div>
                
                
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">Status</label>
                    <div class="col-md-10">
                        <select class="form-select" name="status">
                            <option @if(isset($slider) && $slider->status=='1') selected="selected" @endif value="1">Active</option>
                            <option @if(isset($slider) && $slider->status=='0') selected="selected" @endif value="0">Inactive</option>
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
                title:{
                    required: true,
                    maxlength: 255
                },
               
                description:{
                    required:true,
                    maxlength:255
                }

            },
            message:{
                title:{
                    required:"Please Enter title of Sliders",
                    maxlength:"Text not morethen 20"
                },
                description:{
                    required:"Please Enter Description",
                    maxlength:"Text Limit 50"
                }
                
            }
        });



    
    </script>

@endpush


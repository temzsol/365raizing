@extends('layouts.masteradmin')
@section('body')
@php
    $gst_locations = [
    "" => "Select Tax Location",
    "Jammu" => "01. Jammu & Kashmir",
    "Himachal_Pradesh" => "02. Himachal Pradesh",
    "Punjab" => "03. Punjab",
    "Chandigarh" => "04. Chandigarh",
    "Uttarakhand" => "05. Uttarakhand",
    "Haryana" => "06. Haryana",
    "Delhi" => "07. Delhi",
    "Rajasthan" => "08. Rajasthan",
    "Uttar_Pradesh" => "09. Uttar Pradesh",
    "Bihar" => "10. Bihar",
    "Sikkim" => "11. Sikkim",
    "Arunachal_Pradesh" => "12. Arunachal Pradesh",
    "Nagaland" => "13. Nagaland",
    "Manipur" => "14. Manipur",
    "Mizoram" => "15. Mizoram",
    "Tripura" => "16. Tripura",
    "Meghalaya" => "17. Meghalaya",
    "Assam" => "18. Assam",
    "West_Bengal" => "19. West Bengal",
    "Jharkhand" => "20. Jharkhand",
    "Orissa" => "21. Orissa",
    "Chhattisgarh" => "22. Chhattisgarh",
    "Madhya_Pradesh" => "23. Madhya Pradesh",
    "Gujarat" => "24. Gujarat",
    "Daman_&_Diu" => "25. Daman & Diu",
    "Dadra_&_Nagar_Haveli" => "26. Dadra & Nagar Haveli",
    "Maharashtra" => "27. Maharashtra",
    "Andhra_Pradesh" => "28. Andhra Pradesh",
    "Karnataka" => "29. Karnataka",
    "Goa" => "30. Goa",
    "Lakshadweep" => "31. Lakshadweep",
    "Kerala" => "32. Kerala",
    "Tamil_Nadu" => "33. Tamil Nadu",
    "Puducherry" => "34. Puducherry",
    "Andaman_&_Nicobar_Islands" => "35. Andaman & Nicobar Islands",
    "Telengana" => "36. Telengana",
    "Andrapradesh" => "37. Andrapradesh"
];

@endphp
<style>
    .sub_box{
        height: 80%;
        border: solid 1px;
        width: 50%;
        margin-top: 10px;
        align-self: center;

    }
</style>
<div class="page-content">
<div class="row">
    <div class="col-12">
        @if ($errors->any())
    <div class="alert alert-text-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div class="card">
            <div class="card-body">
                <div class="card">
                        <div class="card-header"><strong>Company</strong><small> Form</small></div>
                        @if(isset($company))
                        <form action="{{route('company.update',$company->id)}}" method="post" enctype="multipart/form-data">
                        @else
                    <form action="{{route('company.store')}}" method="post" enctype="multipart/form-data">
                        @endif
                        @csrf
                        <div class="card-body card-block">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-4">
                                    <label for="company" class=" form-control-label">Company<span class="text-danger">*</span></label>
                                    <input type="text" id="compname" name="compname" placeholder="Enter your company name" class="form-control" required value="{{isset($company)?$company->compname:''}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-4">
                                    <label for="cgst" class=" form-control-label">Tax ID</label>
                                    <input type="text" id="cgst" name="cgst"  value="{{isset($company)?$company->cgst:''}}" placeholder="Enter company Tax ID" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-4">
                                    <label for="gst_location" class =" form-control-label">Tax Location<span class="text-danger">*</span></label>
                                    <select name="gst_location" class="form-control" required>
                                        @foreach($gst_locations as $value => $text)
                                            <option value="{{ $value }}" {{$value==$company->gst_location?'selected':''}}>{{ $text }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label for="gst_file" class=" form-control-label">Tax Document</label>
                                        <input type="file" id="gst_file"  class="form-control" name="gst_file">
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-4">
                                    <label for="cpan" class=" form-control-label">PanCard</label>
                                    <input type="file" id="cpan"  class="form-control" name="cpan" value="{{isset($company)?$company->cpan:''}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-4">
                                    <label for="tan" class=" form-control-label">TAN Number</label>
                                    <input type="text" id="tan" name="tan" value="{{isset($company)?$company->tan:''}}" placeholder="Enter  TAN number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-4">
                                    <label for="mca" class=" form-control-label">MCA </label>
                                    <input type="file" id="mca"  class="form-control" name="mca" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-4">
                                    <label for="billing_address" class=" form-control-label">Billing Address</label>
                                    <input type="text" id="billing_address" placeholder="Enter Billing Address" class="form-control" name="billing_address" value="{{isset($company)?$company->billing_address:''}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-4">
                                <label for="billing_address_location" class =" form-control-label">Billing Address Location</label>
                                <input type="text" id="billing_address_location" placeholder="Enter Billing Address" class="form-control" name="billing_address_location" value="{{isset($company)?$company->billing_address_location:''}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                          <div class="form-group mb-4">
                              <label for="compemail" class=" form-control-label">Email Add<span class="text-danger">*</span></label>
                              <input type="email" name="compemail" value="{{isset($company)?$company->compemail:''}}" id="compemail" placeholder="Enter Email Add" class="form-control" required>
                          </div>
                        </div>
                          <div class="col-md-4">
                          <div class="form-group mb-4">
                              <label for="vat" class=" form-control-label">Mobile<span class="text-danger">*</span></label>
                              <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" name="compmob" value="{{isset($company)?$company->compmob:''}}" id="compmob" placeholder="Enter Mobile Number" class="form-control" required>
                          </div>
                        </div>
                          <div class="col-md-4">
                           <div class="form-group mb-4">
                              <label for="head_office_address" class=" form-control-label">Head Office Address<span class="text-danger">*</span></label>
                              <input type="headoffice" name="head_office_address" value="{{isset($company)?$company->head_office_address:''}}" id="head_office_address" placeholder="Head Office Address" class="form-control"required>
                          </div>
                        </div>
                          <div class="col-md-4">
                          <div class="form-group mb-4">
                              <label for="compstreet" class=" form-control-label">Street<span class="text-danger">*</span></label>
                              <input type="text" name="compstreet" value="{{isset($company)?$company->compstreet:''}}" id="compstreet" placeholder="Enter Street " class="form-control"required>
                          </div>
                        </div>
                          <div class="col-md-4">
                          <div class="form-group mb-4">
                              <label for="compcity" class=" form-control-label">City<span class="text-danger">*</span></label>
                              <input type="text" name="compcity" value="{{isset($company)?$company->compcity:''}}" id="compcity" placeholder="Enter City Name" class="form-control"required>
                          </div>
                        </div>
                          <div class="col-md-4">
                          <div class="form-group mb-4">
                              <label for="compcode" class=" form-control-label">Postal Code<span class="text-danger">*</span></label>
                              <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==6) return false;" name="compcode" value="{{isset($company)?$company->compcode:''}}" id="compcode" placeholder="Enter Postal Code" class="form-control"required>
                          </div>
                        </div>
                          <div class="col-md-4">
                          <div class="form-group mb-4">
                              <label for="compcountry" class=" form-control-label">Country<span class="text-danger">*</span></label>
                              <input type="text" name="compcountry" value="{{isset($company)?$company->compcountry:''}}" id="compcountry" placeholder="Enter Country Name" class="form-control" required>
                          </div>
                        </div>
                          <div class="col-md-4">
                          <div class="form-group mb-4">
                              <label for="web_link" class=" form-control-label">Website link</label>
                              <input type="url" name="web_link" value="{{isset($company)?$company->web_link:''}}" id="web_link" placeholder="Enter Website link" class="form-control">
                          </div>
                        </div>
                    </div>

                    <input type="submit" name="cok" value="submit" class="form-control btn btn-primary" id="Add_comp_submit" Name="Submit" style="margin-top: 15px; border-radius: 6px; width: 130px;"   />
                        </div>
                    </form>
                    
                  </div>
                </div>
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
                            append_section +='<button class="btn btn-text-danger remove" type="button">Remove</button>';
                        append_section +='</div>';
                        append_section +='</div>';
                         $('.repet_section').append(append_section);
                     }
        $(document).on('click','.remove', function(){
        $(this).parents('.repet_section_row').remove();
        });
    </script>

@endpush


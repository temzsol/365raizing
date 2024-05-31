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
         @if(isset($data))
         <form method="post" enctype="multipart/form-data" action="{{url('admin/settings/'.$data->id)}}" id="validation">
            @method('PUT')
            @else
         <form method="post" action="{{url('admin/settings')}}" enctype="multipart/form-data" id="form-validation">
            @endif
            @csrf
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title">{{$page_title}}</h4>
                  <div class="mb-3 row">
                     <label for="example-text-input" class="col-md-2 col-form-label">Website Name<span class="text-danger">*</span></label>
                     <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($data)?$data->web_name:''}}" placeholder="Website Name" id="title" name="web_name" required>
                     </div>
                  </div>
                  <div class="mb-3 row">
                     <label for="example-text-input" class="col-md-2 col-form-label">Website Url<span class="text-danger">*</span></label>
                     <div class="col-md-10">
                        <input class="form-control" type="text" value="{{isset($data)?$data->web_url:''}}" id="web_url" name="web_url" placeholder="Enter Slug">
                     </div>
                  </div>
                  <div class="mb-3 row">
                     <label for="example-email-input" class="col-md-2 col-form-label">Website Logo<span class="text-danger">*</span></label>
                     @if(isset($data))
                     <div class="col-md-10" id="banner_image_hide">
                        <input type="hidden" value="{{isset($data)?$data->id:''}}" id="banner_id">
                        <img src="{{url('/images/settings/'.$data->web_logo)}}" alt="{{$data->web_logo}}" style="height: 100px;"> <i class="bx bx-window-close text-danger" onClick="hidebannerimage()"></i>
                     </div>
                     @endif
                     <div class="col-md-10" id="banner_image_upload">
                        <input class="form-control" type="file"id="web_logo" name="web_logo">
                     </div>
{{-- 
                     <center><h2>Email Setting<h2></center>
                        <div class="mb-3 row">
                           <label for="example-text-input" class="col-md-2 col-form-label">MAIL_MAILER<span class="text-danger">*</span></label>
                           <div class="col-md-4">
                              <input class="form-control" type="text" value="{{isset($data)?$data->mail_mailer:''}}" id="mail_mailer" name="mail_mailer" placeholder="Enter MAIL_MAILER" required>
                           </div>
                           <label for="example-text-input" class="col-md-2 col-form-label">MAIL_HOST<span class="text-danger">*</span></label>
                           <div class="col-md-4">
                              <input class="form-control" type="text" value="{{isset($data)?$data->mail_host:''}}" id="mail_host" name="mail_host" placeholder="Enter MAIL_HOST" required>
                           </div>
                        </div>
                        <div class="mb-3 row">
                           <label for="example-text-input" class="col-md-2 col-form-label">MAIL_PORT<span class="text-danger">*</span></label>
                           <div class="col-md-4">
                              <input class="form-control" type="number" value="{{isset($data)?$data->mail_port:''}}" id="mail_port" name="mail_port" placeholder="Enter MAIL_PORT" maxlength="5" required>
                           </div>
                           <label for="example-text-input" class="col-md-2 col-form-label">MAIL_USERNAME<span class="text-danger">*</span></label>
                           <div class="col-md-4">
                              <input class="form-control" type="text" value="{{isset($data)?$data->mail_username:''}}" id="mail_username" name="mail_username" placeholder="Enter MAIL_USERNAME" required>
                           </div>
                        </div>
                        <div class="mb-3 row">
                           <label for="example-text-input" class="col-md-2 col-form-label">MAIL_PASSWORD<span class="text-danger">*</span></label>
                           <div class="col-md-4">
                              <input class="form-control" type="password" value="{{isset($data)?$data->mail_password:''}}" id="mail_password" name="mail_password" placeholder="Enter MAIL_PASSWORD" required>
                           </div>
                           <label for="example-text-input" class="col-md-2 col-form-label">MAIL_ENCRYPTION<span class="text-danger">*</span></label>
                           <div class="col-md-4">
                              <select name="mail_enctype" class="form-control" required>
                                 <option value="null" @if(isset($data)&& $data->mail_enctypr=='null') {{'selected'}} @endif>NULL</option>
                                 <option value="tls" @if(isset($data)&& $data->mail_enctypr=='tls') {{'selected'}} @endif>TLS</option>
                                 <option value="ssl" @if(isset($data)&& $data->mail_enctypr=='ssl') {{'selected'}} @endif>SSL</option>
                                 <option value="starttls" @if(isset($data)&& $data->mail_enctypr=='starttls') {{'selected'}} @endif>STARTTLS </option>
                              </select>
                              
                           </div>
                        </div>
                        <div class="mb-3 row">
                           <label for="example-text-input" class="col-md-2 col-form-label">MAIL_FROMADDRESS<span class="text-danger">*</span></label>
                           <div class="col-md-4">
                              <input class="form-control" type="email" value="{{isset($data)?$data->mail_from_address:''}}" id="mail_from_address" name="mail_from_address" placeholder="Enter MAIL_FROM_ADDRESS" required>
                           </div>
                           
                        </div> --}}
                  </div>
               </div>
               <center>
                  <h2>
                  Social Links
                  <h2>
               </center>
               @if(isset($data))
               <div class="card-body">
                  <div class="append-social">
                     @foreach($data['web_social_tink_title'] as $key=>$value)
                     <div class="social append-style">
                        <div class="mb-3 row">
                           <label for="sname-0" class="col-md-2 col-form-label">Social Link Name<span class="text-danger">*</span></label>
                           <div class="col-md-10">
                              <input class="form-control jvalidate" type="text" value="{{isset($data)?$value:''}}" name="web_social_tink_title[]" placeholder="Social Link Name" id="sname-0" required>
                           </div>
                        </div>
                        <div class="mb-3 row">
                           <label for="slink-0" class="col-md-2 col-form-label">Link Url<span class="text-danger">*</span></label>
                           <div class="col-md-10">
                              <input class="form-control jvalidate" type="text" value="{{isset($data)?$data['web_social_link'][$key]:''}}" name="web_social_link[]" placeholder="Social Link" id="slink-0" required>
                           </div>
                        </div>
                        <button class="btn btn-danger remove" type="button"><i class="mdi mdi-close-circle-outline"></i></button>
                     </div>
                     @endforeach
                  </div>
                  <div class="mb-3 row">
                     <label for="example-tel-input" class="col-md-2 col-form-label"></label>
                     <div class="col-md-10">
                        <button type="button" class="btn btn-primary" onClick="social_add()" >+Add More</button>
                     </div>
                  </div>
               </div>
               @else
               <div class="card-body">
                  <div class="social">
                     <div class="mb-3 row">
                        <label for="sname-0" class="col-md-2 col-form-label">Social Link Name<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                           <input class="form-control" type="text" findex="1" name="web_social_tink_title[]" placeholder="Social Link Name" id="sname-0" required>
                        </div>
                     </div>
                     <div class="mb-3 row">
                        <label for="slink-0" class="col-md-2 col-form-label">Link Url<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                           <input class="form-control" type="text" name="web_social_link[]" placeholder="Social Link" id="slink-0" required>
                        </div>
                     </div>
                  </div>
                  <div class="append-social"></div>
                  <div class="mb-3 row">
                     <label for="example-tel-input" class="col-md-2 col-form-label"></label>
                     <div class="col-md-10">
                        <button type="button" class="btn btn-primary" onClick="social_add()" >+Add More</button>
                     </div>
                  </div>
               </div>
               @endif
               <center>
                  <h2>
                  Mobile Number
                  <h2>
               </center>
               @if(isset($data))
               <div class="card-body">
                  <div class="append-mobile">
                     @foreach($data['web_mobile'] as $value)
                     <div class="mobile append-style">
                        <div class="mb-3 row">
                           <label for="mobile-0" class="col-md-2 col-form-label">Mobile Number<span class="text-danger">*</span></label>
                           <div class="col-md-10">
                              <input class="form-control jvalidate" findex="1" type="text" value="{{isset($data)?$value:''}}" name="web_mobile[]" placeholder="Enter Mobile" id="mobile-0" required>
                           </div>
                        </div>
                        <button class="btn btn-danger remove" type="button"><i class="mdi mdi-close-circle-outline"></i></button>
                     </div>
                     @endforeach
                  </div>
                  <div class="mb-3 row">
                     <label for="example-tel-input" class="col-md-2 col-form-label"></label>
                     <div class="col-md-10">
                        <button type="button" class="btn btn-primary" onClick="add_mobile()">+Add More</button>
                     </div>
                  </div>
               </div>
               @else           
               <div class="card-body">
                  <div class="mobile">
                     <div class="mb-3 row">
                        <label for="mobile-0" class="col-md-2 col-form-label">Mobile Number<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                           <input class="form-control" type="text" findex="1"  name="web_mobile[]" placeholder="Enter Mobile Number" id="mobile-0" required>
                        </div>
                     </div>
                  </div>
                  <div class="append-mobile"></div>
                  <div class="mb-3 row">
                     <label for="example-tel-input" class="col-md-2 col-form-label"></label>
                     <div class="col-md-10">
                        <button type="button" class="btn btn-primary" onClick="add_mobile()">+Add More</button>
                     </div>
                  </div>
               </div>
               @endif
               <center>
                  <h2>
                  Phone
                  <h2>
               </center>
               @if(isset($data))
               <div class="card-body">
                  <div class="append_phone">
                     @foreach($data['web_phone'] as $value)
                     <div class="phone append-style">
                        <div class="mb-3 row">
                           <label for="phone-0" class="col-md-2 col-form-label">Phone Number<span class="text-danger">*</span></label>
                           <div class="col-md-10">
                              <input class="form-control" type="text" findex="1" value="{{isset($data)?$value:''}}" name="web_phone[]" placeholder="Enter Phone" id="phone-0" required>
                           </div>
                        </div>
                        <button class="btn btn-danger remove"><i class="mdi mdi-close-circle-outline"></i></button>
                     </div>
                     @endforeach
                  </div>
                  <div class="mb-3 row">
                     <label for="buttonaddmore" class="col-md-2 col-form-label"></label>
                     <div class="col-md-10">
                        <button type="button" class="btn btn-primary" data-circal-index="1" onClick="add_pohne()">+Add More</button>
                     </div>
                  </div>
               </div>
               @else
               <div class="card-body">
                  <div class="phone">
                     <div class="mb-3 row">
                        <label for="phone-0" class="col-md-2 col-form-label">Phone Number<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                           <input class="form-control" type="text" findex="1" value="{{isset($data)?$data->web_phone:''}}" name="web_phone[]" placeholder="Enter Phone Number" id="phone-0" required>
                        </div>
                     </div>
                  </div>
                  <div class="append_phone"></div>
                  <div class="mb-3 row">
                     <label for="buttonaddmore" class="col-md-2 col-form-label"></label>
                     <div class="col-md-10">
                        <button type="button" class="btn btn-primary" data-circal-index="1" onClick="add_pohne()">+Add More</button>
                     </div>
                  </div>
               </div>
               @endif
               <center>
                <h2>
                Email
                <h2>
             </center>
             @if(isset($data))
             <div class="card-body">
                <div class="append-email">
                   @foreach($data['web_email'] as $value)
                   <div class="email append-style">
                      <div class="mb-3 row">
                         <label for="email-0" class="col-md-2 col-form-label">Email<span class="text-danger">*</span></label>
                         <div class="col-md-10">
                            <input class="form-control jvalidate" findex="1" type="text" value="{{isset($data)?$value:''}}" name="web_email[]" placeholder="Enter email" id="email-0" required>
                         </div>
                      </div>
                      <button class="btn btn-danger remove" type="button"><i class="mdi mdi-close-circle-outline"></i></button>
                   </div>
                   @endforeach
                </div>
                <div class="mb-3 row">
                   <label for="example-tel-input" class="col-md-2 col-form-label"></label>
                   <div class="col-md-10">
                      <button type="button" class="btn btn-primary" onClick="add_email()">+Add More</button>
                   </div>
                </div>
             </div>
             @else           
             <div class="card-body">
                <div class="email">
                   <div class="mb-3 row">
                      <label for="email-0" class="col-md-2 col-form-label">Email<span class="text-danger">*</span></label>
                      <div class="col-md-10">
                         <input class="form-control" type="text" findex="1"  name="web_email[]" placeholder="Enter email" id="email-0" required>
                      </div>
                   </div>
                </div>
                <div class="append-email"></div>
                <div class="mb-3 row">
                   <label for="example-tel-input" class="col-md-2 col-form-label"></label>
                   <div class="col-md-10">
                      <button type="button" class="btn btn-primary" onClick="add_email()">+Add More</button>
                   </div>
                </div>
             </div>
             @endif
               <center>
                  <h2>
                  Google Map
                  <h2>
               </center>
               @if(isset($data))
               <div class="card-body">
                  <div class="append_google_map">
                     @foreach($data['web_google_map'] as $value)
                     <div class="google_map append-style">
                        <div class="mb-3 row">
                           <label for="google_map-0" class="col-md-2 col-form-label">Google Map Code<span class="text-danger">*</span></label>
                           <div class="col-md-10">
                              <textarea class="form-control" id="google_map-0" findex="1" name="web_google_map[]"required placeholder="Enter Google map IFram Code">{{isset($data)?$value:''}}</textarea>
                           </div>
                        </div>
                        <button class="btn btn-danger remove"><i class="mdi mdi-close-circle-outline"></i></button>
                     </div>
                     @endforeach
                  </div>
                  <div class="mb-3 row">
                     <label for="addmorhelpbutton" class="col-md-2 col-form-label"></label>
                     <div class="col-md-10">
                        <button type="button" onClick="add_help()" class="btn btn-primary">+Add More</button>
                     </div>
                  </div>
               </div>
               @else
               <div class="card-body">
                  <div class="google_map">
                     <div class="mb-3 row">
                        <label for="google_map-0" class="col-md-2 col-form-label">Google Map Code<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                           <textarea class="form-control" id="google_map-0" findex="1" name="web_google_map[]"required placeholder="Enter Google map IFram Code">{{isset($data)?$data->web_google_map:''}}</textarea>
                        </div>
                     </div>
                  </div>
                  <div class="append_google_map"></div>
                  <div class="mb-3 row">
                     <label for="addmorhelpbutton" class="col-md-2 col-form-label"></label>
                     <div class="col-md-10">
                        <button type="button" onClick="add_map()" class="btn btn-primary">+Add More</button>
                     </div>
                  </div>
               </div>
               @endif
               <center>
                  <h2>
                  Address
                  <h2>
               </center>
               @if(isset($data))
               <div class="card-body">
                  <div class="append_address">
                     @foreach($data['address'] as $value)
                     <div class="address append-style">
                        <div class="mb-3 row">
                           <label for="address-0" class="col-md-2 col-form-label">Address<span class="text-danger">*</span></label>
                           <div class="col-md-10">
                              <textarea class="form-control" id="address-0" findex="1" name="address[]"required placeholder="Enter Address">{{isset($data)?$value:''}}</textarea>
                           </div>
                        </div>
                        <button class="btn btn-danger remove"><i class="mdi mdi-close-circle-outline"></i></button>
                     </div>
                     @endforeach
                  </div>
                  <div class="mb-3 row">
                     <label for="addmorhelpbutton" class="col-md-2 col-form-label"></label>
                     <div class="col-md-10">
                        <button type="button" onClick="add_address()" class="btn btn-primary">+Add More</button>
                     </div>
                  </div>
               </div>
               @else
               <div class="card-body">
                  <div class="address">
                     <div class="mb-3 row">
                        <label for="address-0" class="col-md-2 col-form-label">Address<span class="text-danger">*</span></label>
                        <div class="col-md-10">
                           <textarea class="form-control" id="address-0" findex="1" name="address[]"required placeholder="Add Address">{{isset($data)?$data->address:''}}</textarea>
                        </div>
                     </div>
                  </div>
                  <div class="append_address"></div>
                  <div class="mb-3 row">
                     <label for="addmorhelpbutton" class="col-md-2 col-form-label"></label>
                     <div class="col-md-10">
                        <button type="button" onClick="add_address()" class="btn btn-primary">+Add More</button>
                     </div>
                  </div>
               </div>
               @endif
               <div class="card-body">
                  <div class="mb-3 row">
                     <label class="col-md-2 col-form-label" for="status">Status</label>
                     <div class="col-md-10">
                        <select class="form-select" name="status">
                        <option @if(isset($data) && $data->status=='1') selected="selected" @endif value="1">Active</option>
                        <option @if(isset($data) && $data->status=='0') selected="selected" @endif value="0">Inactive</option>
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
               </div>
            </div>
         </form>
      </div>
      <!-- end col -->
   </div>
</div>
@endsection
@push('footer-section-code')
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
   
   // Help section image
   function helphideimage(section_id){
    $('#show_id_'+section_id).show();
    $('#hide_'+section_id).hide();
   }
    
</script>
{{--  For appending Social Link Section --}}
<script>
   function social_add(){
       var sindex = $('#sname-0').attr('findex');
       sindex=parseInt(sindex)+1;
       $('#sname-0').attr('findex',sindex);
       var social= '<div class="social append-style">';
           social += '<div class="mb-3 row">';
               social += ' <label for="sname-'+sindex+'" class="col-md-2 col-form-label">Social Link Name<span class="text-danger">*</span></label>';
               social += ' <div class="col-md-10">';
                   social += '<input class="form-control jvalidate" type="text"  name="web_social_tink_title[]" placeholder="Social Link Name" id="sname-'+sindex+'" required>';
                   social += '</div>';
                   social += '</div>';
                   social += '<div class="mb-3 row">';
                       social += '<label for="slink-'+sindex+'" class="col-md-2 col-form-label">Link Url<span class="text-danger">*</span></label>';
                       social += '<div class="col-md-10">';
                           social += ' <input class="form-control jvalidate" type="text" name="web_social_link[]" placeholder="Social Link" id="sname-'+sindex+'" required>';
                           social += '</div>';
                           social += '</div><button class="btn btn-danger remove"><i class="mdi mdi-close-circle-outline"></i></button>';
                           
                           social += '</div>';
   
   $('.append-social').append(social);
   }
   $("#form-validation").validate();
   $(document).on('click', '.remove', function () {
   $(this).parents('.social').remove();
   });
</script>
{{--  For appending Section Faq --}}
<script>
   function add_mobile(){
       var mindex= $('#mobile-0').attr('findex');
       mindex=parseInt(mindex)+1;
       $('#mobile-0').attr('findex',mindex);
       var mobile= '<div class="mobile append-style">';
            mobile += '<div class="mb-3 row">';
                mobile +='<label for="mobile-'+mindex+'" class="col-md-2 col-form-label">Mobile Number<span class="text-danger">*</span></label>';
                mobile +='<div class="col-md-10">';
                    mobile +='<input class="form-control jvalidate" findex="1" type="text" value="{{isset($faq_data)?$value->web_mobile:''}}" name="web_mobile[]" placeholder="Enter Mobile" id="mobile-'+mindex+'" required>';
                    mobile +='</div>';
                    mobile +='</div><button class="btn btn-danger remove"><i class="mdi mdi-close-circle-outline"></i></button>';
                    mobile +='</div>';
       $('.append-mobile').append(mobile);
   }
   $(document).on('click', '.remove', function () {
       $(this).parents('.mobile').remove();
   });
</script>

{{-- email --}}
<script>
    function add_email(){
        var mindex= $('#email-0').attr('findex');
        mindex=parseInt(mindex)+1;
        $('#email-0').attr('findex',mindex);
        var email= '<div class="email append-style">';
             email += '<div class="mb-3 row">';
                 email +='<label for="email-'+mindex+'" class="col-md-2 col-form-label">Email<span class="text-danger">*</span></label>';
                 email +='<div class="col-md-10">';
                     email +='<input class="form-control jvalidate" findex="1" type="text" value="{{isset($faq_data)?$value->web_email:''}}" name="web_email[]" placeholder="Enter email" id="email-'+mindex+'" required>';
                     email +='</div>';
                     email +='</div><button class="btn btn-danger remove"><i class="mdi mdi-close-circle-outline"></i></button>';
                     email +='</div>';
        $('.append-email').append(email);
    }
    $(document).on('click', '.remove', function () {
        $(this).parents('.email').remove();
    });
 </script>
<script>
   function add_pohne(){
       var phoneindex = $('#phone-0').attr('findex');
       phoneindex=parseInt(phoneindex)+1;
       $('#phone-0').attr('findex',phoneindex);
       var append_section = '<div class="phone append-style">';
        append_section +='<div class="mb-3 row">';
        append_section +='<label for="phone-'+phoneindex+'" class="col-md-2 col-form-label">Phone Number<span class="text-danger">*</span></label>';
        append_section +=' <div class="col-md-10">';
        append_section +='<input class="form-control" type="text" findex="1"  name="web_phone[]" placeholder="Enter Phone" id="phone-'+phoneindex+'" required>';
        append_section +='</div>';
        append_section +='</div><button class="btn btn-danger remove"><i class="mdi mdi-close-circle-outline"></i></button>';
        append_section +='</div>';
   $('.append_phone').append(append_section);
   }
   $(document).on('click', '.remove', function () {
   $(this).parents('.phone').remove();
   });
</script>
{{-- Address Section --}}
<script>
    function add_address(){
        var addressindex = $('#address-0').attr('findex');
        addressindex=parseInt(addressindex)+1;
        $('#address-0').attr('findex',addressindex);
        var append_section = '<div class="address append-style">';
                        append_section += '<div class="mb-3 row">';
                           append_section += '<label for="address-'+addressindex+'" class="col-md-2 col-form-label">Address<span class="text-danger">*</span></label>';
                           append_section += '<div class="col-md-10">';
                              append_section += '<textarea class="form-control" id="address-'+addressindex+'" findex="1" name="address[]"required placeholder="Enter Address"></textarea>';
                           append_section += '</div>';
                        append_section += '</div>';
                        append_section += '<button class="btn btn-danger remove"><i class="mdi mdi-close-circle-outline"></i></button>';
                     append_section += '</div>;';
    $('.append_address').append(append_section);
    }
    $(document).on('click', '.remove', function () {
    $(this).parents('.address').remove();
    });
 </script>
{{-- Mep Section --}}
<script>
   function add_map(){
       var hIndex = $('#google_map-0').attr('findex');
   hIndex=parseInt(hIndex)+1;
   $('#google_map-0').attr('findex',hIndex);
       var append_section='<div class="google_map append-style">';
        append_section +='<div class="mb-3 row">';
            append_section +='<label for="google_map-'+hIndex+'" class="col-md-2 col-form-label">Google Map code<span class="text-danger">*</span></label>';
            append_section +='<div class="col-md-10">';
                append_section +='<textarea class="form-control" id="google_map-'+hIndex+'" name="web_google_map[]"required placeholder="Enter Google map IFram Code"></textarea>';
                append_section +='</div>';
                append_section +='</div><button class="btn btn-danger remove"><i class="mdi mdi-close-circle-outline"></i></button>';
                        
                append_section +='</div>';
   
   $('.append_google_map').append(append_section);
   }
   $(document).on('click','.remove', function(){
   $(this).parents('.google_map').remove();
   });

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
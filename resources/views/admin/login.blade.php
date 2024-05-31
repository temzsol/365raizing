@php
$settings=App\Models\Websitesetting::find(1);
@endphp
<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title>Raizing Group || Login</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta content="Raizing Group" name="description" />
      <meta content="Raizing Group" name="Deepak" />
      <!-- App favicon -->
      <link rel="shortcut icon" href="{{url('/images/settings/logo.png')}}">
      <!-- Bootstrap Css -->
      <link href="{{url('/')}}/admin/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
      <!-- Icons Css -->
      <link href="{{url('/')}}/admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
      <!-- App Css-->
      <link href="{{url('/')}}/admin/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
      <style>
         body{
         background-color: grey;
         }
         .error_msg
         {
            color: red;
         }
      </style>
   </head>
   <body>
      <div class="account-pages my-5 pt-sm-5">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-md-8 col-lg-6 col-xl-5">
                  <div class="card overflow-hidden">
                     <div class="bg-primary bg-soft">
                        <div class="row">
                           <center>
                              <div class="col-12 align-self-end">
                                 <img src="{{url('/images/settings/'.$settings->web_logo)}}" alt="RR Web LOGO" class="img-fluid" height="50%" width="50%">
                              </div>
                           </center>
                        </div>
                     </div>
                     <div class="card-body pt-0">
                        <div class="p-2">
                           <form class="form-horizontal" id="loginform" method="post" action="{{route('login')}}">
                            @csrf
                              <div class="mb-3">
                                 <label for="username" class="form-label">User Email</label>
                                 <input type="text" class="form-control" id="email" name="email" placeholder="Enter username" required>
                              </div>
                              <div class="mb-3">
                                 <label class="form-label">Password</label>
                                 <div class="input-group auth-pass-inputgroup">
                                    <input type="password" name="password" class="form-control" id="loginpassword" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" required>
                                    <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                 </div>
                              </div>
                              <div class="mb-3">
                                 <label class="form-label">Account Type</label>
                                 <div class="input-group auth-pass-inputgroup">
                                    <select name="type" id="type" class="form-control">
                                       <option value="master_admin">Master Admin</option>
                                       <option value="admin">Admin</option>
                                       <option value="hr">HR</option>
                                       <option value="emp">Employee</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="mt-3 d-grid">
                                 <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                                </div>
                                <span class="error_msg" >
                                    @if($errors)
            @foreach ($errors->all() as $error)
            <div class="auth_login_modal_errors_error_container" style="">
                <i class="fa fa-asterisk" style=""></i>
                <span class="auth_login_modal_errors_error_text" style="">{{ $error }}</span>
            </div>
            @endforeach
        @endif 

                                </span>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="mt-5 text-center">
                     <div>
                        <p class="copywright">
                           © <script>document.write(new Date().getFullYear())</script> Raizing Group Develop <i class="mdi mdi-heart text-danger"></i> by TEMZ Pvt. Ltd.
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end account-pages -->
      <!-- JAVASCRIPT -->
      <script src="{{url('/')}}/admin/assets/libs/jquery/jquery.min.js"></script>
      <script src="{{url('/')}}/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="{{url('/')}}/admin/assets/libs/metismenu/metisMenu.min.js"></script>
      <script src="{{url('/')}}/admin/assets/libs/simplebar/simplebar.min.js"></script>
      <script src="{{url('/')}}/admin/assets/libs/node-waves/waves.min.js"></script>
      <!-- App js -->
      <script src="{{url('/')}}/admin/assets/js/app.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script>
         function login(){
             
         }
         
      </script>
      <script>
        $(document).ready(function() {
            $("#loginform").validate({
                rules: {
                    email: {
                        required: true,
                        maxlength: 35,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    }
                },
                messages: {
                    email: {
                        required: "Email Address is required.",
                        maxlength: "Your email must not be more than 35 characters long.",
                        email: "Please enter a valid email address."
                    },
                    password: {
                        required: "Please enter a password.",
                        minlength: "Password should be at least 8 characters long."
                    }
                },
               
            });
        });
    </script>
    
    
    
   </body>
</html>
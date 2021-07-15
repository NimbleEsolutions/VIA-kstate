  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>VIA Character | Register</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicons -->
    <link rel="shortcut icon" href="<?= base_url(); ?>/public/dist/img/via-asa-logo.png" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/toastr/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/dist/css/style.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style type="text/css">
      .input__text {
        padding-right: 0.5rem;
        padding-left: 0.5rem;
        padding-top: 0.95rem;
        padding-bottom: 0.95rem;
        border: none;
        box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
        color: #888888;
      }
      .login__form-input {
        margin-top: 0.5rem;
        box-sizing: border-box;
        width: 100%;
      }
      .login__form-label {
        color: #ffffff;
        font-weight: 700 !important;
        width: 100%;
        font-size: larger;
      }
      .login__forgot-link {
        float: right;
        color: #696767;
        text-decoration: underline;
        cursor: pointer;
      }
      .btn-primary,.btn-primary:hover,.btn-primary:active{
        background-color: #0a461f!important;
        border-color: #0a461f !important;
        color: #ffffff;
        border-radius: 2px;
      }
      .input-group>.form-control:focus {
        border: 2px solid #000000;
      }
      .img-panel{
        background-size: cover;
        background-repeat: no-repeat;
        text-align: center;
      }
      .login-panel{
        padding: 5%;padding-top: 10%;
      }
      .login__box{
       padding: 1rem;
       margin: 0px;
       height: 730px ;
       background-image: linear-gradient(140deg,#004872 0%,rgb(253 253 255 / 92%) 100%),url(<?= base_url() ?>/public/dist/img/landing-page-indus.jpg)!important;
       background-size: cover;
     }
     .card-body{
       box-shadow: none;
     }
     .company-details{
      position: absolute;
      bottom: 2rem;
      right: 1rem;
      font-size: larger;
      color: #000000;
    }
    .madatory{
     color: red;
     font-size: medium;
     font-weight: bold;
   }
   @media only screen and (max-width: 600px) {
    .img-panel {
      display: none !important;
    }
    .title-icon{
      width: 13% !important;
      padding: .9% !important;
      margin: 1%;
    }
    .company-details {
      position: absolute;
      bottom: 8.5rem;
      right: 1rem;
      font-size: medium;
      color: #000000;
    }
  }
</style>
</head>
<body class="hold-transition">
  <div class="row" style="border-bottom: 1px solid #cccccc;vertical-align: middle;margin: 0px;">
    <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
      <img class="title-icon" src="<?= base_url(); ?>/public/dist/img/via-asa-logo.png" style="width: 6%;padding: .4%;">
      <i class="fa fa-angle-right fa-lg"></i>
      <span style="font-size: large;font-weight: 600;padding-left: 1%;">Register As translator</span>
    </div>
  </div>
  <div class="login__box" style="height: 95vh;">
   <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Basic Details</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" id="createProfile" method="post" enctype="multipart/form-data" action="<?= site_url('register-as-translator'); ?>">
          <div class="card-body">
           <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
             <div class="form-group">
               <label>First Name <span class="madatory"> * </span></label>
               <input type="text" class="form-control" name="user_firstName" placeholder="Enter First Name">
             </div>
           </div>
           <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <div class="form-group">
             <label>Last Name <span class="madatory"> * </span></label>
             <input type="text" class="form-control" name="user_lastName" placeholder="Enter Last Name">
           </div>
         </div>
         <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
          <div class="form-group">
           <label>Date Of Birth <span class="madatory"> * </span></label>
           <input type="text" class="form-control dob" name="user_dob" placeholder="Selcet Date Of Birth" readonly="">
         </div>
       </div>
     </div>			        
     <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
         <label>Email Address <span class="madatory"> * </span></label>
         <input type="email" class="form-control" name="user_email" placeholder="Enter email">
       </div>
     </div>
     <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
      <div class="form-group">
       <label>Mobile No. <span class="madatory"> * </span></label>
       <input type="text" class="form-control" name="user_mobile" placeholder="Enter mobile">
     </div>
   </div>
   <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
     <div class="form-group">
       <label>Website <span class="madatory"> * </span></label>
       <input type="text" class="form-control" name="user_website" placeholder="Enter Website">
     </div>
   </div>
 </div>
 <div class="row">
  <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
   <div class="form-group">
     <label>Languages <span class="madatory"> * </span></label>
     <div class="row" id="checkLanguage">
      <?php foreach ($languages as $key) { ?>
        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
         <div class="form-check">
          <input class="form-check-input user_language" name="user_language[]" type="checkbox" value="<?= $key['lang_id']; ?>">
          <label class="form-check-label"><?= $key['lang_name']; ?></label>	
        </div>
      </div>
    <?php } ?>
  </div>
</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
  <div class="form-group">
   <label for="exampleInputFile">Upload CV <span class="madatory"> * </span></label>
   <div class="input-group">
    <div class="custom-file">
      <input type="file" name="user_cv">
    </div>			                      
  </div>
</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
  <div class="form-group">
   <label>Write about yourself as a writer/translator. <span class="madatory"> * </span></label>
   <textarea class="form-control" name="user_self" placeholder="Write about yourself as a writer/translator."></textarea> 
 </div>
</div>
</div>
<div class="form-check">
  <input type="checkbox" class="form-check-input" id="exampleCheck1" name="user_agreement" checked="">
  <label class="form-check-label" for="exampleCheck1">I have read & accepted <a href="#">confidentiality agreement</a></label>
</div>
</div>
<!-- /.card-body -->

<div class="card-footer">
  <button type="submit" class="btn btn-primary">Submit Details</button>
</div>
</form>
</div>
<!-- /.card -->

</div>
</div>
<p class="company-details" style="position: absolute;">For Karnataka Govt | <a href="https://suniltapse.com/" target="_blank">SUNILTAPSE.COM</a></p>
</div>
</div>
<!-- /.login-card-body -->
</div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url(); ?>/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/public/dist/js/adminlte.min.js"></script>
<!-- InputMask -->
<script src="<?= base_url(); ?>/public/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

<!-- jquery-validation -->
<script src="<?= base_url(); ?>/public/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url();?>/public/dist/js/jquery-ui.min.js"></script>

<script type="text/javascript">
  <?php if(isset($validation)): ?>
    toastr.error("Email or Password don't match");
  <?php endif; ?>
  <?php if(isset($success)): ?>
    toastr.success("<?php echo $success; ?>");
  <?php endif; ?>
  <?php if(isset($info)): ?>
    toastr.info("<?php echo $info; ?>");
  <?php endif; ?>
  <?php if(isset($error)): ?>
    toastr.error("<?php echo $error; ?>");
  <?php endif; ?>

$("#createProfile"). submit(function(){
  $('#checkLanguage').next('span').remove();
  var checked = $('.user_language:checkbox'). filter(':checked'). length;
  if (checked == 0){
    $("#checkLanguage").after("<span style='color:red;'>Check at least one language!.</span>");
    return false;
  }else{
    return true; // allow regular form submission
  }
});

$( ".dob" ).datepicker({
  maxDate : '-1d',
  defaultDate : "-26Y",
  dateFormat : 'yy-m-d',
  changeMonth: true,
  changeYear: true,
  yearRange : '1960:c'
});

$('#createProfile').validate({
  rules: {
   user_firstName: {
    required: true
  },
  user_lastName: {
    required: true
  },
  user_dob: {
    required: true
  },
  user_email: {
    required:true,
    email: true
  },
  user_language: {
    required:true
  },
  user_self: {
    required:true
  },
  user_mobile: {
    required:true,
    digits:true,
    minlength:10,
    maxlength:10
  },			
  user_cv: {
    required: true,
    extension: "pdf|doc"
  },
},
messages: {
  user_cv: {
    required: "Please select your cv.",
    extension: "Please upload valid file formats .pdf, .doc only."
  }
},
errorElement: 'span',
errorPlacement: function (error, element) {
  error.addClass('invalid-feedback');
  element.closest('.form-group').append(error);
},
highlight: function (element, errorClass, validClass) {
  $(element).addClass('is-invalid');
},
unhighlight: function (element, errorClass, validClass) {
  $(element).removeClass('is-invalid');
}
});
</script>
</body>
</html>

<!-- Main Footer -->
<footer class="main-footer">
	<!-- To the right -->
	<div class="float-right d-none d-sm-inline">
		<!-- Anything you want -->
	</div>
	<!-- Default to the left -->
	<strong>Copyright &copy; 2021-2022 <a href="https://nimble-esolutions.com/">Nimble e-Solutions</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url(); ?>/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/public/dist/js/adminlte.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/moment/moment.min.js"></script>
<!-- jquery-validation -->
<script src="<?= base_url(); ?>/public/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url(); ?>/public/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/toastr/toastr.min.js"></script>

<script type="text/javascript">
	$(window).on('load',function() {
      	$(".loader").fadeOut("slow");
  	});
  	
	$(document).ready(function () {
		<?php if(isset($success)): ?>
			toastr.success("<?php echo $success; ?>");
		<?php endif; ?>
		<?php if(isset($info)): ?>
			toastr.info("<?php echo $info; ?>");
		<?php endif; ?>
		<?php if(isset($error)): ?>
			toastr.error("<?php echo $error; ?>");
		<?php endif; ?>

		$(document).on('click','#import_users',function(){
			$('#import_profiles').toggle();
		});

		$(document).on('change','select[name="user_role_id"]',function(){
			var role_id = $("select[name='user_role_id']").val();
			$("select[name='up_mod_id']").val("");
			if(role_id == 5){
				$('#user_program').toggle();			
			}else{
				$('#user_program').hide();
			}
		});

		$('#approveRequest').on('show.bs.modal', function(e) {
			$(".loader").fadeIn();
            var trans_user_id = $(e.relatedTarget).data('id');
            $.post('<?= site_url() ?>User/user_language',{trans_user_id}, function(data){
            	$.post('<?= site_url() ?>User/language_data',{}, function(user_language){
					$('#checkLanguage').empty();
            		let result = data.map(({ tran_req_lang_id }) => tran_req_lang_id);
	            	$.each(user_language,function(k,v){
	            		if(jQuery.inArray(v.lang_id, result) !== -1){
		            		$('#checkLanguage').append('<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">'+
				         		'<div class="form-check">'+
				          			'<input class="form-check-input user_language" name="user_language[]" type="checkbox" value="'+v.lang_id+'" checked>'+
				          			'<label class="form-check-label">'+v.lang_name+'</label>'+	
				        		'</div>'+
				      		'</div>');
		            	}else{
		            		$('#checkLanguage').append('<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">'+
				         		'<div class="form-check">'+
				          			'<input class="form-check-input user_language" name="user_language[]" type="checkbox" value="'+v.lang_id+'">'+
				          			'<label class="form-check-label">'+v.lang_name+'</label>'+	
				        		'</div>'+
				      		'</div>');
		            	}
	            	});
            	},'json')
            },'json');
            $(e.currentTarget).find('input[name="trans_user_id"]').val(trans_user_id);
            $(".loader").fadeOut("slow");
        });

        $("#createTranslator"). submit(function(){
		  	$('#checkLanguage').next('span').remove();
		  	var checked = $('.user_language:checkbox'). filter(':checked'). length;
		  	if (checked == 0){
		    	$("#checkLanguage").after("<span style='color:red;'>Check at least one language!.</span>");
		    	return false;
		  	}else{
		    	return true; // allow regular form submission
		  	}
		});

		bsCustomFileInput.init();

		$('#createProfile').validate({
			rules: {
				user_firstName: {
					required: true
				},
				user_lastName: {
					required: true
				},
				user_email: {
					required:true,
					email: true
				},
				user_mobile: {
					required:true,
					digits:true,
					minlength:10,
					maxlength:10
				},
				user_role_id: {
					required: true
				},
				up_mod_id: {
					required: true
				},
				user_password: {
					required: true,
					minlength: 6
				},
				user_cfm_password: {
					required: true,
					equalTo:'input[name="user_password"]'
				},
				user_file: {
					required: true,
					extension: "xlsx|xls"
				}
			},
			messages: {
				user_file: {
					required: true,
					extension: "Please upload valid file formats .xlsx, .xls only."
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
	});
</script>
</body>
</html>

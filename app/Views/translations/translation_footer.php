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
	});

	$(document).on('change','select[name="translator_lang"]', function(){
		let trans_lang = $(this).val();
		$.post('<?= site_url('Translations/translation_for_language') ?>',{trans_lang},function(data){
			console.log(data);
		},'json');
		window.location.href = "<?= site_url('translations/via_definations') ?>";
	})
</script>
</body>
</html>

<?= view('home/dash_header'); 
use App\models\HomeModel;
use App\models\TranslationsModel;
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<!-- <h1>General Form</h1> -->
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= site_url('home') ?>">Home</a></li>
						<li class="breadcrumb-item active">VIA Definations</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- /.row -->
			<div class="row">
				<div class="col-md-12">
					<!-- general form elements disabled -->
					<div class="card card-default">
						<div class="card-header">
							<h3 class="card-title">VIA Definations </h3>
							<div class="card-tools">
								<select class="form-control" name="translator_lang">
									<?php foreach ($translator_lang as $lang) { 
										$lang_name = (new HomeModel())->getData(array('lang_id'=>$lang['tran_req_lang_id']),'kstate_language');
									?>
										<option value="<?= $lang['tran_req_lang_id']; ?>" <?php if(session()->get('trans_000_lang') == 2){ echo "selected"; } ?>><?= $lang_name[0]['lang_name']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body p-0">
							<form method="post" action="<?= site_url('translations/via_definations') ?>" enctype="">
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th style="width: 10px">#</th>
											<th></th>
											<th>English Language</th>
											<th style="width:50%;">Translation Language</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($character as $char) { 
											$lang_tarnslation = (new TranslationsModel())->where(array('char_trans_char_id'=>$char['char_sub_id'],'char_trans_lang_id'=>session()->get('trans_000_lang'),'char_trans_user_id'=>session()->get('id')))->findAll();
										?>

										<tr style="border-bottom: 2px solid;">
											<td rowspan="4" style="vertical-align: middle;">
												<?= $char['char_sub_id']; ?> 
												<input type="text" name="char_trans_char_id[]" class="form-control hidden" value="<?= $char['char_sub_id']; ?>">
											</td>
											<tr>
												<td>Name</td>
												<td><?= $char['char_name']; ?></td>
												<td style="padding: 0;"><input type="text" name="char_trans_name[]" class="form-control" value="<?php if(!empty($lang_tarnslation)){ echo $lang_tarnslation[0]['char_trans_name']; } ?>" style="border: none;height: calc(2.85rem + 2px);"></td>
											</tr>
											<tr>
												<td>Subtitle</td>
												<td><?= $char['char_subtitle']; ?></td>
												<td style="padding: 0;"><input type="text" name="char_trans_subtitle[]" class="form-control" value="<?php if(!empty($lang_tarnslation)){ echo $lang_tarnslation[0]['char_trans_subtitle']; } ?>" style="border: none;height: calc(2.85rem + 2px);"></td>
											</tr>
											<tr style="border-bottom: 2px solid;">
												<td style="vertical-align: middle;">Defination</td>
												<td><?= $char['char_definations']; ?></td>
												<td style="padding: 0;"><textarea name="char_trans_defination[]" rows="4" class="form-control" style="border: none;"><?php if(!empty($lang_tarnslation)){ echo $lang_tarnslation[0]['char_trans_defination']; } ?></textarea></td>
											</tr>
										</tr>
										<?php } ?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="4">
												<button type="submit" class="btn btn-md btn-primary" style="float: right;">Save Translation</button>
											</td>
										</tr>
									</tfoot>
								</table>
							</form>
						</div>
					</div>
					<!-- /.card -->
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= view('translations/translation_footer'); ?>
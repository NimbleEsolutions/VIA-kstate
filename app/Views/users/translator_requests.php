<?= view('home/dash_header'); 
	use App\models\HomeModel;
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
						<li class="breadcrumb-item active">Translator Requests</li>
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
							<h3 class="card-title">All Translator Requests</h3>
							<div class="card-tools">
							</div>
						</div>
						<!-- /.card-header -->
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Lang. Req.</th>
									<th>Name</th>
									<th>Contact</th>
									<th>About</th>
									<th style="text-align: center;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1;foreach (array_reverse($all_translator) as $key) {
									$requested_language = (new HomeModel())->getData(array('tran_req_trans_id'=>$key['trans_id']),'kstate_translator_request');
								?>
								<tr>
									<td><?= $i++; ?></td>
									<td>
										<?php $j = 1; foreach ($requested_language as $lang) {
											$lang_name = (new HomeModel())->getData(array('lang_id'=>$lang['tran_req_lang_id']),'kstate_language');
											if($j == 1){
												echo $lang_name[0]['lang_name'];
											}else{
												echo ", ".$lang_name[0]['lang_name'];
											}
											$j++;
										} ?>
											
									</td>
									<td><?= $key['trans_firstName']." ".$key['trans_lastName']; ?></td>
									<td><?= "<i class='fas fa-envelope-open'></i> ".$key['trans_email']; ?><br> <?= "<i class='fas fa-phone-square-alt'></i> ".$key['trans_mobile']; ?></td>
									<td><?= $key['trans_self']; ?></td>
									<td style="text-align: center;">
										<span class="btn btn-icon btn-xs"><i class="fa fa-cloud-download-alt" title="Download CV"></i></span>
										<?php if($key['trans_isDelete'] == 0 && $key['trans_user_id'] == NULL){ ?>
										<span type="button" class="btn btn-icon btn-xs" data-toggle="modal" data-target="#approveRequest" data-id="<?php echo $key['trans_id'] ?>"><i class="fa fas fa-chalkboard-teacher" title="Approve translator"></i></span>
										<?php } if($key['trans_isDelete'] == 2 && $key['trans_user_id'] != NULL){ ?>
										<span class="btn btn-danger btn-xs"><i class="fa fa-trash-alt" title="Delete Profile"></i></span>
										<span class="btn btn-icon btn-xs"><i class="fa fa-unlock-alt" title="Change Password"></i></span>
										<?php } ?>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<!-- /.card -->
				</div>
			</div>
			<div class="modal fade" id="approveRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
				    <div class="modal-content">
				    	<form role="form" id="createTranslator" method="post" enctype="multipart/form-data" action="<?= site_url('approve_request'); ?>">
				      	<div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Approve Translator Language Request</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
				      	</div>
				      	<div class="modal-body">
				      		<div class="form-group">
				      			<input type="text" name="trans_user_id" class="form-control hidden">
							</div>
				        	<div class="form-group">
						     	<!-- <label>Languages <span class="madatory"> * </span></label> -->
						     	<div class="row" id="checkLanguage">
						      	
						  		</div>
							</div>
				      	</div>
				      	<div class="modal-footer">
					        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
					        <button type="submit" class="btn btn-primary btn-sm">Approve Request</button>
				      	</div>
				      	</form>
				    </div>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= view('users/user_footer'); ?>
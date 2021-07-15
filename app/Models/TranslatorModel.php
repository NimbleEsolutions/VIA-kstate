<?php 
	namespace App\Models;
	use CodeIgniter\Model;

	class TranslatorModel extends Model
	{		
		protected $table = "kstate_translator";
		protected $primaryKey = 'trans_id';

    	protected $returnType     = 'array';
		protected $allowedFields = ['trans_user_id','trans_firstName','trans_lastName','trans_name','trans_mobile','trans_email','trans_dob','trans_website','trans_self','trans_password','trans_cv','trans_isDelete','trans_createdOn','trans_createdBy'];
	}
?>
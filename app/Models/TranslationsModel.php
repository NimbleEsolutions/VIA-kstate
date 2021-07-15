<?php 
	namespace App\Models;
	use CodeIgniter\Model;

	class TranslationsModel extends Model
	{		
		protected $table = "kstate_character_translator";
		protected $primaryKey = 'char_trans_id';

    	protected $returnType     = 'array';
		protected $allowedFields = ['char_trans_char_id','char_trans_user_id','char_trans_lang_id','char_trans_name','char_trans_subtitle','char_trans_defination','char_trans_status','char_trans_createdOn','char_trans_updatedOn'];
	}
?>
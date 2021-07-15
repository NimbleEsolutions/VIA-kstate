<?php 
	namespace App\Models;
	use CodeIgniter\Model;

	class CharacterModel extends Model
	{		
		protected $table = "kstate_character";
		protected $primaryKey = 'char_id';

    	protected $returnType     = 'array';
		protected $allowedFields = ['char_sub_id','char_language','char_name','char_subtitle','char_definations','char_isDelete','char_createdOn'];
	}
?>
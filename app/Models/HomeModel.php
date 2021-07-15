<?php 
	namespace App\Models;
	use CodeIgniter\Model;

	class HomeModel extends Model
	{
		protected $table = "kstate_user";
		protected $primaryKey = 'user_id';

    	protected $returnType     = 'array';
		protected $allowedFields = ['user_firstName','user_lastName','user_name','user_mobile','user_email','user_adhar_card','	user_pan_card','user_passport','user_password','user_role_id','user_vendor_id','user_createdOn','user_createdBy'];
		
		function getData($where,$table){
			$builder = $this->db->table($table);
			if(!empty($where)){
				$builder->where($where);
			}
			return $builder->get()->getResultArray();			
		}

		function insertData($data,$table){
			$builder = $this->db->table($table);
			$builder->insert($data);
			if ($this->db->affectedRows()) {
				return true;			
			}else{
				return false;
			}
		}

		function updateData($data,$table,$where){
			$builder = $this->db->table($table);
			$builder->set($data);
			$builder->where($where);
			$builder->update();
			return true;			
		}

		function orderByData($where,$table,$field,$order){
			$builder = $this->db->table($table);
			if(!empty($where)){
				$builder->where($where);
			}
			if(!empty($field) && !empty($order)){
				$builder->orderBy($field,$order);
			}
			return $builder->get()->getResultArray();			
		}

		function sendMail($mailTo,$subject,$message,$mailTitle) {	        
	        $email = \Config\Services::email();

	        $email->setTo($mailTo);
	        $email->setFrom('info@nimble-esolutions.com', 'Confirm Registration');
	        
	        $email->setSubject($subject);
	        $email->setMessage($message);

	        if ($email->send()) 
			{
	            echo 'Email successfully sent';
	        } 
			else 
			{
	            $data = $email->printDebugger(['headers']);
	            print_r($data);
	        }
	    }

	    public function uploadFiles($file,$folder)
	    {
	    	// print_r($file);die();
	        $validated = $this->validate([
	            'file' => [
	                'uploaded[file]',
	            ],
	        ]);	 
	        if ($validated) {
	            $fileDetails = $file;
	            $fileDetails->move('./public/dist/document/'.$folder.'',$file->getRandomName());
	 
	          $data = [	 
	            'name' =>  $fileDetails->getName(),
	            'type'  => $fileDetails->getClientMimeType()
	          ];
	          return $fileDetails->getName();
	        }
	    }

	}
?>
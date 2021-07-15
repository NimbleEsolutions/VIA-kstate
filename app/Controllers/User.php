<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use \App\Models\HomeModel;
use \App\Models\UserModel;
use \App\Models\TranslatorModel;
use PHPExcel;
use PHPExcel_IOFactory;

class User extends Controller
{
	function create_user_details()
	{
		$home = new HomeModel();
		$data = [
			"success"=>session()->getFlashdata('success'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),			
			"user_role" => (new HomeModel())->getData("role_id NOT IN(1,5,6) AND role_isValid = 0",'kstate_user_role'),
			"all_user" => (new HomeModel())->where("user_role_id NOT IN(1,5) AND user_isDelete = 0")->findAll(),	
		];

		if($this->request->getMethod() == 'post'){
			$user = [
				'user_firstName' => $this->request->getVar('user_firstName'),
				'user_middleName' => $this->request->getVar('user_middleName'),
				'user_lastName' => $this->request->getVar('user_lastName'),
				'user_email' => $this->request->getVar('user_email'),
				'user_mobile' => $this->request->getVar('user_mobile'),
				'user_role_id' => $this->request->getVar('user_role_id'),
				'user_password' => password_hash("".$this->request->getVar('user_password')."", PASSWORD_DEFAULT),
				'user_createdOn' => date('Y-m-d H:i:s'),
				'user_createdBy' => 1,
			];
			// print_r($user);die();
			(new UserModel())->save($user);
			$user_id = (new UserModel())->insertID();			
			session()->setFlashdata('success','User profile successfully created..!');
			return redirect()->route('user/create_user');
		}
		return view('users/create_user', $data);
	}

	function translator_request_details()
	{
		$home = new HomeModel();
		$data = [
			"success"=>session()->getFlashdata('success'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),			
			"user_role" => (new HomeModel())->getData("role_id NOT IN(1,5,6) AND role_isValid = 0",'kstate_user_role'),
			"all_translator" => (new HomeModel())->getData('trans_isDelete IN(0,2)','kstate_translator'),
			"all_language" => (new HomeModel())->getData(array('lang_isDelete'=>0),'kstate_language'),
		];
		return view('users/translator_requests', $data);
	}

	function approve_translator_request()
	{
		helper('text');
		if($this->request->getMethod() == 'post'){
			$user_details = (new TranslatorModel())->find($this->request->getVar('trans_user_id'));
			$random_pwd = random_string('alnum', 8);
			if (!empty($user_details) && $user_details['trans_user_id'] == NULL) {
				$user = [
					'user_firstName' => $user_details['trans_firstName'],
					'user_lastName' => $user_details['trans_lastName'],
					'user_email' => $user_details['trans_email'],
					'user_mobile' => $user_details['trans_mobile'],
					'user_role_id' => 5,
					'user_createdBy' => session()->get('id'),
					'user_password' => password_hash("translator@kstate", PASSWORD_DEFAULT),
					// 'user_password' => password_hash("".$random_pwd."", PASSWORD_DEFAULT),
				];
				(new UserModel())->save($user);
				$user_id = (new UserModel())->insertID();
				(new TranslatorModel())->update($this->request->getVar('trans_user_id'),array('trans_user_id'=>$user_id,'trans_isDelete'=>2));
			}
			for ($i=0; $i < count($this->request->getVar('user_language[]')); $i++) { 
				(new HomeModel())->updateData(array('tran_req_status'=>2,'tran_req_user_id'=>$user_id),'kstate_translator_request',array('tran_req_trans_id'=>$this->request->getVar('trans_user_id'),'tran_req_lang_id'=>$this->request->getVar('user_language['.$i.']'),'tran_req_status'=>0));
			}
			session()->setFlashdata('info','Approved Successfully.');
			return redirect()->route('user/translator_details');
		}
	}

	public function register_translator_details()
	{
		$data = [];
		helper(['form']);

		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"languages" => (new HomeModel())->getData(array('lang_isDelete'=>0),'kstate_language')
		];

		if($this->request->getMethod() == 'post'){
			$translator = [
				'trans_firstName' => $this->request->getVar('user_firstName'),
				'trans_middleName' => $this->request->getVar('user_middleName'),
				'trans_lastName' => $this->request->getVar('user_lastName'),
				'trans_email' => $this->request->getVar('user_email'),
				'trans_mobile' => $this->request->getVar('user_mobile'),
				'trans_dob' => $this->request->getVar('user_dob'),
				'trans_website' => $this->request->getVar('user_website'),
				'trans_self' => $this->request->getVar('user_self'),
				'trans_cv'=>(new HomeModel())->uploadFiles($this->request->getFile('user_cv'),'translator_cv'),
				'trans_createdOn' => date('Y-m-d H:i:s'),
			];
			(new TranslatorModel())->save($translator);
			$trans_id = (new TranslatorModel())->insertID();
			for ($i=0; $i < count($this->request->getVar('user_language[]')); $i++) { 
				$languages = [
					'tran_req_lang_id'=>$this->request->getVar('user_language['.$i.']'),
					'tran_req_trans_id'=>$trans_id,
					'tran_req_status'=>0,
					'tran_req_createdOn'=>date('Y-m-d H:i:s'),
				];
				(new HomeModel())->insertData($languages,'kstate_translator_request');
			}			
			session()->setFlashdata('success','Thank You..! Your CV uploaded successfully. Will get back to You.');
			return redirect()->route('login');
		}
		
		return view('home/register_translator', $data);
	}

	public function import_users_details()
	{
		helper('text');
		$home = new HomeModel();
		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),
			"vendor_details" => (new HomeModel())->where(array('user_role_id'=>4,'user_isDelete'=> 0))->findAll(),
			"all_user" => (new HomeModel())->where("user_role_id IN(5) AND user_isDelete = 0")->findAll(),	
		];

		if($this->request->getMethod() == 'post'){
			$file = $this->request->getFile('user_file');
			if($file){
				$excelReader  = new PHPExcel();
				//mengambil lokasi temp file
				$fileLocation = $file->getTempName();
				//baca file
				$objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
				$sheet	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
				$insertedRows = 0;
				$duplicateRows = 0;
				$rejectedRows = 0;
				foreach ($sheet as $key => $data) {
					// skip
					if ($key == 1) {
						continue;
					}
					$check_user = (new UserModel())->where(array('user_email'=>$data['D'],'user_isDelete'=>0))->findAll();
					if ($data['D'] == $check_user[0]['user_email']) {
						// print_r($check_user);
						$duplicateRows++;
						continue;
					}
					$insertedRows++;
					$random_pwd = random_string('alnum', 8);
					$userRecords = [
						'user_firstName' => $data['B'],
						'user_lastName' => $data['C'],
						'user_email' => $data['D'],
						'user_mobile' => $data['E'],
						'user_role_id' => 5,
						'user_vendor_id' => $this->request->getVar('vendor_id'),
						'user_password' => password_hash("".$random_pwd."", PASSWORD_DEFAULT),
						// 'user_password1' => random_string('alnum', 8),
					];
					if((new HomeModel())->insertData($userRecords,'jinlms_user')){
						$random_code = "".random_string('alnum', 32)."%20".random_string('alnum', 16)."%20".random_string('alnum', 8)."";
						$validUser = [
							'links_user_id' => (new HomeModel())->insertID(),
							'links_verifi_code' => $random_code,
							'links_gen_date' => date('Y-m-d'),
						];
						if((new HomeModel())->insertData($validUser,'jinlms_user_login_links')){
							$message = "Dear ".$data['B'].", <br>url:<a href='".base_url()."/login?q=".$random_code."' target='_blank'>".base_url()."/login?q=".$random_code."</a><br>UN : ".$data['D']." <br>PW : ".$random_pwd."<br><br>Thanks & Regards, <br> Monjin eLMS";
							(new HomeModel())->sendMail($data['D'],"Account Login Details",$message,'');
						}
					}else{
						$rejectedRows++;
					}
				}
			}
			session()->setFlashdata('info',"".$insertedRows." Records inserted successfully. & ".$duplicateRows." Records duplicate found & ".$rejectedRows." records not inserted.");
			return redirect()->route('user/import_users');
		}

		return view('users/import_users', $data);
	}

	function user_language()
	{
		$languages = (new HomeModel())->getData(array('tran_req_user_id'=>$_POST['trans_user_id']),'kstate_translator_request');
		echo json_encode($languages);
	}
	function language_data()
	{
		$all_languages = (new HomeModel())->getData(array('lang_isDelete'=>0),'kstate_language');
		echo json_encode($all_languages);
	}
}
?>
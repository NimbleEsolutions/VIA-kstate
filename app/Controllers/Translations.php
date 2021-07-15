<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use \App\Models\HomeModel;
use \App\Models\TranslationsModel;
use \App\Models\CharacterModel;

class Translations extends Controller
{
	function via_defination_translate()
	{
		$home = new HomeModel();
		$data = [
			"success"=>session()->getFlashdata('success'),
			"info"=>session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),	
			"character" => (new CharacterModel())->where(array('char_isDelete'=>0))->findAll(),	
			"translator_lang" => (new HomeModel())->getData(array('tran_req_status'=>2,'tran_req_user_id'=>session()->get('id')),'kstate_translator_request'),
		];		
		if(session()->get('trans_000_lang') == ''){
			session()->set('trans_000_lang',$data['translator_lang'][0]['tran_req_lang_id']);
		}
		if($this->request->getMethod() == 'post'){
			for ($i=0; $i < count($this->request->getVar('char_trans_char_id[]')); $i++) { 
				$translation = [
					'char_trans_char_id'=>$this->request->getVar('char_trans_char_id['.$i.']'),
					'char_trans_lang_id'=>session()->get('trans_000_lang'),
					'char_trans_user_id'=>session()->get('id'),
					'char_trans_name'=>$this->request->getVar('char_trans_name['.$i.']'),
					'char_trans_subtitle'=>$this->request->getVar('char_trans_subtitle['.$i.']'),
					'char_trans_defination'=>$this->request->getVar('char_trans_defination['.$i.']'),
					'char_trans_status'=>0,
				];
				$status = (new TranslationsModel())->where(array('char_trans_char_id'=>$translation['char_trans_char_id'],'char_trans_lang_id'=>session()->get('trans_000_lang'),'char_trans_user_id'=>session()->get('id')))->findAll();
				// print_r($status);
				if(empty($status)){
					(new TranslationsModel())->save($translation);
					echo "Insert".session()->get('trans_000_lang');
				}else{
					echo "Update".session()->get('trans_000_lang');
					(new TranslationsModel())->update(array('char_trans_id'=>$status[0]['char_trans_id']),array('char_trans_name'=>$translation['char_trans_name'],'char_trans_subtitle'=>$translation['char_trans_subtitle'],'char_trans_defination'=>$translation['char_trans_defination']));
				}
			}
			// die();
			session()->setFlashdata('info','Thank You..! Your translation has been updated..');
			return redirect()->route('translations/via_definations');
		}
		return view('translations/via_definations', $data);
	}

	function translation_for_language(){
		session()->set('trans_000_lang',$_POST['trans_lang']);
		echo json_encode($_POST['trans_lang']);
	}
}
?>
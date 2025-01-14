<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Js_config extends CI_Controller {

	public function index(){
		$js_config = array(
			'id_curso'              => $this->config->item('id_curso'),
			'base_url'              => $this->config->item('base_url'),
			'krismar_apps_url'      => $this->config->item('krismar_apps_url'),
			
			'logged_in'             => FALSE,
			'username'              => '',
			
			'ccdig'                 => FALSE,
			'ccdig_json_url'        => '',
			'ccdig_nivel_educativo' => ''
		);
		
		if($this->session->userdata('log_in')){
			$js_config['logged_in'] = TRUE;
			$js_config['username'] = $this->session->userdata('nombre');
		}
		echo json_encode($js_config);
	}
}

/* End of file js_config.php */
/* Location: ./application/controllers/js_config.php */

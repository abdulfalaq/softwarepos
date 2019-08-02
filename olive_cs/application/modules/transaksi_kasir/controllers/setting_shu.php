<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class setting_shu extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$data['konten'] = $this->load->view('setting_shu/setting_shu', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function edit_shu(){
		$data = $input = $this->input->post();
		$this->db->update('setting_shu',$data,array('id' =>$data['id']));

	}
}

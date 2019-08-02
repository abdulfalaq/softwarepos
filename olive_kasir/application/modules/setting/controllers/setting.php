<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class setting extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
           $data['konten'] = $this->load->view('setting', NULL, TRUE);
           $this->load->view ('admin/main', $data);
	}

	public function get_rupiah_modal_awal()
    {
        $modal_awal = $this->input->post('modal_awal');
        $hasil = format_rupiah($modal_awal);

        echo $hasil;
                         
    }

	public function edit_profile(){
		$data = $input = $this->input->post();
		$this->db->update('setting',$data,array('id' =>$data['id']));

	}
		
	public function logout()
	{
		$this->session->unset_userdata('astrosession');
		$this->session->sess_destroy();
		clearstatcache();
		redirect($this->cname);
	}

	
}

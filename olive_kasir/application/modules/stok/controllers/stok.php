<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class stok extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
        $this->db_master = $this->load->database('kan_master', TRUE);
	}

	public function index()
	{
           $data['konten'] = $this->load->view('stok', NULL, TRUE);
           $this->load->view ('admin/main', $data);
	}
	public function stok_bahan_baku()
    {
        $data['konten'] = $this->load->view('stok/stok/stok_bahan_baku', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function detail_bahan_baku()
    {
        $data['konten'] = $this->load->view('stok/stok/detail_bahan_baku', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function stok_barang_dalam_proses()
    {
        $data['konten'] = $this->load->view('stok/stok/stok_barang_dalam_proses', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function detail_barang_dalam_proses()
    {
        $data['konten'] = $this->load->view('stok/stok/detail_barang_dalam_proses', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function stok_barang_jadi()
    {
        $data['konten'] = $this->load->view('stok/stok/stok_barang_jadi', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function detail_barang_jadi()
    {
        $data['konten'] = $this->load->view('stok/stok/detail_barang_jadi', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
     public function stok_minimal()
    {
        $data['konten'] = $this->load->view('stok/stok/stok_minimal', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
     public function stok_out()
    {
        $data['konten'] = $this->load->view('stok/stok/stok_out', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
	
}

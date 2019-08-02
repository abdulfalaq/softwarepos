<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends MY_Controller {


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
		$data['konten'] = $this->load->view('supplier/pengajuan_supplier', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function tambah()
	{
		$data['konten'] = $this->load->view('supplier/pengajuan_supplier', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar()
	{
		$this->db_keuangan = $this->load->database('kan_keuangan', TRUE);
		$data['konten'] = $this->load->view('supplier/daftar_pengajuan', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function detail_pengajuan()
	{
		$this->db_keuangan = $this->load->database('kan_keuangan', TRUE);
		$data['konten'] = $this->load->view('supplier/detail_pengajuan', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function get_supplier()
	{
		$kode_supplier=$this->input->post('kode_supplier');
		if(!empty($kode_supplier)){
			$this->db_master->where('kode_supplier', $kode_supplier);
			$get_supplier=$this->db_master->get('master_supplier');
			$hasil_supplier=$get_supplier->row();

			echo json_encode($hasil_supplier);
		}
		
	}

	public function simpan_pengajuan()
	{

		$this->db_keuangan = $this->load->database('kan_keuangan', TRUE);

		$post = $this->input->post();

		$data['kategori_supplier']=$post['kategori_supplier'];
		$data['pengajuan_supplier']=$post['pengajuan_supplier'];

		$this->db_keuangan->select_max('id');
		$get_id=$this->db_keuangan->get('pengajuan_supplier');
		$max_id=$get_id->row();
		$no_urut=@get_kode($max_id->id,2);

		$kode_supplier="KAN/SP/".date('Y')."/".$no_urut;

		if($post['pengajuan_supplier']== 'baru'){
			$data['kode_supplier']=$kode_supplier;
			$data['nama_supplier']=$post['nama_supplier'];
		}elseif ($post['pengajuan_supplier']== 'lama') {

			$this->db_master->where('kode_supplier', $post['kode_supplier_lama']);
			$get_supplier=$this->db_master->get('master_supplier');
			$hasil_supplier=$get_supplier->row();

			$data['kode_supplier']=$post['kode_supplier_lama'];
			$data['nama_supplier']=$hasil_supplier->nama_supplier;
			$supplier_lama = @implode('|', @$post['supplier_tdk_bagus']);
			$data['supplier_lama'] = $supplier_lama;
			
		}

		$get_kode_unit = $this->db->get('setting')->row();

		$data['kode_unit_jabung']=@$get_kode_unit->kode_unit;
		$data['alamat_supplier']=$post['alamat_supplier'];
		$data['main_business']=$post['main_business'];
		$data['kontak_person']=$post['kontak_person'];
		$data['tanggal_pengajuan']=$post['tanggal_pengajuan'];

		$alasan_penambahan=@implode('|', @$post['alasan_penambahan']);
		$data['alasan_penambahan']=$alasan_penambahan;
		$data['keterangan_penambahan']=$post['keterangan_penambahan'];

		$dokumen_pendukung=@$post['dokumen_surat'].'|'.@$post['dokumen_company'].'|'.@$post['dokumen_referensi'].'|'.@$post['dokumen_contoh'];
		$data['dokumen_pendukung']=$dokumen_pendukung;

		

		$filename = substr(date("Y"),2,4).date("mdHis");
		if(!empty($_FILES['lampiran_surat']['tmp_name'])){
			move_uploaded_file(
				$_FILES['lampiran_surat']['tmp_name'],
				'./component/upload/uploads/'.'surat_penawaran'.$filename.'.'.pathinfo($_FILES['lampiran_surat']['name'], PATHINFO_EXTENSION)
			);
			$surat_penawaran =  'surat_penawaran'.$filename.'.'.pathinfo($_FILES['lampiran_surat']['name'], PATHINFO_EXTENSION);
		}
		if(!empty($_FILES['lampiran_company']['tmp_name'])){
			move_uploaded_file(
				$_FILES['lampiran_company']['tmp_name'],
				'./component/upload/uploads/'.'company_profile'.$filename.'.'.pathinfo($_FILES['lampiran_company']['name'], PATHINFO_EXTENSION)
			);
			$company_profile =  'company_profile'.$filename.'.'.pathinfo($_FILES['lampiran_company']['name'], PATHINFO_EXTENSION);
		}
		if(!empty($_FILES['lampiran_referensi']['tmp_name'])){
			move_uploaded_file(
				$_FILES['lampiran_referensi']['tmp_name'],
				'./component/upload/uploads/'.'referensi'.$filename.'.'.pathinfo($_FILES['lampiran_referensi']['name'], PATHINFO_EXTENSION)
			);
			$referensi =  'referensi'.$filename.'.'.pathinfo($_FILES['lampiran_referensi']['name'], PATHINFO_EXTENSION);
		}
		if(!empty($_FILES['lampiran_contoh']['tmp_name'])){
			move_uploaded_file(
				$_FILES['lampiran_contoh']['tmp_name'],
				'./component/upload/uploads/'.'contoh_barang'.$filename.'.'.pathinfo($_FILES['lampiran_contoh']['name'], PATHINFO_EXTENSION)
			);
			$contoh_barang =  'contoh_barang'.$filename.'.'.pathinfo($_FILES['lampiran_contoh']['name'], PATHINFO_EXTENSION);
		}

		$lampiran_dokumen=@$surat_penawaran.'|'.@$company_profile.'|'.@$referensi.'|'.@$contoh_barang;
		$data['lampiran_dokumen']=$lampiran_dokumen;
		
		$this->db_keuangan->insert('pengajuan_supplier', $data);

	}
	
}

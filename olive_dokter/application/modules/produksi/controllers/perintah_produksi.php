<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class perintah_produksi extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$data['konten'] = $this->load->view('perintah_produksi/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function tambah()
	{
		$data['konten'] = $this->load->view('perintah_produksi/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function daftar()
	{
		$data['konten'] = $this->load->view('perintah_produksi/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$data['konten'] = $this->load->view('perintah_produksi/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function get_temp()
	{
		$kode_produksi = $this->input->post('kode_produksi');
		$data['table_temp'] = $this->load->view('perintah_produksi/table_temp', NULL, TRUE);

		$this->db->where('kode_produksi', $kode_produksi);
		$get_temp = $this->db->get('opsi_transaksi_produksi_temp')->result();
		$data['jumlah_temp'] = count($get_temp);
		echo json_encode($data);
	}

	public function get_produk()
	{
		$this->db_master = $this->load->database('kan_master', TRUE);

		$get_setting=$this->db->get('setting');
		$hasil_setting=$get_setting->row();
		$kode_unit_jabung=@$hasil_setting->kode_unit;

		$jenis_produk=$this->input->post('jenis_produk');
		echo "<option value=''>- Pilih -</option>";
		if($jenis_produk=='BDP'){
			$this->db_master->where('kode_unit_jabung',$kode_unit_jabung);
			$get_produk=$this->db_master->get('master_barang_dalam_proses');
			$hasil_produk=$get_produk->result();
			foreach ($hasil_produk as $produk) {
				?>
				<option value="<?php echo $produk->kode_barang;?>"><?php echo $produk->nama_barang;?></option>
				<?php
			}
		}elseif ($jenis_produk=='Produk') {
			$this->db_master->where('kode_unit_jabung',$kode_unit_jabung);
			$get_produk=$this->db_master->get('master_produk');
			$hasil_produk=$get_produk->result();
			foreach ($hasil_produk as $produk) {
				?>
				<option value="<?php echo $produk->kode_produk;?>"><?php echo $produk->nama_produk;?></option>
				<?php
			}
		}
	}

	public function add_temp()
	{
		$post = $this->input->post();

		$this->db->where('kode_produksi', $post['kode_produksi']);
		$this->db->where('kode_bahan', $post['kode_bahan']);
		$get_temp = $this->db->get('opsi_transaksi_produksi_temp')->row();

		if(count($get_temp)==0){
			$this->db_master = $this->load->database('kan_master', TRUE);
			if($post['kategori_bahan'] == 'Produk'){
				$this->db_master->where('kode_produk', $post['kode_bahan']);
				$get_bahan = $this->db_master->get('master_produk')->row();
				$post['kode_satuan'] = $get_bahan->kode_satuan_stok;
			} else {
				$this->db_master->where('kode_barang', $post['kode_bahan']);
				$get_bahan = $this->db_master->get('master_barang_dalam_proses')->row();
				$post['kode_satuan'] = $get_bahan->kode_satuan_stok;
			}
			$get_setting = $this->db->get('setting')->row();

			$post['kode_unit_jabung'] = $get_setting->kode_unit;
			$this->db->insert('opsi_transaksi_produksi_temp', $post);
		} else{
			$update['jumlah'] = $get_temp->jumlah + $post['jumlah'];

			$this->db->where('kode_produksi', $post['kode_produksi']);
			$this->db->where('kode_bahan', $post['kode_bahan']);
			$this->db->update('opsi_transaksi_produksi_temp', $update);
		}
	}
	public function update_temp()
	{
		$post = $this->input->post();
		$id = $post['id_temp'];
		unset($post['id_temp']);

		$this->db->where('id_temp', $id);
		$this->db->update('opsi_transaksi_produksi_temp', $post);
	}
	public function delete_temp()
	{
		$post = $this->input->post();
		$id = $post['id_temp'];

		$this->db->where('id_temp', $id);
		$this->db->delete('opsi_transaksi_produksi_temp');
	}
	public function simpan_perintah_produksi()
	{
		$post = $this->input->post();
		$user = $this->session->userdata('astrosession');
		$get_setting = $this->db->get('setting')->row();

		$this->db->where('kode_produksi', $post['kode_produksi']);
		$get_temp = $this->db->get('opsi_transaksi_produksi_temp')->result_array();
		foreach ($get_temp as $temp) {
			unset($temp['id_temp']);
			$this->db->insert('opsi_transaksi_produksi', $temp);
		}

		$this->db->where('kode_produksi', $post['kode_produksi']);
		$this->db->delete('opsi_transaksi_produksi_temp');


		$post['status'] = 'menunggu';
		$post['kode_petugas'] = $user->kode_user;
		$post['kode_unit_jabung'] = $get_setting->kode_unit;
		$this->db->insert('transaksi_produksi', $post);
	}
}

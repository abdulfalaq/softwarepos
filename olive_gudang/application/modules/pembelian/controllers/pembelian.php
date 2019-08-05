<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pembelian extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$data['konten'] = $this->load->view('pembelian', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function detail()
	{
		$data['konten'] = $this->load->view('detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar_pembelian()
	{
		$data['konten'] = $this->load->view('pembelian/daftar_pembelian', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah()
	{
		$data['konten'] = $this->load->view('pembelian/pembelian/tambah', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function get_pembelian($kode){
		$data['kode'] = $kode ;
		$this->load->view('pembelian/pembelian/tabel_transaksi_temp',$data);
	}
	public function get_bahan()
	{
		$kategori_bahan = $this->input->post('kategori_bahan');

		if(@$kategori_bahan=='bahan baku'){
			$this->db->where('status', '1');
			$this->db->from('clouoid1_olive_master.master_bahan_baku');
			$get_bahan_baku=$this->db->get()->result();
			echo "<option value=''>- Pilih -</option>";
			foreach ($get_bahan_baku as $value) {
				?>
				<option value="<?php echo @$value->kode_bahan_baku;?>"><?php echo @$value->nama_bahan_baku;?></option>
				<?php
			}
		}elseif (@$kategori_bahan=='produk') {
			$this->db->where('status', '1');
			$this->db->from('clouoid1_olive_master.master_produk');
			$get_produk=$this->db->get()->result();
			echo "<option value=''>- Pilih -</option>";
			foreach ($get_produk as $value) {
				?>
				<option value="<?php echo @$value->kode_produk;?>"><?php echo @$value->nama_produk;?></option>
				<?php
			}
		}elseif (@$kategori_bahan=='perlengkapan') {
			$this->db->where('status', '1');
			$this->db->from('clouoid1_olive_master.master_perlengkapan');
			$get_perlengkapan=$this->db->get()->result();
			echo "<option value=''>- Pilih -</option>";
			foreach ($get_perlengkapan as $value) {
				?>
				<option value="<?php echo @$value->kode_perlengkapan;?>"><?php echo @$value->nama_perlengkapan;?></option>
				<?php
			}
		}elseif (@$kategori_bahan=='kartu member') {
			$this->db->from('clouoid1_olive_master.kartu_member');
			$get_kartu_member=$this->db->get()->row();
			?>
			<option value="<?php echo @$get_kartu_member->kode_kartu_member;?>"><?php echo @$get_kartu_member->nama_kartu_member;?></option>
			<?php
		}


	}
	public function get_satuan()
	{
		$kategori_bahan = $this->input->post('kategori_bahan');
		$kode_bahan = $this->input->post('kode_bahan');
		if(@$kategori_bahan=='bahan baku'){
			$this->db->where('kode_bahan_baku', $kode_bahan);
			$this->db->where('status', '1');
			$this->db->from('clouoid1_olive_master.master_bahan_baku');
			$this->db->join('clouoid1_olive_master.master_satuan', 'clouoid1_olive_master.master_bahan_baku.kode_satuan_stok = clouoid1_olive_master.master_satuan.kode', 'left');
			$get_bahan_baku=$this->db->get()->row();
			echo json_encode($get_bahan_baku);
		}elseif (@$kategori_bahan=='produk') {
			$this->db->where('kode_produk', $kode_bahan);
			$this->db->where('status', '1');
			$this->db->from('clouoid1_olive_master.master_produk');
			$this->db->join('clouoid1_olive_master.master_satuan', 'clouoid1_olive_master.master_produk.kode_satuan_stok = clouoid1_olive_master.master_satuan.kode', 'left');
			$get_produk=$this->db->get()->row();
			echo json_encode($get_produk);
		}elseif (@$kategori_bahan=='perlengkapan') {
			$this->db->where('kode_perlengkapan', $kode_bahan);
			$this->db->where('status', '1');
			$this->db->from('clouoid1_olive_master.master_perlengkapan');
			$this->db->join('clouoid1_olive_master.master_satuan', 'clouoid1_olive_master.master_perlengkapan.kode_satuan_stok = clouoid1_olive_master.master_satuan.kode', 'left');
			$get_perlengkapan=$this->db->get()->row();
			echo json_encode($get_perlengkapan);
		}elseif (@$kategori_bahan=='kartu member') {
			$this->db->where('kode_kartu_member', $kode_bahan);
			$this->db->from('clouoid1_olive_master.kartu_member');
			$get_kartu_member=$this->db->get()->row();
			echo json_encode($get_kartu_member);
		}

	}
	public function add_item_temp()
	{
		$jenis = $this->input->post('kategori_bahan');
		$kode_barang = $this->input->post('kode_barang');

		if($jenis!==""){
			$data['kode_bahan'] = $this->input->post('kode_bahan');
			$data['kode_pembelian'] = $this->input->post('kode_pembelian');
			$data['kategori_bahan'] = $this->input->post('kategori_bahan');
			$data['jumlah'] = $this->input->post('jumlah');
			$data['kode_satuan'] = $this->input->post('kode_satuan');
			$data['harga_satuan'] = $this->input->post('harga');
			$data['jenis_diskon'] = $this->input->post('jenis_diskon_item');
			$data['diskon_item'] = $this->input->post('diskon_item');
			$data['subtotal'] = $this->input->post('sub_total');
			$data['expired_date'] = $this->input->post('expired_date');

			$this->db->insert("opsi_transaksi_pembelian_temp",$data);

		}
	}
	public function hapus_bahan_temp(){
		$id = $this->input->post('id');
		$this->db->delete('opsi_transaksi_pembelian_temp',array('id'=>$id));
		
	}
	public function hapus_temp(){
		$kode_pembelian = $this->input->post('kode_pembelian');
		$this->db->query("DELETE FROM opsi_transaksi_pembelian_temp WHERE kode_pembelian='$kode_pembelian'");
	}
	public function get_temp_pembelian(){
		$id = $this->input->post('id');
		$this->db->select('nama');
		$this->db->select('nama_bahan_baku');
		$this->db->select('nama_perlengkapan');
		$this->db->select('nama_produk');
		$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.id');
		$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.jumlah');
		$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.expired_date');
		$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.harga_satuan');
		$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.jenis_diskon');
		$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.diskon_item');
		$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.subtotal');
		$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.kategori_bahan');

		$this->db->where('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.id',@$id);
		$this->db->from('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp');
		$this->db->join('clouoid1_olive_master.master_bahan_baku', 'clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.kode_bahan = clouoid1_olive_master.master_bahan_baku.kode_bahan_baku', 'left');
		$this->db->join('clouoid1_olive_master.master_produk', 'clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.kode_bahan = clouoid1_olive_master.master_produk.kode_produk', 'left');
		$this->db->join('clouoid1_olive_master.master_perlengkapan', 'clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.kode_bahan = clouoid1_olive_master.master_perlengkapan.kode_perlengkapan', 'left');
		$this->db->join('clouoid1_olive_master.master_satuan', 'clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.kode_satuan = clouoid1_olive_master.master_satuan.kode', 'left');
		$pembelian = $this->db->get();
		$list_pembelian = $pembelian->row();
		echo json_encode($list_pembelian);
	}
	public function update_item()
	{
		$data['expired_date'] = $this->input->post('expired_date');
		$data['jumlah'] = $this->input->post('jumlah');
		$data['jenis_diskon'] = $this->input->post('jenis_diskon');
		$data['diskon_item'] = $this->input->post('diskon_item');
		$data['subtotal'] = $this->input->post('subtotal');

		$this->db->where(array('id'=>$this->input->post('id')));
		$this->db->update('opsi_transaksi_pembelian_temp',$data);
	}
	public function get_grandtotal()
	{
		$kode_pembelian = $this->input->post('kode_pembelian');
		$diskon = $this->input->post('diskon');
		$jenis_diskon = $this->input->post('jenis_diskon');

		$this->db->select_sum('subtotal') ;
		$query = $this->db->get_where('opsi_transaksi_pembelian_temp',array('kode_pembelian'=>$kode_pembelian));
		$data = $query->row();

		if($jenis_diskon=='Persen'){
			$nilai_diskon=($data->subtotal * $diskon) / 100;
			$grand_total= ($data->subtotal - $nilai_diskon);
		}elseif ($jenis_diskon=='Rupiah') {
			$nilai_diskon=$diskon;
			$grand_total=($data->subtotal - $diskon);
		}
		$hasil = array('grand_total' => $grand_total,'nilai_diskon'=>@format_rupiah($nilai_diskon),'nilai_grand_total'=>@format_rupiah($grand_total),'nilai_pembelian'=>@format_rupiah($data->subtotal),'total_pembelian'=>@$data->subtotal);
		echo json_encode($hasil);
	}			
	public function get_kembali()
	{	
		$grand_total = $this->input->post('grand_total');
		$uang_muka = $this->input->post('uang_muka');
		$jenis_pembayaran = $this->input->post('jenis_pembayaran');
		if($jenis_pembayaran=='cash'){
			$kembalian=@$uang_muka - @$grand_total;
			if($kembalian < 0){
				$kembalian=0;
			}else{
				$kembalian=$uang_muka - $grand_total;
			}
			$hasil=array('nilai_kembali' => @format_rupiah($kembalian),'kembali'=> $kembalian,'nilai_uang_muka'=>@format_rupiah($uang_muka));
		}else{
			$hasil=array('nilai_kembali' => @format_rupiah($grand_total - $uang_muka),'nilai_uang_muka'=>@format_rupiah($uang_muka));
		}

		echo json_encode($hasil);
	}
	public function simpan_transaksi()
	{
		$this->db3 = $this->load->database('olive_keuangan', TRUE);

		$input = $this->input->post();
		$kode_pembelian = $input['kode_pembelian'];
		$tanggal_pembelian = $input['tanggal_pembelian'];
		$proses_bayar = $input['proses_pembayaran'];

		$get_id_petugas = $this->session->userdata('astrosession');
		$id_petugas = $get_id_petugas->id;
		$nama_petugas = $get_id_petugas->uname;

		$grand_total = $input['grand_total'];

		if($input['uang_muka'] < $grand_total && $proses_bayar != 'kredit'){
			echo '0|<div class="alert alert-danger">Periksa nilai pembayaran. '.$grand_total.'</div>';  
		}
		else{
			$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.kode_pembelian');
			$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.kategori_bahan');
			$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.kode_bahan');
			$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.jumlah');
			$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.expired_date');
			$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.kode_satuan');
			$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.harga_satuan');
			$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.jenis_diskon');
			$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.diskon_item');
			$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.subtotal');
			
			$this->db->select('clouoid1_olive_master.master_bahan_baku.real_stock as real_stock_bahan_baku');
			$this->db->select('clouoid1_olive_master.master_produk.real_stock as real_stock_produk');
			$this->db->select('clouoid1_olive_master.master_perlengkapan.real_stock as real_stock_perlengakapan');
			$this->db->select('clouoid1_olive_master.kartu_member.real_stock as real_stock_kartu_member');


			$this->db->where('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.kode_pembelian',@$kode_pembelian);
			$this->db->from('clouoid1_olive_gudang.opsi_transaksi_pembelian_temp');
			$this->db->join('clouoid1_olive_master.master_bahan_baku', 'clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.kode_bahan = clouoid1_olive_master.master_bahan_baku.kode_bahan_baku', 'left');
			$this->db->join('clouoid1_olive_master.master_produk', 'clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.kode_bahan = clouoid1_olive_master.master_produk.kode_produk', 'left');
			$this->db->join('clouoid1_olive_master.master_perlengkapan', 'clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.kode_bahan = clouoid1_olive_master.master_perlengkapan.kode_perlengkapan', 'left');
			$this->db->join('clouoid1_olive_master.kartu_member', 'clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.kode_bahan = clouoid1_olive_master.kartu_member.kode_kartu_member', 'left');
			$this->db->join('clouoid1_olive_master.master_satuan', 'clouoid1_olive_gudang.opsi_transaksi_pembelian_temp.kode_satuan = clouoid1_olive_master.master_satuan.kode', 'left');
			$pembelian_temp = $this->db->get();
			$list_pembelian_temp = $pembelian_temp->result();

			$total = 0;
			foreach ($list_pembelian_temp as $item){
				$data_opsi['kode_pembelian'] = $item->kode_pembelian;
				$data_opsi['kategori_bahan'] = $item->kategori_bahan;
				$data_opsi['kode_bahan'] = $item->kode_bahan;
				$data_opsi['jumlah'] = $item->jumlah;
				$data_opsi['kode_satuan'] = $item->kode_satuan;
				$data_opsi['harga_satuan'] = $item->harga_satuan;
				$data_opsi['jenis_diskon'] = $item->jenis_diskon;
				$data_opsi['diskon_item'] = $item->diskon_item;
				$data_opsi['subtotal'] = $item->subtotal;
				$data_opsi['expired_date'] = $item->expired_date;

				$tabel_opsi_transaksi_pembelian = $this->db->insert("opsi_transaksi_pembelian", $data_opsi);

				
				$harga_satuan = $item->harga_satuan;
				$stok_masuk = $item->jumlah;
				$kode_pembelian = $item->kode_pembelian;
				$kategori_bahan = $item->kategori_bahan;
				$kode_bahan = $item->kode_bahan;


				if($kategori_bahan=='bahan baku'){

					$data_stok['hpp']=@$item->harga_satuan;
					$data_stok['real_stock'] = @$item->jumlah  + @$item->real_stock_bahan_baku;
					$this->db->update('clouoid1_olive_master.master_bahan_baku',$data_stok,array('kode_bahan_baku'=>$item->kode_bahan));
				}
				else if($kategori_bahan=='produk'){

					$data_stok['hpp']=$item->harga_satuan;
					$data_stok['real_stock'] = @$item->jumlah  + @$item->real_stock_produk;
					$this->db->update('clouoid1_olive_master.master_produk',$data_stok,array('kode_produk'=>$item->kode_bahan));

				}
				else if($kategori_bahan=='perlengkapan')
				{

					$data_stok['hpp']=$item->harga_satuan;
					$data_stok['real_stock'] = @$item->jumlah  + @$item->real_stock_perlengakapan;
					$this->db->update('clouoid1_olive_master.master_perlengkapan',$data_stok,array('kode_perlengkapan'=>$item->kode_bahan));

				}
				else if($kategori_bahan=='kartu member')
				{

					$data_stok['hpp']=$item->harga_satuan;
					$data_stok['real_stock'] = @$item->jumlah  + @$item->real_stock_kartu_member;
					$this->db->update('clouoid1_olive_master.kartu_member',$data_stok,array('kode_kartu_member'=>$item->kode_bahan));

				}
				$stok['jenis_transaksi'] = 'pembelian' ;
				$stok['kode_transaksi'] = $kode_pembelian ;
				$stok['kategori_bahan'] = $kategori_bahan ;
				$stok['kode_bahan'] = $item->kode_bahan ;
				$stok['stok_keluar'] = '';
				$stok['stok_masuk'] = $item->jumlah ;
				$stok['posisi_awal'] = 'supplier';
				$stok['posisi_akhir'] = 'gudang';
				$stok['hpp'] = $harga_satuan ;
				$stok['sisa_stok'] = $item->jumlah ;
				$stok['id_petugas'] = $id_petugas;
				$stok['tanggal_transaksi'] = $tanggal_pembelian ;
				$stok['expired_date'] = $item->expired_date;
				$transaksi_stok = $this->db->insert("transaksi_stok", $stok);

			}

			if($transaksi_stok){
				unset($input['kategori_bahan']);
				unset($input['kode_bahan']);
				unset($input['nama_bahan']);
				unset($input['jumlah']);
				unset($input['kode_satuan']);
				unset($input['nama_satuan']);
				unset($input['harga_satuan']);
				unset($input['id_item']);


				if($input['proses_pembayaran'] == 'cash'){
					$query_akun = $this->db->get_where('clouoid1_olive_keuangan.keuangan_sub_kategori_akun',array('kode_sub_kategori_akun'=>'2.1.5'))->row();
				}else if($input['proses_pembayaran'] == 'kredit'){
					$query_akun = $this->db->get_where('clouoid1_olive_keuangan.keuangan_sub_kategori_akun',array('kode_sub_kategori_akun'=>'2.1.3'))->row();
				}

				$kode_sub = @$query_akun->kode_sub_kategori_akun;
				$nama_sub = @$query_akun->nama_sub_kategori_akun;
				$kode_kategori = @$query_akun->kode_kategori_akun;
				$nama_kategori = @$query_akun->nama_kategori_akun;
				$kode_jenis = @$query_akun->kode_jenis_akun;
				$nama_jenis = @$query_akun->nama_jenis_akun;


				unset($input['kode_sub']);
				$input['dibayar'] = $input['uang_muka'];

				unset($input['uang_muka']);
				unset($input['kode_perlengkapan']);
				unset($input['harga']);
				unset($input['id_item']);
				unset($input['expired_date']);
				unset($input['sub_total']);


				unset($input['kode_barang']);
				unset($input['satuan']);
				unset($input['jenis_diskon_item']);
				unset($input['diskon_item']);

				if($input['jenis_diskon'] == "Persen"){
					unset($input['jenis_diskon']);
					$input['diskon_persen'] = $input['diskon'];
					$input['diskon_rupiah'] = '';
				}else{
					unset($input['jenis_diskon']);
					$input['diskon_persen'] = '';
					$input['diskon_rupiah'] = $input['diskon'];
				}

				$input['tanggal_pembelian'] = $tanggal_pembelian ;
				$input['total_nominal'] = $grand_total ;
				$input['grand_total'] = $grand_total;
				$input['petugas'] = $nama_petugas ;
				$input['id_petugas'] = $id_petugas;
				$input['keterangan'] = '' ;
				$input['position'] = 'gudang' ;

				$transaksi['kode_pembelian'] = $this->input->post('kode_pembelian');
				$transaksi['tanggal_pembelian'] = $tanggal_pembelian;
				$transaksi['nomor_nota'] = $this->input->post('nomor_nota');
				$transaksi['kode_supplier'] = $input['kode_supplier'];

				$transaksi['total_nominal'] = $this->input->post('total_pembelian');
				if($this->input->post('jenis_diskon') == "Persen"){
					$transaksi['diskon_persen'] = $this->input->post('diskon');
				}else{
					$transaksi['diskon_rupiah'] = $this->input->post('diskon');
				}
				$transaksi['grand_total'] = $grand_total;

				$get_id_petugas = $this->session->userdata('astrosession');
				$id_petugas = $get_id_petugas->id;
				$nama_petugas = $get_id_petugas->uname;

				$transaksi['id_petugas'] = $id_petugas;

				$transaksi['proses_pembayaran'] = $this->input->post('proses_pembayaran');
				$transaksi['dibayar'] = $this->input->post('uang_muka');
				$transaksi['kembalian'] = $this->input->post('kembalian');
				$transaksi['tanggal_jatuh_tempo'] = $this->input->post('tanggal_jatuh_tempo');

				$tabel_transaksi_pembelian = $this->db->insert("transaksi_pembelian", $transaksi);

				if($tabel_transaksi_pembelian){
					if($input['proses_pembayaran'] == 'cash'){
						$data_keu['id_petugas'] = $id_petugas;
						$data_keu['kode_referensi'] = $kode_pembelian ;
						$data_keu['tanggal_transaksi'] = $tanggal_pembelian ;
						$data_keu['keterangan'] = 'pembelian' ;
						$data_keu['nominal'] = $grand_total ;
						$data_keu['kode_jenis_keuangan'] = $kode_jenis ;
						$data_keu['kode_kategori_keuangan'] = $kode_kategori ;
						$data_keu['kode_sub_kategori_keuangan'] = $kode_sub ;

						$keuangan = $this->db->insert("clouoid1_olive_keuangan.keuangan_keluar", $data_keu);
						$this->simpan_arus_kas('Pengeluaran',$kode_sub,'Pembelian Produk',$grand_total, $tanggal_pembelian);

					}
					else if($input['proses_pembayaran'] == 'debet'){
						$data_keu['id_petugas'] = $id_petugas;
						$data_keu['kode_referensi'] = $kode_pembelian ;
						$data_keu['tanggal_transaksi'] = $tanggal_pembelian ;
						$data_keu['keterangan'] = 'pembelian' ;
						$data_keu['nominal'] = $grand_total - $input['diskon_rupiah'];
						$data_keu['kode_jenis_keuangan'] = $kode_jenis ;
						$data_keu['kode_kategori_keuangan'] = $kode_kategori ;
						$data_keu['kode_sub_kategori_keuangan'] = $kode_sub ;

						$keuangan = $this->db->insert("clouoid1_olive_keuangan.keuangan_keluar", $data_keu);
						$this->simpan_arus_kas('Pengeluaran',$kode_sub,'Pembelian Produk',$grand_total, $tanggal_pembelian);

					}
					else if($input['proses_pembayaran'] == 'kredit'){
						$data_keu['id_petugas'] = $id_petugas;
						$data_keu['kode_referensi'] = $kode_pembelian ;
						$data_keu['tanggal_transaksi'] = $tanggal_pembelian ;
						$data_keu['keterangan'] = 'pembelian' ;
						$data_keu['nominal'] = @$input['dibayar'];
						$data_keu['kode_jenis_keuangan'] = $kode_jenis ;
						$data_keu['kode_kategori_keuangan'] = $kode_kategori ;
						$data_keu['kode_sub_kategori_keuangan'] = $kode_sub ;

						$keuangan = $this->db->insert("clouoid1_olive_keuangan.keuangan_keluar", $data_keu);

						$data_hutang['kode_transaksi'] = $kode_pembelian ;
						$data_hutang['kode_supplier'] = @$input['kode_supplier'];
						$data_hutang['nominal_hutang'] = ($grand_total) - @$input['dibayar'];
						$data_hutang['angsuran'] = '' ;
						$data_hutang['sisa'] = $grand_total  - @$input['dibayar'] ;
						$data_hutang['tanggal_transaksi'] = $tanggal_pembelian ;
						$data_hutang['id_petugas'] = $id_petugas;
						@$data_hutang['tanggal_jatuh_tempo'] = @$input['tanggal_jatuh_tempo'];

						$hutang = $this->db->insert("transaksi_hutang", $data_hutang);

					}
					$this->simpan_persediaan($kode_sub,'Persediaan',$grand_total,$tanggal_pembelian);
					$this->db->delete( 'opsi_transaksi_pembelian_temp', array('kode_pembelian' => $kode_pembelian) );
					echo '1|<div class="alert alert-success">Berhasil Melakukan Pembelian.</div>';  
				}
				else{
					echo '1|<div class="alert alert-danger">Gagal Melakukan Pembelian (Trx_pmbelian) .</div>';  
				}
			}
			else{
				echo '1|<div class="alert alert-danger">Gagal Melakukan Pembelian (update_stok).</div>';  
			}
		}
	}
	public function simpan_arus_kas($jenis_keuangan,$kode_kategori_keuangan,$nama_kategori_keuangan,$nominal,$tanggal){

		$bulan=date('m',strtotime($tanggal));
		$tahun=date('Y',strtotime($tanggal));
		$this->db3 = $this->load->database('olive_keuangan', TRUE);

		$get_laporan_arus_kas 	= $this->db3->get_where('laporan_arus_kas',array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		$hasil_laporan_arus_kas  = $get_laporan_arus_kas->row();
		if(!empty($hasil_laporan_arus_kas)){
			$update_arus_kas['nominal']=$hasil_laporan_arus_kas->nominal +$nominal;
			$this->db3->update('laporan_arus_kas',$update_arus_kas,array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		}else{

			$insert_arus_kas['jenis_keuangan']=$jenis_keuangan;
			$insert_arus_kas['kode_kategori_keuangan']=@$kode_kategori_keuangan;
			$insert_arus_kas['nama_kategori_keuangan']=@$nama_kategori_keuangan;
			$insert_arus_kas['nominal']=$nominal;
			$insert_arus_kas['tanggal']=$tanggal;
			$insert_arus_kas['bulan']=$bulan;
			$insert_arus_kas['tahun']=$tahun;
			$this->db3->insert('laporan_arus_kas',$insert_arus_kas);
		}
	}

	public function simpan_persediaan($kode_kategori_keuangan,$nama_kategori_keuangan,$nominal,$tanggal){

		$bulan=date('m',strtotime($tanggal));
		$tahun=date('Y',strtotime($tanggal));
		$this->db3 = $this->load->database('olive_keuangan', TRUE);

		$get_laporan_persediaan 	= $this->db3->get_where('laporan_persediaan',array('kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		$hasil_laporan_persediaan  = $get_laporan_persediaan->row();
		if(!empty($hasil_laporan_persediaan)){
			$update_persediaan['nominal']=$hasil_laporan_persediaan->nominal +$nominal;
			$this->db3->update('laporan_persediaan',$update_persediaan,array('kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		}else{

			$insert_persediaan['kode_kategori_keuangan']=@$kode_kategori_keuangan;
			$insert_persediaan['nama_kategori_keuangan']=@$nama_kategori_keuangan;
			$insert_persediaan['nominal']=$nominal;
			$insert_persediaan['tanggal']=$tanggal;
			$insert_persediaan['bulan']=$bulan;
			$insert_persediaan['tahun']=$tahun;
			$this->db3->insert('laporan_persediaan',$insert_persediaan);
		}
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kasir extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}

	}

	public function index()
	{	
		$petugas=$this->session->userdata('astrosession');
		$kode_petugas=@$petugas->id;

		$this->db->where('kode_kasir', $kode_petugas);
		$this->db->where('tanggal',date('Y-m-d'));
		$this->db->where('status','open');
		$this->db->where('validasi','');
		$cek_kasir=$this->db->get('transaksi_kasir')->row();
		if(!empty($cek_kasir)){

			$data['konten'] = $this->load->view('kasir', NULL, TRUE);
			$this->load->view ('admin/main', $data);
		}else{
			$data['konten'] = $this->load->view('tambah_kasir', NULL, TRUE);
			$this->load->view ('admin/main', $data);
		}
		
	}
	public function detail()
	{
		$data['konten'] = $this->load->view('detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function list_transaksi()
	{
		$data['konten'] = $this->load->view('list_transaksi', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function pendaftaran_layanan()
	{
		$data['konten'] = $this->load->view('pendaftaran_layanan', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tambah_kasir()
	{	
		
		$data['konten'] = $this->load->view('kasir', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function kasir_layanan()
	{	
		
		$data['konten'] = $this->load->view('kasir_layanan', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function tutup_kasir()
	{	
		$data['konten'] = $this->load->view('tutup_kasir', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function table_pesan_temp()
	{	
		$this->load->view('table_pesan_temp');
	}
	public function table_rekam_medis()
	{	
		$this->load->view('table_rekam_medis');
	}
	public function table_list_transaksi()
	{	
		$this->load->view('tabel_list_transaksi');
	}
	public function table_opsi_layanan()
	{	
		$this->load->view('table_opsi_layanan');
	}
	public function tabel_transaksi_poin()
	{	
		$this->load->view('tabel_transaksi_poin');
	}
	public function tabel_layanan_poin()
	{	
		$this->load->view('tabel_layanan_poin');
	}
	public function buka_kasir()
	{	
		$kode_transaksi=$this->input->post('kode_transaksi');
		$saldo_awal=$this->input->post('saldo_awal');

		$petugas=$this->session->userdata('astrosession');
		$kode_petugas=@$petugas->id;

		$this->db->where('kode_kasir', $kode_petugas);
		$this->db->where('status','open');
		$this->db->where('validasi','');
		$cek_kasir=$this->db->get('transaksi_kasir')->row();
		if(empty($cek_kasir)){
			$kasir['kode_transaksi']=$kode_transaksi;
			$kasir['kode_kasir']=$kode_petugas;
			$kasir['petugas']=$kode_petugas;
			$kasir['tanggal']=date('Y-m-d');
			$kasir['check_in']=date('H:i:s');
			$kasir['saldo_awal']=$saldo_awal;
			$kasir['status']='open';

			$this->db->insert('transaksi_kasir', $kasir);

			$hasil['respon']='sukses';
		}else{
			$hasil['respon']='gagal';
		}
		echo json_encode($hasil);
	}
	public function simpan_tutup_kasir()
	{	
		$kode_transaksi=$this->input->post('kode_transaksi');
		$saldo_akhir=$this->input->post('saldo_akhir');
		$saldo_awal=$this->input->post('saldo_awal');

		$petugas=$this->session->userdata('astrosession');
		$kode_petugas=@$petugas->id;

		$this->db->select_sum('grand_total');
		$get_transaksi=$this->db->get_where('transaksi_layanan', array('kode_kasir' => $kode_transaksi));
		$hasil_transaksi=$get_transaksi->row();

		$update['nominal_penjualan']=@$hasil_transaksi->grand_total;
		$update['saldo_sebenarnya']=@$hasil_transaksi->grand_total+@$saldo_awal;
		$update['saldo_akhir']=@$saldo_akhir;
		$update['selisih'] = abs($update['saldo_sebenarnya'] - @$saldo_akhir);
		$update['status'] = 'close';
		$update['check_out'] = date('H:i:s');

		$update=$this->db->update('transaksi_kasir', $update,array('kode_transaksi' =>$kode_transaksi,'kode_kasir' =>$kode_petugas));
		
		if($update){
			$hasil['respon']='sukses';
		}else{
			$hasil['respon']='gagal';
		}
		echo json_encode($hasil);
	}
	public function get_data_member()
	{	
		$kode_member=$this->input->post('kode_member');
		$this->db->where('kode_member', $kode_member);
		$this->db->from('clouoid1_olive_master.master_member');
		$get_member=$this->db->get()->row();
		echo json_encode($get_member);
	}
	public function get_data_produk()
	{	
		$kode_produk=$this->input->post('kode_menu');
		$this->db->where('kode_produk', $kode_produk);
		$this->db->from('clouoid1_olive_master.master_produk');
		$this->db->join('clouoid1_olive_master.master_kategori_produk', 'clouoid1_olive_master.master_produk.kode_kategori_produk = clouoid1_olive_master.master_kategori_produk.kode_kategori_produk', 'left');
		$get_produk=$this->db->get()->row();
		echo json_encode($get_produk);
	}
	public function gunakan_poin_member()
	{	
		$id=$this->input->post('id');
		$kode_member=$this->input->post('kode_member');
		$kode_transaksi=$this->input->post('kode_transaksi');

		$kode_member=$this->input->post('kode_member');
		$this->db->where('kode_member', $kode_member);
		$this->db->from('clouoid1_olive_master.master_member');
		$get_member=$this->db->get()->row();

		$this->db->where('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.id', $id);
		$this->db->from('clouoid1_olive_master.master_produk');
		$this->db->join('clouoid1_olive_kasir.opsi_transaksi_layanan_temp', 'clouoid1_olive_master.master_produk.kode_produk = clouoid1_olive_kasir.opsi_transaksi_layanan_temp.kode_item', 'left');
		$get_data=$this->db->get()->row();
		
		$this->db->select_sum('poin_terpakai');
		$this->db->where('kode_transaksi', $kode_transaksi);
		$total_poin_temp=$this->db->get('clouoid1_olive_kasir.opsi_transaksi_layanan_temp')->row();
		

		$poin_member=$get_member->poin - @$total_poin_temp->poin_terpakai;
		if(@$poin_member < @$get_data->redeem_poin || $poin_member <0){
			$hasil['respon']='gagal';
		}elseif (($get_data->qty_poin +1) > $get_data->qty) {
			$hasil['respon']='qty_kurang';
		}else{
			$opsi['poin_terpakai']=@$get_data->poin_terpakai + @$get_data->redeem_poin;
			$opsi['qty_poin']=@$get_data->qty_poin +1;
			$opsi['subtotal']=@$get_data->subtotal - @$get_data->harga;
			$this->db->update('clouoid1_olive_kasir.opsi_transaksi_layanan_temp', $opsi, array('id' =>$id));
			$hasil['respon']='sukses';
		}


		echo json_encode($hasil);
	}
	public function gunakan_poin_member_opsi()
	{	
		$id=$this->input->post('id');
		$kode_member=$this->input->post('kode_member');
		$kode_transaksi=$this->input->post('kode_transaksi');

		$kode_member=$this->input->post('kode_member');
		$this->db->where('kode_member', $kode_member);
		$this->db->from('clouoid1_olive_master.master_member');
		$get_member=$this->db->get()->row();

		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.qty');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.subtotal');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.poin_terpakai');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.qty_poin');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.harga');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.jenis_item');
		$this->db->select('clouoid1_olive_master.master_produk.redeem_poin as redeem_poin_produk');
		$this->db->select('clouoid1_olive_master.master_perawatan.redeem_poin as redeem_poin_perawatan');
		$this->db->where('clouoid1_olive_kasir.opsi_transaksi_layanan.id', $id);
		$this->db->from('clouoid1_olive_kasir.opsi_transaksi_layanan');
		$this->db->join('clouoid1_olive_master.master_produk', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item = clouoid1_olive_master.master_produk.kode_produk', 'left');
		$this->db->join('clouoid1_olive_master.master_perawatan', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item = clouoid1_olive_master.master_perawatan.kode_perawatan', 'left');
		$get_data=$this->db->get()->row();
		$this->db->select_sum('poin_terpakai');
		$this->db->where('kode_transaksi', $kode_transaksi);
		$total_poin_temp=$this->db->get('clouoid1_olive_kasir.opsi_transaksi_layanan')->row();
		
		if(@$get_data->jenis_item=='Treatment'){
			$redeem_poin=@$get_data->redeem_poin_perawatan;
		}else{
			$redeem_poin=@$get_data->redeem_poin_produk;
		}
		$poin_member=$get_member->poin - @$total_poin_temp->poin_terpakai;
		if(@$poin_member < @$redeem_poin || $poin_member <0){
			$hasil['respon']='gagal';
		}elseif (($get_data->qty_poin +1) > $get_data->qty) {
			$hasil['respon']='qty_kurang';
		}else{
			$opsi['poin_terpakai']=@$get_data->poin_terpakai + @$redeem_poin;
			$opsi['qty_poin']=@$get_data->qty_poin +1;
			$opsi['subtotal']=@$get_data->subtotal - @$get_data->harga;
			$this->db->update('clouoid1_olive_kasir.opsi_transaksi_layanan', $opsi, array('id' =>$id));
			$hasil['respon']='sukses';
		}


		echo json_encode($hasil);
	}
	public function get_data_layanan()
	{	
		$kode_perawatan=$this->input->post('kode_menu_layanan');
		$this->db->where('kode_perawatan', $kode_perawatan);
		$this->db->from('clouoid1_olive_master.master_perawatan');
		$get_perawatan=$this->db->get()->row();
		echo json_encode($get_perawatan);
	}
	public function simpan_pesanan_temp()
	{	
		$kode_transaksi=$this->input->post('kode_transaksi');
		$kode_menu=$this->input->post('kode_menu');
		$qty=$this->input->post('qty');
		$harga=$this->input->post('harga');
		$jenis_diskon=$this->input->post('jenis_diskon');
		$diskon_item=$this->input->post('diskon_item');
		$kode_terapis=$this->input->post('kode_terapis');
		$jenis_item=$this->input->post('jenis_item');

		$this->db->where('kode_produk', $kode_menu);
		$this->db->from('clouoid1_olive_master.master_produk');
		$this->db->join('clouoid1_olive_master.master_kategori_produk', 'clouoid1_olive_master.master_produk.kode_kategori_produk = clouoid1_olive_master.master_kategori_produk.kode_kategori_produk', 'left');
		$get_produk=$this->db->get()->row();
		
		if(@$qty <= @$get_produk->real_stock){
			if(@$jenis_diskon=='persen'){
				$nominal_diskon=(($qty * $harga) * $diskon_item) /100;
				$subtotal=($qty * $harga)-$nominal_diskon;
				$data['diskon_persen']=$diskon_item;
			}else{
				$nominal_diskon=$diskon_item;
				$subtotal=($qty * $harga)-$nominal_diskon;
				$data['diskon_rupiah']=$diskon_item;
			}
			$data['kode_transaksi']=$kode_transaksi;
			$data['kode_terapis']=$kode_terapis;
			$data['jenis_item']=$jenis_item;
			$data['kode_item']=$kode_menu;
			$data['qty']=$qty;
			$data['hpp']=$get_produk->hpp;
			$data['harga']=$harga;
			$data['jenis_diskon']=$jenis_diskon;
			$data['subtotal']=$subtotal;
			$this->db->insert('opsi_transaksi_layanan_temp', $data);

			$hasil['respon']='sukses';
		}else{
			$hasil['respon']='gagal';
		}
		echo json_encode($hasil);
		
	}
	public function simpan_pesanan_opsi()
	{	
		$kode_transaksi=$this->input->post('kode_transaksi');
		$kode_menu=$this->input->post('kode_menu');
		$qty=$this->input->post('qty');
		$harga=$this->input->post('harga');
		$jenis_diskon=$this->input->post('jenis_diskon');
		$diskon_item=$this->input->post('diskon_item');
		$kode_terapis=$this->input->post('kode_terapis');
		$jenis_item=$this->input->post('jenis_item');

		$this->db->where('kode_produk', $kode_menu);
		$this->db->from('clouoid1_olive_master.master_produk');
		$this->db->join('clouoid1_olive_master.master_kategori_produk', 'clouoid1_olive_master.master_produk.kode_kategori_produk = clouoid1_olive_master.master_kategori_produk.kode_kategori_produk', 'left');
		$get_produk=$this->db->get()->row();
		
		if(@$qty <= @$get_produk->real_stock){
			if(@$jenis_diskon=='persen'){
				$nominal_diskon=(($qty * $harga) * $diskon_item) /100;
				$subtotal=($qty * $harga)-$nominal_diskon;
				$data['diskon_persen']=$diskon_item;
			}else{
				$nominal_diskon=$diskon_item;
				$subtotal=($qty * $harga)-$nominal_diskon;
				$data['diskon_rupiah']=$diskon_item;
			}
			$data['kode_transaksi']=$kode_transaksi;
			$data['kode_terapis']=$kode_terapis;
			$data['jenis_item']=$jenis_item;
			$data['kode_item']=$kode_menu;
			$data['qty']=$qty;
			$data['hpp']=$get_produk->hpp;
			$data['harga']=$harga;
			$data['jenis_diskon']=$jenis_diskon;
			$data['subtotal']=$subtotal;
			$this->db->insert('opsi_transaksi_layanan', $data);

			$hasil['respon']='sukses';
		}else{
			$hasil['respon']='gagal';
		}
		echo json_encode($hasil);
		
	}
	public function simpan_layanan()
	{	
		$kode_transaksi=$this->input->post('kode_transaksi');
		$kode_menu=$this->input->post('kode_menu');
		$qty=$this->input->post('qty');
		$harga=$this->input->post('harga');
		$jenis_diskon=$this->input->post('jenis_diskon');
		$diskon_item=$this->input->post('diskon_item');
		$kode_terapis=$this->input->post('kode_terapis');
		$jenis_item=$this->input->post('jenis_item');

		$this->db->where('kode_perawatan', $kode_menu);
		$this->db->from('clouoid1_olive_master.master_perawatan');
		$get_perawatan=$this->db->get()->row();
		
		if(@$jenis_diskon=='persen'){
			$nominal_diskon=(($qty * $harga) * $diskon_item) /100;
			$subtotal=($qty * $harga)-$nominal_diskon;
			$data['diskon_persen']=$diskon_item;
		}else{
			$nominal_diskon=$diskon_item;
			$subtotal=($qty * $harga)-$nominal_diskon;
			$data['diskon_rupiah']=$diskon_item;
		}
		$data['kode_transaksi']=$kode_transaksi;
		$data['kode_terapis']=$kode_terapis;
		$data['jenis_item']='Treatment';
		$data['kode_item']=$kode_menu;
		$data['qty']=$qty;
		$data['hpp']=$get_perawatan->hpp;
		$data['harga']=$harga;
		$data['jenis_diskon']=$jenis_diskon;
		$data['subtotal']=$subtotal;
		$this->db->insert('opsi_transaksi_layanan', $data);

		$hasil['respon']='sukses';
		
		echo json_encode($hasil);
		
	}
	public function simpan_kartu_member()
	{	
		$kode_transaksi=$this->input->post('kode_transaksi');
		$kode_member=$this->input->post('kode_member');

		$this->db->from('clouoid1_olive_master.kartu_member');
		$get_produk=$this->db->get()->row();

		$this->db->where('kode_member', $kode_member);
		$this->db->from('clouoid1_olive_master.master_member');
		$get_member=$this->db->get()->row();
		
		if(@$get_produk->real_stock >=1){
			
			$data['kode_transaksi']=@$kode_transaksi;
			$data['jenis_item']='kartu member';
			$data['kode_item']=@$get_produk->kode_kartu_member;
			$data['qty']=1;
			$data['hpp']=@$get_produk->hpp;
			if($get_member->afiliasi=='Event'){
				$data['harga']=@$get_produk->harga_event;
				$data['subtotal']=@$get_produk->harga_event;
			}else{
				$data['harga']=@$get_produk->harga_member;
				$data['subtotal']=@$get_produk->harga_member;
			}
			$data['jenis_diskon']='persen';
			
			$this->db->insert('opsi_transaksi_layanan_temp', $data);

			
			$this->db->where('kode_member', $kode_member);
			$this->db->set('kategori_member','Member');
			$this->db->from('clouoid1_olive_master.master_member');
			$this->db->update();
			$hasil['respon']='sukses';
		}else{
			$hasil['respon']='gagal';
		}
		echo json_encode($hasil);
		
	}
	public function delete_kartu_member()
	{	
		$kode_transaksi=$this->input->post('kode_transaksi');
		$kode_member=$this->input->post('kode_member');

		$this->db->delete('opsi_transaksi_layanan_temp',array('kode_transaksi' => $kode_transaksi,'jenis_item' => 'kartu member'));

		$this->db->where('kode_member', $kode_member);
		$this->db->set('kategori_member','Non Member');
		$this->db->from('clouoid1_olive_master.master_member');
		$this->db->update();
	}
	public function simpan_kartu_member_layanan()
	{	
		$kode_transaksi=$this->input->post('kode_transaksi');
		$kode_member=$this->input->post('kode_member');

		$this->db->from('clouoid1_olive_master.kartu_member');
		$get_produk=$this->db->get()->row();

		$this->db->where('kode_member', $kode_member);
		$this->db->from('clouoid1_olive_master.master_member');
		$get_member=$this->db->get()->row();
		
		if(@$get_produk->real_stock >=1){
			
			$data['kode_transaksi']=@$kode_transaksi;
			$data['jenis_item']='kartu member';
			$data['kode_item']=@$get_produk->kode_kartu_member;
			$data['qty']=1;
			$data['hpp']=@$get_produk->hpp;
			if($get_member->afiliasi=='Event'){
				$data['harga']=@$get_produk->harga_event;
				$data['subtotal']=@$get_produk->harga_event;
			}else{
				$data['harga']=@$get_produk->harga_member;
				$data['subtotal']=@$get_produk->harga_member;
			}
			$data['jenis_diskon']='persen';
			
			$this->db->insert('opsi_transaksi_layanan', $data);

			
			$this->db->where('kode_member', $kode_member);
			$this->db->set('kategori_member','Member');
			$this->db->from('clouoid1_olive_master.master_member');
			$this->db->update();
			$hasil['respon']='sukses';
		}else{
			$hasil['respon']='gagal';
		}
		echo json_encode($hasil);
		
	}
	public function delete_kartu_member_layanan()
	{	
		$kode_transaksi=$this->input->post('kode_transaksi');
		$kode_member=$this->input->post('kode_member');

		$this->db->delete('opsi_transaksi_layanan',array('kode_transaksi' => $kode_transaksi,'jenis_item' => 'kartu member'));

		$this->db->where('kode_member', $kode_member);
		$this->db->set('kategori_member','Non Member');
		$this->db->from('clouoid1_olive_master.master_member');
		$this->db->update();
	}
	public function hapus_temp()
	{	
		$id=$this->input->post('id');
		$this->db->delete('opsi_transaksi_layanan_temp',array('id' => $id));
	}
	public function hapus_opsi()
	{	
		$id=$this->input->post('id');
		$this->db->delete('opsi_transaksi_layanan',array('id' => $id));
	}
	public function get_data_temp()
	{	
		$id=$this->input->post('id');
		$get_temp=$this->db->get_where('opsi_transaksi_layanan_temp',array('id' => $id))->row();
		echo json_encode($get_temp);
	}
	public function get_data_opsi()
	{	
		$id=$this->input->post('id');
		$get_temp=$this->db->get_where('opsi_transaksi_layanan',array('id' => $id))->row();
		echo json_encode($get_temp);
	}
	public function update_pesanan_temp()
	{	
		$id=$this->input->post('id_temp');
		$kode_menu=$this->input->post('kode_menu');
		$qty=$this->input->post('qty');
		$harga=$this->input->post('harga');
		$jenis_diskon=$this->input->post('jenis_diskon');
		$diskon_item=$this->input->post('diskon_item');
		$kode_terapis=$this->input->post('kode_terapis');
		$jenis_item=$this->input->post('jenis_item');

		$this->db->where('kode_produk', $kode_menu);
		$this->db->from('clouoid1_olive_master.master_produk');
		$this->db->join('clouoid1_olive_master.master_kategori_produk', 'clouoid1_olive_master.master_produk.kode_kategori_produk = clouoid1_olive_master.master_kategori_produk.kode_kategori_produk', 'left');
		$get_produk=$this->db->get()->row();
		if(@$qty <= @$get_produk->real_stock){
			if(@$jenis_diskon=='persen'){
				$nominal_diskon=(($qty * $harga) * $diskon_item) /100;
				$subtotal=($qty * $harga)-$nominal_diskon;
				$data['diskon_persen']=$diskon_item;
			}else{
				$nominal_diskon=$diskon_item;
				$subtotal=($qty * $harga)-$nominal_diskon;
				$data['diskon_rupiah']=$diskon_item;
			}
			$data['kode_terapis']=$kode_terapis;
			$data['jenis_item']=$jenis_item;
			$data['kode_item']=$kode_menu;
			$data['qty']=$qty;
			$data['hpp']=$get_produk->hpp;
			$data['harga']=$harga;
			$data['jenis_diskon']=$jenis_diskon;
			$data['subtotal']=$subtotal;
			$data['qty_poin']='';
			$data['poin_terpakai']='';
			$this->db->update('opsi_transaksi_layanan_temp', $data,array('id' =>$id));
			$hasil['respon']='sukses';
		}else{
			$hasil['respon']='gagal';
		}
		echo json_encode($hasil);
	}
	public function update_pesanan_opsi()
	{	
		$id=$this->input->post('id_temp');
		$kode_menu=$this->input->post('kode_menu');
		$qty=$this->input->post('qty');
		$harga=$this->input->post('harga');
		$jenis_diskon=$this->input->post('jenis_diskon');
		$diskon_item=$this->input->post('diskon_item');
		$kode_terapis=$this->input->post('kode_terapis');
		$jenis_item=$this->input->post('jenis_item');

		$this->db->where('id', $id);
		$this->db->from('opsi_transaksi_layanan');
		$ambil_paket=$this->db->get()->row();

		$this->db->where('kode_produk', $kode_menu);
		$this->db->from('clouoid1_olive_master.master_produk');
		$this->db->join('clouoid1_olive_master.master_kategori_produk', 'clouoid1_olive_master.master_produk.kode_kategori_produk = clouoid1_olive_master.master_kategori_produk.kode_kategori_produk', 'left');
		$get_produk=$this->db->get()->row();
		if(@$qty <= @$get_produk->real_stock){
			if(@$jenis_diskon=='persen'){
				$nominal_diskon=(($qty * $harga) * $diskon_item) /100;
				$subtotal=($qty * $harga)-$nominal_diskon;
				$data['diskon_persen']=$diskon_item;
			}else{
				$nominal_diskon=$diskon_item;
				$subtotal=($qty * $harga)-$nominal_diskon;
				$data['diskon_rupiah']=$diskon_item;
			}
			$data['kode_terapis']=$kode_terapis;
			$data['jenis_item']=$jenis_item;
			$data['kode_item']=$kode_menu;
			$data['qty']=$qty;
			$data['hpp']=$get_produk->hpp;
			$data['harga']=$harga;
			$data['jenis_diskon']=$jenis_diskon;
			if(@$ambil_paket->ambil_paket !='Ya'){
				$data['subtotal']=$subtotal;
			}
			$data['qty_poin']='';
			$data['poin_terpakai']='';
			$this->db->update('opsi_transaksi_layanan', $data,array('id' =>$id));
			$hasil['respon']='sukses';
		}else{
			$hasil['respon']='gagal';
		}
		echo json_encode($hasil);
	}
	public function update_layanan()
	{	
		$id=$this->input->post('id_temp');
		$kode_menu=$this->input->post('kode_menu');
		$qty=$this->input->post('qty');
		$harga=$this->input->post('harga');
		$jenis_diskon=$this->input->post('jenis_diskon');
		$diskon_item=$this->input->post('diskon_item');
		$kode_terapis=$this->input->post('kode_terapis');
		$jenis_item=$this->input->post('jenis_item');

		$this->db->where('id', $id);
		$this->db->from('opsi_transaksi_layanan');
		$ambil_paket=$this->db->get()->row();

		$this->db->where('kode_perawatan', $kode_menu);
		$this->db->from('clouoid1_olive_master.master_perawatan');
		$get_perawatan=$this->db->get()->row();
		if(@$jenis_diskon=='persen'){
			$nominal_diskon=(($qty * $harga) * $diskon_item) /100;
			$subtotal=($qty * $harga)-$nominal_diskon;
			$data['diskon_persen']=$diskon_item;
		}else{
			$nominal_diskon=$diskon_item;
			$subtotal=($qty * $harga)-$nominal_diskon;
			$data['diskon_rupiah']=$diskon_item;
		}
		$data['kode_terapis']=$kode_terapis;
		$data['jenis_item']='Treatment';
		$data['kode_item']=$kode_menu;
		$data['qty']=$qty;
		$data['hpp']=$get_perawatan->hpp;
		$data['harga']=$harga;
		$data['jenis_diskon']=$jenis_diskon;
		if(@$ambil_paket->ambil_paket !='Ya'){
			$data['subtotal']=$subtotal;
		}
		$this->db->update('opsi_transaksi_layanan', $data,array('id' =>$id));
		$hasil['respon']='sukses';
		
		echo json_encode($hasil);
	}
	public function get_total_pesanan()
	{	
		$kode_transaksi=$this->input->post('kode_transaksi');
		$jenis_diskon_transaksi=$this->input->post('jenis_diskon_transaksi');
		$diskon_transaksi=$this->input->post('diskon_transaksi');

		$this->db->select_sum('subtotal');
		$get_temp=$this->db->get_where('opsi_transaksi_layanan_temp',array('kode_transaksi' => $kode_transaksi))->row();

		if(@$jenis_diskon_transaksi=='persen'){
			$nominal_diskon=(@$get_temp->subtotal * $diskon_transaksi) /100;
			$grand_total=@$get_temp->subtotal-@$nominal_diskon;
		}else{
			$nominal_diskon=$diskon_transaksi;
			$grand_total=@$get_temp->subtotal-@$nominal_diskon;
		}
		$hasil['subtotal']=@$get_temp->subtotal;
		$hasil['nominal_subtotal']=@format_rupiah($get_temp->subtotal);
		$hasil['diskon']=@$nominal_diskon;
		$hasil['nominal_diskon']=@format_rupiah($nominal_diskon);
		$hasil['grand_total']=@$grand_total;
		$hasil['nominal_grand_total']=@format_rupiah($grand_total);
		echo json_encode($hasil);
	}
	public function get_total_pesanan_layanan()
	{	
		$kode_transaksi=$this->input->post('kode_transaksi');
		$jenis_diskon_transaksi=$this->input->post('jenis_diskon_transaksi');
		$diskon_transaksi=$this->input->post('diskon_transaksi');

		$this->db->select_sum('subtotal');
		$get_temp=$this->db->get_where('opsi_transaksi_layanan',array('kode_transaksi' => $kode_transaksi))->row();

		if(@$jenis_diskon_transaksi=='persen'){
			$nominal_diskon=(@$get_temp->subtotal * $diskon_transaksi) /100;
			$grand_total=@$get_temp->subtotal-@$nominal_diskon;
		}else{
			$nominal_diskon=$diskon_transaksi;
			$grand_total=@$get_temp->subtotal-@$nominal_diskon;
		}
		$hasil['subtotal']=@$get_temp->subtotal;
		$hasil['nominal_subtotal']=@format_rupiah($get_temp->subtotal);
		$hasil['diskon']=@$nominal_diskon;
		$hasil['nominal_diskon']=@format_rupiah($nominal_diskon);
		$hasil['grand_total']=@$grand_total;
		$hasil['nominal_grand_total']=@format_rupiah($grand_total);
		echo json_encode($hasil);
	}
	public function batal_transaksi()
	{	
		$kode_transaksi=$this->input->post('kode_transaksi');
		$this->db->delete('opsi_transaksi_layanan_temp',array('kode_transaksi' => $kode_transaksi));
	}
	public function simpan_transaksi()
	{	
		
		$post=$this->input->post();
		$kode_transaksi=@$post['kode_transaksi'];
		$petugas=$this->session->userdata('astrosession');
		$kode_petugas=@$petugas->id;

		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.kode_transaksi');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.kode_periksa');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.kode_dokter');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.kode_terapis');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.jenis_item');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.kode_item');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.qty');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.hpp');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.harga');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.jenis_diskon');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.diskon_persen');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.diskon_rupiah');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.subtotal');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.qty_poin');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.poin_terpakai');

		$this->db->select('clouoid1_olive_master.master_produk.real_stock as real_stock_produk');
		$this->db->select('clouoid1_olive_master.master_produk.insentif_masker');
		$this->db->select('clouoid1_olive_master.kartu_member.real_stock as real_stock_kartu');

		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->from('clouoid1_olive_kasir.opsi_transaksi_layanan_temp');
		$this->db->join('clouoid1_olive_master.master_produk', 'clouoid1_olive_kasir.opsi_transaksi_layanan_temp.kode_item = clouoid1_olive_master.master_produk.kode_produk', 'left');
		$this->db->join('clouoid1_olive_master.kartu_member', 'clouoid1_olive_kasir.opsi_transaksi_layanan_temp.kode_item = clouoid1_olive_master.kartu_member.kode_kartu_member', 'left');
		$data_temp=$this->db->get()->result();
		$hpp_penjualan=0;
		$total_poin_terpakai=0;
		foreach ($data_temp as $temp){
			$total_poin_terpakai +=@$temp->poin_terpakai;

			$opsi['kode_transaksi']=@$temp->kode_transaksi;
			$opsi['kode_periksa']=@$temp->kode_periksa;
			$opsi['kode_dokter']=@$temp->kode_dokter;
			$opsi['kode_terapis']=@$temp->kode_terapis;
			$opsi['jenis_item']=@$temp->jenis_item;
			$opsi['kode_item']=@$temp->kode_item;
			$opsi['qty']=@$temp->qty;
			$opsi['hpp']=@$temp->hpp;
			$opsi['harga']=@$temp->harga;
			$opsi['jenis_diskon']=@$temp->jenis_diskon;
			$opsi['diskon_persen']=@$temp->diskon_persen;
			$opsi['diskon_rupiah']=@$temp->diskon_rupiah;
			$opsi['subtotal']=@$temp->subtotal;
			$opsi['qty_poin']=@$temp->qty_poin;
			$opsi['poin_terpakai']=@$temp->poin_terpakai;
			$this->db->insert('opsi_transaksi_layanan', $opsi);

			$record['kode_transaksi']=@$temp->kode_transaksi;
			$record['tanggal_transaksi']=date('Y-m-d');
			$record['kode_member']=@$post['kode_member'];
			$record['kode_dokter']=@$temp->kode_dokter;
			$record['kode_item']=@$temp->kode_item;
			$record['qty']=@$temp->qty;
			$this->db->insert('data_record_anggota', $record);

			if($temp->jenis_item!='kartu member'){
				$hpp_penjualan+=@$temp->qty * @$temp->hpp;
				
				$this->db->where('kode_produk', @$temp->kode_item);
				$this->db->set('real_stock',@$temp->real_stock_produk - @$temp->qty);
				$this->db->from('clouoid1_olive_master.master_produk');
				$this->db->update();
			}else{
				
				$hpp_penjualan+=@$temp->qty * @$temp->hpp;

				$this->db->where('kode_kartu_member', @$temp->kode_item);
				$this->db->set('real_stock',@$temp->real_stock_kartu - @$temp->qty);
				$this->db->from('clouoid1_olive_master.kartu_member');
				$this->db->update();

				$this->simpan_arus_kas('Pendapatan','1.4.1','Registrasi Member',@$temp->subtotal);
				$this->simpan_laba_rugi('Pemasukan','1.4.1','Registrasi Member',@$temp->subtotal);

			}
			if(!empty($temp->kode_terapis)){
				$this->db->set('kode_transaksi',@$post['kode_transaksi']);
				$this->db->set('kode_karyawan',@$temp->kode_terapis);
				$this->db->set('total_withdraw',@$temp->insentif_masker);
				$this->db->set('tanggal_transaksi',date('Y-m-d'));
				$this->db->insert('clouoid1_olive_keuangan.insentif_terapis');
			}
			
			$trans_stok['jenis_transaksi'] = 'penjualan';
			$trans_stok['kode_transaksi'] = @$kode_transaksi_baru;
			$trans_stok['kategori_bahan'] = @$temp->jenis_item;
			$trans_stok['kode_bahan'] = $temp->kode_item;
			$trans_stok['stok_keluar'] = $temp->qty;
			$trans_stok['hpp'] = $temp->harga;
			$trans_stok['id_petugas'] = $kode_petugas;
			$trans_stok['tanggal_transaksi'] = date('Y-m-d');
			$trans_stok['posisi_awal'] = 'gudang';
			$trans_stok['posisi_akhir'] = 'customer';

			$insert_trans_stok = $this->db->insert('clouoid1_olive_gudang.transaksi_stok', $trans_stok);
		}

		if(@$post['jenis_diskon_transaksi']=='persen'){
			$transaksi['diskon_persen']=@$post['diskon_transaksi'];
		}else{
			$transaksi['diskon_rupiah']=@$post['diskon_transaksi'];
		}
		$transaksi['kode_transaksi']=@$kode_transaksi;
		$transaksi['kode_kasir']=@$post['kode_kasir'];
		$transaksi['tanggal_transaksi']=date('Y-m-d');
		$transaksi['kode_member']=@$post['kode_member'];
		$transaksi['kategori_diskon']=@$post['kategori_diskon'];
		$transaksi['jenis_diskon']=@$post['jenis_diskon_transaksi'];
		if(@$post['jenis_diskon_transaksi']=='persen'){
			$transaksi['diskon_persen']=@$post['diskon_transaksi'];
		}else{
			$transaksi['diskon_rupiah']=@$post['diskon_transaksi'];
		}
		if(@$post['kategori_diskon']=='promo'){
			$transaksi['kode']=@$post['kode_promo'];
		}elseif (@$post['kategori_diskon']=='merchant') {
			$transaksi['kode']=@$post['kode_merchant'];
		}
		$transaksi['total_layanan']=@$post['total_pesanan'];
		$transaksi['grand_total']=@$post['grand_total'];
		$transaksi['dibayar']=@$post['dibayar'];
		$transaksi['kembalian']=@$post['kembalian'];
		$transaksi['jenis_transaksi']=@$post['jenis_transaksi'];
		$transaksi['nama_bank']=@$post['nama_bank'];
		$transaksi['nomor_rekening']=@$post['nomor_rekening'];
		$transaksi['id_petugas']=@$kode_petugas;
		$transaksi['jam_penjualan']=date('H:i:s');
		$transaksi['status']='selesai';

		$this->db->insert('transaksi_layanan', $transaksi);

		$this->db->select('poin');
		$this->db->select('kategori_member');
		$this->db->where('kode_member', @$post['kode_member']);
		$this->db->from('clouoid1_olive_master.master_member');
		$poin_member = $this->db->get();
		$hasil_poin_member = $poin_member->row();
		@$update_poin['poin']=@$hasil_poin_member->poin - @$total_poin_terpakai;
		$this->db->update('clouoid1_olive_master.master_member', $update_poin,array('kode_member' =>@$post['kode_member']));

		if ($hasil_poin_member->kategori_member == 'Member') {
			$this->db->from('clouoid1_olive_master.setting_poin');
			$get_poin = $this->db->get();
			$hasil_get_poin = $get_poin->row();

			if(empty($update_poin['poin'])){
				if ($post['grand_total'] >= @$hasil_get_poin->nominal_transaksi) {
					$total_poin=@$post['grand_total']/@$hasil_get_poin->nominal_transaksi;
					
					$this->db->where('kode_member', $post['kode_member']);
					$this->db->set('poin',floor($total_poin));
					$this->db->from('clouoid1_olive_master.master_member');
					$this->db->update();

				}
			}else{
				if ($post['grand_total'] >= @$hasil_get_poin->nominal_transaksi) {
					$total_poin=@$post['grand_total']/@$hasil_get_poin->nominal_transaksi;

					$this->db->where('kode_member', $post['kode_member']);
					$this->db->set('poin',@$update_poin['poin'] + (floor($total_poin)));
					$this->db->from('clouoid1_olive_master.master_member');
					$this->db->update();
				}
			}
		}

		$keuangan['kode_jenis_keuangan'] = '1';
		$keuangan['kode_kategori_keuangan'] = '1.1';
		$kode_sub = '';
		if ($post['jenis_transaksi'] == 'tunai') {
			$kode_sub = '1.1.1';
		} elseif ($post['jenis_transaksi'] == 'debit') {
			$kode_sub = '1.1.2';
		}else {
			$kode_sub = '1.1.5';
		}

		$keuangan['kode_sub_kategori_keuangan'] = $kode_sub;
		$keuangan['nominal'] = @$post['dibayar'];
		$keuangan['tanggal_transaksi'] = date('Y-m-d');
		$keuangan['id_petugas'] = $kode_petugas;
		$keuangan['kode_referensi'] = $post['kode_transaksi'];
		$this->db->insert('clouoid1_olive_keuangan.keuangan_masuk', $keuangan);

		$this->db->select('kode_jenis_akun');
		$this->db->select('kode_sub_kategori_akun');
		$this->db->where('kode_sub_kategori_akun', '2.6.2');
		$this->db->from('clouoid1_olive_keuangan.keuangan_sub_kategori_akun');
		$kategori_keluar = $this->db->get();
		$hasil_kategori_keluar = $kategori_keluar->row();

		$keuangan['kode_jenis_keuangan'] = $hasil_kategori_keluar->kode_jenis_akun;
		$keuangan['kode_kategori_keuangan'] = '2.6';
		$keuangan['kode_sub_kategori_keuangan'] = $hasil_kategori_keluar->kode_sub_kategori_akun;
		$keuangan['nominal'] = $hpp_penjualan;
		$keuangan['tanggal_transaksi'] = date('Y-m-d');
		$keuangan['id_petugas'] = $kode_petugas;
		$keuangan['kode_referensi'] = $post['kode_transaksi'];
		$this->db->insert('clouoid1_olive_keuangan.keuangan_keluar', $keuangan);

		$this->simpan_arus_kas('Pendapatan','1.1.1','Penjualan',@$post['grand_total']);
		$this->simpan_laba_rugi('Pemasukan','1.1.1','Penjualan',@$post['grand_total']);
		$this->simpan_laba_rugi('Pengeluaran',@$hasil_kategori_keluar->kode_sub_kategori_akun,'HPP',$hpp_penjualan);

		$this->db->delete('opsi_transaksi_layanan_temp',array('kode_transaksi' => $kode_transaksi));

		
	}
	public function simpan_transaksi_layanan()
	{			
		$post=$this->input->post();
		$kode_transaksi=@$post['kode_transaksi'];
		$petugas=$this->session->userdata('astrosession');
		$kode_petugas=@$petugas->id;

		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.kode_transaksi');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.kode_periksa');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.kode_dokter');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.kode_terapis');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.jenis_item');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.qty');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.hpp');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.harga');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.jenis_diskon');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.diskon_persen');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.diskon_rupiah');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.subtotal');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.qty_poin');
		$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.poin_terpakai');

		$this->db->select('clouoid1_olive_master.master_produk.real_stock as real_stock_produk');
		$this->db->select('clouoid1_olive_master.master_produk.insentif_masker');
		$this->db->select('clouoid1_olive_master.master_perawatan.insentif_terapi');
		$this->db->select('clouoid1_olive_master.kartu_member.real_stock as real_stock_kartu');

		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->from('clouoid1_olive_kasir.opsi_transaksi_layanan');
		$this->db->join('clouoid1_olive_master.master_produk', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item = clouoid1_olive_master.master_produk.kode_produk', 'left');
		$this->db->join('clouoid1_olive_master.master_perawatan', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item = clouoid1_olive_master.master_perawatan.kode_perawatan', 'left');
		$this->db->join('clouoid1_olive_master.kartu_member', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item = clouoid1_olive_master.kartu_member.kode_kartu_member', 'left');
		$data_temp=$this->db->get()->result();
		$hpp_penjualan=0;
		$total_poin_terpakai=0;
		foreach ($data_temp as $temp){
			$total_poin_terpakai+=$temp->poin_terpakai;
			$record['kode_transaksi']=@$temp->kode_transaksi;
			$record['tanggal_transaksi']=date('Y-m-d');
			$record['kode_member']=@$post['kode_member'];
			$record['kode_dokter']=@$temp->kode_dokter;
			$record['kode_item']=@$temp->kode_item;
			$record['qty']=@$temp->qty;
			$this->db->insert('data_record_anggota', $record);
			if($temp->jenis_item=='kartu member'){
				$hpp_penjualan+=@$temp->qty * @$temp->hpp;

				$this->db->where('kode_kartu_member', @$temp->kode_item);
				$this->db->set('real_stock',@$temp->real_stock_kartu - @$temp->qty);
				$this->db->from('clouoid1_olive_master.kartu_member');
				$this->db->update();

				$this->simpan_arus_kas('Pendapatan','1.4.1','Registrasi Member',@$temp->subtotal);
				$this->simpan_laba_rugi('Pemasukan','1.4.1','Registrasi Member',@$temp->subtotal);
			}elseif($temp->jenis_item!='Treatment' && $temp->jenis_item!='treatment' && $temp->jenis_item!='kartu member'){
				$hpp_penjualan+=@$temp->qty * @$temp->hpp;
				
				$this->db->where('kode_produk', @$temp->kode_item);
				$this->db->set('real_stock',@$temp->real_stock_produk - @$temp->qty);
				$this->db->from('clouoid1_olive_master.master_produk');
				$this->db->update();
			}else{
				
				$hpp_penjualan+=@$temp->qty * @$temp->hpp;

				$this->db->where('clouoid1_olive_master.opsi_master_perawatan.kode_perawatan', @$temp->kode_item);
				$this->db->select('clouoid1_olive_master.master_perlengkapan.real_stock as real_stock_perlengkapan');

				$this->db->select('clouoid1_olive_master.opsi_master_perawatan.jenis');
				$this->db->select('clouoid1_olive_master.opsi_master_perawatan.kode_perlengkapan');
				$this->db->select('clouoid1_olive_master.opsi_master_perawatan.kode_bahan');
				$this->db->select('clouoid1_olive_master.opsi_master_perawatan.qty');
				$this->db->select('clouoid1_olive_master.master_bahan_baku.real_stock as real_stock_bahan');

				$this->db->from('clouoid1_olive_master.opsi_master_perawatan');
				$this->db->join('clouoid1_olive_master.master_perlengkapan', 'clouoid1_olive_master.opsi_master_perawatan.kode_perlengkapan = clouoid1_olive_master.master_perlengkapan.kode_perlengkapan', 'left');
				$this->db->join('clouoid1_olive_master.master_bahan_baku', 'clouoid1_olive_master.opsi_master_perawatan.kode_bahan = clouoid1_olive_master.master_bahan_baku.kode_bahan_baku', 'left');
				$opsi_perawatan=$this->db->get()->result();
				foreach ($opsi_perawatan as $opsi) {
					if($opsi->jenis=='Perlengkapan'){

						$this->db->where('kode_perlengkapan', @$opsi->kode_perlengkapan);
						$this->db->set('real_stock',@$opsi->real_stock_perlengkapan - (@$temp->qty * @$opsi->qty));
						$this->db->from('clouoid1_olive_master.master_perlengkapan');
						$this->db->update();
					}else{
						$this->db->where('kode_bahan_baku', @$opsi->kode_bahan);
						$this->db->set('real_stock',@$opsi->real_stock_bahan - (@$temp->qty * @$opsi->qty));
						$this->db->from('clouoid1_olive_master.master_bahan_baku');
						$this->db->update();
					}
				}

			}
			if(!empty($temp->kode_terapis)){
				$this->db->set('kode_transaksi',@$post['kode_transaksi']);
				$this->db->set('kode_karyawan',@$temp->kode_terapis);
				if(@$temp->jenis_item=='Treatment' || @$temp->jenis_item=='treatment'){
					$this->db->set('total_withdraw',@$temp->insentif_terapi);
				}else{
					$this->db->set('total_withdraw',@$temp->insentif_masker);
				}
				
				$this->db->set('tanggal_transaksi',date('Y-m-d'));
				$this->db->insert('clouoid1_olive_keuangan.insentif_terapis');
			}
		}

		if(@$post['jenis_diskon_transaksi']=='persen'){
			$transaksi['diskon_persen']=@$post['diskon_transaksi'];
		}else{
			$transaksi['diskon_rupiah']=@$post['diskon_transaksi'];
		}
		$transaksi['kode_transaksi']=@$kode_transaksi;
		$transaksi['kode_kasir']=@$post['kode_kasir'];
		$transaksi['tanggal_transaksi']=date('Y-m-d');
		$transaksi['kode_member']=@$post['kode_member'];
		$transaksi['kategori_diskon']=@$post['kategori_diskon'];
		$transaksi['jenis_diskon']=@$post['jenis_diskon_transaksi'];
		if(@$post['jenis_diskon_transaksi']=='persen'){
			$transaksi['diskon_persen']=@$post['diskon_transaksi'];
		}else{
			$transaksi['diskon_rupiah']=@$post['diskon_transaksi'];
		}
		if(@$post['kategori_diskon']=='promo'){
			$transaksi['kode']=@$post['kode_promo'];
		}elseif (@$post['kategori_diskon']=='merchant') {
			$transaksi['kode']=@$post['kode_merchant'];
		}
		$transaksi['total_layanan']=@$post['total_pesanan'];
		$transaksi['grand_total']=@$post['grand_total'];
		$transaksi['dibayar']=@$post['dibayar'];
		$transaksi['kembalian']=@$post['kembalian'];
		$transaksi['jenis_transaksi']=@$post['jenis_transaksi'];
		$transaksi['nama_bank']=@$post['nama_bank'];
		$transaksi['nomor_rekening']=@$post['nomor_rekening'];
		$transaksi['id_petugas']=@$kode_petugas;
		$transaksi['jam_penjualan']=date('H:i:s');
		$transaksi['status']='selesai';

		$this->db->update('transaksi_layanan', $transaksi,array('kode_transaksi' =>$kode_transaksi));

		$transaksi_registrasi['status']='selesai';
		$this->db->update('clouoid1_olive_cs.transaksi_registrasi', $transaksi_registrasi,array('kode_transaksi' =>$kode_transaksi));

		$this->db->select('poin');
		$this->db->select('kategori_member');
		$this->db->where('kode_member', @$post['kode_member']);
		$this->db->from('clouoid1_olive_master.master_member');
		$poin_member = $this->db->get();
		$hasil_poin_member = $poin_member->row();
		@$update_poin['poin']=@$hasil_poin_member->poin - @$total_poin_terpakai;
		$this->db->update('clouoid1_olive_master.master_member', $update_poin,array('kode_member' =>@$post['kode_member']));

		if ($hasil_poin_member->kategori_member == 'Member') {
			$this->db->from('clouoid1_olive_master.setting_poin');
			$get_poin = $this->db->get();
			$hasil_get_poin = $get_poin->row();

			if(empty($update_poin['poin'])){
				if ($post['grand_total'] >= @$hasil_get_poin->nominal_transaksi) {
					$total_poin=@$post['grand_total']/@$hasil_get_poin->nominal_transaksi;
					
					$this->db->where('kode_member', $post['kode_member']);
					$this->db->set('poin',floor($total_poin));
					$this->db->from('clouoid1_olive_master.master_member');
					$this->db->update();

				}
			}else{
				if ($post['grand_total'] >= @$hasil_get_poin->nominal_transaksi) {
					$total_poin=@$post['grand_total']/@$hasil_get_poin->nominal_transaksi;

					$this->db->where('kode_member', $post['kode_member']);
					$this->db->set('poin',@$update_poin['poin'] + (floor($total_poin)));
					$this->db->from('clouoid1_olive_master.master_member');
					$this->db->update();
				}
			}
		}

		$keuangan['kode_jenis_keuangan'] = '1';
		$keuangan['kode_kategori_keuangan'] = '1.1';
		$kode_sub = '';
		if ($post['jenis_transaksi'] == 'tunai') {
			$kode_sub = '1.1.1';
		} elseif ($post['jenis_transaksi'] == 'debit') {
			$kode_sub = '1.1.2';
		}else {
			$kode_sub = '1.1.5';
		}

		$keuangan['kode_sub_kategori_keuangan'] = $kode_sub;
		$keuangan['nominal'] = @$post['dibayar'];
		$keuangan['tanggal_transaksi'] = date('Y-m-d');
		$keuangan['id_petugas'] = $kode_petugas;
		$keuangan['kode_referensi'] = $post['kode_transaksi'];
		$this->db->insert('clouoid1_olive_keuangan.keuangan_masuk', $keuangan);

		$this->db->select('kode_jenis_akun');
		$this->db->select('kode_sub_kategori_akun');
		$this->db->where('kode_sub_kategori_akun', '2.6.2');
		$this->db->from('clouoid1_olive_keuangan.keuangan_sub_kategori_akun');
		$kategori_keluar = $this->db->get();
		$hasil_kategori_keluar = $kategori_keluar->row();

		$keuangan['kode_jenis_keuangan'] = $hasil_kategori_keluar->kode_jenis_akun;
		$keuangan['kode_kategori_keuangan'] = '2.6';
		$keuangan['kode_sub_kategori_keuangan'] = $hasil_kategori_keluar->kode_sub_kategori_akun;
		$keuangan['nominal'] = $hpp_penjualan;
		$keuangan['tanggal_transaksi'] = date('Y-m-d');
		$keuangan['id_petugas'] = $kode_petugas;
		$keuangan['kode_referensi'] = $post['kode_transaksi'];
		$this->db->insert('clouoid1_olive_keuangan.keuangan_keluar', $keuangan);

		$this->simpan_arus_kas('Pendapatan','1.1.1','Penjualan',@$post['grand_total']);
		$this->simpan_laba_rugi('Pemasukan','1.1.1','Penjualan',@$post['grand_total']);
		$this->simpan_laba_rugi('Pengeluaran',@$hasil_kategori_keluar->kode_sub_kategori_akun,'HPP',$hpp_penjualan);

	}

	public function simpan_arus_kas($jenis_keuangan,$kode_kategori_keuangan,$nama_kategori_keuangan,$nominal){
		$tanggal=date('Y-m-d');
		$bulan=date('m',strtotime($tanggal));
		$tahun=date('Y',strtotime($tanggal));

		$this->db->select('nominal');
		$get_laporan_arus_kas   = $this->db->get_where('clouoid1_olive_keuangan.laporan_arus_kas',array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		$hasil_laporan_arus_kas  = $get_laporan_arus_kas->row();
		if(!empty($hasil_laporan_arus_kas)){
			$update_arus_kas['nominal']=$hasil_laporan_arus_kas->nominal +$nominal;
			$this->db->update('clouoid1_olive_keuangan.laporan_arus_kas',$update_arus_kas,array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		}else{

			$insert_arus_kas['jenis_keuangan']=$jenis_keuangan;
			$insert_arus_kas['kode_kategori_keuangan']=@$kode_kategori_keuangan;
			$insert_arus_kas['nama_kategori_keuangan']=@$nama_kategori_keuangan;
			$insert_arus_kas['nominal']=$nominal;
			$insert_arus_kas['tanggal']=$tanggal;
			$insert_arus_kas['bulan']=$bulan;
			$insert_arus_kas['tahun']=$tahun;
			$this->db->insert('clouoid1_olive_keuangan.laporan_arus_kas',$insert_arus_kas);
		}

	}
	public function simpan_laba_rugi($jenis_keuangan,$kode_kategori_keuangan,$nama_kategori_keuangan,$nominal){
		$tanggal=date('Y-m-d');
		$bulan=date('m',strtotime($tanggal));
		$tahun=date('Y',strtotime($tanggal));

		$this->db->select('nominal');
		$get_laporan_laba_rugi   = $this->db->get_where('clouoid1_olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		$hasil_laporan_laba_rugi  = $get_laporan_laba_rugi->row();
		if(!empty($hasil_laporan_laba_rugi)){
			$update_laba_rugi['nominal']=$hasil_laporan_laba_rugi->nominal +$nominal;
			$this->db->update('clouoid1_olive_keuangan.laporan_laba_rugi',$update_laba_rugi,array('jenis_keuangan' =>$jenis_keuangan,'kode_kategori_keuangan'=>$kode_kategori_keuangan,'bulan'=>$bulan,'tahun'=>$tahun));
		}else{

			$insert_laba_rugi['jenis_keuangan']=$jenis_keuangan;
			$insert_laba_rugi['kode_kategori_keuangan']=@$kode_kategori_keuangan;
			$insert_laba_rugi['nama_kategori_keuangan']=@$nama_kategori_keuangan;
			$insert_laba_rugi['nominal']=$nominal;
			$insert_laba_rugi['tanggal']=$tanggal;
			$insert_laba_rugi['bulan']=$bulan;
			$insert_laba_rugi['tahun']=$tahun;
			$this->db->insert('clouoid1_olive_keuangan.laporan_laba_rugi',$insert_laba_rugi);
		}

	}

	
	public function print_invoice()
	{
		$kode_transaksi = $this->input->post('kode_transaksi');
		if(!empty($kode_transaksi)){

			$this->db->from('clouoid1_olive_master.master_setting');
			$setting = $this->db->get();
			$hasil_setting = $setting->row();

			$transaksi = $this->db->get_where('transaksi_layanan',array('kode_transaksi'=>$kode_transaksi));
			$hasil_transaksi = $transaksi->row();
			

			$this->db->where('kode_member',@$hasil_transaksi->kode_member);
			$this->db->from('clouoid1_olive_master.master_member');
			$get_member = $this->db->get();
			$hasil_member = $get_member->row();

			$printTestText  = align_center(62,$hasil_setting->nama_perusahaan)."\n";
			$printTestText .= align_center(62,$hasil_setting->web_resto)."\n";
			$printTestText .= align_center(62,$hasil_setting->alamat_perusahaan)."\n";
			$printTestText .= align_center(62,$hasil_setting->telp_perusahaan)."\n";
			$printTestText .= repeat_value(62,'_')."\n";
			$printTestText .= align_left(28,'No.Nota : '.$hasil_transaksi->kode_transaksi)."         ".align_left(26,'Tanggal : '.tanggalIndo($hasil_transaksi->tanggal_transaksi))."\n";
			$printTestText .= align_left(28,'No.RM   : '.$hasil_transaksi->kode_member)."         ".align_left(26,'Kasir   : '."Olive")."\n";
			$printTestText .= align_left(62,'Nama Pasien : '.$hasil_member->nama_member)."\n";
			$printTestText .= repeat_value(62,'_')."\n";
			$printTestText .= align_left(20,'ITEM')." ".align_left(7,'QTY')." ".align_right(11,'HARGA')." ".align_center(9,'DISC')." ".align_right(11,'SUBTOTAL')."\n";
			$printTestText .= repeat_value(62,'_')."\n";
			$subtotal = 0;
			$jmlTTL = 0;

			$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.jenis_item');
			$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item');
			$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.qty');
			$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.hpp');
			$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.harga');
			$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.jenis_diskon');
			$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.diskon_persen');
			$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.diskon_rupiah');
			$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.subtotal');

			$this->db->select('clouoid1_olive_master.master_produk.nama_produk');
			$this->db->select('clouoid1_olive_master.master_perawatan.nama_perawatan');
			$this->db->select('clouoid1_olive_master.master_paket.nama_paket');

			$this->db->where('kode_transaksi', $kode_transaksi);
			$this->db->from('clouoid1_olive_kasir.opsi_transaksi_layanan');
			$this->db->join('clouoid1_olive_master.master_produk', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item = clouoid1_olive_master.master_produk.kode_produk', 'left');
			$this->db->join('clouoid1_olive_master.kartu_member', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item = clouoid1_olive_master.kartu_member.kode_kartu_member', 'left');
			$this->db->join('clouoid1_olive_master.master_paket', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item = clouoid1_olive_master.master_paket.kode_paket', 'left');
			$this->db->join('clouoid1_olive_master.master_perawatan', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item = clouoid1_olive_master.master_perawatan.kode_perawatan', 'left');
			$data_temp=$this->db->get()->result();
			foreach ($data_temp as $value) {
				if($value->jenis_item=='Paket'){
					$nama_produk = substr($value->nama_paket,0 ,20);
				}elseif($value->jenis_item=='Treatment'){
					$nama_produk = substr($value->nama_perawatan,0 ,20);
				}elseif($value->jenis_item!='kartu member' && $value->jenis_item!='Paket' && $value->jenis_item!='Treatment'){
					$nama_produk = substr($value->nama_produk,0 ,20);
				}else{
					$nama_produk = substr('Kartu Member',0 ,20);
				}
				

				$printTestText .= align_left(20,@$nama_produk)." ";
				$printTestText .= align_center(7,@$value->qty)." ";
				$printTestText .= align_right(11,format_angka(@$value->harga))." ";
				if ($value->jenis_diskon == 'persen') {
					$printTestText .= align_center(9,@$value->diskon_persen.''.'%')." ";
				} else {
					$printTestText .= align_center(9,format_angka(@$value->diskon_rupiah))." ";
				}
				$printTestText .= align_right(11,format_angka($value->subtotal))."\n";
				$subtotal += $value->subtotal;
				$jmlTTL += $value->qty;
			}
			$printTestText .= repeat_value(62,'_')."\n";
			$printTestText .= align_left(20,'Pembayaran : '.$hasil_transaksi->jenis_transaksi)." ".align_left(15,'Jam Mulai : '.'-')." ".align_left(25,'Jam Selesai : '.$hasil_transaksi->jam_penjualan)."\n";
			$printTestText .= repeat_value(62,'_')."\n\n";
			$printTestText .= align_left(62,'TOTAL   : '.@format_angka(@$hasil_transaksi->total_layanan))."\n";
			if ($hasil_transaksi->diskon_persen != '') { 
				$diskon = $hasil_transaksi->diskon_persen; 
			} 
			else { 
				$diskon = $hasil_transaksi->diskon_rupiah;
			}
			$printTestText .= align_left(62,'POTONGAN: '.$diskon)."\n";
			$printTestText .= align_left(62,'JUMLAH  : '.format_angka($hasil_transaksi->grand_total))."\n";
			$printTestText .= align_left(62,'BAYAR   : '.format_angka($hasil_transaksi->dibayar))."\n";
			$printTestText .= align_left(62,'KEMBALI : '.format_angka($hasil_transaksi->kembalian))."\n";
			if ($hasil_member->poin == '') { 
				$poin = '0'; 
			} else { 
				$poin =$hasil_member->poin; 
			}
			$this->db->from('clouoid1_olive_master.setting_poin');
			$get_poin = $this->db->get();
			$hasil_get_poin = $get_poin->row();
			if ($hasil_member->kategori_member == 'Member') {
				$hasil_poin = @$hasil_transaksi->grand_total/@$hasil_get_poin->nominal_transaksi;
			}
			$printTestText  .= align_center(62,'Anda Mendapat '.floor(@$hasil_poin).' Stamp')."\n";
			$printTestText  .= align_center(62,'Total '.$poin.' Stamp')."\n";
			$printTestText  .= align_center(62,'-- TERIMA KASIH ATAS KUNJUNGAN ANDA --')."\n\n\n\n";
			
			//print_r($printTestText);

			$handle = printer_open($hasil_setting->printer);
			printer_set_option($handle, PRINTER_MODE, "RAW");
			$font = printer_create_font("Roman Condensed", 10, 25, 300, false, false, false, 0);
			printer_select_font($handle, $font);
			printer_write($handle, $printTestText);
			printer_close($handle);
		}
	}

}

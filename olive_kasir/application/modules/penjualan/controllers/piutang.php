<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class piutang extends MY_Controller {


	public function __construct()
	{
		parent::__construct();		
		if ($this->session->userdata('astrosession') == FALSE) {
			redirect(base_url('authenticate'));			
		}
	}

	public function index()
	{
		$this->db_master = $this->load->database('kan_master', TRUE);
		$data['konten'] = $this->load->view('piutang/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function daftar()
	{
		$this->db_master = $this->load->database('kan_master', TRUE);
		$data['konten'] = $this->load->view('piutang/daftar', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function daftar_konsinyasi()
	{
		$this->db_master = $this->load->database('kan_master', TRUE);
		$data['konten'] = $this->load->view('piutang/daftar_konsinyasi', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail()
	{
		$this->db_kasir = $this->load->database('kan_kasir', TRUE);
		$data['konten'] = $this->load->view('piutang/detail', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function detail_konsinyasi()
	{
		$this->db_kasir = $this->load->database('kan_kasir', TRUE);
		$data['konten'] = $this->load->view('piutang/detail_konsinyasi', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail_pertransaksi(){
		$this->db_master = $this->load->database('kan_master', TRUE);
		$data['konten']  = $this->load->view('piutang/detail_pertransaksi', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function detail_pertransaksi_konsinyasi(){
		$this->db_master = $this->load->database('kan_master', TRUE);
		$data['konten']  = $this->load->view('piutang/detail_pertransaksi_konsinyasi', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}

	public function angsur(){
		$this->db_master = $this->load->database('kan_master', TRUE);
		$data['konten']  = $this->load->view('piutang/angsur', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function angsur_konsinyasi(){
		$this->db_master = $this->load->database('kan_master', TRUE);
		$data['konten']  = $this->load->view('piutang/angsur_konsinyasi', NULL, TRUE);
		$this->load->view ('admin/main', $data);
	}
	public function simpan_angsuran(){
		$input = $this->input->post();
		$this->db_kasir = $this->load->database('kan_kasir', TRUE);

		$get_piutang=$this->db_kasir->get_where('transaksi_piutang', array('kode_piutang' =>@$input['kode_transaksi'],'kode_member' =>@$input['kode_member'],'kode_unit_jabung' =>@$input['kode_unit_jabung']));
		$hasil_piutang=$get_piutang->row();
		if(@$input['jenis_angsuran']=='angsuran'){
			$piutang['tanggal_jatuh_tempo']=@$input['tanggal_jatuh_tempo'];
		}

		$piutang['angsuran']=@$hasil_angsuran->angsuran;
        $piutang['sisa']=@$hasil_piutang->sisa - @$hasil_angsuran->angsuran;
        
		$this->db_kasir->update('transaksi_piutang',$piutang, array('kode_piutang' =>@$input['kode_transaksi'],'kode_member' =>@$input['kode_member'],'kode_unit_jabung' =>@$input['kode_unit_jabung']));
		

		$data['kode_angsuran'] ='AS_'.date('ymdHis');
		$data['kode_piutang'] =  $input['kode_transaksi'];
		$data['angsuran'] =  @$input['dibayar'];
		$data['tanggal_angsuran'] = date('Y-m-d');
		$data['kode_unit_jabung'] = @$input['kode_unit_jabung'];
		$data['jenis_pembayaran'] = @$input['jenis_pembayaran'];
		$data['status'] = 'proses';

		$this->db_kasir->insert('opsi_transaksi_piutang',$data);
		
	}
	public function simpan_angsuran_konsinyasi()
    {
        $this->db_kasir = $this->load->database('kan_kasir', TRUE);

        $kode_transaksi=$this->input->post('kode_transaksi');
        $post=$this->input->post();

        $get_setting=$this->db->get('setting');
        $hasil_setting=$get_setting->row();
        $kode_unit_jabung=@$hasil_setting->kode_unit;

        $user = $this->session->userdata('astrosession');


        $this->db->where('kan_suol.transaksi_member_konsinyasi.kode_transaksi', $kode_transaksi);
        $this->db->where('kan_suol.transaksi_stok.kode_transaksi', $kode_transaksi);
        $this->db->where('kan_suol.transaksi_stok.jenis_transaksi','penjualan');
        $this->db->where('kan_suol.transaksi_stok.kategori_bahan', 'Produk');
        $this->db->from('kan_suol.transaksi_member_konsinyasi');
        $this->db->join('kan_master.master_produk', 'kan_suol.transaksi_member_konsinyasi.kode_produk = kan_master.master_produk.kode_produk', 'left');
        $this->db->join('kan_suol.transaksi_stok', 'kan_suol.transaksi_member_konsinyasi.kode_produk = kan_suol.transaksi_stok.kode_bahan AND kan_suol.transaksi_member_konsinyasi.tanggal_expired = kan_suol.transaksi_stok.tanggal_expired', 'left');
        $get_temp=$this->db->get();
        $hasil_temp=$get_temp->result();
        $total_nominal=0;
        if(!empty($hasil_temp)){
            foreach ($hasil_temp as $temp) {

                $produk_terjual=$post['produk_terjual_'.$temp->kode_produk];
                $produk_rusak=$post['produk_rusak_'.$temp->kode_produk];
                $sisa=$post['sisa_'.$temp->kode_produk];
                

                $opsi['jumlah_terjual']=@$produk_terjual;
                $opsi['jumlah_rusak']=@$produk_rusak;
                $opsi['sisa']=@$sisa;
                

                $total_nominal +=@$produk_terjual * @$temp->harga_satuan;
                $this->db->update('transaksi_member_konsinyasi', $opsi,array('kode_transaksi' =>$kode_transaksi,'kode_produk' =>$temp->kode_produk));

                if(!empty($sisa) and $sisa > 0){
                    $stok_produk['real_stok']=@$temp->real_stok + $sisa;

                    $this->db_master->where('kode_unit_jabung', @$kode_unit_jabung);
                    $this->db_master->where('kode_produk',$temp->kode_produk);
                    $this->db_master->update('master_produk', $stok_produk);

                }

                if(!empty($produk_rusak) and $produk_rusak > 0){

                    $ts_stok['stok_keluar']=@$temp->stok_keluar - $produk_rusak;

                    $this->db->where('kode_transaksi', $kode_event);
                    $this->db->where('tanggal_expired', $temp->tanggal_expired);
                    $this->db->where('kode_bahan',$temp->kode_produk);
                    $this->db->where('jenis_transaksi','penjualan');
                    $this->db->where('kategori_bahan', 'Produk');
                    $this->db->update('transaksi_stok', $ts_stok);

                    $record_tstok['jenis_transaksi'] = 'spoil';
                    $record_tstok['kode_transaksi'] = $temp->kode_event;
                    $record_tstok['kategori_bahan'] = 'Produk';
                    $record_tstok['tanggal_expired'] = $temp->tanggal_expired;
                    $record_tstok['kode_bahan'] = $temp->kode_produk;
                    $record_tstok['stok_keluar'] = $produk_rusak;
                    $record_tstok['hpp'] = $temp->harga_satuan;
                    $record_tstok['kode_petugas'] = $user->kode_user;
                    $record_tstok['tanggal_transaksi'] = date('Y-m-d H:i:s');
                    $record_tstok['posisi_awal'] = 'gudang';
                    $record_tstok['kode_unit_jabung'] = $kode_unit_jabung;
                    $record_tstok['status'] = 'keluar';
                    $this->db->insert('transaksi_stok', $record_tstok);
                }

            }
        }

        $get_piutang=$this->db_kasir->get_where('transaksi_piutang', array('kode_piutang' =>@$kode_transaksi,'kode_member' =>@$post['kode_member'],'kode_unit_jabung' =>@$post['kode_unit_jabung']));
		$hasil_piutang=$get_piutang->row();

        $piutang['angsuran']=@$total_nominal;
        $piutang['sisa']=@$hasil_piutang->sisa - @$total_nominal;
        
		$this->db_kasir->update('transaksi_piutang',$piutang, array('kode_piutang' =>@$kode_transaksi,'kode_member' =>@$post['kode_member'],'kode_unit_jabung' =>@$post['kode_unit_jabung']));


		$data['kode_angsuran'] ='AS_'.date('ymdHis');
		$data['kode_piutang'] = @$post['kode_transaksi'];
		$data['angsuran'] =  @$total_nominal;
		$data['tanggal_angsuran'] = date('Y-m-d');
		$data['kode_unit_jabung'] = @$post['kode_unit_jabung'];
		
		$data['status'] = 'proses';

		$this->db_kasir->insert('opsi_transaksi_piutang',$data);

        $hasil['respon']='sukses';
        
        echo json_encode($hasil);
    }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class perencanaan_produksi extends MY_Controller {


    public function __construct()
    {
        parent::__construct();      
        if ($this->session->userdata('astrosession') == FALSE) {
            redirect(base_url('authenticate'));         
        }
    }

    public function index()
    {
        $data['konten'] = $this->load->view('perencanaan_produksi/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function daftar()
    {
        $data['konten'] = $this->load->view('perencanaan_produksi/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function detail()
    {
        $this->db_master = $this->load->database('kan_master', TRUE);
        $data['konten'] = $this->load->view('perencanaan_produksi/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function tambah()
    {
        $this->db_master = $this->load->database('kan_master', TRUE);
        $data['konten'] = $this->load->view('perencanaan_produksi/tambah', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function data_opsi_perencanaan()
    {
        $this->db_master = $this->load->database('kan_master', TRUE);
        $this->load->view('perencanaan_produksi/data_opsi_perencanaan');
        
    }
    public function simpan_opsi_perencanaan()
    {
        $post=$this->input->post();
        $cek_opsi=$this->db->get_where('opsi_perencanaan_produksi_temp',array('kode_produk' =>@$post['kode_produk'],'kode_perencanaan' =>@$post['kode_perencanaan']));
        $hasil_cek=$cek_opsi->row();
        if(!empty($hasil_cek)){
            $post['qty']=@$hasil_cek->qty + @$post['qty'];
            $this->db->update('opsi_perencanaan_produksi_temp',$post,array('kode_produk' =>@$post['kode_produk'],'kode_perencanaan' =>@$post['kode_perencanaan']));
        }else{
            $this->db->insert('opsi_perencanaan_produksi_temp',$post);
        }
        
    }
    public function get_opsi_perencanaan()
    {
        $id=$this->input->post('id');
        $get_opsi=$this->db->get_where('opsi_perencanaan_produksi_temp',array('id_temp' =>@$id));
        $hasil_get=$get_opsi->row();
        echo json_encode($hasil_get);        
    }
    public function update_opsi_perencanaan()
    {
        $post=$this->input->post();

        $this->db->update('opsi_perencanaan_produksi_temp',$post,array('id_temp' =>@$post['id_temp']));
        
    }
    public function hapus_opsi_perencanaan()
    {
        $id=$this->input->post('id_temp');
        $this->db->delete('opsi_perencanaan_produksi_temp', array('id_temp' =>$id));
    }
    public function hapus_opsi_perencanaan_all()
    {
        $kode_perencanaan=$this->input->post('kode_perencanaan');
        $this->db->delete('opsi_perencanaan_produksi_temp', array('kode_perencanaan' =>$kode_perencanaan));
    }
    public function simpan_perencanaan()
    {
        $this->db_master = $this->load->database('kan_master', TRUE);
        $post=$this->input->post();

        $kode_pengadaan=@$post['kode_perencanaan'];

        $get_opsi=$this->db->get_where('opsi_perencanaan_produksi_temp',array('kode_perencanaan' =>@$post['kode_perencanaan']));
        $hasil_get=$get_opsi->result_array();
        foreach ($hasil_get as $opsi) {
            unset($opsi['id_temp']);
            $this->db->insert('opsi_perencanaan_produksi',$opsi);

            $get_opsi_produk=$this->db_master->get_where('opsi_master_produk',array('kode_produk' =>@$opsi['kode_produk']));
            $hasil_opsi_produk=$get_opsi_produk->result();

            foreach ($hasil_opsi_produk as $opsi_produk) {

                if($opsi_produk->jenis_bahan=='BB'){
                    $get_konversi_produk=$this->db_master->get_where('master_bahan_baku',array('kode_bahan_baku' =>@$opsi_produk->kode_bahan));
                    $hasil_konversi_produk=$get_konversi_produk->row();

                    $jumlah_pengadaan=($opsi_produk->qty * $opsi['qty'])/$hasil_konversi_produk->konversi;

                    $cek_opsi=$this->db->get_where('opsi_pengadaan',array('kode_bahan_baku' =>@$opsi_produk->kode_bahan,'kode_pengadaan' =>@$kode_pengadaan));
                    $hasil_cek=$cek_opsi->row();
                    if(!empty($hasil_cek)){
                        $opsi_pengadaan_bb['total_kebutuhan']=@$hasil_cek->total_kebutuhan + @$jumlah_pengadaan;
                        $this->db->update('opsi_pengadaan',$opsi_pengadaan_bb,array('kode_bahan_baku' =>@$opsi_produk->kode_bahan,'kode_pengadaan' =>@$kode_pengadaan));
                    }else{
                        $opsi_pengadaan['kode_pengadaan']=$kode_pengadaan;
                        $opsi_pengadaan['kode_bahan_baku']=@$opsi_produk->kode_bahan;
                        $opsi_pengadaan['total_kebutuhan']=$jumlah_pengadaan;
                        $this->db->insert('opsi_pengadaan',$opsi_pengadaan);
                    }

                }else{

                    $get_opsi_bdp=$this->db_master->get_where('opsi_master_barang_dalam_proses',array('kode_barang' =>@$opsi_produk->kode_bahan));
                    $hasil_opsi_bdp=$get_opsi_bdp->result();
                    foreach ($hasil_opsi_bdp as $opsi_bdp) {

                        if($opsi_bdp->jenis_bahan=='BB'){
                            $get_konversi_bb=$this->db_master->get_where('master_bahan_baku',array('kode_bahan_baku' =>@$opsi_bdp->kode_bahan));
                            $hasil_konversi_bb=$get_konversi_bb->row();

                            $jumlah_pengadaan1=($opsi_bdp->qty * $opsi['qty'])/$hasil_konversi_bb->konversi;

                            $cek_opsi=$this->db->get_where('opsi_pengadaan',array('kode_bahan_baku' =>@$opsi_bdp->kode_bahan,'kode_pengadaan' =>@$kode_pengadaan));
                            $hasil_cek=$cek_opsi->row();
                            if(!empty($hasil_cek)){
                                $update_bb['total_kebutuhan']=@$hasil_cek->total_kebutuhan + @$jumlah_pengadaan1;
                                $this->db->update('opsi_pengadaan',$update_bb,array('kode_bahan_baku' =>@$opsi_bdp->kode_bahan,'kode_pengadaan' =>@$kode_pengadaan));
                            }else{
                                $opsi_pengadaan['kode_pengadaan']=$kode_pengadaan;
                                $opsi_pengadaan['kode_bahan_baku']=@$opsi_bdp->kode_bahan;
                                $opsi_pengadaan['total_kebutuhan']=$jumlah_pengadaan1;
                                $this->db->insert('opsi_pengadaan',$opsi_pengadaan);
                            }
                        }else{
                            $get_opsi_bdp2=$this->db_master->get_where('opsi_master_barang_dalam_proses',array('kode_barang' =>@$opsi_bdp->kode_bahan));
                            $hasil_opsi_bdp2=$get_opsi_bdp2->result();
                            foreach ($hasil_opsi_bdp2 as $opsi_bdp2) {
                                $jumlah_pengadaan2=$opsi_bdp2->qty * $jumlah_pengadaan1;

                                $cek_opsi=$this->db->get_where('opsi_pengadaan',array('kode_bahan_baku' =>@$opsi_bdp2->kode_bahan,'kode_pengadaan' =>@$kode_pengadaan));
                                $hasil_cek=$cek_opsi->row();
                                echo $this->db->last_query();
                                if(!empty($hasil_cek)){
                                    $update['total_kebutuhan']=@$hasil_cek->total_kebutuhan + @$jumlah_pengadaan2;
                                    $this->db->update('opsi_pengadaan',$update,array('kode_bahan_baku' =>@$opsi_bdp2->kode_bahan,'kode_pengadaan' =>@$kode_pengadaan));
                                }else{
                                    $opsi_pengadaan['kode_pengadaan']=$kode_pengadaan;
                                    $opsi_pengadaan['kode_bahan_baku']=@$opsi_bdp2->kode_bahan_baku;
                                    $opsi_pengadaan['total_kebutuhan']=$jumlah_pengadaan2;
                                    $this->db->insert('opsi_pengadaan',$opsi_pengadaan);
                                }
                                
                            }
                        }

                    }

                }
            }
        }
        $user = $this->session->userdata('astrosession');
        $kode_petugas=$user->kode_user;

        $perencanaan['kode_perencanaan']=$post['kode_perencanaan'];
        $perencanaan['bulan']=$post['bulan'];
        $perencanaan['tahun']=$post['tahun'];
        $perencanaan['tanggal_input']=date('Y-m-d');
        $perencanaan['kode_unit_jabung']=$post['kode_unit_jabung'];
        $perencanaan['kode_petugas']=$kode_petugas;
        $this->db->insert('perencanaan_produksi',$perencanaan);

        $pengadaan['kode_pengadaan']=$kode_pengadaan;
        $pengadaan['bulan']=$post['bulan'];
        $pengadaan['tahun']=$post['tahun'];
        $pengadaan['tanggal_input']=date('Y-m-d');
        $pengadaan['kode_unit_jabung']=$post['kode_unit_jabung'];
        $pengadaan['kode_petugas']=$kode_petugas;
        $this->db->insert('pengadaan',$pengadaan);

        $kode_perencanaan=$this->input->post('kode_perencanaan');
        $this->db->delete('opsi_perencanaan_produksi_temp', array('kode_perencanaan' =>$kode_perencanaan));
    }

}

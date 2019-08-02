<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pengadaan_bahan_baku extends MY_Controller {


    public function __construct()
    {
        parent::__construct();		
        if ($this->session->userdata('astrosession') == FALSE) {
            redirect(base_url('authenticate'));			
        }
    }

    public function index()
    {
        $data['konten'] = $this->load->view('pengadaan_bahan_baku/daftar', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function detail()
    {
        $this->db_master = $this->load->database('kan_master', TRUE);
        $data['konten'] = $this->load->view('pengadaan_bahan_baku/detail', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }

    public function edit()
    {
        $this->db_master = $this->load->database('kan_master', TRUE);
        $data['konten'] = $this->load->view('pengadaan_bahan_baku/edit', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function edit_ditolak()
    {
        $this->db_master = $this->load->database('kan_master', TRUE);
        $data['konten'] = $this->load->view('pengadaan_bahan_baku/edit_ditolak', NULL, TRUE);
        $this->load->view ('admin/main', $data);
    }
    public function data_pengadaan()
    {
        $this->load->view('pengadaan_bahan_baku/data_pengadaan');

    }

    public function simpan_supplier()
    {

        $this->db_keuangan = $this->load->database('kan_keuangan', TRUE);

        $post=$this->input->post();
        $kode_pengadaan=@$post['kode_pengadaan'];

        $this->db->where('kan_suol.opsi_pengadaan.kode_pengadaan', @$post['kode_pengadaan']);
        $this->db->from('kan_master.master_bahan_baku');
        $this->db->join('kan_suol.opsi_pengadaan', 'kan_suol.opsi_pengadaan.kode_bahan_baku = kan_master.master_bahan_baku.kode_bahan_baku ');
        $get_opsi_pengadaan = $this->db->get();
        $hasil_opsi_pengadaan=$get_opsi_pengadaan->result();
        $gagal=0;
        $gagal_supp=0;
        foreach ($hasil_opsi_pengadaan as $opsi) {
            $kode_supplier='kode_supplier_'.$opsi->kode_bahan_baku;
            $qty_po='qty_po_'.$opsi->kode_bahan_baku;
            $harga='harga_'.$opsi->kode_bahan_baku;
            $jml_harga='jml_harga'.$opsi->kode_bahan_baku;

            $kekurangan= @$opsi->total_kebutuhan - (@$opsi->real_stok/@$opsi->konversi);

            $jml_supplier=count(@$post[$kode_supplier]);
            $total_qty_po=0;
            $array_supplier=array();
            for ($i=0; $i < $jml_supplier ; $i++) { 
                $total_qty_po+=@$post[$qty_po][$i];
                if(in_array(@$post[$kode_supplier][$i],$array_supplier)){
                    $gagal_supp +=1;
                }else{
                    array_push($array_supplier,@$post[$kode_supplier][$i]);
                }
                
            }
            if($kekurangan == $total_qty_po){
                $this->db->delete('opsi_pengadaan',array('kode_pengadaan' =>$kode_pengadaan,'kode_bahan_baku'=>$opsi->kode_bahan_baku));

                for ($i=0; $i < $jml_supplier ; $i++) { 
                    if(!empty($post[$kode_supplier][$i])){
                        $data_opsi['kode_pengadaan']=@$kode_pengadaan;
                        $data_opsi['kode_bahan_baku']=@$opsi->kode_bahan_baku;
                        $data_opsi['total_kebutuhan']=@$opsi->total_kebutuhan;
                        $data_opsi['kode_supplier']=@$post[$kode_supplier][$i];
                        $data_opsi['stok_awal']= @$opsi->real_stok / @$opsi->konversi;
                        $data_opsi['kekurangan_kebutuhan']=@$post[$qty_po][$i];
                        $data_opsi['harga_satuan']=@$post[$harga][$i];
                        $data_opsi['nominal_subtotal']=@$post[$harga][$i] * @$post[$qty_po][$i];
                        $this->db->insert('opsi_pengadaan', $data_opsi);
                    }
                }
            }else{

                $gagal +=1;
            }
        }

        $pengadaan['nominal_subtotal']=@$post['subtotal'];
        $pengadaan['ppn']=@$post['ppn'];
        $pengadaan['nominal_ppn']=@$post['nominal_ppn'];
        $pengadaan['nominal_grand_total']=@$post['grandtotal'];
        $pengadaan['status']='proses';
        $this->db->update('pengadaan',$pengadaan,array('kode_pengadaan' =>@$post['kode_pengadaan']));

        $get_pengadaan=$this->db->get_where('pengadaan',array('kode_pengadaan' =>@$post['kode_pengadaan']));
        $hasil_pengadaan=$get_pengadaan->row_array();
        unset($hasil_pengadaan['id']);
        $this->db_keuangan->insert('pengadaan',$hasil_pengadaan);

        $get_opsi_pengadaan=$this->db->get_where('opsi_pengadaan',array('kode_pengadaan' =>@$post['kode_pengadaan']));
        $hasil_opsi_pengadaan=$get_opsi_pengadaan->result_array();
        foreach ($hasil_opsi_pengadaan as $opsi_pengadaan) {
            unset($opsi_pengadaan['id']);
            $this->db_keuangan->insert('opsi_pengadaan',$opsi_pengadaan);
        }

        if($gagal > 0){
            $respon['respon']='gagal';
            echo json_encode($respon);
        }elseif ($gagal_supp > 0) {
            $respon['respon']='gagal_supp';
            echo json_encode($respon);
        }else{
            $respon['respon']='sukses';
            echo json_encode($respon);
        }
    }

    public function update_supplier()
    {

        $this->db_keuangan = $this->load->database('kan_keuangan', TRUE);

        $post=$this->input->post();
        $kode_pengadaan=@$post['kode_pengadaan'];

        $this->db->where('kan_suol.opsi_pengadaan.kode_pengadaan', @$post['kode_pengadaan']);
        $this->db->from('kan_master.master_bahan_baku');
        $this->db->join('kan_suol.opsi_pengadaan', 'kan_suol.opsi_pengadaan.kode_bahan_baku = kan_master.master_bahan_baku.kode_bahan_baku ');
        $get_opsi_pengadaan = $this->db->get();
        $hasil_opsi_pengadaan=$get_opsi_pengadaan->result();
        $gagal=0;
        $gagal_supp=0;
        foreach ($hasil_opsi_pengadaan as $opsi) {
            $kode_supplier='kode_supplier_'.$opsi->kode_bahan_baku;
            $qty_po='qty_po_'.$opsi->kode_bahan_baku;
            $harga='harga_'.$opsi->kode_bahan_baku;
            $jml_harga='jml_harga'.$opsi->kode_bahan_baku;

            $kekurangan= @$opsi->total_kebutuhan - (@$opsi->real_stok/@$opsi->konversi);

            $jml_supplier=count(@$post[$kode_supplier]);
            $array_supplier=array();
            for ($i=0; $i < $jml_supplier ; $i++) { 
                $total_qty_po+=@$post[$qty_po][$i];
                if(in_array(@$post[$kode_supplier][$i],$array_supplier)){
                    $gagal_supp +=1;
                }else{
                    array_push($array_supplier,@$post[$kode_supplier][$i]);
                }
                
            }
            if($kekurangan == $total_qty_po){
                $this->db->delete('opsi_pengadaan',array('kode_pengadaan' =>$kode_pengadaan,'kode_bahan_baku'=>$opsi->kode_bahan_baku));

                for ($i=0; $i < $jml_supplier ; $i++) { 
                    if(!empty($post[$kode_supplier][$i])){
                        $data_opsi['kode_pengadaan']=@$kode_pengadaan;
                        $data_opsi['kode_bahan_baku']=@$opsi->kode_bahan_baku;
                        $data_opsi['total_kebutuhan']=@$opsi->total_kebutuhan;
                        $data_opsi['kode_supplier']=@$post[$kode_supplier][$i];
                        $data_opsi['stok_awal']= @$opsi->real_stok / @$opsi->konversi;
                        $data_opsi['kekurangan_kebutuhan']=@$post[$qty_po][$i];
                        $data_opsi['harga_satuan']=@$post[$harga][$i];
                        $data_opsi['nominal_subtotal']=@$post[$harga][$i] * @$post[$qty_po][$i];
                        $this->db->insert('opsi_pengadaan', $data_opsi);
                    }
                }
            }else{

                $gagal +=1;
            }
        }

        $pengadaan['nominal_subtotal']=@$post['subtotal'];
        $pengadaan['ppn']=@$post['ppn'];
        $pengadaan['nominal_ppn']=@$post['nominal_ppn'];
        $pengadaan['nominal_grand_total']=@$post['grandtotal'];
        $pengadaan['status']='proses';
        $this->db->update('pengadaan',$pengadaan,array('kode_pengadaan' =>@$post['kode_pengadaan']));

        $get_pengadaan=$this->db->get_where('pengadaan',array('kode_pengadaan' =>@$post['kode_pengadaan']));
        $hasil_pengadaan=$get_pengadaan->row_array();
        unset($hasil_pengadaan['id']);
        $this->db_keuangan->insert('pengadaan',$hasil_pengadaan);

        $this->db_keuangan->delete('opsi_pengadaan',array('kode_pengadaan' =>$kode_pengadaan));
        
        $get_opsi_pengadaan=$this->db->get_where('opsi_pengadaan',array('kode_pengadaan' =>@$post['kode_pengadaan']));
        $hasil_opsi_pengadaan=$get_opsi_pengadaan->result_array();
        foreach ($hasil_opsi_pengadaan as $opsi_pengadaan) {
            unset($opsi_pengadaan['id']);
            $this->db_keuangan->insert('opsi_pengadaan',$opsi_pengadaan);
        }

        if($gagal > 0){
            $respon['respon']='gagal';
            echo json_encode($respon);
        }elseif ($gagal_supp > 0) {
            $respon['respon']='gagal_supp';
            echo json_encode($respon);
        }else{
            $respon['respon']='sukses';
            echo json_encode($respon);
        }
    }

}

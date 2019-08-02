<?php
$kode = $this->uri->segment(3);
$this->db->where('kan_suol.opsi_transaksi_produksi.kode_produksi', $kode);
$this->db->from('kan_suol.opsi_transaksi_produksi');
$this->db->join('kan_master.master_barang_dalam_proses', 'kan_suol.opsi_transaksi_produksi.kode_bahan = kan_master.master_barang_dalam_proses.kode_barang', 'left');
$this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_produksi.kode_bahan = kan_master.master_produk.kode_produk', 'left');
$hasil_data_opsi= $this->db->get()->result();
$nomor=0;
foreach ($hasil_data_opsi as $opsi) {
  if($opsi->kategori_bahan == 'Produk'){
    $nama_produk = $opsi->nama_produk;
  } else{
    $nama_produk = $opsi->nama_barang;
  }
  ?>
  <label>RELEASE PRODUCT</label>
  <table id="tabel_release_produk" class="table table-bordered table-striped" style="">

    <tr>
      <td style="text-align: center;width:25%;"><label>Tanggal</label></td>
      <td colspan="3">
        <div class="input-group">
          <input type="date" class="form-control" name="tanggal_rilis[]" value="<?php echo date("Y-m-d"); ?>">
          <span class="input-group-btn">
            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
          </span>
        </div>
      </td>
    </tr>

    <tr>
      <td style="text-align: center;"><label>Produk</label></td>
      <td colspan="3" ><input type="text" value="<?php echo @$nama_produk; ?>" class='form-control' readonly/></td>
    </tr> 

    <tr>
      <td style="text-align: center;width:25%;"><label>Tanggal Produksi</label></td>
      <td colspan="3" >
        <div class="input-group">
          <input type="date" class="form-control" name="tanggal_produksi_opsi[]" value="<?php echo date("Y-m-d"); ?>">
          <span class="input-group-btn">
            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
          </span>
        </div>
      </td>
    </tr>
    <tr>
      <td style="text-align: center;width:25%;"><label>Tanggal Exprd</label></td>
      <td colspan="3" >
        <div class="input-group">
          <input type="date" class="form-control" name="expired_date[]" value="<?php echo date("Y-m-d"); ?>">
          <span class="input-group-btn">
            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
          </span>
        </div>
      </td>
    </tr>
    <tr >
      <td style="text-align: center;"><label>REVIEW CRITERIA</label></td>
      <td style="text-align: center;width:5%; "><label>Yes</label></td>
      <td style="text-align: center;width:5%;"><label>No</label></td>
      <td style="text-align: center;"><label>Remarks</label></td>
    </tr>  

    <tr>
      <td style="text-align: center;"><label>1.Spesifikasi Bahan Baku</label></td>
      <td style="text-align: center;"><label><input type="radio" name="spesifikasi_bb<?php echo $nomor;?>" value="Yes"></label></td>
      <td style="text-align: center;"><label><input type="radio" name="spesifikasi_bb<?php echo $nomor;?>" value="No" checked></label></td>
      <td style="text-align: center;"><input type="text" name="remark_spesifikasi_bb[]" class='form-control'  /></td>
    </tr> 

    <tr>
      <td style="text-align: center;"><label>2.Spesifikasi Kemasan</label></td>
      <td style="text-align: center;"><label><input type="radio" name="spesifikasi_kemasan<?php echo $nomor;?>" value="Yes"></label></td>
      <td style="text-align: center;"><label><input type="radio" name="spesifikasi_kemasan<?php echo $nomor;?>" value="No" checked></label></td>
      <td style="text-align: center;"><input type="text" name="remark_spesifikasi_kemasan[]" class='form-control'  /></td>
    </tr> 

    <tr>
      <td style="text-align: center;"><label>3.Kesesuaian Prosedur Proses</label></td>
      <td style="text-align: center;"><label><input type="radio" name="kpp<?php echo $nomor;?>" value="Yes"></label></td>
      <td style="text-align: center;"><label><input type="radio" name="kpp<?php echo $nomor;?>" value="No" checked></label></td>
      <td style="text-align: center;"><input  type="text" name="remark_kpp[]" class='form-control'  /></td>
    </tr> 

    <tr>
      <td style="text-align: center;"><label>4.Hasil Analisa</label></td>
      <td style="text-align: center;"><label><input type="radio" name="hasil_analisa<?php echo $nomor;?>" value="Yes"></label></td>
      <td style="text-align: center;"><label><input type="radio" name="hasil_analisa<?php echo $nomor;?>" value="No" checked></label></td>
      <td style="text-align: center;"><input  type="text" name="remark_hasil_analisa[]" class='form-control'  /></td>
    </tr> 
  </table>

  <table id="tabel_problem" class="table table-bordered table-striped" style="">
    <tr>
      <td colspan="3" style="text-align: center;"><label>Kegagalan Produksi</label></td>
    </tr>
    <tr>
      <td style="text-align: center;width:10%;"><label>#</label></td>
      <td style="text-align: center;"><label>PROBLEM</label></td>
      <td style="text-align: center;"><span class="glyphicon glyphicon-ok"></span></td>
    </tr>
    <tr>
      <td style="text-align: center;"><label>1.</label></td>
      <td ><label>Listrik Padam</label></td>
      <td style="text-align: center;">
        <input type="checkbox" value="Listrik Padam" name="kegagalan_produksi<?php echo $nomor;?>[]">
      </td>
    </tr>

    <tr>
      <td style="text-align: center;width:10%;"><label>2.</label></td>
      <td  style="text-align: center;"><label>TABEL PERALATAN</label></td>
      <td style="text-align: center;"></td>
    </tr>

    <tr>
      <td style="text-align: center;"><label>a.</label></td>
      <td style=""><label>Voltage Turun</label></td>
      <td style="text-align: center;">
        <input type="checkbox" value="Voltage Turun" name="kegagalan_produksi<?php echo $nomor;?>[]">
      </td>
    </tr>

    <tr>
      <td style="text-align: center;"><label>b.</label></td>
      <td style=""><label>Pompa Susah</label></td>
      <td style="text-align: center;">
        <input type="checkbox" value="Pompa Susah" name="kegagalan_produksi<?php echo $nomor;?>[]">
      </td>
    </tr> 

    <tr>
      <td style="text-align: center;"><label>c.</label></td>
      <td style=""><label>Kompresor Bermasalah</label></td>
      <td style="text-align: center;">
        <input type="checkbox" value="Kompresor Bermasalah" name="kegagalan_produksi<?php echo $nomor;?>[]">
      </td>
    </tr>
    <tr>
      <td style="text-align: center;width:10%;"><label>d.</label></td>
      <td style=""><label>Mesin Packing</label></td>
      <td style="text-align: center;">
        <input type="checkbox" value="Mesin Packing" name="kegagalan_produksi<?php echo $nomor;?>[]">
      </td>
    </tr>  
                
  </table>
  <hr style="border-top: 5px solid #0c7a23">
  <br>
  <?php
  $nomor++;
}
?>

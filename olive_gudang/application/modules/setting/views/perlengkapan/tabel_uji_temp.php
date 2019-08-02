<?php
$kode = $this->uri->segment(3);
$this->db->where('kan_suol.opsi_transaksi_produksi.kode_produksi', $kode);
$this->db->from('kan_suol.opsi_transaksi_produksi');
$this->db->join('kan_master.master_barang_dalam_proses', 'kan_suol.opsi_transaksi_produksi.kode_bahan = kan_master.master_barang_dalam_proses.kode_barang', 'left');
$this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_produksi.kode_bahan = kan_master.master_produk.kode_produk', 'left');
$hasil_data_opsi= $this->db->get()->result();
?>
<label>HASIL ANALISA :</label>

<table id="tabel_hasil_analisa" class="table table-bordered table-striped" style="font-size:1.5em;overflow-x:auto; <?php if(count($hasil_data_opsi) > 5){ echo "display:block;";}?>">
  <tr>
    <?php
    foreach ($hasil_data_opsi as $produk) {
      ?>
      <th colspan="3" style="text-align: center;"><label>
        <?php 
        if($produk->kategori_bahan == 'Produk'){
          echo $produk->nama_produk;
        } else{
          echo $produk->nama_barang;
        }
        ?>
      </label></th>
      <?php
    }
    ?>
  </tr>
  <tr>
    <?php
    foreach ($hasil_data_opsi as $produk) {
      ?>
      <td ><label>PH</label></td>
      <td style="text-align: center;" width="1%" ><label>:</label></td> 
      <td><label><input type="text" class='form-control' name="ph[]" placeholder="PH" /></label></td> 
      <?php
    }
    ?>
  </tr>
  <tr>
    <?php
    foreach ($hasil_data_opsi as $produk) {
      ?>
      <td ><label>Fat</label></td>
      <td style="text-align: center;" width="1%"><label>:</label></td> 
      <td><label><input type="text" class='form-control' name="fat[]" placeholder="Fat" /></label></td> 
      <?php
    }
    ?>
  </tr>
  <tr>
    <?php
    foreach ($hasil_data_opsi as $produk) {
      ?>
      <td ><label>Protein</label></td>
      <td style="text-align: center;" width="1%"><label>:</label></td> 
      <td><label><input type="text" class='form-control' name="protein[]" placeholder="Protein" /></label></td> 
      <?php
    }
    ?>
  </tr>
  <tr>
    <?php
    foreach ($hasil_data_opsi as $produk) {
      ?>
      <td ><label>Keasaman</label></td>
      <td style="text-align: center;" width="1%"><label>:</label></td> 
      <td><label><input type="text" class='form-control' name="keasaman[]" placeholder="Keasaman" /></label></td> 
      <?php
    }
    ?>
  </tr>
  <tr>
    <?php
    foreach ($hasil_data_opsi as $produk) {
      ?>
      <td ><label>Coliform</label></td>
      <td style="text-align: center;" width="1%"><label>:</label></td> 
      <td><label><input type="text" class='form-control' name="coliform[]" placeholder="Coliform" /></label></td> 
      <?php
    }
    ?>
  </tr>
  <tr>
    <?php
    foreach ($hasil_data_opsi as $produk) {
      ?>
      <td ><label>Reduktase</label></td>
      <td style="text-align: center;" width="1%"><label>:</label></td> 
      <td><label><input type="text" class='form-control' name="reduktase[]" placeholder="Reduktase" /></label></td> 
      <?php
    }
    ?>
  </tr>
  <tr>
    <?php
    foreach ($hasil_data_opsi as $produk) {
      ?>
      <td ><label>TPC</label></td>
      <td style="text-align: center;" width="1%"><label>:</label></td> 
      <td><label><input type="text" class='form-control' name="tpc[]" placeholder="TPC" /></label></td> 
      <?php
    }
    ?>
  </tr>
  <tr>
    <?php
    foreach ($hasil_data_opsi as $produk) {
      ?>
      <td ><label>Alkohol</label></td>
      <td style="text-align: center;" width="1%"><label>:</label></td> 
      <td><label><input type="text" class='form-control' name="alkohol[]" placeholder="Alkohol" /></label></td> 
      <?php
    }
    ?>
  </tr>
  <tr>
    <?php
    foreach ($hasil_data_opsi as $produk) {
      ?>
      <td ><label>BJ</label></td>
      <td style="text-align: center;" width="1%" ><label>:</label></td> 
      <td><label><input type="text" class='form-control' name="bj[]" placeholder="BJ" /></label></td> 
      <?php
    }
    ?>
  </tr>
</table>

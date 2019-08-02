<?php 
$tgl_awal=$this->input->post('tgl_awal');
$tgl_akhir=$this->input->post('tgl_akhir');
if(!empty($tgl_awal) && !empty($tgl_akhir)){
  $this->db->where('tanggal_retur_keluar >=', $tgl_awal);
  $this->db->where('tanggal_retur_keluar <=', $tgl_akhir);
}
$this->db->order_by('id','DESC');
$get_gudang = $this->db->get('transaksi_retur')->result();
$total_retur=count($get_gudang);
$no = 0;
foreach ($get_gudang as $value) { 
  $no++; ?>
  <tr>
    <td><?= $no ?></td>
    <td><?= $value->kode_retur ?></td>
    <td><?= $value->nomor_nota ?></td>
    <td><?= $value->total_nominal ?></td>
    <td><?= $value->status_retur ?></td>
    <td><?= $value->grand_total ?></td>
    <td align="center">
      <a href="<?php echo base_url('retur/tambah_retur/detail/'.$value->kode_retur ) ?>" class="btn btn-primary"><i class="fa fa-search"></i> </a>
      <?php if(@$value->status_retur=='menunggu'){
        ?>
        <a href="<?php echo base_url('retur/tambah_retur/edit/'.$value->kode_retur ) ?>" class="btn btn-danger"><i class="fa fa-pencil"></i> </a>
        <?php
      }?>

    </td>
  </tr>
  <?php 
} 
?>
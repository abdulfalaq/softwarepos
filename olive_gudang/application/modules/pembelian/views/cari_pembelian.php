<?php 
$tgl_awal=$this->input->post('tgl_awal');
$tgl_akhir=$this->input->post('tgl_akhir');
if(!empty($tgl_awal) && !empty($tgl_akhir)){
	$this->db->where('tanggal_pembelian >=', $tgl_awal);
	$this->db->where('tanggal_pembelian <=', $tgl_akhir);
}
$this->db->order_by('clouoid1_olive_gudang.transaksi_pembelian.id','DESC');
$this->db->from('clouoid1_olive_gudang.transaksi_pembelian');
$this->db->join('clouoid1_olive_master.master_supplier', 'clouoid1_olive_gudang.transaksi_pembelian.kode_supplier = clouoid1_olive_master.master_supplier.kode_supplier', 'left');
$get_gudang = $this->db->get()->result();
$no = 1;
foreach ($get_gudang as $value) { ?>
<tr>
	<td><?php echo $no ?></td>
	<td><?php echo tanggalIndo($value->tanggal_pembelian) ?></td>
	<td><?php echo $value->kode_pembelian ?></td>
	<td><?php echo $value->nomor_nota ?></td>
	<td><?php echo $value->nama_supplier ?></td>
	<td><?php echo format_rupiah ($value->grand_total) ?></td>
	<td>
		<div class="btn-group">
			<a href="<?php echo base_url('pembelian/pembelian/detail/'.$value->kode_pembelian); ?>" data-toggle="tooltip" title="Detail" class="btn btn-success"><i class="fa fa-search"></i> </a>
		</div>
	</td>
</tr>
<?php $no++; }
?>		
<?php 
$tgl_awal=$this->input->post('tgl_awal');
$tgl_akhir=$this->input->post('tgl_akhir');
if(!empty($tgl_awal) && !empty($tgl_akhir)){
	$this->db->where('tanggal_transaksi >=', $tgl_awal);
	$this->db->where('tanggal_transaksi <=', $tgl_akhir);
}
$this->db->order_by('clouoid1_olive_keuangan.transaksi_penggajian.id','DESC');
$this->db->from('clouoid1_olive_keuangan.transaksi_penggajian');
$this->db->join('clouoid1_olive_master.master_karyawan', 'clouoid1_olive_keuangan.transaksi_penggajian.kode_karyawan = clouoid1_olive_master.master_karyawan.kode_karyawan', 'left');
$get_gudang = $this->db->get()->result();

$no = 0;
foreach ($get_gudang as $value) { 
	$no++; ?>
	<tr>
		<td><?= $no ?></td>
		<td><?= @tanggalIndo($value->tanggal_transaksi) ?></td>
		<td><?= $value->nama_karyawan ?></td>
		<td><?= @format_rupiah($value->total_gaji) ?></td>
		<td align="center">
			<div class="btn-group">
				<a href="<?php echo base_url('penggajian/detail/'.@$value->kode_transaksi); ?>" data-toggle="tooltip" style="background-color: #26a69a;color:white" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i> </a>
			</div>
		</td>
	</tr>
	<?php }
	?>
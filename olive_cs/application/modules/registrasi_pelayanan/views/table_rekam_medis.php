<?php
$kode_member=$this->uri->segment(4);
$this->db->from('olive_kasir.data_record_anggota');
$this->db->join('olive_kasir.data_rekam_medik','olive_kasir.data_rekam_medik.kode_member = olive_kasir.data_record_anggota.kode_member','left');
$this->db->where('olive_kasir.data_record_anggota.kode_member', @$kode_member);
$data_rekam_medik=$this->db->get()->result();
foreach ($data_rekam_medik as $data) {
	?>
	<tr>
		<td><?php echo @TanggalIndo($data->tanggal_transaksi);?></td>
		<td><?php echo $data->anamnesa ?></td>
		<td><?php echo @$data->diagnosa;?></td>
	</tr>
	<?php
}
?>
<?php
$this->db->from('olive_kasir.data_record_anggota');
$this->db->where('olive_kasir.data_record_anggota.kode_member',$get_data->kode_member);
$this->db->join('olive_master.master_perawatan','olive_master.master_perawatan.kode_perawatan = olive_kasir.data_record_anggota.kode_item','left');
$this->db->join('olive_master.master_produk','olive_master.master_produk.kode_produk = olive_kasir.data_record_anggota.kode_item','left');
$this->db->order_by('olive_kasir.data_record_anggota.id','DESC');
$get_medik = $this->db->get()->result();
foreach ($get_medik as  $value) { ?>
	<tr>
		<td><?php echo tanggalIndo($value->tanggal_transaksi) ?></td>
		<td><?php echo @$value->nama_perawatan; echo @$value->nama_produk ?></td>
		<td><?php echo $value->qty ?></td>
	</tr>
	<?php }
	?>

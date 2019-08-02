<?php
$kode_transaksi=$this->uri->segment(3);
$jenis_opsi=$this->uri->segment(4);

$this->db->select('olive_kasir.opsi_transaksi_batal_temp.id');
$this->db->select('olive_kasir.opsi_transaksi_batal_temp.qty');
$this->db->select('olive_kasir.opsi_transaksi_batal_temp.jenis_diskon');
$this->db->select('olive_kasir.opsi_transaksi_batal_temp.diskon_persen');
$this->db->select('olive_kasir.opsi_transaksi_batal_temp.diskon_rupiah');
$this->db->select('olive_kasir.opsi_transaksi_batal_temp.harga');
$this->db->select('olive_kasir.opsi_transaksi_batal_temp.subtotal');
$this->db->select('olive_kasir.opsi_transaksi_batal_temp.jenis_item');
$this->db->select('olive_master.master_produk.nama_produk');
$this->db->select('olive_master.master_perawatan.nama_perawatan');
$this->db->select('olive_master.master_karyawan.nama_karyawan');

if(@$jenis_opsi=='Treatment'){
	$this->db->where('jenis_item', 'Treatment');
}else{
	$this->db->where('jenis_item !=', 'Treatment');
}
$this->db->where('kode_transaksi', $kode_transaksi);
$this->db->from('olive_kasir.opsi_transaksi_batal_temp');
$this->db->join('olive_master.master_produk', 'olive_kasir.opsi_transaksi_batal_temp.kode_item = olive_master.master_produk.kode_produk', 'left');
$this->db->join('olive_master.master_perawatan', 'olive_kasir.opsi_transaksi_batal_temp.kode_item = olive_master.master_perawatan.kode_perawatan', 'left');
$this->db->join('olive_master.master_karyawan', 'olive_kasir.opsi_transaksi_batal_temp.kode_terapis = olive_master.master_karyawan.kode_karyawan', 'left');
$get_temp=$this->db->get()->result();
$no=1;
foreach ($get_temp as $temp) {
	?>
	<tr>
		<td><?php echo $no++;;?></td>
		<td><?php if(@$jenis_opsi=='Treatment'){echo @$temp->nama_perawatan;}else{echo @$temp->nama_produk;}?></td>
		<td><?php echo @$temp->qty;?></td>
		<td><?php echo @format_rupiah($temp->harga);?></td>
		<td><?php if(@$temp->jenis_diskon=='persen'){ echo @$temp->diskon_persen.' %'; }else{ echo @format_rupiah(@$temp->diskon_rupiah);}?></td>
		<td><?php echo @format_rupiah($temp->subtotal);?></td>
		<td><?php echo @$temp->nama_karyawan;?></td>
		<td><?php echo @get_edit_delete($temp->id);?></td>
	</tr>
	<?php
}
?>

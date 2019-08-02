<?php
$kode_transaksi=$this->uri->segment(3);

$this->db->select('olive_kasir.opsi_transaksi_layanan_temp.id');
$this->db->select('olive_kasir.opsi_transaksi_layanan_temp.qty');
$this->db->select('olive_kasir.opsi_transaksi_layanan_temp.jenis_diskon');
$this->db->select('olive_kasir.opsi_transaksi_layanan_temp.diskon_persen');
$this->db->select('olive_kasir.opsi_transaksi_layanan_temp.diskon_rupiah');
$this->db->select('olive_kasir.opsi_transaksi_layanan_temp.harga');
$this->db->select('olive_kasir.opsi_transaksi_layanan_temp.subtotal');
$this->db->select('olive_kasir.opsi_transaksi_layanan_temp.jenis_item');
$this->db->select('olive_master.master_produk.nama_produk');
$this->db->select('olive_master.master_karyawan.nama_karyawan');

$this->db->where('kode_transaksi', $kode_transaksi);
$this->db->from('olive_kasir.opsi_transaksi_layanan_temp');
$this->db->join('olive_master.master_produk', 'olive_kasir.opsi_transaksi_layanan_temp.kode_item = olive_master.master_produk.kode_produk', 'left');
$this->db->join('olive_master.master_karyawan', 'olive_kasir.opsi_transaksi_layanan_temp.kode_terapis = olive_master.master_karyawan.kode_karyawan', 'left');
$get_temp=$this->db->get()->result();
$no=1;
foreach ($get_temp as $temp) {
	if($temp->jenis_item!='kartu member'){

		?>
		<tr>
			<td><?php echo $no++;;?></td>
			<td><?php echo @$temp->nama_produk;?></td>
			<td><?php echo @$temp->qty;?></td>
			<td><?php echo @format_rupiah($temp->harga);?></td>
			<td><?php if(@$temp->jenis_diskon=='persen'){ echo @$temp->diskon_persen.' %'; }else{ echo @format_rupiah(@$temp->diskon_rupiah);}?></td>
			<td><?php echo @format_rupiah($temp->subtotal);?></td>
			<td><?php echo @$temp->nama_karyawan;?></td>
			<td>
				<?php echo @get_edit_delete_poin($temp->id);?>
			</td>
		</tr>
		<?php
	}else{
		?>
		<tr>
			<td><?php echo $no++;;?></td>
			<td>Kartu Member</td>
			<td><?php echo @$temp->qty;?></td>
			<td><?php echo @format_rupiah($temp->harga);?></td>
			<td><?php if(@$temp->jenis_diskon=='persen'){ echo @$temp->diskon_persen.' %'; }else{ echo @format_rupiah(@$temp->diskon_rupiah);}?></td>
			<td><?php echo @format_rupiah($temp->subtotal);?></td>
			<td></td>
			<td></td>
		</tr>
		<?php
	}
}
?>

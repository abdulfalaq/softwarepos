<?php 
$kode_supplier=$this->input->post('kode_supplier');
$tgl_awal=$this->input->post('tgl_awal');
$tgl_akhir=$this->input->post('tgl_akhir');

if(!empty($tgl_awal) && !empty($tgl_akhir)){
	$this->db->where('tanggal_transaksi >=', @$tgl_awal);
	$this->db->where('tanggal_transaksi <=', @$tgl_akhir);
}
$this->db->order_by('id','DESC');
$this->db->where('kode_supplier',$kode_supplier);
$get_gudang = $this->db->get('olive_gudang.transaksi_hutang')->result();

$no = 0;
foreach ($get_gudang as $value) { 
	$no++; ?>
	<tr>
		<td><?= $no ?></td>
		<td><?= @$value->kode_transaksi ?></td>
		<td><?= tanggalIndo(@$value->tanggal_transaksi) ?></td>
		<td><?= @$value->kode_supplier ?></td>
		<td><?= format_rupiah(@$value->nominal_hutang)  ?></td>
		<td><?= format_rupiah(@$value->sisa)  ?></td>
		<td><?= tanggalIndo(@$value->tanggal_jatuh_tempo) ?></td>
		<td>
			<?php
			if (@$value->sisa == '0' ) {
				echo ('Lunas');
			} else {
				echo ('Angsuran');
			}		
			?>
		</td>
		<td align="center">
			<a href="<?php echo base_url('supplier/akun_supplier/detail_hutang/'.@$value->kode_supplier.'/'.@$value->kode_transaksi) ?>" class="btn btn-success "><i class="fa fa-eye"></i> Detail</a>
			<?php
			if (@$value->sisa != '0' ) {
				?>
				<a href="<?php echo base_url('supplier/akun_supplier/bayar_hutang/'.@$value->kode_supplier.'/'.@$value->kode_transaksi) ?>" class="btn btn-primary "><i class="fa fa-money"></i> Bayar</a>
				<?php
			} 
			?>

		</td>
	</tr>
	<?php 
} 
?>
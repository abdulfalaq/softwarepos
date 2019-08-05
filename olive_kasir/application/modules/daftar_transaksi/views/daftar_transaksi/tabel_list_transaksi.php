<?php
$tgl_awal=$this->input->post('tgl_awal');
$tgl_akhir=$this->input->post('tgl_akhir');

if(!empty($tgl_awal) || !empty($tgl_akhir)){
	$this->db->where('clouoid1_olive_kasir.transaksi_layanan.tanggal_transaksi >=',@$tgl_awal);
	$this->db->where('clouoid1_olive_kasir.transaksi_layanan.tanggal_transaksi <=',@$tgl_akhir);
}else{
	$this->db->where('clouoid1_olive_kasir.transaksi_layanan.tanggal_transaksi',date('Y-m-d'));
}
$this->db->select('clouoid1_olive_kasir.transaksi_layanan.kode_transaksi');
$this->db->select('clouoid1_olive_kasir.transaksi_layanan.tanggal_transaksi');
$this->db->select('clouoid1_olive_kasir.transaksi_layanan.grand_total');
$this->db->select('clouoid1_olive_master.master_member.nama_member');
$this->db->select('clouoid1_olive_master.master_layanan.nama_layanan');

$this->db->where('clouoid1_olive_kasir.transaksi_layanan.status','proses');
$this->db->from('clouoid1_olive_kasir.transaksi_layanan');
$this->db->join('clouoid1_olive_master.master_member', 'clouoid1_olive_kasir.transaksi_layanan.kode_member = clouoid1_olive_master.master_member.kode_member', 'left');
$this->db->join('clouoid1_olive_master.master_layanan', 'clouoid1_olive_kasir.transaksi_layanan.kode_layanan = clouoid1_olive_master.master_layanan.kode_layanan', 'left');
$get_list=$this->db->get()->result();
$no=1;
foreach ($get_list as $lsit) {
	?>
	<tr>
		<td><?php echo $no++;?></td>
		<td><?php echo @TanggalIndo($lsit->tanggal_transaksi);?></td>
		<td><?php echo @$lsit->kode_transaksi;?></td>
		<td><?php echo @$lsit->nama_member;?></td>
		<td><?php echo @$lsit->nama_layanan;?></td>
		<td><?php echo @format_rupiah($lsit->grand_total);?></td>
		<td>
			<div class="button-group">
				<a href="<?php echo base_url('kasir/kasir_layanan/'. @$lsit->kode_transaksi); ?>" class="btn btn-icon waves-effect waves-light btn-success m-b-5">
					<li class="fa fa-money"></li>
				</a>
			</div>
		</td>
	</tr>
	<?php
}
?>

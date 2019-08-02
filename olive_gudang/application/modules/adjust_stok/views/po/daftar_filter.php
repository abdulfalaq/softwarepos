<?php
$data = $this->input->post();


$this->db->select('kan_suol.transaksi_po.kode_po, kan_suol.transaksi_po.tanggal_input,kan_suol.transaksi_po.tanggal_barang_datang,kan_suol.transaksi_po.status');
$this->db->select('kan_master.master_user.nama_user');
$this->db->order_by('kan_suol.transaksi_po.id','DESC');
$this->db->like('kan_suol.transaksi_po.tanggal_barang_datang',$data['bulan']);
$this->db->from('kan_suol.transaksi_po');
$this->db->join('kan_master.master_user', 'kan_suol.transaksi_po.kode_petugas = kan_master.master_user.kode_user ');
$get_po = $this->db->get();
$hasil_po=$get_po->result();
$no=1;
foreach ($hasil_po as $po) {
	?>
	<tr>
		<td><?php echo $no++;?></td>
		<td><?php echo @$po->kode_po;?></td>
		<td><?php echo @TanggalIndo($po->tanggal_input);?></td>
		<td><?php echo @TanggalIndo($po->tanggal_barang_datang);?></td>
		<td><?php echo @$po->nama_user;?></td>
		<td><?php echo @$po->status;?></td>
		<td>
			<a href="<?php echo base_url().'pembelian/po/detail/'.@paramEncrypt($po->kode_po);?>" class="btn btn-icon waves-effect btn-no-radius waves-light btn-success m-b-5"><i class="fa fa-eye"></i></a>
		</td>   
	</tr>
	<?php
}
?>

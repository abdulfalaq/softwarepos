<?php 
$bulan=$this->input->post('bulan');
$tahun=$this->input->post('tahun');

$tanggal 	= date('Y-m-d');
$month 		= date("m",strtotime($tanggal));

$this->db->where('MONTH(tanggal_transaksi)', $bulan);
$this->db->where('YEAR(tanggal_transaksi)', $tahun);
$this->db->where('status', 'selesai');
$this->db->order_by('tanggal_transaksi','desc');
$this->db->group_by('tanggal_transaksi');
$get_transaksi = $this->db->get('transaksi_layanan')->result();

$no = 0;
foreach ($get_transaksi as $value) { 
	$no++; ?>
	<tr>
		<td><?php echo $no ?></td>
		<td><?php echo tanggalIndo($value->tanggal_transaksi); ?></td>
		<td align="right"><?php 
		$this->db->select_sum('grand_total');
		$this->db->where('status', 'selesai');
		$this->db->where('tanggal_transaksi', $value->tanggal_transaksi);
		$total_jual = $this->db->get('transaksi_layanan');
		$hasil_total = $total_jual->row();
		echo format_rupiah(@$hasil_total->grand_total); ?></td>
		<td align="center">
			<div class="btn-group">
				<a href="<?php echo base_url('daftar_transaksi/daftar_transaksi/detail/'.$value->tanggal_transaksi) ?>" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle btn-primary"><i class="fa fa-search"></i></a>
			</div>
		</td>
	</tr>
	<?php }
	?>
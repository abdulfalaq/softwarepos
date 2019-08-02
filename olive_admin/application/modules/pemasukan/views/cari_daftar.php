<?php 
$tgl_awal=$this->input->post('tgl_awal');
$tgl_akhir=$this->input->post('tgl_akhir');
if(!empty($tgl_awal) && !empty($tgl_akhir)){
	$this->db->where('olive_keuangan.keuangan_masuk.tanggal_transaksi >=', $tgl_awal);
	$this->db->where('olive_keuangan.keuangan_masuk.tanggal_transaksi <=', $tgl_akhir);
}
$this->db->order_by('id','DESC');
$get_gudang = $this->db->get('olive_keuangan.keuangan_masuk')->result();
?>
<table class="table table-striped table-hover table-bordered" id="datatable">
	<thead>
		<tr>
			<th width="50px;">No</th>
			<th>Tanggal</th>
			<th>Kategori</th>
			<th>Nama Akun</th>
			<th>Nominal</th>
			<th width="133px;">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no = 0;
		foreach ($get_gudang as $value) { 
			$no++; ?>
			<tr>               
				<td><?= $no ?></td>
				<td><?= $value->tanggal_transaksi ?></td>
				<td><?= $value->nama_kategori_keuangan ?></td>
				<td><?= $value->nama_sub_kategori_keuangan ?></td>                  
				<td><?= $value->nominal ?></td>                  
				<td align="center">
					<div class="btn-group">
						<a href="<?php echo base_url ("pemasukan/pemasukan/detail/".$value->kode_sub_kategori_keuangan); ?>" data-toggle="tooltip" style="background-color: #26a69a;color:white" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i> </a>
					</div>
				</td>
			</tr>
			<?php 
		} 
		?>
	</tbody>                
</table>
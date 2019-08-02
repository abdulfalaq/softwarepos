<?php
$bulan=$this->input->post('bulan');
$this->db->order_by('id','DESC');
$get_pengadaan=$this->db->get_where('pengadaan',array('tahun' =>date('Y'),'bulan' =>$bulan));
$hasil_pengadaan=$get_pengadaan->result();
$no=1;
foreach ($hasil_pengadaan as $pengadaan) {
	?>
	<tr>
		<td><?php echo $no++;?></td>
		<td><?php echo @$pengadaan->kode_pengadaan;?></td>
		<td><?php echo @BulanIndo($pengadaan->bulan);?></td>
		<td><?php echo @$pengadaan->tahun;?></td>
		<td><?php echo @$pengadaan->status;?></td>
		<td>
			<?php 
			if(empty($pengadaan->status)){
				?>
				<a href="<?php echo base_url('pembelian/pengadaan_bahan_baku/edit').'/'.@$pengadaan->kode_pengadaan; ?>" class="btn btn-icon waves-effect btn-no-radius waves-light btn-warning m-b-5">
					<li class="fa fa-pencil"></li>
				</a>
				<?php
			}else{
				?>
				<a href="<?php #echo base_url().'pembelian/perencanaan_produksi/detail/'.@$perencanaan->kode_perencanaan;?>" class="btn btn-icon waves-effect btn-no-radius waves-light btn-success m-b-5">
					<li class="fa fa-eye"></li>
				</a>
				<?php
			}
			?>
		</td>   
	</tr>
	<?php
}
?>
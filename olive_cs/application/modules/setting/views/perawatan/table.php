<?php 
$data = $this->input->post();
$this->db->from('olive_master.opsi_master_perawatan_temp');
$this->db->select('olive_master.opsi_master_perawatan_temp.hpp');
$this->db->select('olive_master.opsi_master_perawatan_temp.kode_perawatan');
$this->db->select('olive_master.opsi_master_perawatan_temp.id');
$this->db->select('olive_master.opsi_master_perawatan_temp.jenis');
$this->db->select('olive_master.opsi_master_perawatan_temp.qty');
$this->db->select('olive_master.master_perlengkapan.nama_perlengkapan');
$this->db->select('olive_master.master_bahan_baku.nama_bahan_baku');


$this->db->join('olive_master.master_perlengkapan','olive_master.master_perlengkapan.kode_perlengkapan = olive_master.opsi_master_perawatan_temp.kode_perlengkapan','Left');
$this->db->join('olive_master.master_bahan_baku','olive_master.master_bahan_baku.kode_bahan_baku = olive_master.opsi_master_perawatan_temp.kode_bahan','Left');

$this->db->where('olive_master.opsi_master_perawatan_temp.kode_perawatan',$data['kode_perawatan']);
$get_sapi = $this->db->get()->result();
?>
<table id="" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th width="5%">No as</th>
			<th>Kode</th>
			<th>Nama</th>
			<th>HPP</th>
			<th>Qty</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no = 0;
		$hpp=0;
		foreach ($get_sapi as $value) { 
			$hpp+=@$value->hpp * @$value->qty;
			$no++;
			?> 
			<tr>
				<td><?= $no ?></td>
				<td><?= $value->kode_perawatan ?></td>		
				<td>
					<?php if($value->jenis == 'Perlengkapan'){
						echo ($value->nama_perlengkapan);
					}else {
						echo ($value->nama_bahan_baku);
					}
					?>

				</td>
				<td><?= $value->hpp ?></td>
				<td><?= $value->qty ?></td>	
				<td><div class="btn-group">
				
					<a onclick="actEdit('<?php echo $value->id ?>')"   class="btn btn-icon waves-effect btn-no-radius waves-light btn-warning m-b-5"><i class="fa fa-pencil"></i></a>
					<a onclick="actDelete('<?php echo $value->id ?>')" class="btn btn-no-radius btn-icon waves-effect waves-light btn-danger m-b-5"><i class="fa fa-remove"></i></a>
				</div>
			</td>
			<?php }
			?>
		</tr>
	</tbody>
</table>
<script type="text/javascript">
	var hpp='<?php echo $hpp;?>';
	$('#hpp').val(hpp);
</script>
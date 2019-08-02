<?php 
$this->db_master->order_by('id','DESC');
$get_pelayanan = $this->db_master->get('master_pelayanan')->result();
?>

<a href="<?php echo base_url('pembelian'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master_pelayanan'); ?>">Pelayanan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Pelayanan</h1>

	<?php $this->load->view('menu_master'); ?><br>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Daftar Pelayanan</span>
					<a href="<?php echo base_url('master/master_pelayanan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('master/master_pelayanan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<div class="sukses" ></div>
						<table class="table table-striped table-hover table-bordered" id="tabel_daftar"  style="font-size:1.0em;">
							<thead>
								<tr>
									<th width="50px;">No</th>
									<th>Kode Pelayanan</th>
									<th>Nama Pelayanan</th>
									<th>Status</th>

									<th width="133px;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 0;
								foreach ($get_pelayanan as $value) { 
									$no++; ?>
									<tr>
										<td><?= $no ?></td>
										<td><?= $value->kode_pelayanan ?></td>
										<td><?= $value->nama_pelayanan ?></td>
										<td><?php if($value->status == 1){
											echo ('Aktif');
										}else {
											echo ('Tidak Aktif');
										}
										?>
									</td>
									<td>
										<div class="btn-group">
											<a href="<?php echo base_url('master/master_pelayanan/detail/'.$value->id)?>" id="edit" data-toggle="tooltip" title="Edit" class="btn btn-icon-only btn-circle btn-success"><i class="fa fa-eye"></i></a>
											<a href="<?php echo base_url('master/master_pelayanan/edit/'.$value->id)?>" id="edit" data-toggle="tooltip" title="Edit" class="btn btn-icon-only btn-circle btn-warning"><i class="fa fa-pencil"></i></a>
											<a id="hapus" onclick="actDelete('<?= $value->id ?>')" data-toggle="tooltip" title="Delete" class="btn btn-icon-only btn-circle btn-danger"><i class="fa fa-remove"></i></a>
										</div>
									</td>
								</tr>
								<?php } ?>
							</tbody>                
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>  
</div>
<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Alert</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan menghapus data ini?</h2>
				<input type="hidden" id="id">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function actDelete(key) {
		$('#modal-hapus').modal('show');
		$('#id').val(key);
	}
	function hapus_data() {
		var id=$('#id').val();
		$.ajax({
			url: '<?php echo base_url('master/master_pelayanan/hapus_pelayanan'); ?>',
			type: 'post',
			data:{id:id},
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$('#modal-hapus').modal('hide');
				window.location.reload();
			}
		});
	}
</script>
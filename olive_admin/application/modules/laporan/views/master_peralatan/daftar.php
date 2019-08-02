<?php 

$this->db2->order_by('id','DESC');
$this->db2->where('status','1');
$get_gudang = $this->db2->get('master_peralatan')->result();

?>

<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Master Peralatan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Master Peralatan</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Master Peralatan</span>
					<a href="<?php echo base_url('master/master_peralatan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Master Semen Beku</a>
					<a href="<?php echo base_url('master/master_peralatan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Master Semen Beku</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Peralatan</th>
									<th>Nama Peralatan</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>    
								<?php 
								$no = 0;
								foreach ($get_gudang as $value) { 
									$no++; ?>
									<tr>
										<th><?= $no ?></th>
										<th><?= $value->kode_peralatan ?></th>
										<th><?= $value->nama_peralatan ?></th>
										<th><?= $value->status ?></th>
										<td><?php echo get_detail_edit_delete($value->kode_peralatan);?></td>
									</tr>
									<?php }
									?>
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
					<input type="hidden" id="kode_peralatan">
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
			$('#kode_peralatan').val(key);
		}
		function hapus_data() {
			var kode_peralatan=$('#kode_peralatan').val();
			$.ajax({
				url: '<?php echo base_url('master/master_peralatan/hapus_gudang'); ?>',
				type: 'post',
				data:{kode_peralatan:kode_peralatan},
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
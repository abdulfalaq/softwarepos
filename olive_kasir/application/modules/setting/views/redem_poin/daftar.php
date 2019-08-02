<?php 

$this->db->order_by('id','DESC');
$get_gudang = $this->olive_master->get('master_redem_poin')->result();

?>


<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('Setting'); ?>">Setting</a></li>
		<li><a href="#">Redem Poin</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Redem Poin</h1>

	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Redem Poin</span>
					<a href="<?php echo base_url('setting/redem_poin/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Redem Poin</a>
					<a href="<?php echo base_url('setting/redem_poin/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Redem Poin</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<div class="box-body">
							<table id="datatable" class="table table-striped table-bordered">
								<thead>
									<tr width="100%">
										<th>No</th>
										<th>Jenis Produk</th>
										<th>Kode Produk</th>
										<th>Setara Poin</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 0;
									foreach ($get_gudang as $value) { ?>
										<?php 
										$no++; ?>
										<tr>
											<th><?= $no ?></th>
											<th><?= $value->jenis_produk ?></th>
											<th><?= $value->kode_produk ?></th>
											<th><?= $value->setara_poin ?></th>
											<th align="center">
												<div class="btn-group">
													<a href="<?php echo base_url('setting/redem_poin/detail/'.$value->id); ?>" data-toggle="tooltip" title="Detail" class="btn btn-success"><i class="fa fa-search"></i> </a>
													<a href="<?php echo base_url('setting/redem_poin/edit/'.$value->id); ?>" data-toggle="tooltip" title="Edit" class="btn btn-warning"><i class="fa fa-pencil"></i> </a>
													<a onclick="actDelete (<?php echo $value->id ?>)" data-toggle="tooltip" title="Edit" class="btn btn-danger"><i class="fa fa-trash"></i> </a>
												</div>
											</th>
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
		var id = $('#id').val();
		$.ajax({
			url: '<?php echo base_url('setting/redem_poin/hapus'); ?>',
			type: 'post',
			data:{id:id},
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$('#modal-hapus').modal('hide');
				window.location="<?php echo base_url('setting/redem_poin/daftar');?>";
			}
		});
	}
	function detail(){

	}
</script>
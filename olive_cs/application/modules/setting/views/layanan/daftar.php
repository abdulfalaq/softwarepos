

<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Layanan Periksa</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Layanan Periksa </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Layanan Periksa</span>
					<a href="<?php echo base_url('setting/layanan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah </a>
					<a href="<?php echo base_url('setting/layanan'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Daftar</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12" style="margin-top: 20px;">
						<?php 

						$this->olive_master->order_by('id','DESC');
						$get_gudang = $this->olive_master->get('master_layanan_periksa')->result();

						?>
						<table class="table table-striped table-hover table-bordered" id="datatable"  style="font-size:1.0em;">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Periksa</th>
									<th>Nama Periksa</th>
									<th>Harga Periksa</th>
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
										<th><?= $value->kode_periksa ?></th>
										<th><?= $value->nama_periksa ?></th>
										<th><?= format_rupiah($value->harga_periksa) ?></th>
										<th align="center">
											<div class="btn-group">
												<a href="<?php echo base_url('setting/layanan/detail/'.$value->kode_periksa); ?>" id="detail" data-toggle="tooltip" title="Detail" class="btn btn-primary btn-circle green"><i class="fa fa-search"></i></a>
												<a href="<?php echo base_url('setting/layanan/edit/'.$value->kode_periksa ); ?>" key="4" id="ubah" data-toggle="tooltip" title="Edit" class="btn btn-warning btn-circle yellow"><i class="fa fa-pencil"></i></a>
												<a onclick="actDelete ('<?php echo $value->kode_periksa ?>')" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-circle red"><i class="fa fa-remove"></i></a>
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
	</div> <!-- //row -->
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
				<input type="hidden" id="kode_periksa">
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
		$('#kode_periksa').val(key);
	}
	function hapus_data() {
		var kode_periksa = $('#kode_periksa').val();
		$.ajax({
			url: '<?php echo base_url('setting/layanan/hapus'); ?>',
			type: 'post',
			data:{kode_periksa:kode_periksa},
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$('#modal-hapus').modal('hide');
				window.location="<?php echo base_url('setting/layanan/daftar');?>";
			}
		});
	}
	function detail(){

	}
</script>
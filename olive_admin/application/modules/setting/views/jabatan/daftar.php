
<!-- back button -->
<a href="<?php echo base_url('admin'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Jabatan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Setting </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Jabatan </span>
					<a href="<?php echo base_url('setting/jabatan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/jabatan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<?php 
					$this->db->order_by('id','DESC');
					$get_gudang = $this->db->get('clouoid1_olive_master.master_jabatan')->result();
					?>
					<table id="datatable" class="table table-striped table-bordered">
						<thead>
							<tr width="100%">
								<th>No</th>
								<th>Kode Jabatan</th>
								<th>Nama Jabatan</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="body_bahan">
							<?php 
							$no = 0;
							foreach ($get_gudang as $value) { 
								$no++; ?>
								<tr >
									<td><?= $no ?></td>
									<td><?= $value->kode_jabatan ?></td>
									<td><?= $value->nama_jabatan ?></td>
									<td>
										<?php
										if ($value->status == '1') {
											echo "<b>Aktif</b>";
										} else {
											echo "<b>Tidak Aktif</b>";
										}
										
										?>
									</td>
									<td>
										<div class="btn-group">
											<a href="<?php echo base_url ('setting/jabatan/detail/'.$value->kode_jabatan) ?>" data-toggle="tooltip" title="Detail" class="btn btn-success btn-circle green"><i class="fa fa-search"></i> </a>
											<a href="<?php echo base_url ('setting/jabatan/edit/'.$value->kode_jabatan) ?>" data-toggle="tooltip" title="Edit" class="btn btn-warning btn-circle yellow"><i class="fa fa-pencil"></i> </a>
											<a  onclick="actDelete('<?php echo $value->kode_jabatan ?>')" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-circle red"><i class="fa fa-trash"> </i></a>
										</div>
									</td>
								</tr>
								<?php 
							} 
							?>
						</tbody>
					</table>
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
				<input type="hidden" id="kode_jabatan">
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
		$('#kode_jabatan').val(key);
	}
	function hapus_data() {
		var kode_jabatan = $('#kode_jabatan').val();
		$.ajax({
			url: '<?php echo base_url('setting/jabatan/hapus'); ?>',
			type: 'post',
			data:{kode_jabatan:kode_jabatan},
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$('#modal-hapus').modal('hide');
				window.location="<?php echo base_url('setting/jabatan/daftar');?>";  
			}
		});
	}
</script>
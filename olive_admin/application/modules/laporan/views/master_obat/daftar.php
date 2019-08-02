<?php 

$this->db->order_by('id','DESC');
$get_gudang = $this->db2->get('master_obat')->result();


?>

<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Master Obat</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Master</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Obat</span>
					<a href="<?php echo base_url('master/master_obat/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('master/master_obat/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<div class="sukses" ></div>
						<table class="table table-striped table-hover table-bordered" id="tabel_daftar"  style="font-size:1.0em;">
							<thead>
								<tr>
									<th width="50px;">No</th>
									<th>Kode Obat</th>
									<th>Nama Obat</th>
									<th>Jenis</th>
									<th width="133px;">Action</th>
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
										<th><?= $value->kode_obat ?></th>
										<th><?= $value->nama_obat ?></th>
										<th><?= $value->jenis_obat ?></th>
										<th>
											<?php echo get_detail_edit_delete($value->kode_obat);?>
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
<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Alert</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan menghapus data ini?</h2>
				<input type="hidden" id="kode_obat">
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
		$('#kode_obat').val(key);
	}
	function hapus_data() {
		var kode_obat = $('#kode_obat').val();
		$.ajax({
			url: '<?php echo base_url('master/master_obat/hapus_data'); ?>',
			type: 'post',
			data:{kode_obat:kode_obat},
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$('#modal-hapus').modal('hide');
				setInterval(function(){ window.location="<?php echo base_url('master/master_obat/daftar');?>"; }, 1500);
			}
		});
	}
	function detail(){

	}
</script>

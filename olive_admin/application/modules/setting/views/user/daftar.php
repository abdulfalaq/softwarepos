
<!-- back button -->
<a href="<?php echo base_url('admin'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">User</a></li>
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
					<span class="pull-left" style="font-size: 24px">Data User </span>
					<a href="<?php echo base_url('setting/user/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/user/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<?php 
					$this->db->from('olive_master.master_user user');
					$this->db->join('olive_master.master_jabatan jabatan','jabatan.kode_jabatan = user.jabatan','left');
					$this->db->order_by('user.id','DESC');
					$get_gudang = $this->db->get()->result();
					?>
					<table id="datatable" class="table table-striped table-bordered">
						<thead>
							<tr width="100%">
								<th>No</th>
								<th>Nama</th>
								<th>Username</th>
								<th>Jabatan</th>
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
									<td><?= $value->nama_karyawan ?></td>
									<td><?= $value->uname ?></td>
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
											<a href="<?php echo base_url ('setting/user/detail/'.$value->kode_karyawan) ?>" data-toggle="tooltip" title="Detail" class="btn btn-success btn-circle green"><i class="fa fa-search"></i> </a>
											<a href="<?php echo base_url ('setting/user/edit/'.$value->kode_karyawan) ?>" data-toggle="tooltip" title="Edit" class="btn btn-warning btn-circle yellow"><i class="fa fa-pencil"></i> </a>
											<a  onclick="actDelete('<?php echo $value->kode_karyawan ?>')" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-circle red"><i class="fa fa-trash"> </i></a>
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

<div id="modal-confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi Hapus Data</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan menghapus data user tersebut ?</span>
				<input kode_karyawan="kode_karyawan" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button onclick="delData()"  class="btn green">Ya</button>
			</div>
		</div>
	</div>
</div>

<script>
function actDelete(Object) {
	$('#id-delete').val(Object);
	$('#modal-confirm').modal('show');
}

function delData() {
	var kode_karyawan = $('#kode_karyawan').val();
	var url = '<?php echo base_url().'setting/user/hapus'; ?>';
	$.ajax({
		type: "POST",
		url: url,
		data: {
			kode_karyawan: kode_karyawan
		},
		beforeSend:function(){
			$(".tunggu").show();  
		},
		success: function(msg) {
			$('#modal-confirm').modal('hide');
            // alert(id);
            window.location.reload();
        }
    });
	return false;
}

$(document).ready(function(){

	$("#tabel_daftar").dataTable({
		"paging":   false,
		"ordering": true,
		"info":     false
	});
})

</script>
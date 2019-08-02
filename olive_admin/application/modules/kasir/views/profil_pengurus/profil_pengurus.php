
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Data Koperasi</a></li>
		<li><a href="#">Kepengurusan</a></li>
		<li>Profil Pengurus</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
		<h1>Profil Pengurus</h1>

		<?php $this->load->view('menu_setting'); ?>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading text-right">
						<span class="pull-left" style="font-size: 20px;">Daftar Pengurus</span>
						<a href="<?php echo @base_url('setting/kepengurusan_profil_pengurus/tambah'); ?>" type="button" class="btn btn-no-radius btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
						<a href="<?php echo @base_url('setting/kepengurusan_profil_pengurus'); ?>" type="button" class="btn btn-no-radius btn-primary"><i class="fa fa-list"></i> Daftar Data</a>
					</div>
					<div class="panel-body">
						<table id="datatables" class="table table-bordered table-blue">
							<thead>
								<th width="100px">No</th>
								<th>Nama</th>
								<th>Pendidikan</th>
								<th>Jabatan</th>
								<th>Periode</th>
								<th width="100px">Action</th>
							</thead>
							<tbody>
							<?php 
								$ambil_data = $this->db->get('data_pengurus');
								$hasil_data = $ambil_data->result();

								$no = 1;
								foreach ($hasil_data as $item) {
							?>
								<tr>
									<td><?php echo $no++?></td>
									<td><?php echo $item->nama_pengurus?></td>
									<td><?php echo $item->pendidikan_terakhir?></td>
									<td><?php echo $item->nama_jabatan ?></td>
									<td><?php echo $item->periode_awal ?>-<?php echo $item->periode_akhir ?></td>
									<td align="center">
									<a href="<?php echo base_url('setting/kepengurusan_profil_pengurus/edit/'.$item->id); ?>" class="btn btn-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
									<a href="#" onclick="hapus(<?php echo $item->id?>);" class="btn btn-danger" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
							<?php }?>
							</tbody>
						</table>
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
      <input type="hidden" id="hapus" name="hapus">
        <h2>Anda yakin akan menghapus data ini?</h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" id="hapus_data"><i class="fa fa-trash"></i> Hapus Data</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
	$('#hapus_data').click(function(){
		var id = $('#hapus').val();
			$.ajax({
			url: '<?php echo base_url().'setting/kepengurusan_profil_pengurus/hapus' ?>',
			type: 'post',
			data: {id:id},
			beforeSend: function(){
				$('.loading').show();
			},
			success: function(data){
				window.location.reload();
			}
		});
		return false;

	});

	$(document).ready(function(){
		$('#update_btn').hide();
	});

	function update() {
		$('#simpan_btn').hide();
		$('#update_btn').show();
	}

	function hapus(key) {
		$('#modal-hapus').modal('show');
		$('#hapus').val(key);
	}

	$('#update_btn').click(function(){
		$('#update_btn').hide();
		$('#simpan_btn').show();
	});
</script>
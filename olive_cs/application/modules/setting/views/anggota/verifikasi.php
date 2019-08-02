
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
		<h1>Anggota</h1>

		<?php $this->load->view('menu_setting'); ?>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading text-right">
						<span class="pull-left" style="font-size: 20px;">Daftar Verifikasi</span>
						<a href="<?php echo @base_url('setting/anggota_pendaftaran'); ?>" type="button" class="btn btn-no-radius btn-success"><i class="fa fa-plus"></i> Pendaftaran</a>
						<a href="<?php echo @base_url('setting/anggota_verifikasi'); ?>" type="button" class="btn btn-no-radius btn-warning"><i class="fa fa-check"></i>List Verifikasi</a>
						<a href="<?php echo @base_url('setting/anggota_akun'); ?>" type="button" class="btn btn-no-radius btn-primary"><i class="fa fa-list"></i> List Anggota</a>
					</div>
					<div class="panel-body">
						<table id="datatables" class="table table-bordered table-blue">
							<thead>
								<th width="100px">No</th>
								<th>Nama</th>
								<th>Kode Anggota</th>
								<th>Status</th>
								<th>Tanggal Pendaftaran</th>
								<th width="130px">Action</th>
							</thead>
							<tbody>
								<?php
								$nomor = 1;
								$sql = $this->db->get_where('data_anggota',array('status_pinjaman'=>'belum divalidasi'))->result();
								foreach ($sql as $data) {
								?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $data->nama_anggota; ?></td>
									<td><?php echo $data->kode_anggota; ?></td>
									<td>
										<button class="btn btn-sm btn-no-radius btn-warning">Belum Diverifikasi</button>
									</td>
									<td><?php echo @tanggalIndo($data->tanggal_pendaftaran); ?></td>
									<td align="center">
										<a href="<?php echo base_url('setting/anggota_verifikasi/detail')."/".$data->id; ?>" class="btn btn-success" data-toggle="tooltip" title="Detail"><i class="fa fa-ellipsis-h"></i></a>
										<a onclick="verifikasi(<?php echo $data->id; ?>)" href="#" class="btn btn-danger" data-toggle="tooltip" title="Verifikasi Anggota"><i class="fa fa-check"></i></a>
									</td>
								</tr>
								<?php
								$nomor++;
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div> <!-- //row -->
</div>



<div id="modal-verifikasi" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Alert</h4>
      </div>
      <div class="modal-body text-center">
        <h2>Verifikasi anggota ini?</h2>
      </div>
      <div class="modal-footer">
      	<input type="hidden" name="id_verifikasi" id="id_verifikasi" value="">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
        <button onclick="verifikasi_anggota();" type="button" class="btn btn-success"><i class="fa fa-check"></i> Verifikasi</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
	$(document).ready(function(){
		$('#update_btn').hide();
	});

	function update() {
		$('#simpan_btn').hide();
		$('#update_btn').show();
	}

	function verifikasi(key) {
		$('#modal-verifikasi').modal('show');
		$('#id_verifikasi').val(key);
	}

	function verifikasi_anggota(){
		var id = $('#id_verifikasi').val();
		$.ajax({
			url : '<?php echo @base_url('setting/anggota_verifikasi/verifikasi'); ?>',
			type : 'post',
			data : { id:id },
			success : function(response){
				if(response == 'ok'){
					window.location.href='';
				}else{
					alert(response);
				}
			}
		});
	}

	$('#update_btn').click(function(){
		$('#update_btn').hide();
		$('#simpan_btn').show();
	});
</script>
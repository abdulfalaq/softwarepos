<?php
$id = $this->uri->segment(4);
$simpanan = $this->db->get_where('master_simpanan_wajib',array('id'=>$id))->row();
?>


<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Data Koperasi</a></li>
		<li><a href="#">Produk</a></li>
		<li><a href="#">Simpanan</a></li>
		<li>Simpanan Wajib</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
		<h1>Produk Simpanan Wajib</h1>

		<?php $this->load->view('menu_setting'); ?>

		<div class="clearfix"></div>

		<form id="form" onsubmit="return false">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading text-right">
						<span class="pull-left" style="font-size: 24px">Edit Produk Simpanan wajib</span>
						<a href="<?php echo base_url('setting/produk_simpanan_wajib/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Produk</a>
						<a href="<?php echo base_url('setting/produk_simpanan_wajib'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Produk</a>
					</div>
					<div class="panel-body">
						<table class="table-form" width="100%">
							<tr>
								<td>Kode</td>
								<td>
									<input type="text" name="kode" id="kode" required="" class="form-control" value="<?php echo $simpanan->kode; ?>" readonly>
								</td>
							</tr>
							<tr>
								<td width="300px">Nominal Simpanan</td>
								<td>
									<div class="input-group">
										<span class="input-group-addon">Rp</span>
										<input type="number" name="nominal" id="nominal" required="" class="form-control" value="<?php echo $simpanan->nominal_simpanan_wajib; ?>">
									</div>
								</td>
							</tr>
							<tr>
								<td>Tanggal Aktivasi (Bln/Tgl/Thn)</td>
								<td>
									<input type="date" name="tanggal_aktivasi" id="tanggal_aktivasi" required="" class="form-control" value="<?php echo $simpanan->tanggal_aktivasi; ?>">
								</td>
							</tr>
						</table>
					</div>
					<div class="panel-footer text-right">
						<button class="btn btn-lg btn-super btn-no-radius btn-warning"><i class="fa fa-edit"></i> UPDATE</button>
					</div>
				</div>
			</div>
		</div> <!-- //row -->
		</form>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
	function hapus(key) {
		$('#modal-hapus').modal('show');
	}

	$('#nominal').keyup(function(){
		var nominal =  parseInt($(this).val());
		if(nominal <= 0){
			alert('Nominal salah!');
			$(this).val('');
		}
	});


	$('#form').submit(function(){		
		$.ajax({
			url: '<?php echo base_url('setting/produk_simpanan_wajib/act_update'); ?>',
			type: 'post',
			data: $(this).serialize(),
			beforeSend: function(){
				$('.tunggu').show();
			},
			success: function(response){
				if(response == "success"){
					$('.alert-success').show();

					$('.tunggu').hide();
					$('.alert_berhasil').show();
					setTimeout(function(){
						window.location.href='<?php echo base_url('setting/produk_simpanan_wajib'); ?>';
					},1000);	
				}else{
					$('#alert-error').html(response);
					$('.alert-danger').show();
					setTimeout(function(){ $('.alert-danger').hide(); },2000);
				}			
			}			
		});
	});
</script>
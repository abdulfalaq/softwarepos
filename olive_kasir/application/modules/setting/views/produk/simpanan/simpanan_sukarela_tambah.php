
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Data Koperasi</a></li>
		<li><a href="#">Produk</a></li>
		<li><a href="#">Simpanan</a></li>
		<li>Tabungan</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Produk Tabungan</h1>

	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>
	<form id="form" onsubmit="return false">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading text-right">
						<span class="pull-left" style="font-size: 24px">Tambah Produk Tabungan</span>
						<a href="<?php echo base_url('setting/produk_simpanan_sukarela/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Produk</a>
						<a href="<?php echo base_url('setting/produk_simpanan_sukarela'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Produk</a>
					</div>
					<div class="panel-body">
						<table class="table-form" width="100%">
							<tr>
								<td width="300px">Kode Tabungan</td>
								<td>
									<input type="text" name="kode_produk" id="kode_produk" required="" class="form-control" value="MPT_<?php echo date('ymdhis');  ?>" readonly>
								</td>
							</tr>
							<tr>
								<td width="300px">Nama Produk Tabungan</td>
								<td>
									<input type="text" name="nama_produk_simpanan_sukarela" id="nama_produk_simpanan_sukarela" required="" class="form-control">
								</td>
							</tr>
							<tr>
								<td>Jasa Tabungan Per Tahun</td>
								<td>
									<div class="input-group">
										<input type="text" name="jasa_simpanan_sukarela" id="jasa_simpanan_sukarela" onkeyup="jasa_simpanan()" required="" class="form-control">
										<span class="input-group-addon">%</span>
									</div>
								</td>
							</tr>
						</table>
					</div>
					<div class="panel-footer text-right">
						<button type="submit" class="btn btn-lg btn-super btn-no-radius btn-success"><i class="fa fa-save"></i> SIMPAN</button>
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
	$('#form').submit(function(){
		
		$.ajax({
			url: '<?php echo base_url('setting/produk_simpanan_sukarela/act_simpan'); ?>',
			type: 'post',
			data: $(this).serialize(),
			beforeSend: function(){
				$('.tunggu').show();
			},
			success: function(response){
				$('.tunggu').hide();

				if(response == "success"){
					$('#load-table').load('<?php echo base_url('setting/produk_simpanan_sukarela/load_table'); ?>'); //load tabel
					$('.alert-success').show();

					$('.tunggu').hide();
					$('.alert_berhasil').show();
					setTimeout(function(){
					window.location.href='<?php echo base_url('setting/produk_simpanan_sukarela'); ?>';
					},2000);	
				}else{
					$('#alert-error').html(response);
					$('.alert-danger').show();
					setTimeout(function(){ $('.alert-danger').hide(); },2000);
				}			
			}			
		});
	});

	function jasa_simpanan(event){
		var jasa = $('#jasa_simpanan_sukarela').val();
		if (jasa < 0 || jasa > 100) {
			alert('Pengisian Prosentase Salah.');
			$('#jasa_simpanan_sukarela').val('');
		}
	}



    $("input[id*='jasa_simpanan_sukarela']").keydown(function (event) {
        if (event.shiftKey == true) {
            event.preventDefault();
        }

        if ((event.keyCode >= 48 && event.keyCode <= 57) || 
            (event.keyCode >= 96 && event.keyCode <= 105) || 
            event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
            event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

        } else {
            event.preventDefault();
        }

        if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
            event.preventDefault(); 
        //if a decimal has been added, disable the "."-button
    });	
</script>
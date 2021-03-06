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
						<span class="pull-left" style="font-size: 24px">Edit Produk Tabungan</span>
						<a href="<?php echo base_url('setting/produk_simpanan_sukarela/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Produk</a>
						<a href="<?php echo base_url('setting/produk_simpanan_sukarela'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Produk</a>
					</div>
					<?php
					$id=$this->uri->segment(4);
					$this->db->where('id',$id);
					$sql = $this->db->get('master_produk_tabungan');
					$result = $sql->row();

					?>
					<div class="panel-body">
						<input type="hidden" name="id" value="<?php echo $id;?>">
						<table class="table-form" width="100%">
							<tr>
								<td width="300px">Kode Tabungan</td>
								<td>
									<input type="text" value="<?php echo @$result->kode_produk; ?>" name="" id="" required="" disabled="" class="form-control">
								</td>
							<tr>
							<tr>
								<td width="300px">Nama Tabungan</td>
								<td>
									<input type="text" value="<?php echo @$result->nama_produk; ?>" name="nama_produk_simpanan_sukarela" id="nama_produk_simpanan_sukarela" required="" class="form-control">
								</td>
							<tr>
								<td>Jasa Tabungan Per Tahun</td>
								<td>
									<div class="input-group">
										<input type="text" value="<?php echo @$result->jasa_per_tahun; ?>" name="jasa_simpanan_sukarela" id="jasa_simpanan_sukarela" required="" class="form-control" onkeyup="jasa_simpanan()">
										<span class="input-group-addon">%</span>
									</div>
								</td>
							</tr>
							<tr>
								<td width="300px">Jasa Tabungan Per Hari</td>
								<td>
									<div class="input-group">
										<input type="number" value="<?php echo @$result->jasa_per_hari; ?>" name="" id="" required="" class="form-control" disabled="">
										<span class="input-group-addon">%</span>
									</div>
								</td>
							<tr>
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
	$('#form').submit(function(){
		
		$.ajax({
			url: '<?php echo base_url('setting/produk_simpanan_sukarela/act_update'); ?>',
			type: 'post',
			data: $(this).serialize(),
			beforeSend: function(){
				$('.loading').show();
			},
			success: function(response){
				$('.loading').hide();

				if(response == "success"){
					$('#load-table').load('<?php echo base_url('setting/produk_simpanan_sukarela/load_table'); ?>'); //load tabel
					$('.alert-success').show();
					setTimeout(function(){ window.location.href='<?php echo base_url('setting/produk_simpanan_sukarela'); ?>'; },2000);
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
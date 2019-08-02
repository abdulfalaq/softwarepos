
<!-- back button -->
<a href="<?php echo base_url('pengeluaran'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pengeluaran'); ?>">Pengeluaran</a></li>
		<li><a href="#">Tambah</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Pengeluaran </span>
					<a href="<?php echo base_url('pengeluaran/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('pengeluaran/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Daftar</a>
				</div>
				<div class="panel-body">
					<div class="sukses" ></div>
					<form id="formGudang"  method="post">
						<div class="row">
							<input type="hidden" name="id" value="" />
							<div class="form-group  col-xs-6">
								<label class="gedhi"><b>Kode Pengeluaran</b></label>
								<input class="form-control" type="text" id="kode_sub_kategori_keuangan" name="kode_sub_kategori_keuangan" value="P_<?php echo date('ymdHis')?>" readonly="" />
							</div>

							<div class="form-group  col-xs-6">
								<label class="gedhi"><b>Kategori</b></label>
								<input class="form-control" type="text" id="nama_kategori_keuangan" name="nama_kategori_keuangan" value="Pengeluaran" readonly="" />
							</div>
						</div>
						<div class="row">
							<div class="form-group col-xs-6">
								<label class="gedhi">Nominal</label>
								<div class="input-group">
									<span class="input-group-addon rp_nom">Rp 0,00</span>
									<input type="number" class="form-control input-group" onkeyup="get_nominal()" onclick="get_nominal()" name="nominal" id="nominal"  required=""/>
								</div>
							</div>
							<div class="form-group  col-xs-6">
								<label class="gedhi"><b>Nama Akun</b></label>
								<input class="form-control" type="text" id="nama_sub_kategori_keuangan" name="nama_sub_kategori_keuangan" placeholder="Sub Kategori" required="" />
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label><b>Keterangan</b></label>
								<textarea class="form-control" value="" name="keterangan" id="keterangan" required=""></textarea>
							</div>
						</div>
						<br>
						<div class="box-footer">
							<button type="submit" class="btn btn-lg btn-primary" id="data_form">Simpan </button>
						</div>
					</form>
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
				<input type="hidden" id="kode_perawatan">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button onclick="hapus_data()" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

	$("#formGudang").submit( function() {  
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'pengeluaran/simpan_tambah' ?>",  
			cache :false,  
			data :$(this).serialize(),
			dataType: 'Json',
			beforeSend:function(){
				$(".tunggu").show();   
			},
			success : function(data) { 
				if (data.response == 'sukses') {
					$(".tunggu").hide();   
					$(".alert_berhasil").show();   
					setInterval(function(){ window.location="<?php echo base_url('pengeluaran/daftar');?>"; }, 1500);
				}else{
					alert('Gagal Menyimpan data');
					$(".tunggu").hide();   
					setInterval(function(){ location.reload() }, 2000);
				}
			},  
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
		return false;              
	});   
	
	function get_nominal(){
		var nom = $('#nominal').val();
		if(parseInt(nom) <= 0){
			alert("Nominal Salah");
			$('#nominal').val('');
			$(".rp_nom").html("Rp. 0");
		}else{
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() . 'pengeluaran/get_nom' ?>",
				data: {
					nom: nom
				},

				success: function(msg)
				{
					$(".rp_nom").html(msg);
				}
			});
		}
	}

</script>



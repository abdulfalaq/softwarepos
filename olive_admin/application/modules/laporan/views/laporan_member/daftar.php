
<a href="<?php echo base_url('laporan'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('laporan'); ?>">Laporan</a></li>
		<li><a href="#">Laporan Member Retention</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Laporan</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<br>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Laporan Member Retention</span>
					<br>
					<br>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-5" id="">
							<div class="input-group">
								<span class="input-group-addon">Bulan Awal</span>
								<input type="month" class="form-control tgl" id="tgl_awal">
							</div>
						</div>                   
						<div class="col-md-2 pull-left">
							<button style="width: 147px" type="button" class="btn btn-warning btn-no-radius pull-right" id="cari"><i class="fa fa-search"></i> Cari</button>
						</div>
					</div>
					<br>
					<div id="cari_transaksi">

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
				<input type="hidden" id="id">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

$('#cari').click(function(){
	var tgl_awal  = $("#tgl_awal").val();
	if (tgl_awal == ''){ 
		alert('Masukan Tanggal Awal & Tanggal Akhir..!')
	}
	else{
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url('laporan/laporan_member/load_data_cari'); ?>",
			cache :false,

			data : {tanggal_awal:tgl_awal},
			beforeSend:function(){
				$(".tunggu").show();  
			},
			success : function(data) {
				$(".tunggu").hide();  
				$("#cari_transaksi").html(data);
			},  
			error : function(data) {  
				$(".tunggu").hide();  
				alert(data)
			}  
		});
	}

	$('#tgl_awal').val('');
	$('#tgl_akhir').val('');

});
</script>

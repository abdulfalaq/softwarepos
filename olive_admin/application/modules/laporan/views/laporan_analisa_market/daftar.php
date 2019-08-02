
<a href="<?php echo base_url('laporan'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('laporan'); ?>">Laporan</a></li>
		<li><a href="#">Laporan Analisa Market</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Laporan Analisa Market</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<br>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Laporan Analisa Market</span>
					<a id="print" target="_blank" class="btn btn-primary green-seagreen"><i class="fa fa-print"></i>Print</a>
					<br>
					<br>
				</div>
				<div class="panel-body">
					<div class="box-body">            
						<div class="row">      
							<div class="col-xs-12">
								<!-- /.box -->
								<div class="portlet box blue">
									<div class="portlet-title">
										<div class="caption">
										</div>
										<div class="tools">
											<a href="javascript:;" class="collapse">
											</a>
											<a href="javascript:;" class="reload">
											</a>

										</div>
									</div>
									<div class="portlet-body">
										<div class="box-body">            
											<div class="sukses" ></div>
											<div class="row">
												<div class="col-md-5" id="">
													<div class="input-group">
														<span class="input-group-addon">Tanggal Awal</span>
														<input type="text" class="form-control tgl" id="tgl_awal">
													</div>
												</div>

												<div class="col-md-5" id="">
													<div class="input-group">
														<span class="input-group-addon">Tanggal Akhir</span>
														<input type="text" class="form-control tgl" id="tgl_akhir">
													</div>
												</div>                        
												<div class="col-md-2 pull-left">
													<button style="width: 147px" type="button" class="btn btn-warning pull-right" id="cari"><i class="fa fa-search"></i> Cari</button>
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
					</div>    
				</div>  
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url().'component/lib/jquery.min.js'?>"></script>
<script src="<?php echo base_url().'component/lib/zebra_datepicker.js'?>"></script>
<link rel="stylesheet" href="<?php echo base_url().'component/lib/css/default.css'?>"/>
<script type="text/javascript">

	$('.tgl').Zebra_DatePicker({});
	$('#cari').click(function(){
		var tgl_awal =$("#tgl_awal").val();
		var tgl_akhir =$("#tgl_akhir").val();
		if (tgl_awal=='' || tgl_akhir==''){ 
			alert('Masukan Tanggal Awal & Tanggal Akhir..!')
		}
		else{
			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url().'laporan/laporan_analisa_market/cari_data'; ?>",  
				cache :false,

				data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir},
				beforeSend:function(){
					$(".tunggu").show();  
				},
				success : function(data) {
					$(".tunggu").hide();  
					$("#cari_transaksi").html(data);
				} 
			});
		}
	});


	$("#print").click(function(){
		var tgl_awal = $("#tgl_awal").val();
		var tgl_akhir = $("#tgl_akhir").val();
		window.open("<?php echo base_url().'laporan/laporan_analisa_market/print_perlengkapan'; ?>/"+tgl_awal+"/"+tgl_akhir);
	});
</script>

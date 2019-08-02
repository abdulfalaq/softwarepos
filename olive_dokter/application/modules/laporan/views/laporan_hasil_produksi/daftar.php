
<a href="<?php echo base_url('penjualan'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
		<li><a href="#">Laporan Hasil Produksi</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Laporan Hasil Produksi</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-left">
					<span style="font-size: 24px">Data Laporan Hasil Produksi </span>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<h4>Pilih Bulan</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<input type="month" id="bulan_report" class="form-control">
							</div>
							<div class="col-md-2">
								<button onclick="get_report_perbulan()" class="btn btn-info btn-no-radius">Oke</button>
							</div>
							<div class="col-md-4">
								<button id="btn-print" style="display:none" onclick="print_out()" class="btn btn-primary btn-no-radius pull-right"><i class="fa fa-print"></i> PRINT OUT</button>
							</div>
						</div><br>
						<div class="row">
							<div class="col-md-12" >
								<table class="table table-bordered table-striped " id="datatable">

									<thead>
										<tr>
											<th>NO</th>
											<th>Kode Produksi</th>
											<th>Tanggal Perintah Produksi</th>
											<th>Tanggal Produksi</th>
											<th>Jenis Sample</th>
											<th>Petugas</th>
											<th>Kode Unit Jabung</th>
										</tr>
									</thead>
									<tbody id="load_data">
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

function get_report_perbulan () {
	bulan_report = $('#bulan_report').val();

	$.ajax({
		url: '<?php echo base_url('laporan/laporan_hasil_produksi/filtering_report'); ?>',
		type: 'post',
		data:{ bulan_report:bulan_report},
		beforeSend: function(data){
			$('tunggu').show();
		},
		success: function(data){
			$('tunggu').hide();
			$('#load_data').html(data);
			$('#btn-print').show();
		},
	});			
}

function print_out(){
	var bulan 		= $("#bulan").val();
	var tahun 		= $("#tahun").val();
	if (bulan != '' && tahun != '') {
		window.open("<?php echo base_url() . 'laporan/laporan_hasil_produksi/print_out_data/'; ?>"+bulan+"/"+tahun);
	}
}

</script>
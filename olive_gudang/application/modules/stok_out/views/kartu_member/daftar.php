<style type="text/css">
.pko {
	height: 60px !important;
}
</style>

<!-- back button -->
<a href="<?php echo base_url(); ?>"><button class="button-back"></button></a>
<!-- //back button -->
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li>Kartu Member</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Data Pembelian</h1>
	<?php $this->load->view('menu_master'); ?>
	<div class="page-content">
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading text-right">
						<span class="pull-left" style="font-size: 24px">Kartu Member</span>
						<br><br>
					</div>
					<div class="panel-body">                   
						<div class="row">      
							<div class="col-xs-12">
								<div class=" pull-right">
									<a style="padding:13px; margin-bottom:10px;width: 190px" class="btn btn-info pull-right"><i class="fa fa-list"></i> Total Stock Member 1239</a> 
									<a style="padding:13px; margin-bottom:10px;width: 190px" class="btn btn-warning pull-right"><i class="fa fa-credit-card"></i> Total Kartu Member 11</a> 
								</div>
								<div class="double bg-green pull-right" style="cursor:default">
									<div  style="padding-right:10px; font-family:arial; font-weight:bold">
									</div>
								</div>
								<br>
								<br>
								<div class="box-body">            

									<div class="sukses" ></div>
									<br>
									<div class="row">
										<div class="col-md-5" id="">
											<div class="input-group">
												<span class="input-group-addon">Tanggal Awal</span>
												<input type="text" class="form-control tgl" id="tgl_awal" >
											</div>
										</div>

										<div class="col-md-5" id="">
											<div class="input-group">
												<span class="input-group-addon">Tanggal Akhir</span>
												<input type="text" class="form-control tgl" id="tgl_akhir" >
											</div>
										</div>                        
										<div class="col-md-2 pull-left">
											<button style="width: 190px" type="button" class="btn btn-warning pull-right" id="cari"><i class="fa fa-search"></i> Cari</button>
										</div>
									</div><br><br>
									<div id="cari_transaksi">
										<table class="table table-striped table-hover table-bordered" id="daftar_pembelian">
											<thead>
												<tr>
													<th>No</th>
													<th>Tanggal Pembelian</th>
													<th>Kode Pembelian</th>
													<th>Nota Ref</th>
													<th>Supplier</th>
													<th>Total</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody id="scroll_data">

												<tr>
													<td>1</td>
													<td>17 Januari 2018</td>
													<td>PEM_290118140316_1</td>
													<td>1548</td>
													<td>CV Yola</td>
													<td>Rp 500.000,00</td>
													<td align="center">
														<div class="btn-group">
															<a href="<?php echo base_url('kartu_member/detail'); ?>" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-success"><i class="fa fa-search"></i> </a>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<input type="hidden" class="form-control rowcount" value="0">
									<input type="hidden" class="form-control pagenum " value="0">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script>
				$('.btn-back').click(function(){
					$(".tunggu").show();
					window.location = "http://192.168.100.17/elladerma_gudang/pembelian/daftar";
				});

				$(".ngeload").click(function(){
					if(parseInt($(".pagenum").val()) <= parseInt($(".rowcount").val())) {
						var pagenum = parseInt($(".pagenum").val()) + 1;
						$(".pagenum").val(pagenum);
						load_table(pagenum);
					}
				})

				function load_table(page){
					var tgl_awal =$("#tgl_awal").val();
					var tgl_akhir =$("#tgl_akhir").val();
					$.ajax({
						type: "POST",
						url: "http://192.168.100.17/elladerma_gudang/pembelian/get_load_more",
						data: ({  page:$(".pagenum").val(),tgl_awal:tgl_awal,tgl_akhir:tgl_akhir,}),
						beforeSend: function(){
							$(".tunggu").show();  
						},
						success: function(msg)
						{
							$(".tunggu").hide();
							$("#scroll_data").append(msg);

						}
					});
				}
			</script>

			<div id="modal_setting" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
				<div class="modal-dialog" style="width:1000px;">
					<div class="modal-content" >
						<div class="modal-header" style="background-color:grey">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
							<label><b><i class="fa fa-gears"></i>Setting</b></label>
						</div>

						<form id="form_setting" >
							<div class="modal-body">

								<div class="box-body">

									<div class="row">
										<div class="col-xs-6">
											<div class="form-group">
												<label>Note</label>
												<input type="text" name="keterangan"  class="form-control" />
											</div>

										</div>
									</div>

								</div>

								<div class="modal-footer" style="background-color:#eee">
									<button class="btn red" data-dismiss="modal" aria-hidden="true">Cancel</button>
									<button type="submit" class="btn btn-success">Simpan</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<script src="http://192.168.100.17/elladerma_gudang/component/lib/jquery.min.js"></script>
				<script src="http://192.168.100.17/elladerma_gudang/component/lib/zebra_datepicker.js"></script>
				<link rel="stylesheet" href="http://192.168.100.17/elladerma_gudang/component/lib/css/default.css"/>
				<script type="text/javascript">

					$('.tgl').Zebra_DatePicker({});


					$('#cari').click(function(){
						var tgl_awal =$("#tgl_awal").val();
						var tgl_akhir =$("#tgl_akhir").val();
						var kode_unit =$("#kode_unit").val();
						if (tgl_awal=='' || tgl_akhir==''){ 
							alert('Masukan Tanggal Awal & Tanggal Akhir..!')
						}
						else{
							$.ajax( {  
								type :"post",  
								url : "http://192.168.100.17/elladerma_gudang/pembelian/cari_pembelian",  
								cache :false,
								beforeSend:function(){
									$(".tunggu").show();  
								},  
								data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir,kode_unit:kode_unit},
								beforeSend:function(){
									$(".tunggu").show();  
								},
								success : function(data) {
									$(".tunggu").hide();  
									$("#cari_transaksi").html(data);
								},  
								error : function(data) {  
         // alert("das");  
     }  
 });
						}

						$('#tgl_awal').val('');
						$('#tgl_akhir').val('');

					});
				</script>
				<script>
					function setting() {
						$('#modal_setting').modal('show');
					}

					$(document).ready(function(){
						$("#daftar_pembelian").dataTable({
							"paging":   false,
							"ordering": true,
							"searching": false,
							"info":     false
						});


						$("#form_setting").submit(function(){
							var keterangan = "http://192.168.100.17/elladerma_gudang/pembelian/keterangan";
							$.ajax({
								type: "POST",
								url: keterangan,
								data: $('#form_setting').serialize(),
								success: function(msg)
								{
									$('#modal_setting').modal('hide');  
								}
							});
							return false;
						});

					});

				</script>
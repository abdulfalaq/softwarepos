
<!-- back button -->
<a href="<?php echo base_url(); ?>"><button class="button-back"></button></a>
<!-- //back button -->
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>"> Pembelian</a></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Data Pembelian</h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="row">      

		<div class="col-xs-12">
			<!-- /.box -->
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Pembelian
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse">
						</a>
						<a href="javascript:;" class="reload">
						</a>

					</div>
				</div>
				<div class="portlet-body">
					<a style="padding:13px; margin-bottom:10px;width: 190px" class="btn btn-warning pull-right"><i class="fa fa-list"></i>Total Pembelian 11</a> 
					<div class="double bg-green pull-right" style="cursor:default">
						<div  style="padding-right:10px; padding-top:0px; font-size:48px; font-family:arial; font-weight:bold">
						</div>
					</div>
					<br><br>
					<br><br>
					<div class="box-body">
						<div class="sukses" ></div>
						<br>
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
								<button style="width: 190px" type="button" class="btn btn-warning pull-right" id="cari"><i class="fa fa-search"></i> Cari</button>
							</div>
						</div>
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
												<a href="detail/PEM_290118140316_1" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i> </a>
											</div>
										</td>
									</tr>

									<tr>
										<td>2</td>
										<td>28 Januari 2018</td>
										<td>PEM_290118114420_1</td>
										<td>4665</td>
										<td>CV Yola</td>
										<td>Rp 20.000,00</td>
										<td align="center">
											<div class="btn-group">
												<a href="detail/PEM_290118114420_1" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i> </a>
											</div>
										</td>
									</tr>

									<tr>
										<td>3</td>
										<td>11 Desember 2017</td>
										<td>PEM_111217115952_1</td>
										<td>100</td>
										<td>CV Yola</td>
										<td>Rp 110.000,00</td>
										<td align="center">
											<div class="btn-group">
												<a href="detail/PEM_111217115952_1" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i> </a>
											</div>
										</td>
									</tr>

									<tr>
										<td>4</td>
										<td>09 Desember 2017</td>
										<td>PEM_091217101138_4</td>
										<td>32453</td>
										<td>CV Alami</td>
										<td>Rp 300.000,00</td>
										<td align="center">
											<div class="btn-group">
												<a href="detail/PEM_091217101138_4" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i> </a>
											</div>
										</td>
									</tr>

									<tr>
										<td>5</td>
										<td>09 Desember 2017</td>
										<td>PEM_091217100903_3</td>
										<td>34334</td>
										<td>CV sejahtera</td>
										<td>Rp 125.000,00</td>
										<td align="center">
											<div class="btn-group">
												<a href="detail/PEM_091217100903_3" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i> </a>
											</div>
										</td>
									</tr>

									<tr>
										<td>6</td>
										<td>09 Desember 2017</td>
										<td>PEM_091217100816_2</td>
										<td>324</td>
										<td>CV Yola</td>
										<td>Rp 100.000,00</td>
										<td align="center">
											<div class="btn-group">
												<a href="detail/PEM_091217100816_2" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i> </a>
											</div>
										</td>
									</tr>

									<tr>
										<td>7</td>
										<td>09 Desember 2017</td>
										<td>PEM_091217100722_1</td>
										<td>234</td>
										<td>CV Yola</td>
										<td>Rp 100.000,00</td>
										<td align="center">
											<div class="btn-group">
												<a href="detail/PEM_091217100722_1" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i> </a>
											</div>
										</td>
									</tr>

									<tr>
										<td>8</td>
										<td>18 November 2017</td>
										<td>PEM_181117140913_1</td>
										<td>001</td>
										<td>pak men</td>
										<td>Rp 10.045.000,00</td>
										<td align="center">
											<div class="btn-group">
												<a href="detail/PEM_181117140913_1" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i> </a>
											</div>
										</td>
									</tr>

									<tr>
										<td>9</td>
										<td>02 November 2017</td>
										<td>PEM_021117115444_1</td>
										<td>555</td>
										<td>CV Yola</td>
										<td>Rp 200.000,00</td>
										<td align="center">
											<div class="btn-group">
												<a href="detail/PEM_021117115444_1" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i> </a>
											</div>
										</td>
									</tr>

									<tr>
										<td>10</td>
										<td>01 November 2017</td>
										<td>PEM_011117103341_2</td>
										<td>1234</td>
										<td>CV sejahtera</td>
										<td>Rp 209.000,00</td>
										<td align="center">
											<div class="btn-group">
												<a href="detail/PEM_011117103341_2" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i> </a>
											</div>
										</td>
									</tr>

									<tr>
										<td>11</td>
										<td>01 November 2017</td>
										<td>PEM_011117102348_1</td>
										<td>123</td>
										<td>CV sejahtera</td>
										<td>Rp 95.000,00</td>
										<td align="center">
											<div class="btn-group">
												<a href="detail/PEM_011117102348_1" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i> </a>
											</div>
										</td>
									</tr>

								</tbody>
        <!-- <tfoot>
          <tr>
            <th>No</th>
            <th>Tanggal Pembelian</th>
            <th>Kode Pembelian</th>
            <th>Nota Ref</th>
            <th>Supplier</th>
            <th>Total</th>
            <th>Action</th>
          </tr>
      </tfoot> -->
  </table>



</div>
<div class="text-center">
	<a id="ngeload" class="btn btn-success btn-lg ngeload"><i class="fa fa-refresh"></i> Load More</a>
</div>
<input type="hidden" class="form-control rowcount" value="0">
<input type="hidden" class="form-control pagenum " value="0">
<!--  -->

</div>

<!------------------------------------------------------------------------------------------------------>

</div>
</div>
</div><!-- /.col -->
</div>
</div>    
</div>  
<style type="text/css" media="screen">
.btn-back
{
	position: fixed;
	bottom: 10px;
	left: 10px;
	z-index: 999999999999999;
	vertical-align: middle;
	cursor:pointer
}
</style>
<img class="btn-back" src="http://192.168.100.17/elladerma_gudang/component/img/back_icon.png" style="width: 70px;height: 70px;">

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
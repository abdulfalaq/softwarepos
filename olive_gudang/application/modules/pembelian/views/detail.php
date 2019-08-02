
<!-- back button -->
<a href="<?php echo base_url('pembelian/daftar_pembelian'); ?>"><button class="button-back"></button></a>
<!-- //back button -->
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>"> Pembelian</a></li>
		<li>Detail Pembelian</li>
	</ol>
</div>

<div class="clearfix"></div>
<?php 
$kode_pembelian=$this->uri->segment(4);
$this->db->where('kode_pembelian',$kode_pembelian);
$get_gudang = $this->db->get('transaksi_pembelian')->row();
?>
<div class="container">
	<h1>Data Pembelian</h1>
	<?php $this->load->view('menu_setting'); ?>
	<div class="page-content">
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading text-right">
						<span class="pull-left" style="font-size: 24px">Detail Transaksi Pembelian</span>
						<br><br>
					</div>
					<div class="panel-body">                   
						<form id="data_form" action="" method="post">
							<div class="box-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Kode Transaksi</label>
											<input readonly="" type="text" value="<?php echo $get_gudang->kode_pembelian?>" class="form-control" name="kode_pembelian" id="kode_pembelian" />
										</div>
										<div class="form-group">
											<label>Supplier</label>
											<select disabled="" class="form-control select2" name="kode_supplier" id="kode_supplier">
												<option selected="" value="">--Pilih Supplier--</option> 
												<?php 
												$get_supplier = $this->db->get('olive_master.master_supplier')->result();
												foreach ($get_supplier as  $value) { ?>
												<option <?php if($get_gudang->kode_supplier==$value->kode_supplier ){echo "selected";} ?> ><?php echo $value->nama_supplier ?></option>
												<?php } 
												?>
											</select> 
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="gedhi">Tanggal Transaksi</label>
											<input type="text" value="<?php echo tanggalindo ($get_gudang->tanggal_pembelian)?>" readonly="" class="form-control" name="tanggal_pembelian" id="tanggal_pembelian"/>
										</div>
										<div class="form-group">
											<label>Nota Referensi</label>
											<input readonly="" type="text" value="<?php echo $get_gudang->nomor_nota?>" class="form-control"  name="nomor_nota" id="nomor_nota" />
										</div>
									</div>
								</div>
							</div> 
							<?php 
							$kode_pembelian=$this->uri->segment(4);
							$this->db->from('opsi_transaksi_pembelian tp');
							$this->db->join('olive_master.master_bahan_baku mbb','mbb.kode_bahan_baku = tp.kode_bahan','left');
							$this->db->join('olive_master.master_perlengkapan mp','mp.kode_perlengkapan = tp.kode_bahan','left');
							$this->db->where('tp.kode_pembelian',$kode_pembelian);
							$this->db->order_by('tp.id','DESC');
							$get_gudang2 = $this->db->get('')->result();
							?>
							<div id="list_transaksi_pembelian">
								<div class="box-body">
									<table id="tabel_daftar" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No</th>
												<th>Kode Pembelian</th>
												<th>Nama Bahan</th>
												<th>Kategori Bahan</th>
												<th>Jumlah</th>
												<th>Diskon Item</th>
												<th>Harga</th>
												<th>Subtotal</th>
												<th>Exp.Date</th>
											</tr>
										</thead>
										<tbody id="tabel_temp_data_transaksi">
											<?php 
											$no = 0;
											$total=0;
											foreach ($get_gudang2 as $value) { 
												$total+=@$value->subtotal;
												$no++; ?>
												<tr>
													<td><?php echo $no ?></td>
													<td><?php echo $value->kode_pembelian ?></td>
													<td><?php echo $value->nama_bahan_baku; echo $value->nama_perlengkapan ?></td>
													<td><?php echo $value->kategori_bahan ?></td>
													<td><?php echo $value->jumlah ?></td>
													<td><?php echo $value->diskon_item ?></td>
													<td><?php echo format_rupiah ($value->harga_satuan) ?></td>
													<td><?php echo format_rupiah($value->subtotal) ?></td>
													<td><b><?php echo @tanggalIndo($value->expired_date) ?></b></td>
												</tr>

												<?php }
												?>
												<tr>
													<td colspan="6"></td>
													<td style="font-weight:bold;">Total Pembelian</td>
													<td colspan="2" id="tb_grand_total">
														<?= @format_rupiah($total) ?>                 </td>                    
													</tr>
												</tbody>
												<tfoot>

												</tfoot>
											</table>
										</div>
									</div>
									<div class="box-body">
										<div class="row">
											<div class="col-md-3">
												<label>Jenis Pembayaran</label>
												<div class="form-group">
													<select class="form-control" id="proses_pembayaran" name="proses_pembayaran" disabled="">
														<option <?php if($get_gudang->proses_pembayaran=='Cash'){echo "selected";}?> value="cash">Cash</option>
														<option <?php if($get_gudang->proses_pembayaran=='kredit'){echo "selected";}?> value="kredit">Credit</option>
													</select>
												</div>
											</div>		
											<div class="col-md-3" id="form_jatuh_tempo">
												<label>Jatuh Tempo</label>
												<div class="form-group">
													<input type="text" readonly class="form-control" name="tanggal_jatuh_tempo" id="tanggal_jatuh_tempo" value="<?php echo @tanggalindo($get_gudang->tanggal_jatuh_tempo)?>" />

												</div>
											</div>

											<div class="col-md-3">
												<label id="label_uang_muka">Diskon Belanja</label>
												<div class="form-group">
													<input type="text" class="form-control" name="diskon_persen" id="diskon_persen" readonly value="<?php echo  $get_gudang->diskon_persen?> %"/>
													<input type="hidden" class="form-control"  name="kode_sub" id="kode_sub">
												</div>
											</div>

											<div class="col-md-3">
												<label id="label_uang_muka"><b>Grand Total</b></label>
												<div class="form-group">
													<input type="text" class="form-control" name="grand_total" id="grand_total" readonly  value="<?php echo format_rupiah ($get_gudang->grand_total)?>"/>
													<input type="hidden" class="form-control"  name="kode_sub" id="kode_sub">
												</div>
											</div>
										</div>
									</form>

								</div>
							</div>
						</div><!-- /.col -->
					</div>
				</div>    
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

<a href="<?php echo base_url('pembelian'); ?>"><button class="button-back"></button></a>
<!-- //back button -->
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>"> Pembelian</a></li>
		<li><a href="<?php echo base_url('#'); ?>">Daftar Pembelian</a></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1> Pembelian</h1>
	<?php $this->load->view('menu_setting'); ?>
	<div class="page-content">
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading text-right">
						<span class="pull-left" style="font-size: 24px">Data Pembelian</span>
						<br><br>
					</div>

					<div class="panel-body">                   
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
							<div class="col-md-1 pull-left">
								<button   type="button" class="btn btn-info btn-no-radius pull-right" id="cari"><i class="fa fa-search"></i> Cari</button>
							</div>
						</div><br><br>
						<div >
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
								<tbody id="cari_transaksi">    
									<?php 
									$this->db->order_by('olive_gudang.transaksi_pembelian.id','DESC');
									$this->db->from('olive_gudang.transaksi_pembelian');
									$this->db->join('olive_master.master_supplier', 'olive_gudang.transaksi_pembelian.kode_supplier = olive_master.master_supplier.kode_supplier', 'left');
									$get_gudang = $this->db->get()->result();
									$no = 1;
									foreach ($get_gudang as $value) { ?>
									<tr>
										<td><?php echo $no ?></td>
										<td><?php echo tanggalIndo($value->tanggal_pembelian) ?></td>
										<td><?php echo $value->kode_pembelian ?></td>
										<td><?php echo $value->nomor_nota ?></td>
										<td><?php echo $value->nama_supplier ?></td>
										<td><?php echo format_rupiah ($value->grand_total) ?></td>
										<td>
											<div class="btn-group">
												<a href="<?php echo base_url('pembelian/pembelian/detail/'.$value->kode_pembelian); ?>" data-toggle="tooltip" title="Detail" class="btn btn-no-radius btn-success"><i class="fa fa-search"></i> </a>
											</div>
										</td>
									</tr>
									<?php $no++; }
									?>		
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


<script src="<?php echo base_url();?>component/lib/jquery.min.js"></script>
<script src="<?php echo base_url();?>component/lib/zebra_datepicker.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>component/lib/css/default.css"/>
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
				url : "<?php echo base_url()?>pembelian/daftar_pembelian/cari_pembelian",  
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

				}  
			});
		}

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


	});

</script>
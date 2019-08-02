
<?php 
$this->db->order_by('id','DESC');
$get_gudang = $this->db->get('transaksi_opname')->result();
?>
<a href="<?php echo base_url('adjust_stok'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('adjust_stok'); ?>">Adjust Stok</a></li>
		<li><a href="#">Adjust</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Adjust Stok</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right" style="height: 55px">
					<span class="pull-left" style="font-size: 24px">Input Adjust</span>
				</div>
				<div class="panel-body">
					<div class="box-body">   
						<form id="data_form" method="post">
							<input type="hidden" name="kode_opname" id="kode_opname" value="<?php echo 'OP_'.date('ymdhis') ?>">
							<div class="box-body">            
								<div class="row">
									<div class="col-md-12 " id="">
										<div class="col-md-3 " id="">
											<div class="input-group">
												<span class="input-group-addon">Tanggal</span>
												<input type="date" name="tanggal" id="tanggal" value="<?php echo date('Y-m-d') ?>" class="form-control" />
											</div>
										</div>
										<div class="col-md-4 " id="">
											<div class="input-group">
												<span class="input-group-addon">Jenis</span>
												<select class="form-control" name="jenis_bahan" id="jenis_bahan" onchange="get_bahan()">
													<option value="">-- pilih jenis --</option>
													<option value="Produk"> Produk </option>
													<option value="Bahan Baku"> Bahan Baku </option>
													<option value="Perlengkapan"> Perlengkapan </option>

												</select>
											</div>
										</div>
										<div class="col-md-3 " id="">
											<div class="input-group">
												<span class="input-group-addon">Data</span>
												<select class="form-control" name="kode_bahan" id="kode_bahan">

												</select>
											</div>
										</div>
										<div class="col-md-2 " id="">
											<a onclick="add_jadwal_opname()" style="width: 100px" type="button" class="btn btn-no-radius btn-info " id="add_opname"><i class="fa fa-plus"></i> Add</a>
										</div>
									</div>
								</div> 
							</div>
						</form>
					</div>
					<div class="load_opsi_jadwal" style="margin-top:30px">

					</div>
				</div>
			</div><br><br>
			<div class="panel panel-default">
				<div class="panel-heading text-right" style="height: 55px">
					<span class="pull-left" style="font-size: 24px">Hasil Adjust</span>
				</div>
				<div class="panel-body">
					<form id="pencarian_form" method="post" style="margin-left: 0px;" class="form-horizontal" target="_blank">

						<div class="row">
							<div class="col-md-4" id="trx_penjualan">
								<div class="input-group">
									<span class="input-group-addon">Tanggal Awal</span>
									<input type="date" class="form-control tgl" id="tgl_awal" />
								</div>
							</div>
							<div class="col-md-4" id="trx_penjualan">
								<div class="input-group">
									<span class="input-group-addon">Tanggal Akhir</span>
									<input type="date" class="form-control tgl" id="tgl_akhir" />
								</div>
							</div>
						</div>
						<br>
					</form>
					<form id="data_opname">
						<div id="po">
							<table class="table table-striped table-hover table-bordered datatables" id="tabel_daftar">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Opname</th>
										<th>Tanggal</th>
										<th>Validasi</th>
										<th>Action</th>
									</tr>
									<tbody id="scroll_data">
										<?php 
										$no = 0;
										foreach ($get_gudang as $value) { 
											$no++; ?>
											<tr>
												<td><?= $no ?></td>
												<td><?= $value->kode_opname ?></td>
												<td><?= tanggalIndo ($value->tanggal_opname) ?></td>
												<td><?= $value->validasi ?></td>
												<td>
													<a  href="<?php echo base_url('adjust_stok/adjust/detail/'.$value->kode_opname ) ?>" title="Detail" style="background-color: #1f897f;color:white" class="btn btn-xs green"><i class="fa fa-search"></i>  Detail</a>
												</td>
											</tr>
											<?php 
										} 
										?>
									</tbody>
									<tfoot>
										<tr>
											<th>No</th>
											<th>Kode Opname</th>
											<th>Tanggal</th>
											<th>Validasi</th>
											<th>Action</th>
										</tr>
									</tfoot>
								</table>
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
					<input type="hidden" id="kode_peralatan">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
				</div>
			</div>
		</div>
	</div>

	<script>
	function get_bahan () {
		jenis_bahan = $('#jenis_bahan').val();
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'adjust_stok/adjust/get_bahan' ?>",  
			cache :false,  
			data :{jenis_bahan:jenis_bahan},
			beforeSend:function(){
				$(".tunggu").show();   
			},
			success : function(data) { 
				$(".tunggu").hide();   
				$("#kode_bahan").html(data);
			}
		});
	}

	function load_table_opsi(){
		kode_opname 	= $('#kode_opname').val();
		$('.load_opsi_jadwal').load('<?php echo base_url() ?>adjust_stok/adjust/opsi_jadwal/'+kode_opname);
	}

	function add_jadwal_opname(){
		kode_opname = $('#kode_opname').val();
		tanggal 	= $('#tanggal').val();
		jenis_bahan = $('#jenis_bahan').val();
		kode_bahan 	= $('#kode_bahan').val();

		if (tanggal != '' && jenis_bahan != '' && kode_bahan != '') {
			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url() . 'adjust_stok/adjust/add_opsi_jadwal_opname_temp' ?>",  
				cache :false,  
				dataType:'json',
				data :{kode_opname:kode_opname,tanggal_opname:tanggal,jenis_bahan:jenis_bahan,kode_bahan:kode_bahan},
				beforeSend:function(){
					$(".tunggu").show();   
				},
				success : function(data) { 
					if (data.response == 'sukses') {
						$(".tunggu").hide();   
						load_table_opsi();
						$('#tanggal').attr('disabled', true);
						$('#jenis_bahan').val('');
						$('#kode_bahan').html('');
					}else if(data.response == 'ada'){
						alert('Data Sudah Ada');
						$(".tunggu").hide();   
						load_table_opsi();
						$('#tanggal').attr('disabled', true);
						$('#jenis_bahan').val('');
						$('#kode_bahan').html('');
					}else{
						alert('Data gagal di simpan.');
						$(".tunggu").hide();   
					}

				}
			});
		}else{
			alert('Mohon Untuk Melengkapi Form.');
			$(".tunggu").hide();   
		}
	}
	function actDel(key){
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'adjust_stok/adjust/hapus_opsi' ?>",  
			cache :false,  
			data :{id:key},
			beforeSend:function(){
				$(".tunggu").show();   
			},
			success : function(data) { 
				$(".tunggu").hide();   
				load_table_opsi();
			}
		});
	}

	function input_opname_pilih(){
		kode_opname 	= $('#kode_opname').val();
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'adjust_stok/adjust/simpan_opsi_adjust' ?>",  
			cache :false, 
			data :{kode_opname:kode_opname},
			beforeSend:function(){
				$(".tunggu").show();   
			},
			success : function(data) { 
				window.location = '<?php echo base_url() ?>adjust_stok/adjust/input_opname/'+kode_opname;
			}
		});
	}
	</script>
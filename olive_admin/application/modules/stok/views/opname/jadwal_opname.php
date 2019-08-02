
<!-- back button -->
<a href="<?php echo base_url('stok'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('stok'); ?>">Stok</a></li>
		<li><a href="#">Opname</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Opname </h1>

	<?php $this->load->view('menu_stok'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Input Jadwal Opname </span>
					<a href="<?php echo base_url('stok/opname/jadwal_opname'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Jadwal</a>
					<a href="<?php echo base_url('stok/opname/data_jadwal'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Jadwal</a>
				</div>
				<?php
				$get_unit=$this->db->get('setting');
				$hasil_unit=$get_unit->row();
				?>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-3">
								<label>Tanggal</label>
								<input type="date" name="tanggal" id="tanggal" class="form-control">
							</div>
							<div class="col-md-3">
								<label>Jenis Bahan</label>
								<select name="jenis_bahan" id="jenis_bahan" class="form-control select2" onchange="get_jenis_bahan()">
									<option value="">- Pilih -</option>
									<option value="BB">Bahan Baku</option>
									<option value="BDP">Barang Dalam Proses</option>
									<option value="Produk">Produk</option>
								</select>
							</div>
							<div class="col-md-3">
								<label>Data</label>
								<select name="kode_bahan" id="kode_bahan" class="form-control select2">
									<option value="">- Pilih -</option>
								</select>
							</div>
							<div class="col-md-2">
								<button class="btn btn-primary" onclick="add_item()" style="margin-top: 25px;">ADD</button>
							</div>
						</div>
					</div>
					<input type="hidden" name="kode_unit_jabung" id="kode_unit_jabung" value="<?php echo @$hasil_unit->kode_unit;?>">
					<input type="hidden" name="kode_opname" id="kode_opname" value="<?php echo 'OP_'.date('ymdHis');?>">
					<hr>
					<div class="col-md-12" style="margin-top: 20px;">
						<table id="" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th style="width: 70px;">No</th>
									<th>Kode Bahan</th>
									<th>Nama Bahan</th>
									<th>Action</th>
								</tr>
							</thead>

							<tbody id="data_opsi_temp">

							</tbody>
						</table>
					</div>
					<div class="col-md-12">
						<button onclick="konfirm_simpan()" class="btn_simpan btn btn-no-radius btn-info btn-md pull-right"><i class="fa fa-send"></i> SIMPAN</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- //row -->
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
				<input type="hidden" name="id_temp" id="id_temp">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-danger" onclick="hapus_data()"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="modal-kofirm" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Konfirmasi</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan menyimpan data ini ?</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-success" onclick="simpan_opname()"><i class="fa fa-send"></i> Simpan</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
	$('.btn_simpan').attr('disabled',true);
	function get_jenis_bahan(){
		var jenis_bahan=$('#jenis_bahan').val();
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'stok/opname/get_jenis_bahan' ?>",  
			cache :false,  
			data :{jenis_bahan:jenis_bahan},
			beforeSend:function(){
				$(".tunggu").show();
			},
			success : function(data) { 
				$(".tunggu").hide();
				$('#kode_bahan').html(data);
			},  
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
		return false;  
	}
	function load_opsi_temp() {
		var kode_opname=$('#kode_opname').val();
		var jenis_bahan=$('#jenis_bahan').val();
		$('#data_opsi_temp').load('<?php echo base_url().'stok/opname/tabel_opsi_temp/';?>'+kode_opname+'/'+jenis_bahan);
	}
	function add_item(){
		var kode_opname=$('#kode_opname').val();
		var jenis_bahan=$('#jenis_bahan').val();
		var kode_bahan=$('#kode_bahan').val();
		var tanggal=$('#tanggal').val();
		var kode_unit_jabung=$('#kode_unit_jabung').val();
		if(tanggal=='' || jenis_bahan=='' || kode_bahan==''){
			alert('Silahkan Lengkapi Form ...!');
		}else{
			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url() . 'stok/opname/add_item' ?>",  
				cache :false,  
				data :{kode_opname:kode_opname,kode_unit_jabung:kode_unit_jabung,jenis_bahan:jenis_bahan,kode_bahan:kode_bahan},
				dataType:'json',
				beforeSend:function(){
					$(".tunggu").show();
				},
				success : function(data) {
					$(".tunggu").hide();
					$('#kode_bahan').select2('val','');
					if(data.response=='gagal'){
						alert('Bahan Telah Tersedia ...!');
					}else{
						load_opsi_temp();
					}
				},  
				error : function() {
					alert("Data gagal dimasukkan.");  
				}  
			});
		}
		
		return false;  
	}
	function actDelete(key) {
		$('#modal-hapus').modal('show');
		$('#id_temp').val(key);
	}
	function hapus_data(){
		var id_temp=$('#id_temp').val();
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'stok/opname/hapus_item' ?>",  
			cache :false,  
			data :{id_temp:id_temp},
			beforeSend:function(){
				$(".tunggu").show();
			},
			success : function(data) {
				$(".tunggu").hide();
				load_opsi_temp();
				$('#modal-hapus').modal('hide');
			},  
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
		return false;  
	}
	function konfirm_simpan() {
		$('#modal-kofirm').modal('show');
	}
	function simpan_opname(){
		var kode_opname=$('#kode_opname').val();
		var tanggal=$('#tanggal').val();
		var kode_unit_jabung=$('#kode_unit_jabung').val();
		var jenis_bahan=$('#jenis_bahan').val();
		
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'stok/opname/simpan_jadwal' ?>",  
			cache :false,  
			data :{kode_opname:kode_opname,kode_unit_jabung:kode_unit_jabung,tanggal:tanggal,jenis_bahan:jenis_bahan},
			beforeSend:function(){
				$(".tunggu").show();
			},
			success : function(data) {
				$(".tunggu").hide();
				$(".alert_berhasil").show();
				setTimeout(function(){
					window.location="<?php echo base_url('stok/opname/data_jadwal');?>";
				},1500);
			},  
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
		
		return false;  
	}
</script>
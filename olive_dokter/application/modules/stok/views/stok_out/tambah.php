
<!-- back button -->
<a href="<?php echo base_url('stok'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('stok'); ?>">Stok</a></li>
		<li><a href="#">Stok Out</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Stok Out </h1>

	<?php $this->load->view('menu_stok'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Stok Out </span>
					<a href="<?php echo base_url('stok/stok_out/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Stok Out</a>
					<a href="<?php echo base_url('stok/stok_out/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Stok Out</a>
				</div>
				<?php
				$get_unit=$this->db->get('setting');
				$hasil_unit=$get_unit->row();
				?>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-1">
							<label>Tanggal</label>
						</div>
						<div class="col-md-4">
							<input type="date" name="tanggal" id="tanggal" class="form-control">
							<input type="hidden" name="kode_transaksi"  id="kode_transaksi" value="<?php echo 'SO_'.date('ymdHis');?>" class="form-control" >
							<input type="hidden" name="kode_unit" id="kode_unit" value="<?php echo @$hasil_unit->kode_unit;?>">
						</div>
						<div class="col-md-2">
							<button class="btn btn-warning btn_lock" onclick="lock_tanggal()">Lock</button>
							<button class="btn btn-danger btn_cancel" onclick="unlock_tanggal()">Cancel</button>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<label>Bahan Baku</label>
							<select class="form-control select2 opsi_stok_out" name="kode_bahan_baku" id="kode_bahan_baku" onchange="get_satuan()">
								<option value="">- Pilih -</option>
								<?php
								$this->db_master->where('kode_unit_jabung', @$hasil_unit->kode_unit);
								$get_bb=$this->db_master->get('master_bahan_baku');
								$hasil_bb=$get_bb->result();
								foreach ($hasil_bb as $bahan) {
									?>
									<option value="<?php echo @$bahan->kode_bahan_baku;?>"><?php echo @$bahan->nama_bahan_baku;?></option>
									<?php
								}
								?>
							</select>
						</div>
						<div class="col-md-2">
							<label>QTY</label>
							<input type="number" name="qty" id="qty" class="form-control opsi_stok_out" onkeyup="cek_qty()">
						</div>
						<div class="col-md-2">
							<label>Satuan</label>
							<input type="text" readonly="" name="satuan_stok" id="satuan_stok" class="form-control opsi_stok_out">
							<input type="hidden" name="kode_satuan_stok" id="kode_satuan_stok" class="form-control">
							<input type="hidden" name="id_opsi" id="id_opsi" class="form-control">
						</div>
						<div class="col-md-3">
							<label>Keterangan</label>
							<input type="text"  name="keterangan" id="keterangan" class="form-control opsi_stok_out">
						</div>
						<div class="col-md-2">
							<button class="btn btn-primary btn_add opsi_stok_out" onclick="add_item()" style="margin-top: 25px;"><i class="fa fa-plus"></i> ADD</button>
							<button class="btn btn-primary btn_update opsi_stok_out" onclick="update_item()" style="margin-top: 25px;"><i class="fa fa-pencil"></i> Update</button>
						</div>
					</div>
					<br>
					<hr>
					<br>
					<div class="col-md-12 row">
						<table id="" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Bahan Baku</th>
									<th>QTY</th>
									<th>Keterangan</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="data_temp">    
								
							</tbody>
						</table>
					</div>
					<div class="col-md-12">
						<button class="btn btn-lg btn-info pull-right opsi_stok_out" onclick="confirm_simpan()"><i class="fa fa-send"></i> Simpan</button>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- //row -->
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
				<input type="hidden" id="id_temp">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Konfirmasi</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan menyimpan data ini?</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" onclick="simpan_so()" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
unlock_tanggal();
$('.btn_cancel').hide();
$(".btn_update").hide();

function lock_tanggal(){
	var tanggal =$('#tanggal').val();
	if(tanggal==''){
		alert('Silahkan Pilih Tanggal ..!');
	}else{
		$('#tanggal').attr('readonly',true);
		$('.opsi_stok_out').attr('disabled',false);
		$('.btn_lock').hide();
		$('.btn_cancel').show();
	}

}
function unlock_tanggal(){
	$('#tanggal').attr('readonly',false);
	$('.opsi_stok_out').attr('disabled',true);
	$('.btn_lock').show();
	$('.btn_cancel').hide();

	var kode_stok_out=$('#kode_transaksi').val();
	$.ajax({
		url: '<?php echo base_url('stok/stok_out/hapus_opsi_stokout_all'); ?>',
		type: 'post',
		data:{kode_stok_out:kode_stok_out},
		beforeSend:function(){
			$(".tunggu").show();
		},
		success: function(hasil){
			$(".tunggu").hide();
			load_data_temp();
		}
	});
}

function get_satuan(){
	var kode_bahan_baku=$("#kode_bahan_baku").val();
	$.ajax({
		url: '<?php echo base_url('stok/stok_out/get_satuan'); ?>',
		type: 'post',
		data:{kode_bahan_baku:kode_bahan_baku},
		dataType:'json',
		beforeSend:function(){
			$(".tunggu").show();
		},
		success: function(hasil){
			$(".tunggu").hide();
			$("#kode_satuan_stok").val(hasil.kode_satuan_stok);
			$("#satuan_stok").val(hasil.nama);
			$("#kuota_pengadaan").val(hasil.total_kebutuhan);
			$("#harga_satuan").val(hasil.hpp);
		}
	});

}

function cek_qty(){
	var qty =$('#qty').val();
	if(qty=='-' ||  parseInt(qty) < 0){
		alert('QTY Salah ..!');
		$('#qty').val('');
	}

}
function hapus(key) {
	$('#modal-hapus').modal('show');
}

function load_data_temp(){
	var kode_transaksi=$('#kode_transaksi').val();
	$('#data_temp').load("<?php echo base_url().'stok/stok_out/data_opsi/'?>"+kode_transaksi);
}

function add_item(){
	var kode_transaksi=$("#kode_transaksi").val();
	var kode_bahan_baku=$("#kode_bahan_baku").val();
	var keterangan=$("#keterangan").val();
	var qty=$("#qty").val();
	var kode_satuan_stok=$("#kode_satuan_stok").val();
	if(kode_bahan_baku=='' || qty=='' ){
		alert('Harap Lengkapi Form..!');
	}else{
		$.ajax({
			url: '<?php echo base_url('stok/stok_out/add_item'); ?>',
			type: 'post',
			data:{kode_transaksi:kode_transaksi,kode_bahan_baku:kode_bahan_baku,qty:qty,kode_satuan_stok:kode_satuan_stok,keterangan:keterangan},
			dataType:'json',
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(msg){
				$(".tunggu").hide();
				if(msg.hasil=='gagal'){
					alert("Bahan Baku Telah Ditambahkan ...!");
				}else{
					$("#kode_bahan_baku").select2('val','');
					$("#qty").val('');
					$("#satuan_stok").val('');
					$("#kode_satuan_stok").val('');
					$("#keterangan").val('');
					load_data_temp();
				}

			}
		});
	}
}

function actEdit(id) {
	var id=id;
	$.ajax({
		url: '<?php echo base_url('stok/stok_out/get_opsi'); ?>',
		type: 'post',
		data:{id:id},
		dataType:'json',
		beforeSend:function(){
		},
		success: function(hasil){
			$('#id_opsi').val(id);
			$('#kode_bahan_baku').val(hasil.kode_bahan_baku);
			$('#kode_bahan_baku').select2().trigger('change');
			$('#qty').val(hasil.jumlah);
			$('#kode_satuan_stok').val(hasil.kode_satuan);
			$("#satuan_stok").val(hasil.nama);
			$("#keterangan").val(hasil.keterangan);

			$('.btn_update').show();
			$('.btn_add').hide();
		}
	});
}

function update_item(){
	var id=$("#id_opsi").val();
	var kode_transaksi=$("#kode_transaksi").val();
	var kode_bahan_baku=$("#kode_bahan_baku").val();
	var keterangan=$("#keterangan").val();
	var qty=$("#qty").val();
	var kode_satuan_stok=$("#kode_satuan_stok").val();
	if(kode_bahan_baku=='' || qty=='' ){
		alert('Harap Lengkapi Form..!');
	}else{
		$.ajax({
			url: '<?php echo base_url('stok/stok_out/update_item'); ?>',
			type: 'post',
			data:{id:id,kode_transaksi:kode_transaksi,kode_bahan_baku:kode_bahan_baku,qty:qty,kode_satuan_stok:kode_satuan_stok,keterangan:keterangan},
			dataType:'json',
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(msg){
				$(".tunggu").hide();
				if(msg.hasil=='gagal'){
					alert("Bahan Baku Telah Ditambahkan ...!");
				}else{
					$("#kode_bahan_baku").select2('val','');
					$("#qty").val('');
					$("#satuan_stok").val('');
					$("#kode_satuan_stok").val('');
					$("#keterangan").val('');
					$('.btn_update').hide();
					$('.btn_add').show();
					load_data_temp();
				}

			}
		});
	}
}

function actDelete(key) {
	$('#modal-hapus').modal('show');
	$('#id_temp').val(key);
}
function hapus_data() {
	var id=$('#id_temp').val();
	$.ajax({
		url: '<?php echo base_url('stok/stok_out/hapus_opsi'); ?>',
		type: 'post',
		data:{id:id},
		beforeSend:function(){
			$(".tunggu").show();
		},
		success: function(hasil){
			$(".tunggu").hide();
			$('.btn_update').hide();
			$('.btn_add').show();
			$('#modal-hapus').modal('hide');
			load_data_temp();
		}
	});
}

function confirm_simpan(){
	$('#modal-konfirmasi').modal('show');
}

function simpan_so() {
	var kode_stok_out=$('#kode_transaksi').val();
	var tanggal_transaksi=$('#tanggal').val();
	var kode_unit=$('#kode_unit').val();

	$.ajax({
		url: '<?php echo base_url('stok/stok_out/simpan_so'); ?>',
		type: 'post',
		data:{kode_stok_out:kode_stok_out,tanggal_transaksi:tanggal_transaksi,kode_unit:kode_unit},
		beforeSend:function(){
			$('#modal-konfirmasi').modal('hide');
			$(".tunggu").show();
		},
		success: function(hasil){
			$(".tunggu").hide();
			$(".alert_berhasil").show();
			setTimeout(function(){
				window.location="<?php echo base_url('stok/stok_out/daftar');?>";
			},1500);
		},
		error : function() {
			alert("Data gagal dimasukkan.");  
		}  
	});
}

</script>
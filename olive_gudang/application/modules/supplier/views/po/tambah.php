
<!-- back button -->
<a href="<?php echo base_url('pembelian'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>">Pembelian</a></li>
		<li><a href="#">PO Supplier</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>PO Supplier </h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah PO Supplier </span>
					<a href="<?php echo base_url('pembelian/po/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah PO Supplier</a>
					<a href="<?php echo base_url('pembelian/po/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data PO Supplier</a>
				</div>
				<?php
				$user = $this->session->userdata('astrosession');

				$get_setting=$this->db->get('setting');
				$hasil_setting=$get_setting->row();
				$kode_unit_jabung=@$hasil_setting->kode_unit;

				$this->db->select_max('id');
				$get_id=$this->db->get('transaksi_po');
				$max_id=$get_id->row();
				$no_urut=@get_kode($max_id->id,2);

				$kode_po="KAN/PO-".$kode_unit_jabung."/".date('m')."/".$no_urut;
				$kode_po_encript=paramEncrypt($kode_po);
				?>

				<div class="panel-body">
					<div class="row">
						<div class="col-md-3">
							<label>Kode Transaksi</label>
							<input type="text" readonly="" name="kode_transaksi"  id="kode_transaksi" value="<?php echo $kode_po;?>" onchange="cek_kode_po()" class="form-control transaksi_po" >

						</div>
						<div class="col-md-2">
							<label>Tanggal Transaksi</label>
							<input type="date" name="tanggal_transaksi" id="tanggal_transaksi" value="<?php echo date('Y-m-d');?>" class="form-control transaksi_po" readonly="">
						</div>
						<div class="col-md-2">
							<label>Operator</label>
							<input type="text" name="operator" id="operator" value="<?php echo $user->nama_user; ?>" class="form-control transaksi_po" readonly="">
							<input type="hidden" name="kode_petugas" id="kode_petugas" value="<?php echo $user->kode_user; ?>" class="form-control transaksi_po" readonly="">
						</div>
						<div class="col-md-2">
							<label>Supplier</label>
							<select class="form-control transaksi_po" name="kode_supplier" id="kode_supplier">
								<option value="">- Pilih Supplier -</option>
								<?php
								$get_kode_unit = $this->db->get('setting')->row();

								$this->db_master->where('status_supplier !=','blacklist');
								$this->db_master->where('kode_unit_jabung', $get_kode_unit->kode_unit);
								$get_supplier=$this->db_master->get('master_supplier');
								$hasil_supplier=$get_supplier->result();
								foreach ($hasil_supplier as $supplier) {
									?>
									<option value="<?php echo $supplier->kode_supplier?>"><?php echo $supplier->nama_supplier?></option>
									<?php
								}
								?>
							</select>
						</div>
						<div class="col-md-2">
							<label>Tanggal Barang Datang</label>
							<input type="date" name="tanggal_barang_datang" id="tanggal_barang_datang" value="" class="form-control transaksi_po" >
						</div>
						<div class="col-md-1">
							<button class="btn btn-warning transaksi_po btn_lock" style="margin-top: 25px;" onclick="lock_transaksi()">LOCK</button>
							<button class="btn btn-danger btn_cancel" style="margin-top: 25px;" onclick="unlock_confirm()">CANCEL</button>
						</div>
					</div>
					<hr><br>
					<div class="row opsi_po">
						<div class="col-md-3">
							<label>Bahan Baku</label>
							<select class="form-control" name="kode_bahan_baku" id="kode_bahan_baku" onchange="get_satuan()">
								<option>- Pilih Bahan -</option>
							</select>
						</div>
						<div class="col-md-2">
							<label>QTY</label>
							<input type="number" name="qty" id="qty" onkeyup="cek_qty()" class="form-control">
						</div>
						<div class="col-md-2">
							<label>Kuota Pengadaan</label>
							<input type="text" readonly="" name="kuota_pengadaan" id="kuota_pengadaan" class="form-control">
						</div>
						<div class="col-md-2">
							<label>Satuan</label>
							<input type="text" readonly="" name="satuan_pembelian" id="satuan_pembelian" class="form-control">
							<input type="hidden" name="kode_satuan_pembelian" id="kode_satuan_pembelian" class="form-control">
							<input type="hidden" name="harga_satuan" id="harga_satuan" class="form-control">
							<input type="hidden" name="id_opsi" id="id_opsi" class="form-control">
						</div>
						
						<div class="col-md-2">
							<button class="btn btn-primary btn_add" onclick="add_item()" style="margin-top: 25px;"><i class="fa fa-plus"></i> ADD</button>
							<button class="btn btn-primary btn_update" onclick="update_item()" style="margin-top: 25px;"><i class="fa fa-pencil"></i> Update</button>
						</div>
					</div>
					<br>
					<table id="" class="table table-striped table-bordered opsi_po">
						<thead>
							<tr>
								<th width="5%">No</th>
								<th>Nama Bahan</th>
								<th>QTY</th>
								<th width="15%">Action</th>
							</tr>
						</thead>

						<tbody id="data_temp">

						</tbody>
					</table>
					<br>
					<br>
					<button class="btn btn-lg btn-success pull-right opsi_po" onclick="confirm_simpan_po()">Simpan</button>
				</div>
			</div>
		</div>
	</div> <!-- //row -->
</div>


<!-------------------------------------------------- Modal ---------------------------------------------->
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
				<button type="button" onclick="simpan_po()" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
	</div>
</div>
<div id="modal-konfirmasi-cancel" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Konfirmasi Batal</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan membatalkan data ini?</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
				<button type="button" onclick="unlock_transaksi()" class="btn btn-danger"><i class="fa fa-save"></i> Batal</button>
			</div>
		</div>
	</div>
</div>
<!-------------------------------------------------- Modal ---------------------------------------------->


<script type="text/javascript">
$(".opsi_po").hide();
$(".btn_update").hide();
$(".btn_cancel").hide();

function cek_kode_po(){
	var kode_transaksi=$("#kode_transaksi").val();
	string_kode=kode_transaksi.indexOf("/");
	if(string_kode >= 0){
		alert('Kode Tidak Boleh Menggunakan tanda " / "');
		$("#kode_transaksi").val('');
	}else{
		$.ajax({
			url: '<?php echo base_url('pembelian/po/cek_kode_po'); ?>',
			type: 'post',
			data:{kode_transaksi:kode_transaksi},
			dataType:'json',
			success: function(msg){
				if(msg.hasil=='gagal'){
					alert('Kode Telah Tersedia ..!');
					$("#kode_transaksi").val('');
				}
			}
		});

	}

}
function lock_transaksi(){
	var kode_supplier=$("#kode_supplier").val();
	var kode_transaksi=$("#kode_transaksi").val();
	var tanggal_barang_datang=$("#tanggal_barang_datang").val();
	if(kode_transaksi==''){
		alert('Masukkan Kode PO');
	}else if(kode_supplier==''){
		alert('Pilih Supplier');
	}else if(tanggal_barang_datang==''){
		alert('Pilih Tanggal Barang Datang');
	}else{
		$(".transaksi_po").attr('disabled',true);
		$(".opsi_po").show();

		var kode_supplier=$('#kode_supplier').val();
		$.ajax({
			url: '<?php echo base_url('pembelian/po/get_bahan_baku'); ?>',
			type: 'post',
			data:{kode_supplier:kode_supplier},
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$('#kode_bahan_baku').html(hasil);
				$(".btn_lock").hide();
				$(".btn_cancel").show();
			}
		});
	}

}
function unlock_transaksi(){
	var kode_transaksi=$('#kode_transaksi').val();

	$.ajax({
		url: '<?php echo base_url('pembelian/po/delete_all_temp'); ?>',
		type: 'post',
		data:{kode_transaksi:kode_transaksi},
		beforeSend:function(){
			$(".tunggu").show();
		},
		success: function(hasil){
			$(".tunggu").hide();
			$(".btn_lock").show();
			$(".btn_cancel").hide();
			$(".transaksi_po").attr('disabled',false);
			$(".opsi_po").hide();
			$('#modal-konfirmasi-cancel').modal('hide');
		}
	});

}
function unlock_confirm(){

	$('#modal-konfirmasi-cancel').modal('show');
}
function get_satuan(){
	var kode_bahan_baku=$("#kode_bahan_baku").val();
	$.ajax({
		url: '<?php echo base_url('pembelian/po/get_satuan'); ?>',
		type: 'post',
		data:{kode_bahan_baku:kode_bahan_baku},
		dataType:'json',
		beforeSend:function(){
			$(".tunggu").show();
		},
		success: function(hasil){
			$(".tunggu").hide();
			$("#kode_satuan_pembelian").val(hasil.kode_satuan_pembelian);
			$("#satuan_pembelian").val(hasil.nama);
			$("#kuota_pengadaan").val(hasil.total_kebutuhan);
			$("#harga_satuan").val(hasil.hpp);
		}
	});

}
function cek_qty(){
	var qty=$("#qty").val();
	var kuota_pengadaan=$("#kuota_pengadaan").val();
	if(parseInt(qty) < 0){
		alert('QTY Salah ...!');
		$("#qty").val('');
	}else if(parseInt(qty) > parseInt(kuota_pengadaan) ){
		alert('QTY Melebihi Kuota ...!');
		$("#qty").val('');
	}

}
function load_data_temp(){
	$('#data_temp').load("<?php echo base_url().'pembelian/po/data_opsi_po/'.$kode_po_encript;?>");
}
function add_item(){
	var kode_transaksi=$("#kode_transaksi").val();
	var kode_supplier=$("#kode_supplier").val();
	var kode_bahan_baku=$("#kode_bahan_baku").val();
	var qty=$("#qty").val();
	var kode_satuan_pembelian=$("#kode_satuan_pembelian").val();
	var harga_satuan=$("#harga_satuan").val();
	if(kode_bahan_baku=='' || qty=='' ){
		alert('Harap Lengkapi Form..!');
	}else{
		$.ajax({
			url: '<?php echo base_url('pembelian/po/add_item'); ?>',
			type: 'post',
			data:{kode_transaksi:kode_transaksi,kode_supplier:kode_supplier,kode_bahan_baku:kode_bahan_baku,qty:qty,kode_satuan_pembelian:kode_satuan_pembelian,harga_satuan:harga_satuan},
			dataType:'json',
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(msg){
				$(".tunggu").hide();
				if(msg.hasil=='gagal'){
					alert("Bahan Baku Telah Ditambahkan ...!");
				}else{
					$("#kode_bahan_baku").val('');
					$("#qty").val('');
					$("#kuota_pengadaan").val('');
					$("#satuan_pembelian").val('');
					$("#kode_satuan_pembelian").val('');
					$("#harga_satuan").val('');
					load_data_temp();
				}

			}
		});
	}
}
function actEdit(id) {
	var id=id;
	$.ajax({
		url: '<?php echo base_url('pembelian/po/get_opsi_po'); ?>',
		type: 'post',
		data:{id:id},
		dataType:'json',
		beforeSend:function(){
		},
		success: function(hasil){
			$('#id_opsi').val(id);
			$('#kode_bahan_baku').val(hasil.kode_bahan_baku);
			$('#qty').val(hasil.qty);
			$('#kode_satuan_pembelian').val(hasil.kode_satuan);
			$("#satuan_pembelian").val(hasil.nama);
			$("#kuota_pengadaan").val(hasil.total_kebutuhan);
			$("#harga_satuan").val(hasil.hpp);

			$('.btn_update').show();
			$('.btn_add').hide();
		}
	});
}
function update_item(){
	var id=$("#id_opsi").val();
	var kode_transaksi=$("#kode_transaksi").val();
	var kode_supplier=$("#kode_supplier").val();
	var kode_bahan_baku=$("#kode_bahan_baku").val();
	var qty=$("#qty").val();
	var kode_satuan_pembelian=$("#kode_satuan_pembelian").val();
	var harga_satuan=$("#harga_satuan").val();
	if(kode_bahan_baku=='' || qty=='' ){
		alert('Harap Lengkapi Form..!');
	}else{
		$.ajax({
			url: '<?php echo base_url('pembelian/po/update_item'); ?>',
			type: 'post',
			data:{id:id,kode_transaksi:kode_transaksi,kode_supplier:kode_supplier,kode_bahan_baku:kode_bahan_baku,qty:qty,kode_satuan_pembelian:kode_satuan_pembelian,harga_satuan:harga_satuan},
			dataType:'json',
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(msg){
				$(".tunggu").hide();
				if(msg.hasil=='gagal'){
					alert("Bahan Baku Telah Ditambahkan ...!");
				}else{
					$("#kode_bahan_baku").val('');
					$("#qty").val('');
					$("#kuota_pengadaan").val('');
					$("#satuan_pembelian").val('');
					$("#kode_satuan_pembelian").val('');
					$("#harga_satuan").val('');
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
		url: '<?php echo base_url('pembelian/po/hapus_opsi_po'); ?>',
		type: 'post',
		data:{id:id},
		beforeSend:function(){
			$(".tunggu").show();
		},
		success: function(hasil){
			$(".tunggu").hide();
			$('#modal-hapus').modal('hide');
			load_data_temp();
		}
	});
}
function confirm_simpan_po(){
	var jml_opsi=$('#jml_opsi').val();
	if(parseInt(jml_opsi)=='1' || jml_opsi==null){
		alert('Silahkan Tambah Bahan Baku PO ..!');
	}else{
		$('#modal-konfirmasi').modal('show');
	}

}
function simpan_po() {
	var kode_po=$('#kode_transaksi').val();
	var kode_petugas=$('#kode_petugas').val();
	var tanggal_transaksi=$('#tanggal_transaksi').val();
	var kode_supplier=$('#kode_supplier').val();
	var tanggal_transaksi=$('#tanggal_transaksi').val();
	var tanggal_barang_datang=$('#tanggal_barang_datang').val();

	$.ajax({
		url: '<?php echo base_url('pembelian/po/simpan_po'); ?>',
		type: 'post',
		data:{kode_po:kode_po,kode_petugas:kode_petugas,kode_supplier:kode_supplier,tanggal_transaksi:tanggal_transaksi,tanggal_barang_datang:tanggal_barang_datang},
		beforeSend:function(){
			$('#modal-konfirmasi').modal('hide');
			$(".tunggu").show();
		},
		success: function(hasil){
			$(".tunggu").hide();
			$(".alert_berhasil").show();
			setTimeout(function(){
				window.location="<?php echo base_url('pembelian/po/daftar');?>";
			},1500);
		},
		error : function() {
			alert("Data gagal dimasukkan.");  
		}  
	});
}
</script>
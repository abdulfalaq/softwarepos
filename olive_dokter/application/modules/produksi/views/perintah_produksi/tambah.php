
<!-- back button -->
<a href="<?php echo base_url('admin'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('produksi'); ?>">Produksi</a></li>
		<li><a href="#">Perintah Produksi</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Perintah Produksi</h1>

	<?php $this->load->view('menu_master'); ?>
	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Perintah Produksi </span>
					<a href="<?php echo base_url('produksi/perintah_produksi/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Perintah Produksi</a>
					<a href="<?php echo base_url('produksi/perintah_produksi/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Kebutuhan Bahan Baku</a>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-2 text-right">
							<label>Kode Perintah Produksi</label>
						</div>
						<div class="col-md-6">
							<input type="text" readonly="" id="kode_produksi" value="<?php echo 'PRO_'.date('ymdHis');?>" class="form-control">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-2 text-right">
							<label>Tanggal Perintah Produksi</label>
						</div>
						<div class="col-md-6">
							<input type="date" readonly="" id="tanggal_perintah_produksi" value="<?php echo date('Y-m-d');?>" class="form-control">
						</div>
					</div>
					<hr><br>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-3">
								<input type="hidden" id="id_update_temp">
								<label>Jenis Produk</label>
								<select id="jenis_produk" class="form-control" onchange="get_produk()">
									<option value="">- Pilih -</option>
									<option value="BDP">Barang Dalam Proses</option>
									<option value="Produk">Produk</option>
								</select>
							</div>
							<div class="col-md-3">
								<label>BDP / Produk</label>
								<select id="kode_bahan" class="form-control">
									<option value="">- Pilih -</option>

								</select>
							</div>
							<div class="col-md-3">
								<label>QTY</label>
								<input type="number" id="qty" class="form-control" onkeyup="cek_qty_produksi()">
							</div>
							<div class="col-md-2">
								<button class="btn btn-primary btn_add" style="margin-top: 25px;">ADD</button>
								<button class="btn btn-primary btn_update" style="margin-top: 25px; display: none">Update</button>
							</div>
						</div>
					</div>
					<div class="col-md-12" style="margin-top: 20px;">
						<table id="" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th style="width: 70px;">No</th>
									<th>Produk</th>
									<th>QTY</th>
									<th style="width: 150px;">Action</th>
								</tr>
							</thead>

							<tbody id="data_temp">

							</tbody>
						</table>
						<input type="hidden" id="jumlah_temp">
					</div>
					<div class="col-md-12">
						<button disabled="" id="simpan_perintah" class="btn btn-no-radius btn-info btn-md pull-right"><i class="fa fa-send"></i> SIMPAN</button>
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
				<input type="hidden" id="id_temp">
				<h2>Anda yakin akan menghapus data ini?</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-danger" onclick="delete_temp()"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
				<button type="button" onclick="simpan_perintah()" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
	function get_produk(){
		$('#kode_bahan').attr('disabled', true);
		var jenis_produk=$('#jenis_produk').val();
		$.ajax({
			url: '<?php echo base_url('produksi/perintah_produksi/get_produk'); ?>',
			type: 'post',
			data:{jenis_produk:jenis_produk},
			success: function(hasil){
				$('#kode_bahan').html(hasil);
				$('#kode_bahan').attr('disabled', false);
			}
		});
	}
	function cek_qty_produksi(){
		var qty=$('#qty').val();
		if(qty=='' || parseInt(qty) < 0){
			alert('QTY salah ...!');
			$('#qty').val('');
		}
	}
	function get_edit(obj) {
		tr = $(obj).parent().parent();
		id_temp = tr.find('#id_temp').val();
		jenis_produk = tr.find('#kategori_bahan').val();
		kode_bahan = tr.find('#kode_bahan').val();
		nama_bahan = tr.find('#nama_bahan').text();
		qty = tr.find('#qty').val();

		$('#jenis_produk').attr('disabled', true);
		$('#kode_bahan').attr('disabled', true);
		$('#id_update_temp').val(id_temp);
		$('#jenis_produk').val(jenis_produk);
		$('#kode_bahan').append('<option value="'+kode_bahan+'" selected>'+nama_bahan+'</option>');
		$('#qty').val(qty);
		$('.btn_add').hide();
		$('.btn_update').show();
	}
	function hapus(key) {
		$('#modal-hapus').find('#id_temp').val(key);
		$('#modal-hapus').modal('show');
	}
	function load_table_temp(kode_produksi){
		var jenis_produk=$('#jenis_produk').val();
		$.ajax({
			url: '<?php echo base_url('produksi/perintah_produksi/get_temp'); ?>',
			type: 'post',
			dataType: 'json',
			data:{kode_produksi:kode_produksi},
			success: function(hasil){
				$('#data_temp').html(hasil.table_temp);
				$('#jumlah_temp').val(hasil.jumlah_temp);
				if(parseInt(hasil.jumlah_temp) > 0){
					$('#simpan_perintah').attr('disabled', false);
				} else{
					$('#simpan_perintah').attr('disabled', true);
				}
			}
		});
	}
	$('.btn_add').click(function(){
		kode_produksi = $('#kode_produksi').val();
		kategori_bahan = $('#jenis_produk').val();
		kode_bahan = $('#kode_bahan').val();
		qty = $('#qty').val();
		if(kode_produksi != '' && kategori_bahan != '' && kode_bahan != '' && qty != ''){
			$.ajax({
				url: '<?php echo base_url('produksi/perintah_produksi/add_temp'); ?>',
				type: 'post',
				data: {kode_produksi:kode_produksi ,kategori_bahan:kategori_bahan ,kode_bahan:kode_bahan ,jumlah:qty},
				success: function(hasil){
					load_table_temp(kode_produksi);
					$('#jenis_produk').val('');
					$('#kode_bahan').html('<option value="">- Pilih -</option>');
					$('#kode_bahan').val('');
					$('#qty').val('');
				}
			});
		}else{
			if(kode_produksi == ''){
				pesan = 'Kode perintah produksi tidak ada silahkan reload page!';
			} else if(kategori_bahan == ''){
				pesan = 'Pilih kategori bahan!';
			} else if(kode_bahan == ''){
				pesan = 'Pilih BDP / Produk yang ingin diproduksi!';
			} else if(qty == ''){
				pesan = 'Masukkan QTY BDP / Produk yang ingin diproduksi!';
			}
			alert(pesan);
		}
	});
	$('.btn_update').click(function(){
		id_temp = $('#id_update_temp').val();
		qty = $('#qty').val();
		if(qty != ''){
			$.ajax({
				url: '<?php echo base_url('produksi/perintah_produksi/update_temp'); ?>',
				type: 'post',
				data: {id_temp:id_temp, jumlah:qty},
				success: function(hasil){
					load_table_temp(kode_produksi);
					$('#id_update_temp').val('');
					$('#jenis_produk').val('');
					$('#kode_bahan').html('<option value="">- Pilih -</option>');
					$('#kode_bahan').val('');
					$('#qty').val('');
					$('#jenis_produk').attr('disabled', false);
					$('#kode_bahan').attr('disabled', false);
					$('.add_temp').show();
					$('.btn_update').hide();
				}
			});
		}else{
			alert('Masukkan QTY BDP / Produk yang ingin diproduksi!');
		}
	});
	function delete_temp() {
		id_temp = $('#modal-hapus').find('#id_temp').val();
		$.ajax({
			url: '<?php echo base_url('produksi/perintah_produksi/delete_temp'); ?>',
			type: 'post',
			data: {id_temp:id_temp},
			success: function(hasil){
				load_table_temp(kode_produksi);
				$('#modal-hapus').modal('hide');
			}
		});
	}
	$('#simpan_perintah').click(function(){
		$('#modal-konfirmasi').modal('show');
	});

	function simpan_perintah(){
		kode_produksi = $('#kode_produksi').val();
		tanggal_perintah_produksi = $('#tanggal_perintah_produksi').val();
		jumlah_temp = $('#jumlah_temp').val();
		if(parseInt(jumlah_temp)>0){
			$.ajax({
				url: '<?php echo base_url('produksi/perintah_produksi/simpan_perintah_produksi'); ?>',
				type: 'post',
				data: {kode_produksi:kode_produksi ,tanggal_perintah_produksi:tanggal_perintah_produksi},
				beforeSend:function(){
					$('#modal-konfirmasi').modal('hide');
					$(".tunggu").show();
				},
				success: function(hasil){
					$(".tunggu").hide();
					$(".alert_berhasil").show();
					setTimeout(function(){
						window.location="<?php echo base_url('produksi/perintah_produksi');?>";
					},1500);
				},
			});
		}else{
			alert('Minimal 1 BDP / Produk yang akan diproduksi!');
		}
	}
</script>
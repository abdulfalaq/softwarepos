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
	<?php $this->load->view('menu_setting'); ?>
	<div class="page-content">
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading text-right">
						<span class="pull-left" style="font-size: 24px">Tambah Registrasi Pelayanan</span>
						<br><br>
					</div>

					<div class="panel-body">                   
						<div class="sukses" ></div>

						<form id="data_form">
							<div class="col-md-3">
								<div class="form-group">
									<label>Kode Transaksi</label>
									<input readonly="true" type="text" value="PEM_100218105556_1" class="form-control" placeholder="Kode Transaksi" name="kode_pembelian" id="kode_pembelian" />
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Tanggal Transaksi</label>
									<input type="date" value="2018-02-10"  class="form-control" placeholder="Tanggal Transaksi" name="tanggal_pembelian" id="tanggal_pembelian"/>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Supplier</label>
									<select class="form-control select2" name="kode_supplier" id="kode_supplier" required="">
										<option selected="true" value="">--Pilih Supplier--</option>
										<option value="SP0001">CV Yola</option>
										<option value="SP0002">CV sejahtera</option>
										<option value="SP0003">CV Alami</option>
										<option value="SP0004">pak men</option>
									</select> 
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Nota Referensi</label>
									<input type="text" class="form-control" placeholder="Nota Referensi" name="nomor_nota" id="nomor_nota" required=""/>
								</div>
							</div>
							<div class="col-md-1">  
								<div class="form-group">
									<label>&nbsp;</label>
									<a onclick="simpan_supplier()" id="simpan_supplier"  class="btn btn-primary btn-block">Simpan</a>
									<a onclick="update_supplier()" id="update_supplier"  class="btn btn-danger btn-block">Delete</a>
								</div>
							</div>
							<div class="col-xs-12">
								<div class="sukses" ></div>
							</div>
							<br>
							<div style="width: 100%; float: left; padding-bottom: 30px; margin-top:15px;" class="form_pembelian">
								<div class="col-md-9" style="padding: 0;" data-mh="xxx">
									<div class="col-md-12">
										<div style=" float: left; padding: 14px 0; background: #dadad9; margin-bottom: 15px;">
											<div class="col-xs-4" id="bahan_baku">
												<label>Jenis Bahan</label>
												<select class="form-control" id="kategori_bahan" name="kategori_bahan">
													<option value="">--PILIH JENIS BARANG</option>
													<option value="perlengkapan">Perlengkapan</option>
													<option value="bahan_baku">Bahan</option>
													<option value="produk">Produk</option>
												</select>
												<input type="hidden" name="kode_barang" id="kode_barang" value="">
											</div>
											<div class="col-xs-4 sec_perlengkapan">
												<label>Nama Perlengkapan</label>
												<select name="kode_perlengkapan" id="kode_perlengkapan" class="form-control">
													<option>--Pilih Perlengkapan</option>
													<option value="P0001">Handuk</option>
													<option value="P0002">Kemben </option>
													<option value="P0003">bandana</option>
													<option value="P0004">cap</option>
												</select>
											</div>
											<div class="col-xs-4 sec_bahan_baku">
												<label>Nama Bahan</label>
												<select name="kode_bahan" id="kode_bahan" class="form-control">
													<option>--Pilih Bahan</option>
													<option value="BB0001">Scrub Pemutih</option>
													<option value="BB0002">Cairian Gosok</option>
													<option value="BB0003">extract bengkoang</option>
													<option value="BB0004">tisu</option>
													<option value="BB0005">tisu glondong</option>
												</select>
											</div>
											<div class="col-xs-4 sec_produk">
												<label>Nama produk</label>
												<select name="kode_produk" id="kode_produk" class="form-control">
													<option>--Pilih produk</option>
													<option value="PR0001">Panadol</option>
													<option value="PR0002">Pembersih Wajah</option>
													<option value="PR0003">Demacolin</option>
													<option value="PR0004">acne lotion</option>
													<option value="PR0005">Masker Naturgo</option>
													<option value="PR0006">tes</option>
													<option value="PR0007">air mawar</option>
												</select>
											</div>
											<div class="col-xs-4 pilih">
												<label>Nama Barang</label>
												<input type="text" id="nama_barang" class="form-control" value="" readonly="">
												<select name="kode_bahan" id="kode_bahan" class="form-control" disabled="true">
													<option>Pilih</option>
												</select>
											</div>
											<input type="hidden" id="nama_bahan" name="nama_bahan" value="" />
											<div class="col-xs-4 sec_expdate">
												<label>Exp Date</label>
												<input type="date" name="expired_date" id="expired_date" class="form-control">
											</div>
											<div class="col-xs-1">
												<label>Jumlah</label>
												<input type="text" class="form-control" placeholder="0" name="jumlah" id="jumlah"/>
											</div>
											<div class="col-xs-2">
												<label>Satuan</label>
												<input readonly type="text" class="form-control" placeholder="Satuan" name="satuan" id="satuan_stok"/>
											</div>
											<div class="col-xs-2">
												<label>Harga </label>
												<input type="text" class="form-control" placeholder="0" name="harga" id="harga" />
												<input type="hidden" name="kode_satuan" id="kode_satuan" />
											</div>
											<div class="col-xs-2" style="width: 120px">
												<label>Jenis Diskon</label>
												<select class="form-control" name="jenis_diskon_item" id="jenis_diskon_item">
													<option value="Persen">Persen</option>
													<option value="Rupiah">Rupiah</option>
												</select>
											</div>
											<div class="col-xs-2" style="width: 110px">
												<label>Diskon</label>
												<div class="input-icon right">
													<i class="fa icon_diskon_item" ></i>
													<input type="text" class="form-control" placeholder="0" name="diskon_item" id="diskon_item" />
												</div>
											</div>
											<div class="col-xs-2">
												<label>Subtotal</label>
												<input type="text" readonly="true" class="form-control" placeholder="Sub Total" name="sub_total" id="sub_total" />
												<input type="hidden" name="id_item" id="id_item" />
											</div>
											<div class="col-xs-1" style="padding:auto 0px;">
												<label>&nbsp;</label>
												<a onclick="add_item()" id="add"  class="btn btn-primary">Add</a>
												<a onclick="update_item()" id="update" style="padding-left: 5px ;padding-right: 5px;" class="btn btn-warning pull-left">Update</a>
											</div>
										</div>              
									</div>
									<div id="list_transaksi_pembelian" class="col-xs-12">
										<div class="box-body">
											<label><strong>List Produk</strong></label>
											<table id="tabel_daftar" class="table table-bordered table-striped">
												<thead>
													<tr>
														<th>No</th>
														<th>Nama</th>
														<th>Exp Date</th>
														<th>Jumlah</th>
														<th>Harga</th>
														<th>Diskon</th>
														<th>Subtotal</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody id="tabel_temp_data_transaksi">

												</tbody>
												<tfoot>

												</tfoot>
											</table>
										</div>
									</div>
									<div class="col-md-6">
										<label>Diskon</label>
										<table width="100%">
											<tr>
												<td width="100px;">
													<select class="form-control" id="jenis_diskon" name="jenis_diskon">
														<option value="Persen">Persen</option>
														<option value="Rupiah">Rupiah</option>
													</select>
												</td>
												<td>
													<div class="input-icon right">
														<i class="fa icon_diskon" ></i>
														<input type="text" class="form-control" placeholder="0" name="diskon" id="diskon">
													</div>
												</td>
											</tr>
										</table>
									</div>
									<div class="col-md-12"><strong><div id="nilai_uang_muka" class="pull-right" style="font-size: 20px"></div></strong></div>
								</div>
								<div class="col-md-3 pko" style="background: #c49f47;color: #fff; margin-bottom: 5px;" data-mh="xxx">
									<div class="col-md-12">
										<label style="font-size: 15px">Total Pembelian</label>
									</div>
									<div class="col-md-12">
										<label class="pull-right nilai_pembelian" style="font-size: 20px">Rp.0</label>
										<input type="hidden" name="total_pembelian" id="total_pembelian" value="0">
									</div>
								</div>
								<div class="col-md-3 pko" style="background: #cb5a5e;color: #fff; margin-bottom: 5px;" data-mh="xxx">
									<div class="col-md-12">
										<label style="font-size: 15px">Diskon</label>
									</div>
									<div class="col-md-12">
										<label class="pull-right nilai_diskon" style="font-size: 20px">Rp.0</label>
									</div>
								</div>
								<div class="col-md-3 pko" style="background: #3598dc;color: #fff; margin-bottom: 5px;" data-mh="xxx">
									<div class="col-md-12">
										<label style="font-size: 15px">Grand Total</label>
									</div>
									<div class="col-md-12">
										<label class="pull-right nilai_grand_total" style="font-size: 20px">Rp.0</label>
										<input type="hidden" name="grand_total" id="grand_total">
									</div>
								</div>
								<div class="col-md-3" style="background: #66b82f; padding-top: 20px; margin-bottom: 30px;" data-mh="xxx">
									<div class="col-md-12">
										<label>Jenis Pembayaran</label>
										<div class="form-group">
											<select class="form-control" id="jenis_pembayaran" name="proses_pembayaran" >
												<option value="cash">Cash</option>
												<option value="kredit">Kredit</option>
											</select>
										</div>
									</div>
									<hr>
									<div class="col-md-12" id="form_jatuh_tempo">
										<label>Jatuh Tempo</label>
										<div class="form-group">
											<input type="date" class="form-control" name="tanggal_jatuh_tempo" id="jatuh_tempo" />
										</div>
									</div>
									<div class="col-md-12">
										<label id="label_uang_muka">Dibayar</label>
										<div class="form-group">
											<input type="text" class="form-control" onkeyup="get_kembali()" name="uang_muka" id="uang_muka" />
										</div>
									</div>
									<div class="col-md-12" style="background: #8e5fa2; color:#FFF; padding:10px; border-radius: 8px !important; box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.38); margin-bottom: -27px;">
										<div class="input-group text-center" style="width: 100%;">
											<h5><div id="label_kembalian">Kembalian</div></h5>
											<h3><div id="nilai_dibayar">Rp. 0</div></h3>
											<input type="hidden" class="form-control"  name="kembalian" id="kembalian" />
											<input type="hidden" class="form-control"  name="kode_sub" id="kode_sub" />
										</div>
									</div>
								</div>
							</div>

							<div class="col-xs-12 form_pembelian" style="margin-bottom: 15px;">
								<a onclick="confirm_bayar()"  class="btn btn-success btn-block btn-lg" style="padding: 25px 0; border-radius: 8px !important;"><i class="fa fa-save"></i> Simpan</a>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="modal-confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color:grey">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title" style="color:#fff;">Konfirmasi Hapus Data</h4>
				</div>
				<div class="modal-body">
					<span style="font-weight:bold; font-size:14pt">Apakah anda yakin akan menghapus pembelian bahan tersebut ?</span>
					<input id="id-delete" type="hidden">
				</div>
				<div class="modal-footer" style="background-color:#eee">
					<button class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
					<button onclick="delData()" class="btn green">Ya</button>
				</div>
			</div>
		</div>
	</div>

	<div id="modal-supplier" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color:grey">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title" style="color:#fff;">Konfirmasi</h4>
				</div>
				<div class="modal-body">
					<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan menyimpan data tersebut ?</span>
					<input id="kode_supplier" type="hidden">
				</div>
				<div class="modal-footer" style="background-color:#eee">
					<button class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
					<button onclick="save_supplier()" class="btn green">Ya</button>
				</div>
			</div>
		</div>
	</div>
	<div id="modal-supplier-update" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color:grey">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title" style="color:#fff;">Konfirmasi</h4>
				</div>
				<div class="modal-body">
					<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan menghapus data tersebut ?</span>
					<input id="kode_supplier" type="hidden">
				</div>
				<div class="modal-footer" style="background-color:#eee">
					<button class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
					<button onclick="delete_supplier()" class="btn green">Ya</button>
				</div>
			</div>
		</div>
	</div>

	<div id="modal-confirm-bayar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color:grey">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title" style="color:#fff;">Konfirmasi Pembayaran</h4>
				</div>
				<div class="modal-body">
					<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan membayar pembelian tersebut<!-- bahan sebesar <span id="bayare"></span> --> ?</span>
					<input id="id-delete" type="hidden">
					<input id="bahan-delete" type="hidden">
				</div>
				<div class="modal-footer" style="background-color:#eee">
					<button class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
					<button id="simpan_transaksi" class="btn green">Ya</button>
				</div>
			</div>
		</div>
	</div>
	<div id="modal-confirm-tanggal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color:grey">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title" style="color:#fff;">Konfirmasi Jatuh Tempo</h4>
				</div>
				<div class="modal-body">
					<span style="font-weight:bold; font-size:12pt">Silahkan Pilih Tanggal Jatuh Tempo !</span>
					<input id="id-delete" type="hidden">
					<input id="bahan-delete" type="hidden">
				</div>
				<div class="modal-footer" style="background-color:#eee">
					<button class="btn green" data-dismiss="modal" aria-hidden="true">OK</button>

				</div>
			</div>
		</div>
	</div>
	<div id="modal-confirm-dibayar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color:grey">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title" style="color:#fff;">Konfirmasi Bayar</h4>
				</div>
				<div class="modal-body">
					<span style="font-weight:bold; font-size:12pt">Nominal Pembayaran Kurang !</span>
					<input id="id-delete" type="hidden">
					<input id="bahan-delete" type="hidden">
				</div>
				<div class="modal-footer" style="background-color:#eee">
					<button class="btn green" data-dismiss="modal" aria-hidden="true">OK</button>

				</div>
			</div>
		</div>
	</div>
	<div id="modal-confirm-uangmuka" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color:grey">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title" style="color:#fff;">Konfirmasi Uang Muka</h4>
				</div>
				<div class="modal-body">
					<span style="font-weight:bold; font-size:12pt">Periksa Kembali Nominal Uang Muka !</span>
					<input id="id-delete" type="hidden">
					<input id="bahan-delete" type="hidden">
				</div>
				<div class="modal-footer" style="background-color:#eee">
					<button class="btn green" data-dismiss="modal" aria-hidden="true">OK</button>

				</div>
			</div>
		</div>
	</div>



	<script type="text/javascript">

		$('#nama_barang').hide();

		function formDefault() {
			$('#kategori_bahan').val('');
			$('.sec_bahan_baku').hide();
			$('.sec_perlengkapan').hide();
			$('.sec_produk').hide();
			$('#nama_barang').hide();
			$('.pilih select').show();
			$('.pilih').show();
			$('.jumlah').val('0');
			$('#satuan_stok').val('');
			$('#harga').val('0');
			$('#jenis_diskon_item').val('Persen');
			$('#diskon_item').val('0');
			$('#sub_total').val('0');
			$('#expired_date').val('');
			$('.sec_expdate').hide();
		}


		$(".form_pembelian").hide();
		$(".sec_perlengkapan").hide();

		function setting() {
			$('#modal_setting').modal('show');
		}

		function simpan_supplier() {
			var kode_supplier = $("#kode_supplier").val();
			var tanggal_pembelian = $("#tanggal_pembelian").val();
			if (kode_supplier == '') {
				alert('Nama Supplier Harus Diisi.');
			}else if (tanggal_pembelian == '') {
				alert('Tanggal Pembelian Harus Diisi.');
			}    else{
				$('#modal-supplier').modal('show');
			};
		}
		function update_supplier() {
			$('#modal-supplier-update').modal('show');
		}

		function save_supplier(){
			document.getElementById('kode_supplier').disabled = true;
			document.getElementById('nomor_nota').readOnly = true;
			document.getElementById('tanggal_pembelian').readOnly = true;
			$('#modal-supplier').modal('hide');
			$("#update_supplier").show();
			$("#simpan_supplier").hide();
			$(".form_pembelian").show();
		}

		function delete_supplier(){
			document.getElementById('kode_supplier').disabled = false;
			document.getElementById('nomor_nota').readOnly = false;
			$('#modal-supplier-update').modal('hide');
			$("#update_supplier").hide();
			$("#simpan_supplier").show();
			$(".form_pembelian").hide();

			var kode_pembelian = $('#kode_pembelian').val();
			var kode_supplier = $('#kode_supplier').val();
			var url = 'http://192.168.100.17/elladerma_gudang/pembelian/hapus_temp';
			$.ajax({
				type: "POST",
				url: url,
				data: $('#data_form').serialize(),
				beforeSend:function(){
					$(".tunggu").show();  
				},
				success: function(msg) {

					$(".tunggu").hide();
					$('#modal-confirm').modal('hide');
					$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_gudang/pembelian/get_pembelian/"+kode_pembelian);
					$('#kategori_bahan').val('bahan baku');
					get_grandtotal();
					window.location.href="";
				}
			});
			return false;
		}

		function confirm_bayar(){
			var uang = $("#nilai_dibayar").text();
			var uang_muka = $("#uang_muka").val();
			var grand_total = $("#grand_total").val();
			var proses_pembayaran = $("#jenis_pembayaran").val();
			var jatuh_tempo = $("#jatuh_tempo").val();
			if(proses_pembayaran=='kredit' && jatuh_tempo==''){
				$("#modal-confirm-tanggal").modal('show');
			}else if(( parseInt(uang_muka) < 0 || parseInt(grand_total) <= parseInt(uang_muka) || uang_muka=='') && proses_pembayaran=='kredit'){
				$("#modal-confirm-uangmuka").modal('show');
			}else if((parseInt(grand_total) > parseInt(uang_muka) || uang_muka=='') && proses_pembayaran=='cash'){
				$("#modal-confirm-dibayar").modal('show');
			}else{
				$("#bayare").text(uang);
				$("#modal-confirm-bayar").modal('show');
			}

		}

		$('#jenis_diskon_item').on('change',function(){
			var jenis_diskon_item = $("#jenis_diskon_item").val();
			var jumlah = $('#jumlah').val();
			var harga = $('#harga').val();
			var pembelian=(jumlah * harga);
			if(jenis_diskon_item == 'Persen')
			{ 
				$(".icon_diskon_item").text('%');
			}else if(jenis_diskon_item == 'Rupiah')
			{
				$(".icon_diskon_item").text('Rp');
			}
			$("#diskon_item").val('');
			$("#sub_total").val(pembelian);
		});
		$('#jenis_diskon').on('change',function(){
			var jenis_diskon = $("#jenis_diskon").val();
			if(jenis_diskon == 'Persen')
			{ 
				$(".icon_diskon").text('%');
			}else if(jenis_diskon == 'Rupiah')
			{
				$(".icon_diskon").text('Rp');
			}
			$("#diskon").val('');
			get_grandtotal();
		});

		$("#diskon_item").keyup(function(){
			var jenis_diskon_item = $("#jenis_diskon_item").val();
			var diskon_item = parseInt($("#diskon_item").val());
			var jumlah = $('#jumlah').val();
			var harga = $('#harga').val();
			var pembelian=(jumlah * harga);
			if(jenis_diskon_item == 'Persen'){ 
				if(diskon_item < 0 || diskon_item > 100){
					alert('Jumlah Diskon Salah');
					$("#diskon_item").val('');
					$("#sub_total").val(pembelian);
				}else{

					var nilai_diskon = ( pembelian * diskon_item) /100;
					var total = ( pembelian - nilai_diskon);
					$("#sub_total").val(total);
				}
			}else if(jenis_diskon_item == 'Rupiah'){
				if(diskon_item < 0 ||diskon_item > pembelian){
					alert('Jumlah Diskon Salah');
					$("#diskon_item").val('');
					$("#sub_total").val(pembelian);
				}else{
					var total = ( pembelian - diskon_item);
					$("#sub_total").val(total);
				}
			}

		});

		$("#diskon").keyup(function(){
			var jenis_diskon = $("#jenis_diskon").val();
			var diskon = parseInt($(this).val());
			var pembelian=$('#total_pembelian').val();
			if(jenis_diskon == 'Persen'){ 
				if(diskon < 0 || diskon > 99){
					alert('Jumlah Diskon Salah');
					$("#diskon").val('');
				}
			}else if(jenis_diskon == 'Rupiah'){
				if(diskon < 0 ||diskon > pembelian){
					alert('Jumlah Diskon Salah');
					$("#diskon").val('');
				}
			}
			get_grandtotal();
		});

		$('#jenis_pembayaran').on('change',function(){
			var jenis_pembayaran = $("#jenis_pembayaran").val();
			$("#jatuh_tempo").val('');

			if(jenis_pembayaran == 'cash')
			{ 
				$("#form_jatuh_tempo").hide();
				$("#label_uang_muka").text('Dibayar');
				$("#label_kembalian").text('Kembalian');
			}else if(jenis_pembayaran == 'kredit')
			{
				$("#form_jatuh_tempo").show();
				$("#uang_muka").val('');
				$("#label_uang_muka").text('Uang Muka');
				$("#label_kembalian").text('Hutang');
			}
			get_grandtotal();
		});

		var jenis_pembayaran = $("#jenis_pembayaran").val();
		if(jenis_pembayaran == 'cash')
		{
			$("#form_jatuh_tempo").hide();
			var total = $("#tabel_temp_data_transaksi #tb_grand_total").text();
			$("#uang_muka").val(total);
		}else if(jenis_pembayaran == 'kredit')
		{
			$("#form_jatuh_tempo").show();

		}


		$("#jumlah").keyup(function(){

			var jumlah = parseInt($('#jumlah').val());
			if(jumlah < 0  ){
				alert("Jumlah Salah");
			}else{
				var jenis_diskon_item = $("#jenis_diskon_item").val();
				var diskon_item = parseInt($("#diskon_item").val()); 
				var harga = $('#harga').val();
				var pembelian=(jumlah * harga);
				if(jenis_diskon_item == 'Persen' && $("#diskon_item").val() !=''){ 
					if(diskon_item < 0 || diskon_item > 100){
						alert('Jumlah Diskon Salah');
						$("#diskon_item").val('');
						$("#sub_total").val('');
					}else{

						var nilai_diskon = ( pembelian * diskon_item) /100;
						var total = ( pembelian - nilai_diskon);
						$("#sub_total").val(total);
					}
				}else if(jenis_diskon_item == 'Rupiah' && $("#diskon_item").val() !=''){
					if(diskon_item < 0 ||diskon_item > pembelian){
						alert('Jumlah Diskon Salah');
						$("#diskon_item").val('');
						$("#sub_total").val('');
					}else{
						var total = ( pembelian - diskon_item);
						$("#sub_total").val(total);
					}
				}else{
					$("#sub_total").val(pembelian);
				}
			}
		});



		$("#harga").keyup(function(){
			var harga = parseInt($('#harga').val());
			if(harga < 0  ){
				alert("Jumlah Salah");
			}else{
				var jenis_diskon_item = $("#jenis_diskon_item").val();
				var diskon_item = parseInt($("#diskon_item").val()); 
				var jumlah = parseInt($('#jumlah').val());
				var pembelian=(jumlah * harga);
				if(jenis_diskon_item == 'Persen' && $("#diskon_item").val() !=''){ 
					if(diskon_item < 0 || diskon_item > 100){
						alert('Jumlah Diskon Salah');
						$("#diskon_item").val('');
						$("#sub_total").val('');
					}else{
						var nilai_diskon = (pembelian * diskon_item) /100;
						var total = ( pembelian - nilai_diskon);
						$("#sub_total").val(total);
					}

				}else if(jenis_diskon_item == 'Rupiah' && $("#diskon_item").val() !=''){
					if(diskon_item < 0 ||diskon_item > pembelian){
						alert('Jumlah Diskon Salah');
						$("#diskon_item").val('');
						$("#sub_total").val('');
					}else{
						var total = ( pembelian - diskon_item);
						$("#sub_total").val(total);
					}
				}else{
					$("#sub_total").val(pembelian);

				}
			}

		});


		$(document).ready(function(){
			$("#tanggal").hide();
			$("#update").hide();
			$("#update_supplier").hide();
			$("#peralatan").hide();
			$("#form_expired").hide();
			$(".sec_bahan_baku").hide();
			$(".sec_produk").hide();
			$(".sec_expdate").hide();



			var kode_pembelian = $('#kode_pembelian').val() ;  
			$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_gudang/pembelian/get_pembelian/"+kode_pembelian);

			$(".tgl").datepicker();

			$('#nomor_nota').on('change',function(){
				var nomor_nota = $('#nomor_nota').val();
				var url = "http://192.168.100.17/elladerma_gudang/pembelian/get_kode_nota";
				$.ajax({
					type: 'POST',
					url: url,
					data: {nomor_nota:nomor_nota},
					success: function(msg){
						if(msg == 1){
							$(".notif_nota").html('<div class="alert alert-warning">Kode_Telah_dipakai</div>');
							setTimeout(function(){
								$('.notif_nota').html('');
							},1700);              
							$('#nomor_nota').val('');
						}
						else{

						}
					}
				});
			});


			$("#kode_sub").val('2.1.1');

			$("#proses_pembayaran").change(function(){
				var proses_pembayaran = $("#proses_pembayaran").val();
				if(proses_pembayaran== 'cash'){
					$("#kode_sub").val('2.1.1');
				}
				else if(proses_pembayaran== 'debet'){
					$("#kode_sub").val('2.1.2');

				}
				else{
					$("#kode_sub").val('2.1.3');
				}
				if(proses=="kredit"){
					$("#tanggal").show();
				}else{
					$("#tanggal").hide();
				}
			});



			$("#dibayar").keyup(function(){
				var dibayar = $("#dibayar").val();
				var kode_pembelian = $('#kode_pembelian').val() ;
				var grand = $("#tb_grand_total").text();
				var proses_pembayaran = $('#proses_pembayaran').val() ;
				var url = "http://192.168.100.17/elladerma_gudang/pembelian/get_rupiah";
				var url_kredit = "http://192.168.100.17/elladerma_gudang/pembelian/get_rupiah_kredit";
				if(proses_pembayaran==''){
					alert('Pembayaran Harus Diisi');
				}
				else{
					if(proses_pembayaran=='cash' || proses_pembayaran=='debet'){
						$.ajax({
							type: "POST",
							url: url,
							data: {dibayar:dibayar,kode_pembelian:kode_pembelian,grand:grand},
							success: function(msg) {            
								var data = msg.split("|");  
								var nilai_dibayar = data[1];
								var nilai_kembali = data[0];
								$("#nilai_dibayar").html(nilai_dibayar);


							}
						});
					}
					else if(proses_pembayaran=='credit'){
						$.ajax({
							type: "POST",
							url: url_kredit,
							data: {dibayar:dibayar,kode_pembelian:kode_pembelian,grand:grand},
							success: function(msg) {            
								var data = msg.split("|");  
								var nilai_dibayar = data[1];
								var nilai_kembali = data[0];
								$("#nilai_dibayar").html(nilai_dibayar);
								$("#nilai_kembali").html(nilai_kembali);
							}
						});
					}
				}

			})

			$("#simpan_transaksi").click(function(){
				var simpan_transaksi = "http://192.168.100.17/elladerma_gudang/pembelian/simpan_transaksi";
				var kode_pembelian = $('#kode_pembelian').val() ;
				$.ajax({
					type: "POST",
					url: simpan_transaksi,
        // data: $('#data_form').serialize(),
        data: {
        	kode_pembelian:$('#kode_pembelian').val(),
        	tanggal_pembelian:$('#tanggal_pembelian').val(),
        	nomor_nota:$('#nomor_nota').val(),
        	kode_supplier:$('#kode_supplier').val(),
        	total_pembelian:$('#total_pembelian').val(),
        	jenis_diskon:$('#jenis_diskon').val(),
        	diskon:$('#diskon').val(),
        	grand_total:$('#grand_total').val(),
        	proses_pembayaran:$('#jenis_pembayaran').val(),
        	uang_muka:$('#uang_muka').val(),
        	kembalian:$('#kembalian').val(),
        	tanggal_jatuh_tempo:$('#jatuh_tempo').val()
        },
        beforeSend:function(){
        	$(".tunggu").show();  
        },
        success: function(msg)
        {
        	$(".tunggu").hide();  
        	$("#modal-confirm-bayar").modal('hide');
        	var data = msg.split("|");
        	var num = parseInt(data[0]);
        	var pesan = data[1];

        	if(num > 0){  
        		kode = $("#kode_sub").val();
        		setTimeout(function(){$('.sukses').html(msg);
              // window.location = "http://192.168.100.17/elladerma_gudang/pembelian/tambah";
              window.location = "";
              // window.open("http://192.168.100.17/elladerma_gudang/pembelian/print_pembelian/"+kode_pembelian);
          },1500);  
        	}
        	else{
        		$(".sukses").html(pesan);   
        		setTimeout(function(){$('.sukses').html('');
        			window.location = "";
        		},1500); 
        	}     
        }
    });
				return false;

			});

		});

function add_item(){
	var kategori_bahan = $('#kategori_bahan').val();
	var kode_pembelian = $('#kode_pembelian').val();
	var nomor_nota = $('#nomor_nota').val();
	var kode_supplier = $('#kode_supplier').val();
	var kode_bahan = $('#nama_bahan').val();
	var diskon = $('#diskon_item').val();
	var jenis_diskon = $('#jenis_diskon_item').val();
	var jumlah = $('#jumlah').val();
	var satuan_stok = $('#satuan_stok').val();
	var kode_satuan = $('#kode_satuan').val();
	var nama_satuan = $("#nama_satuan").val();
	var harga_satuan = $('#harga').val();
	var subtotal = $("#sub_total").val();
	var expired_date = $('#expired_date').val();

	var url = "http://192.168.100.17/elladerma_gudang/pembelian/add_item_temp/ ";

	if(nomor_nota == '' && kode_supplier == ''){
		$(".sukses").html('<div class="alert alert-danger">Nomor Nota dan Supplier harus diisi.</div><span aria-hidden="true">&times;</span>');   
		setTimeout(function(){
			$('.sukses').html('');     
		},3000);
	}else if(kode_bahan == '' || jumlah == ''){
		$(".sukses").html('<div class="alert alert-danger">Silahkan Lengkapi Form</div>');   
		setTimeout(function(){
			$('.sukses').html('');     
		},3000);
	}
	else{
		$.ajax({
			type: "POST",
			url: url,
      // data: $('#data_form').serialize(),
      data: {
      	kategori_bahan:$('#kategori_bahan').val(),
      	kode_barang:$('#kode_barang').val(),
      	kode_produk:$('#kode_produk').val(),
      	kode_pembelian:$('#kode_pembelian').val(),
      	kategori_bahan:$('#kategori_bahan').val(),
      	jumlah:$('#jumlah').val(),
      	harga:$('#harga').val(),
      	jenis_diskon_item:$('#jenis_diskon_item').val(),
      	diskon_item:$('#diskon_item').val(),
      	kode_supplier:$('#kode_supplier').val(),
      	sub_total:$('#sub_total').val(),
      	expired_date:$('#expired_date').val()
      },
      beforeSend:function(){
      	$(".tunggu").show();  
      },
      success: function(data)
      {
      	$(".tunggu").hide();
      	formDefault();

      	if(data==1){
      		$(".sukses").html('<div class="alert alert-danger">Item Telah Tersedia</div>');
      		setTimeout(function(){$('.sukses').html('');},1800); 
      	}else{
      		$('.sukses').html('');     
      		$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_gudang/pembelian/get_pembelian/"+kode_pembelian);
      		$('#kode_bahan').val('');
      		$('#kode_produk').val('');
      		$('#kode_perlengkapan').val('');
      		$('#kategori_bahan').val('');
      		$('#jumlah').val('');
      		$('#expired_date').val('');
      		$("#harga").val('');
      		$("#satuan_stok").val('');
      		$("#diskon_item").val('');

      		$('#sub_total').val('');
      		$("#nama_bahan").val('');
      		$("#kode_satuan").val(''); 
      		$("#nama_satuan").val(''); 
      		get_grandtotal();
      	}
      }
  });
	}
}

function actDelete(id) {
	$('#id-delete').val(id);
	$('#modal-confirm').modal('show');
}

function actEdit(id) {
	$('#kategori_bahan').attr('disabled','disabled');
	$('#kode_perlengkapan').attr('disabled','disabled');
	var id = id;
	var kode_pembelian = $('#kode_pembelian').val();
	var url = "http://192.168.100.17/elladerma_gudang/pembelian/get_temp_pembelian";
	$.ajax({
		type: 'POST',
		url: url,
		dataType: 'json',
		data: {id:id},
		success: function(pembelian){
			$("#add").hide();
			$("#update").show();

			$('#kategori_bahan').val(pembelian.kategori_bahan);
			$("#kode_bahan").val(pembelian.kode_bahan);
			$("#kode_produk").val(pembelian.kode_bahan);
			$("#kode_perlengkapan").val(pembelian.kode_bahan);
			$("#kategori_bahan").val(pembelian.kategori_bahan);
			$("#nama_bahan").val(pembelian.nama_bahan);
			$('#jumlah').val(pembelian.jumlah);
			$('#kode_satuan').val(pembelian.kode_satuan);
			$("#nama_satuan").val(pembelian.nama_satuan);
			$('#harga').val(pembelian.harga_satuan);
			$('#diskon_item').val(pembelian.diskon_item);
			$('#jenis_diskon_item').val(pembelian.jenis_diskon);
			$('#sub_total').val(pembelian.subtotal);
			$('#expired_date').val(pembelian.expired_date);
			$('#satuan_stok').val(pembelian.nama_satuan);
			$('#kode_supplier').val(pembelian.kode_supplier);
			$('#sub_total').val(pembelian.subtotal);
			$("#id_item").val(pembelian.id);

			$('.sec_expdate').val(pembelian.expired_date);

			$('#nama_barang').show();
			$('#nama_barang').val(pembelian.nama_bahan);
			$('.pilih select').hide();

			if(pembelian.kategori_bahan == "bahan_baku"){
				$('.sec_expdate').show();
			}


			$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_gudang/pembelian/get_pembelian/"+kode_pembelian);
			document.getElementById('kode_bahan').disabled = true;
		}
	});
}

function update_item(){
	$('#kategori_bahan').removeAttr('disabled');
	$('#kode_perlengkapan').removeAttr('disabled');
	var kode_pembelian = $('#kode_pembelian').val();
	var kategori_bahan = $('#kategori_bahan').val();
	var diskon = $('#diskon_item').val();
	var kode_bahan = $('#kode_bahan').val();
	var jumlah = $('#jumlah').val();
	var expired_date = $('#expired_date').val();
	var kode_satuan = $('#kode_satuan').val();
	var nama_satuan = $("#nama_satuan").val();
	var harga_satuan = $('#harga').val();
	var nama_bahan = $("#nama_bahan").val();
	var subtotal = $("#sub_total").val();
	var jenis_diskon = $("#jenis_diskon_item").val();
	var id_item = $("#id_item").val();

	var url = "http://192.168.100.17/elladerma_gudang/pembelian/update_item/ ";

	$.ajax({
		type: "POST",
		url: url,
		data: { 
			expired_date:expired_date,
			kode_pembelian:kode_pembelian,
			kategori_bahan:kategori_bahan,
			kode_bahan:kode_bahan,
			nama_bahan:nama_bahan,
			jumlah:jumlah,
			kode_satuan:kode_satuan,
			nama_satuan:nama_satuan,
			harga_satuan:harga_satuan,
			diskon_item:diskon,
			jenis_diskon:jenis_diskon,
			subtotal:subtotal,
			id:id_item
		},
		success: function(data)
		{
			formDefault();
			document.getElementById('kode_bahan').disabled = false;
			$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_gudang/pembelian/get_pembelian/"+kode_pembelian);
			$('#kategori_bahan').val('');
			$('#kode_bahan').val('');
			$('#jumlah').val('');
			$("#nama_satuan").val('');
			$('#harga_satuan').val('');
			$("#nama_bahan").val('');
			$("#kode_satuan").val('');
			$("#id_item").val('');
			$("#harga").val('');
			$("#sub_total").val('');
			$("#expired_date").val('');
			$("#satuan_stok").val('');
			$("#diskon_item").val('');
			$("#add").show();
			$("#update").hide();
			$("#bahan_baku").show();
			$("#peralatan").hide();
			$("#form_expired").hide();
			$("#bahan").show();
			get_grandtotal();
		}
	});
}

function delData() {
	var id = $('#id-delete').val();
	var kode_pembelian = $('#kode_pembelian').val();
	var url = 'http://192.168.100.17/elladerma_gudang/pembelian/hapus_bahan_temp/delete';
	$.ajax({
		type: "POST",
		url: url,
		dataType: 'json',
		data: {
			id:id
		},
		beforeSend:function(){
			$(".tunggu").show();  
		},
		success: function(msg) {

			$(".tunggu").hide();
			$('#modal-confirm').modal('hide');
			$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_gudang/pembelian/get_pembelian/"+kode_pembelian);
			$('#kategori_bahan').val('bahan baku');
			get_grandtotal();

		}
	});
	return false;
}

function get_grandtotal() {
	var kode_pembelian = $('#kode_pembelian').val();
	var kode_supplier = $('#kode_supplier').val();
	var diskon = $('#dikon').val();
	var jenis_diskon = $('#jenis_diskon').val();
	var jenis_pembayaran = $('#jenis_pembayaran').val();

	var url = 'http://192.168.100.17/elladerma_gudang/pembelian/get_grandtotal';

	$.ajax({
		type: "POST",
		url: url,
		data: $('#data_form').serialize(),
		dataType: 'json',
		success: function(msg) {

			$('#grand_total').val(msg.grand_total);

			$('.nilai_diskon').text(msg.nilai_diskon);
			$('.nilai_grand_total').text(msg.nilai_grand_total);
			$('.nilai_pembelian').text(msg.nilai_pembelian);
			$('#total_pembelian').val(msg.total_pembelian);

			if(jenis_pembayaran=='cash'){
        //$('#uang_muka').val(msg.grand_total);

        $('#kembalian').val('');
    }else{
    	$('#uang_muka').val('');
    	$('#kembalian').val(msg.grand_total);
    	$('#nilai_dibayar').text(msg.nilai_grand_total);
    }
},  
error : function() {  
	alert("Failed to action!");  
	return false;
} 
});
	return false;
}

function get_kembali() {
	var uang_muka = $('#uang_muka').val();
	var grand_total = $('#grand_total').val();
	var jenis_pembayaran = $('#jenis_pembayaran').val();
	var url = 'http://192.168.100.17/elladerma_gudang/pembelian/get_kembali';

	if((parseInt(uang_muka) < 0 || uang_muka=='-') && jenis_pembayaran=='cash'){
		alert("Nominal Salah");
		$('#uang_muka').val('');
		get_grandtotal();

	}else if((parseInt(uang_muka) < 0 || uang_muka=='-' || parseInt(uang_muka) >= parseInt(grand_total)) && jenis_pembayaran=='kredit'){
		alert("Nominal Salah");
		$('#uang_muka').val('');
		get_grandtotal();
		$('#nilai_uang_muka').text('Rp. 0');

	}else{
		$.ajax({
			type: "POST",
			url: url,
			dataType: 'json',
			data: {
				grand_total:grand_total,uang_muka:uang_muka,jenis_pembayaran:jenis_pembayaran
			},
			success: function(msg) {
				$('#nilai_dibayar').text(msg.nilai_kembali);
				$('#kembalian').val(msg.kembali);
				$('#nilai_uang_muka').text(msg.nilai_uang_muka);
			}
		});
		return false;
	}

}


function get_satuan(){
	var kategori_bahan = $('#kategori_bahan').val();
	var kode_bahan = $('#nama_bahan').val();
	var url = 'http://192.168.100.17/elladerma_gudang/pembelian/get_satuan';
	$.ajax({
		type: "POST",
		url: url,
		dataType: 'json',
		data: {
			kategori_bahan:kategori_bahan,kode_bahan:kode_bahan
		},
		success: function(msg) {
			$('#satuan_stok').val(msg.satuan_stok);
			$('#kode_satuan').val(msg.id_satuan_stok);
		}
	});
}


function setValZero()
{
	$('#jumlah').val('0');
	$('#harga').val('0');
	$('#sub_total').val('0');
	$('#diskon_item').val('0');
}


$('#kategori_bahan').change(function(){
	var kategori_bahan = $('#kategori_bahan').val();

	$('.sec_perlengkapan select').val('');
	$('.sec_bahan_baku select').val('');

	if(kategori_bahan == "bahan_baku"){
		$('.sec_perlengkapan').hide();
		$('.sec_bahan_baku').show();
		$('.sec_expdate').show();
		$('.pilih').hide(); 
		$('.sec_produk').hide();

	}
	else if(kategori_bahan == "produk"){
		$('.sec_perlengkapan').hide();
		$('.sec_produk').show();
		$('.sec_bahan_baku').hide();
		$('.sec_expdate').show();
		$('.pilih').hide();
	}else if(kategori_bahan == "perlengkapan"){
		$('.sec_perlengkapan').show();
		$('.sec_bahan_baku').hide();
		$('.sec_expdate').hide();
		$('.pilih').hide();
		$('.sec_produk').hide();

	}else{
		$('.sec_perlengkapan').hide();
		$('.sec_bahan_baku').hide();
		$('.sec_expdate').hide();
		$('.sec_produk').hide();

		$('.pilih').show();
	}
	$('#nama_bahan').val('');
	setValZero();
	$('#kode_barang').val('');
});

$('#kode_perlengkapan').change(function(){
	$('#nama_bahan').val($('#kode_perlengkapan').val());
	get_satuan();
	setValZero();
	$('#kode_barang').val($(this).val());
});

$('#kode_bahan').change(function(){
	$('#nama_bahan').val($('#kode_bahan').val());
	get_satuan();
	setValZero();
	$('#kode_barang').val($(this).val());
});


$('#kode_produk').change(function(){
	$('#nama_bahan').val($('#kode_produk').val());
	get_satuan();
	setValZero();
	$('#kode_barang').val($(this).val());
});

</script>

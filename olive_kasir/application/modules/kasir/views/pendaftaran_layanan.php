<!-- back button -->
<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('kasir/pendaftaran_layanan'); ?>">Reservasi</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Reservasi</span>
					<br><br>
				</div>
				<div class="panel-body">
					<div class="col-xs-12">
						<!-- /.box -->
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Reservasi

								</div>
								<div class="tools">
									<a href="javascript:;" class="collapse">
									</a>
									<a href="javascript:;" class="reload">
									</a>

								</div>
							</div>

							<div class="portlet-body" style="padding: 0; float: left; width: 100%;">
								<div style="font-size: 26px; font-weight: 600; padding-left: 4px; padding-top: 16px;">Tambah Reservasi</div>
								<!-- FORM ATAS (KODE TRANSAKSI) -->
								<div style="width: 100%; float: left; padding: 15px 0; border-bottom: 1px solid #CCC; border-top: 1px solid #CCC; margin-top: 15px;">
									<div class="col-xs-12">
										<div class="sukses"></div>
									</div>
									<form id="data_form">
										<div class="col-md-3">
											<div class="form-group">
												<label>Kode Reservasi</label>
												<input readonly="true" type="text" value="RES_090218152353_1" class="form-control" placeholder="Kode Reservasi" name="kode_reservasi" id="kode_reservasi" />
												<input type="hidden"  name="kode_layanan" id="kode_layanan" value="PKT_090218152353_1">
											</div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label>Customer</label>
												<select class="form-control select2" name="kode_member" id="kode_member" required="">
													<option value="">--Pilih Customer--</option>
													<option value="20171010001">Arda</option>
													<option value="20171011002">jihan ali reza</option>
													<option value="20171017003">Lia Rosinta</option>
													<option value="20171017004">Novia Chandra</option>
													<option value="20171017005">Irma Oktaviani</option>
													<option value="20171209001">Ihsan</option>
													<option value="20171209002">Sinta</option>
													<option value="20171209003">Ratna</option>
												</select> 
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Jenis Reservasi</label>
												<select class="form-control select2" name="jenis_reservasi" id="jenis_reservasi" required="">
													<option value="">--Pilih--</option>
													<option value="Paket">Paket</option>
													<option value="Treatment">Treatment</option>
												</select> 
											</div>
										</div>
										<div class="col-md-1">  
											<div class="form-group">
												<label>&nbsp;</label>
												<a onclick="simpan_member()" id="simpan_member"  class="btn btn-primary btn-block">Simpan</a>
												<a onclick="delete_member()" id="update_member"  class="btn btn-danger btn-block">Delete</a>
											</div>
										</div>

									</div>
									<br>


									<div style="width: 66%; float: left; padding-bottom: 30px; margin-top:15px;" class="form_reservasi">
										<!-- LEFT SIDE -->



										<div class="col-md-12">
											<div style=" float: left; padding: 14px 0; background: #dadad9; margin-bottom: 15px;width: 100%;">
												<input type="hidden" id="id_temp">
												<div class="col-xs-3 select_paket">
													<label>Paket</label>
													<input type="hidden" name="kode_paket_lama" id="kode_paket_lama">
													<select name="kode_paket" id="kode_paket" class="form-control">
														<option value="">--Pilih Paket</option>
														<option value="PKT0002">Paket A</option>
														<option value="PKT0003">test</option>
														<option value="PKT0004">anam2</option>
														<option value="PKT45345">Paket A2</option>
														<option value="PKT2108">Paket  B</option>
													</select>
												</div>
												<div class="col-xs-3 select_treatment">
													<label>Treatment</label>
													<select name="kode_treatment" id="kode_treatment" class="form-control">
														<option value="">--Pilih Treatment</option>
														<option value="TRT_101017102550_1">Body Massage</option>
														<option value="TRT_101017153319_1">potong kuku</option>
														<option value="TRT_101017154024_1">Acne Treatment</option>
														<option value="TRT_231017121148_1">segar</option>
													</select>
												</div>

												<div class="col-xs-3 select_jenis_diskon">
													<label>Harga</label>
													<input readonly="true" type="text" name="harga" id="harga" class="form-control" placeholder="harga">
												</div>

												<div class="col-xs-2 select_jenis_diskon">
													<label>Jenis Diskon</label>
													<select hidden name="jenis_diskon" id="jenis_diskon" class="form-control">
														<option value="persen" selected="true">Persen</option>
														<option value="rupiah">Rupiah</option>
													</select>
												</div>

												<div class="col-xs-2 input_diskon">
													<label>Diskon</label>
													<div class="input-icon right" id="form_diskon_item">
														<i class="fa">%</i>
														<input type="text" name="diskon" onkeyup="diskonpersen_cek()" id="diskon_item"  class="form-control" placeholder="Diskon Persen" value="0">
													</div>
													<div class="input-icon right" id="form_diskon_rupiah">
														<i class="fa">Rp.</i>
														<input type="text" name="diskon_rupiah" onkeyup="diskonrupiah_cek()" id="diskon_rupiah"  class="form-control" placeholder=" Diskon Rupiah" value="0">
													</div>
												</div>

												<div class="col-xs-1">
													<label>&nbsp;</label>
													<a onclick="add_item()" id="add"  class="btn btn-primary">Add</a>
													<a onclick="update_item()" id="update"  class="btn btn-warning pull-left">Update</a>
												</div>
											</div>              
										</div>


										<!-- TABLE LIST -->
										<div id="list_transaksi_reservasi" class="col-xs-12">
											<div class="box-body">
												<label><strong>List Produk</strong></label>
												<table id="tabel_daftar" class="table table-bordered table-striped" style="font-size:1.5em;">
													<thead>
														<tr>
															<th>No</th>
															<th>Treatment</th>
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

										<div class="tabdiskonbawah">

											<div class="form-group col-md-6">
												<select hidden name="jenis_diskon_all" id="jenis_diskon_all" class="form-control">
													<option value="persen" selected="true">Persen</option>
													<option value="rupiah">Rupiah</option>
												</select>
											</div>
											<div class="form-group col-md-6">
												<div class="input-icon right" id="form_diskon_item_all">
													<i class="fa">%</i>
													<input type="text" name="diskon_all" onClick="this.select();" onkeyup="diskon_persen()" id="persen" class="form-control" placeholder="Diskon Persen" value="0">
												</div>
												<div class="input-icon right" id="form_diskon_rupiah_all">
													<i class="fa">Rp.</i>
													<input type="text" name="diskon_rupiah_all" onClick="this.select();" onkeyup="diskon_rupiah()" id="rupiah" class="form-control" placeholder=" Diskon Rupiah" value="0">
												</div>
												<input type="hidden" name="diskon_rupiah_all" readonly="true" id="rupiah_diskon" value="0">
											</div>

										</div>
									</div>
									<div  style="margin-top: 20px;"  class="col-md-4 form_reservasi" id="tabel3">
										<div class="bg-yellow" style="height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
											<span style="font-size:22px; " class="pull-right" id="total_pesanan">Rp 0,00</span>

											<p style="font-size: 18px;">Total Pesanan</p>
										</div>
										<div class="bg-red" style="height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
											<span style="font-size:22px; " class="pull-right" id="diskon_all">Rp 0,00</span>
											<i style="font-size:56px; margin-top:5px"></i>
											<p style="font-size: 18px;">Discount</p>
										</div>
										<div class="bg-blue" style="height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
											<span style="font-size:22px; " class="pull-right" id="grand_total">Rp 0</span>
											<i style="font-size:56px; margin-top:5px"></i>
											<p style="font-size: 18px;">Grand Total</p>
										</div>

										<div style="height: 40px;" class="form-group">
											<div class="input-group">
												<span class="input-group-addon">Kategori Diskon &nbsp;&nbsp;&nbsp;</span>
												<span id="golongan">
													<select class="form-control" id="kategori_diskon" name="kategori_diskon">
														<option selected="true" value="">-- Pilih Kategori Diskon --</option>
														<option value="member" id="member_diskon">Member</option>
														<option value="promo" id="promo">Promo</option>
														<option value="merchant" id="merchant">Merchant</option>
													</select>
												</span>
											</div>
										</div>

										<div style="height: 40px;" class="form-group form_promo">
											<div class="input-group">
												<span class="input-group-addon">Promo &nbsp;&nbsp;&nbsp;</span>
												<span id="golongan">
													<select name="" class="form-control" id="kode_promo" name="kode_promo">
														<option value="">-- Pilih Promo --</option>
													</select>
												</span>
											</div>
										</div>

										<div style="height: 40px;" class="form-group form_merchant">
											<div class="input-group">
												<span class="input-group-addon">Merchant &nbsp;&nbsp;&nbsp;</span>
												<span id="golongan">
													<select name="" class="form-control" id="kode_merchant" name="kode_merchant" >
														<option value="">-- Pilih Merchant --</option>
													</select>
												</span>
											</div>
										</div>

										<div style="height:60px; margin-bottom:5px">
											<div style="height: 40px;" class="form-group">
												<div class="input-group">
													<span class="input-group-addon">Jenis Transaksi &nbsp;&nbsp;&nbsp;</span>
													<span id="golongan">
														<select class="form-control" id="jenis_transaksi" name="jenis_transaksi">
															<option selected="true" value="tunai">Tunai</option>
															<option value="debit" id="debit">Debit Card</option>
															<option value="kredit" id="kredit">Credit Card</option>
														</select>
													</span>
												</div>
											</div>
										</div>

										<div style="height:60px; margin-bottom:5px;margin-top: -20px;" class="jatuh_tempo">
											<div style="height: 40px;" class="form-group">
												<div class="input-group">
													<span class="input-group-addon">Jatuh Tempo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
													<span id="golongan">
														<input placeholder="Tanggal" type="date" class="form-control" id="tgl_jatuh_tempo" value="2018-02-09"/>
													</span>
												</div>
											</div>
										</div>
										<div style="height:60px;margin-bottom: 5px;margin-top: -20px;" class="debit">
											<div style="height: 40px;" class="form-group">
												<div class="input-group">
													<span class="input-group-addon">Nama Bank &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
													<span id="golongan">
														<select class="form-control" id="nama_bank">
															<option value="">- Pilih Bank -</option>
															<option value="BCA">BCA</option>
															<option value="BNI">BNI</option>
															<option value="BRI">BRI</option>
															<option value="Mandiri">Mandiri</option>
															<option value="Niaga">Niaga</option>
															<option value="BII">BII</option>
															<option value="Lain-lain">Lain-lain</option>
														</select>
													</span>
												</div>
											</div>
										</div>
										<div style="height:60px;margin-bottom: 5px;margin-top: -20px;" class="debit">

											<div style="height: 40px;" class="form-group">
												<div class="input-group">
													<span class="input-group-addon">Nomor Card&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
													<span id="golongan">
														<input type="text" class="form-control" id="nomor_debit" />

													</span>
												</div>
											</div>
										</div>

										<div style="height:60px; margin-top: -20px;">
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon" id='bayar_text' style="font-size: x-large;font-weight: bolder;"><strong>Dibayar &nbsp;&nbsp;&nbsp;</strong></span>
													<span id="dibayar">
														<input type="hidden" id="total_no" />
														<input type="hidden" id="total2" />
														<input type="hidden" id="kembalian2" />
														<input style="font-size: 30px;" onkeyup="kembalian()" step="any" lang="de" type="text" autocomplete="off" class="form-control input-lg tagsinput" name="bayar" id="bayar" />
													</span>
												</div>
											</div>
										</div>

										<div class="bg-purple" style="height:40px; padding: 0px 10px 0px 10px; margin-top:-5px">
											<span style="font-size:26px; " class="pull-right totalDiskon" id="kembalian">Rp 0</span>
											<i style="font-size:56px; margin-top:5px"></i>
											<p style="font-size: 18px;" id="kemablian_text">Kembalian</p>
										</div><br>

										<div class="kembalian">

										</div>

									</div>
									<div class="col-xs-12 form_reservasi" style="margin-bottom: 15px;">
										<a onclick="confirm_bayar()"  class="btn btn-success btn-block btn-lg" style="padding: 25px 0; border-radius: 8px !important;"><i class="fa fa-save"></i> Simpan</a>
									</div>
								</form>
								<div id="cari_transaksi">
									<table class="table table-striped table-hover table-bordered" id="daftar_reservasi">
										<thead>
											<tr>
												<th>No</th>
												<th>Kode Transaksi</th>
												<th>Tanggal Transaksi</th>
												<th>Kode Customer</th>
												<th>Nama Customer</th>
												<th>Status</th>
												<th>Detail</th>
											</tr>
										</thead>
										<tbody id="scroll_data">
											<tr>
												<td>1</td>
												<td>RES_030218144936_8</td>
												<td>2018-02-03</td>
												<td>20171209001</td>
												<td>Ihsan</td>
												<td>menunggu</td>
												<td align="center">
													<div class="btn-group">
														<a href="detail" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-success"><i class="fa fa-search"></i> </a>
													</div>
												</td> 
											</tr>
										</tbody>
									</table>
								</div>
								<input type="hidden" class="form-control rowcount" value="1">
								<input type="hidden" class="form-control pagenum " value="0">
								<!--  -->

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(".select2").select2();
		$("#update").hide();
		$("#update_member").hide();
		$(".form_reservasi").hide();
		$(".sec_perlengkapan").hide();
		$("#form_diskon_rupiah_all").hide();
		$("#form_diskon_item_all").show();
		$(".debit").fadeOut(500);
		$(".jatuh_tempo").fadeOut(500);
		$(".form_promo").fadeOut(500);
		$(".form_merchant").fadeOut(500);
		$("#form_diskon_rupiah").hide();

		$("#kode_treatment").change(function(){
			var url = "http://192.168.100.17/elladerma_kasir/reservasi/reservasi/get_harga";
			var kode_treatment = $("#kode_treatment").val();
			$.ajax( {
				type:"POST", 
				url : url,  
				dataType: 'json',
				data :{kode_treatment:kode_treatment},

				success : function(data) {
					$("#harga").val(data.harga_perawatan);
				},  
				error : function(data) {  
					alert(data);  
				}  
			});
		});

		$("#kode_paket").change(function(){
			var url = "http://192.168.100.17/elladerma_kasir/reservasi/reservasi/get_harga_paket";
			var kode_paket = $("#kode_paket").val();
			$.ajax( {
				type:"POST", 
				url : url,  
				dataType: 'json',
				data :{kode_paket:kode_paket},

				success : function(data) {
					$("#harga").val(data.harga_paket);
				},  
				error : function(data) {  
					alert(data);  
				}  
			});
		});

	});

	$("#jenis_diskon_all").change(function(){
		if($("#jenis_diskon_all").val()=='rupiah'){
			$("#form_diskon_rupiah_all").show();
			$("#form_diskon_item_all").hide();
			$("#persen").val('0');
			$("#rupiah_diskon").val('0');
			diskon_all();
			grand_total();
		} else {
			$("#form_diskon_rupiah_all").hide();
			$("#form_diskon_item_all").show();
			$("#rupiah").val('0');
			$("#rupiah_diskon").val('0');
			diskon_all();
			grand_total();
		}
	});

	$("#jenis_transaksi").change(function(){
		var jenis = $("#jenis_transaksi").val();
		grand_total=$("#total_no").val();
		if(jenis=="debit" || jenis=="kredit"){
			$(".debit").fadeIn(500);
			$(".jatuh_tempo").fadeOut(500);
			$("#bayar_text").text('Dibayar');
			$("#bayar").val(grand_total);
		}else{
			$("#bayar_text").text('Dibayar');
			$(".debit").fadeOut(500);
			$(".jatuh_tempo").fadeOut(500);
			$("#bayar").val(0);
		}
	});

	$("#kategori_diskon").change(function(){
		var kategori_diskon = $("#kategori_diskon").val();
		if(kategori_diskon=="promo"){
			$(".form_promo").fadeIn(500);
			$(".form_merchant").fadeOut(500);
		}else if(kategori_diskon=="merchant"){
			$(".form_merchant").fadeIn(500);
			$(".form_promo").fadeOut(500);
		}else{
			$(".form_promo").fadeOut(500);
			$(".form_merchant").fadeOut(500);
		}
	})

	function simpan_member() {
		var kode_member = $("#kode_member").val();
		var jenis_reservasi = $("#jenis_reservasi").val();
		if (kode_member == '') {
			alert('Nama Customer Harus Diisi.');
		}else if(jenis_reservasi == '') {
			alert('Pilih Reservasi !');
		}else{
			save_member();
		};
	}
	function update_member() {
		$('#modal-member-update').modal('show');
	}

	function save_member(){
		document.getElementById('kode_member').disabled = true;
		document.getElementById('jenis_reservasi').disabled = true;

		var jenis_reservasi = $("#jenis_reservasi").val();
		if(jenis_reservasi=='Paket'){
			$(".select_paket").show();
			$(".select_treatment").hide();
			$(".select_jenis_diskon").show();
			$(".input_diskon").show();
		}else{
			$(".select_paket").hide();
			$(".select_treatment").show();
			$(".select_jenis_diskon").show();
			$(".input_diskon").show();
		}
		$('#modal-member').modal('hide');
		$("#update_member").show();
		$("#simpan_member").hide();
		$(".form_reservasi").show();
		$("#dokter").show();
		$("#tanggal_reservasi").show();
	}

	$("#jenis_diskon").change(function(){
		if($("#jenis_diskon").val()=='rupiah'){
			$("#form_diskon_rupiah").show();
			$("#form_diskon_item").hide();
			$("#diskon_item").val('0');

		} else {
			$("#form_diskon_rupiah").hide();
			$("#form_diskon_item").show();
			$("#diskon_rupiah").val('0');
		}
	});

	function delete_member(){
		document.getElementById('kode_member').disabled = false;
		document.getElementById('jenis_reservasi').disabled = false;

		$('#modal-member-update').modal('hide');
		$("#update_member").hide();
		$("#simpan_member").show();
		$(".form_reservasi").hide();

		var kode_reservasi = $('#kode_reservasi').val();
		var kode_member = $('#kode_member').val();
		var url = 'http://192.168.100.17/elladerma_kasir/reservasi/reservasi/hapus_temp';
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
				$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_kasir/reservasi/reservasi/get_reservasi/"+kode_reservasi+'/'+jenis_reservasi);
				$('#kategori_bahan').val('bahan baku');
				get_grandtotal();
				window.location.href="";
			}
		});
		return false;
	}

	function diskonpersen_cek(){
		var dis_persen = $('#diskon_item').val();

		if (dis_persen < 0 || dis_persen > 100 ) {
			alert('Diskon Salah !');
			$('#diskon_item').val('');
		}
	}

	function diskonrupiah_cek(){
		var dis_rupiah = $('#diskon_rupiah').val();
		var subtotal   = $("#harga").val();
		if (dis_rupiah < 0 ) {
			alert('diskon harus melebihi 0 !');
			$('#diskon_rupiah').val('');
		}else if(parseInt(dis_rupiah) > parseInt(subtotal)) {
			alert('diskon Melebihi subtotal !');
			$('#diskon_rupiah').val('');
		}
	}

	function add_item(){
		var kode_reservasi  = $('#kode_reservasi').val();
		var kode_member     = $('#kode_member').val();
		var jenis_reservasi = $('#jenis_reservasi').val();
		var kode_paket      = $('#kode_paket').val();
		var kode_treatment  = $('#kode_treatment').val();
		var jenis_diskon    = $('#jenis_diskon').val();
		var diskon_persen   = $('#diskon_item').val();
		var diskon_rupiah   = $('#diskon_rupiah').val();
		var subtotal        = $('#harga').val();

		var url = "http://192.168.100.17/elladerma_kasir/reservasi/reservasi/add_item_temp/ ";

		if(kode_member == ''){
			$(".sukses").html('<div class="alert alert-danger">member harus diisi.</div><span aria-hidden="true">&times;</span>');   
			setTimeout(function(){
				$('.sukses').html('');     
			},3000);
		}
		else{
			if (diskon_persen < 0) {
				$(".sukses").html("<div class='alert alert-warning'>Diskon salah !</div>");
				setTimeout(function(){$('.sukses').html('');},1500); 
			} else if (diskon_persen > 100) {
				$(".sukses").html("<div class='alert alert-warning'>Diskon salah !</div>");
				setTimeout(function(){$('.sukses').html('');},1500); 
				$("#diskon_item").val('0');
			} else if (parseInt(diskon_rupiah) < 0) {
				$(".sukses").html("<div class='alert alert-warning'>Diskon salah !</div>");
				setTimeout(function(){$('.sukses').html('');},1500); 
				$("#diskon_rupiah").val('0');
			}else if (parseInt(diskon_rupiah) > parseInt(subtotal)) {
				$(".sukses").html("<div class='alert alert-warning'>Diskon melebihi subtotal !</div>");
				setTimeout(function(){$('.sukses').html('');},1500); 
				$("#diskon_rupiah").val('0');
			}else{

				$.ajax({
					type: "POST",
					url: url,
					data: {
						kode_paket:kode_paket,
						kode_treatment:kode_treatment,
						kode_reservasi:kode_reservasi,
						kode_member:kode_member,
						jenis_reservasi:jenis_reservasi,
						jenis_diskon:jenis_diskon,
						diskon_persen:diskon_persen,
						diskon_rupiah:diskon_rupiah
					},
					beforeSend:function(){
						$(".tunggu").show();  
					},
					success: function(data)
					{
						$(".tunggu").hide();
						$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_kasir/reservasi/reservasi/get_reservasi/"+kode_reservasi+'/'+jenis_reservasi);
						$('.sukses').html('');     
						$('#kode_paket').val('');
						$('#kode_treatment').val('');
						$('#diskon_item').val('');
						$('#diskon_rupiah').val('');
						$('#harga').val('');
						totalan();
						grand_total();
					}
				});
			}
		}
	}

	function actDelete(id) {
		$('#id-delete').val(id);
		$('#modal-confirm').modal('show');
	}

	function actEdit(id) {

		var id = id;
		var kode_reservasi = $('#kode_reservasi').val();
		var jenis_reservasi = $('#jenis_reservasi').val();
		var url = "http://192.168.100.17/elladerma_kasir/reservasi/reservasi/get_temp_reservasi";
		$.ajax({
			type: 'POST',
			url: url,
			dataType: 'json',
			data: {id:id},
			success: function(reservasi){
				$("#add").hide();
				$("#update").show();
				if(jenis_reservasi=='Paket'){
					$("#kode_paket").val(reservasi.kode_paket);
					$("#kode_paket_lama").val(reservasi.kode_paket);
					$("#harga").val(reservasi.harga_paket);
					$("#id_temp").val(reservasi.id);
					if(reservasi.jenis_diskon=="persen"){
						$("#diskon_item").val(reservasi.diskon_persen);
					}else{
						$("#diskon_rupiah").val(reservasi.diskon_rupiah);
					}
				}else{
					$("#kode_treatment").val(reservasi.kode_item);
					$("#harga").val(reservasi.harga);
					$("#id_temp").val(reservasi.id);
					if(reservasi.jenis_diskon=="persen"){
						$("#diskon_item").val(reservasi.diskon_persen);
					}else{
						$("#diskon_rupiah").val(reservasi.diskon_rupiah);
					}
				}

				$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_kasir/reservasi/reservasi/get_reservasi/"+kode_reservasi+'/'+jenis_reservasi);

			}
		});
	}



	function update_item(){
		var kode_reservasi = $('#kode_reservasi').val();
		var kode_member = $('#kode_member').val();
		var kode_paket = $('#kode_paket').val();
		var kode_paket_lama = $('#kode_paket_lama').val();
		var jenis_reservasi = $('#jenis_reservasi').val();
		var kode_treatment = $('#kode_treatment').val();
		var id_temp = $('#id_temp').val();
		var jenis_diskon    = $('#jenis_diskon').val();
		var diskon_persen   = $('#diskon_item').val();
		var diskon_rupiah   = $('#diskon_rupiah').val();
		var subtotal        = $('#harga').val();
		var url = "http://192.168.100.17/elladerma_kasir/reservasi/reservasi/update_item/ ";

		$.ajax({
			type: "POST",
			url: url,
			data: { 
				kode_reservasi:kode_reservasi,
				kode_member:kode_member,
				kode_paket:kode_paket,
				kode_paket_lama:kode_paket_lama,
				jenis_reservasi:jenis_reservasi,
				kode_treatment:kode_treatment,
				id_temp:id_temp,
				jenis_diskon:jenis_diskon,
				diskon_persen:diskon_persen,
				diskon_rupiah:diskon_rupiah,
				subtotal:subtotal
			},
			success: function(data)
			{
				$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_kasir/reservasi/reservasi/get_reservasi/"+kode_reservasi+'/'+jenis_reservasi);
				$("#kode_paket").val('');
				$("#kode_paket_lama").val('');
				$('#kode_treatment').val('');
				$('#diskon_item').val('');
				$('#diskon_rupiah').val('');
				$('#harga').val('');
				$('#id_temp').val('');
				$("#add").show();
				$("#update").hide();
				totalan();
				grand_total();
			}
		});
	}

	function actDelete(id) {
		var kode_reservasi = $('#kode_reservasi').val();
		var jenis_reservasi = $('#jenis_reservasi').val();
		var url = 'http://192.168.100.17/elladerma_kasir/reservasi/reservasi/hapus_bahan_temp/delete';
		$.ajax({
			type: "POST",
			url: url,
			dataType: 'json',
			data: {
				id:id,jenis_reservasi:jenis_reservasi
			},
			beforeSend:function(){
				$(".tunggu").show();  
			},
			success: function(msg) {

				$(".tunggu").hide();
				$('#modal-confirm').modal('hide');
				$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_kasir/reservasi/reservasi/get_reservasi/"+kode_reservasi+'/'+jenis_reservasi);
				$('#kategori_bahan').val('bahan baku');

				totalan();
				grand_total();
			}
		});
		return false;
	}
	function totalan() {
		var kode_reservasi = $("#kode_reservasi").val();
		var jenis_reservasi = $("#jenis_reservasi").val();
		var url = "http://192.168.100.17/elladerma_kasir/reservasi/reservasi/get_total_temp";
		$.ajax({
			type: 'POST',
			url: url,
			dataType:'json',
			data: {kode_reservasi:kode_reservasi,jenis_reservasi:jenis_reservasi},
			success: function(kasir){
				$("#total_pesanan").text(kasir.total);
				$("#grand_total").text(kasir.total);
				$("#total2").val(kasir.total2);
			}
		});
	}
	function grand_total(){
		var url = "http://192.168.100.17/elladerma_kasir/reservasi/reservasi/grand_total";
		var rupiah = $("#rupiah_diskon").val();
		var kode_reservasi = $("#kode_reservasi").val();
		var jenis_reservasi = $("#jenis_reservasi").val();
		$.ajax({
			type: 'POST',
			url: url,
			dataType:'json',
			data: {rupiah:rupiah,kode_reservasi:kode_reservasi,jenis_reservasi:jenis_reservasi},
			success: function(rupiah){
				$("#grand_total").text(rupiah.total_grand);
				$("#total_no").val(rupiah.total_no);
			}
		});
	}
	function diskon_persen(){
		var diskon_persen = $("#persen").val();
		if (parseInt(diskon_persen) < 0 || parseInt(diskon_persen) > 100) {
			alert('diskon salah !');
			$("#persen").val('0');
			$("#rupiah").val('0');
			$("#rupiah_diskon").val('0');
			diskon_all();
			grand_total();
		}else {
			var jumlah = $("#total2").val();
			var rupiah = Math.round((diskon_persen/100 )* jumlah);
			$("#rupiah_diskon").val(rupiah);
			diskon_all();
			grand_total();
		}

	}
	function diskon_rupiah(){
		var jumlah = $("#total2").val();
		var no_meja = $("#kode_meja").val();
		var diskon_rupiah = $("#rupiah").val();
		if (parseInt(diskon_rupiah) > parseInt(jumlah) || parseInt(diskon_rupiah) < 0) {
			alert('Diskon Salah !');
			$("#persen").val('0');
			$("#rupiah").val('0');
			$("#rupiah_diskon").val('0');
			diskon_all();
			grand_total();
		}else{
			$("#rupiah_diskon").val(diskon_rupiah);
			diskon_all();
			grand_total();
		}
	}
	function diskon_all(){
		var url = "http://192.168.100.17/elladerma_kasir/kasir/kasir/diskon_all";
		var rupiah = $("#rupiah_diskon").val();
		$.ajax({
			type: 'POST',
			url: url,
			data: {rupiah:rupiah},
			success: function(rupiah){
				$("#diskon_all").text(rupiah);
			}
		});
	}
	function kembalian(){
		var url = "http://192.168.100.17/elladerma_kasir/kasir/kasir/kembalian";
		var dibayar = $("#bayar").val();
		var total = $("#total_no").val();
		var jenis_transaksi = $("#jenis_transaksi").val();
		if (dibayar < 0) {
			alert('Pembayaran kurang dari 0 !');
			$("#bayar").val('');
			kembalian();
		}else if (dibayar == 0 || dibayar == '') {
			$("#kembalian").text('Rp 0');
			$("#rupiah_bayar").text('Rp 0');
		}else{
			$.ajax({
				type: 'POST',
				url: url,
				dataType:'json',
				data: {total:total,dibayar:dibayar},
				success: function(rupiah){
					if (jenis_transaksi == 'kredit') {
						$("#kemablian_text").text('Hutang');
						$("#kembalian").text(rupiah.hutang1);
						$("#kembalian2").val(rupiah.hutang2);
						$("#rupiah_bayar").text(rupiah.dibayar);
					}else{
						$("#kemablian_text").text('Kembalian');
						$("#kembalian").text(rupiah.kembalian1);
						$("#kembalian2").val(rupiah.kembalian2);
						$("#rupiah_bayar").text(rupiah.dibayar);
					}
				}
			});
		}

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
			simpan_transaksi();
		}

	}

	function simpan_transaksi() {
		var simpan_transaksi = "http://192.168.100.17/elladerma_kasir/reservasi/reservasi/simpan_transaksi";
		var kode_reservasi = $('#kode_reservasi').val() ;
		var total_pesanan = $("#total2").val();
		var persen = $("#persen").val();
		var rupiah = $("#rupiah").val();
		var grand_total = $("#total_no").val();
		var jenis_transaksi = $("#jenis_transaksi").val();
		var kembalian = $("#kembalian2").val();
		var bayar = $("#bayar").val();
		var kode_member = $("#kode_member").val();
		var kode_penjualan_baru = $("#kode_penjualan_baru").val();
		var nama_bank = $("#nama_bank").val();
		var nomor_debit = $("#nomor_debit").val();
		var kategori_diskon = $("#kategori_diskon").val();
		var kode_promo = $("#kode_promo").val();
		var kode_merchant = $("#kode_merchant").val();
		var kode_reservasi=$('#kode_reservasi').val();
		var kode_dokter=$('#kode_dokter').val();
		var kode_item=$('#kode_item').val();
		var tanggal_reservasi=$('#tanggal_reservasi').val();
		var kode_member=$('#kode_member').val();
		var kode_layanan=$('#kode_layanan').val();
		var jenis_reservasi=$('#jenis_reservasi').val();

		if(bayar==""){
			alert('Pembayaran masih kosong');
			$('#modal-confirm-bayar').modal('hide');
		}else if(jenis_transaksi == 'tunai' && parseInt(bayar) < parseInt(grand_total)){
			alert('Pembayaran Kurang !'); 
			$('#modal-confirm-bayar').modal('hide');
			$("#bayar").val('');
			kembalian();
		}else if(jenis_transaksi == 'debit' && nama_bank == ''){
			$('#modal-confirm-bayar').modal('hide');
			alert('Nama Bank harus Di isi!');
			$("#bayar").val('');
			kembalian();
		}else if(jenis_transaksi == 'debit' && (parseInt(bayar) < parseInt(grand_total) || parseInt(bayar) > parseInt(grand_total))){
			$('#modal-confirm-bayar').modal('hide');
			alert('Maaf Pembayaran Via Debit, Harus Sesuai Total pembayaran!');
			$("#bayar").val('');
			kembalian();
		}else{
			if(kode_member=="" && jenis_transaksi=="kredit"){
				alert('Pembayaran kredit hanya digunakan untuk member');
				$('#modal-confirm-bayar').modal('hide');
			}else if(jenis_transaksi=="kredit" && parseInt(bayar) >= parseInt(grand_total)){
				alert('Pembayaran kredit tidak boleh melebihi atau sama dengan total pembayaran !');
				$("#bayar").val('');
				kembalian();
				$('#modal-confirm-bayar').modal('hide');
			}else if(jenis_transaksi=="kredit" && parseInt(bayar) < 0){
				alert('Pembayaran kredit tidak boleh kurang dari 0 !');
				$('#modal-confirm-bayar').modal('hide');
				$("#bayar").val('');
				kembalian();
			}else{
				if (parseInt(persen) == '' && parseInt(rupiah) != '') {
					var persen = Math.round(rupiah/total_pesanan*100);
				}else if(parseInt(rupiah) == '' && parseInt(persen) != ''){
					var rupiah = Math.round((persen/100 )*total_pesanan);
				}
				$.ajax({
					type: "POST",
					url: simpan_transaksi,
					data: {
						kode_reservasi:kode_reservasi,
						kode_member:kode_member,
						kode_layanan:kode_layanan,
						nomor_debit:nomor_debit,nama_bank:nama_bank,bayar:bayar,kembalian:kembalian,
						total_pesanan:total_pesanan,persen:persen,rupiah:rupiah,grand_total:grand_total,jenis_transaksi:jenis_transaksi,
						kode_member:kode_member,kategori_diskon:kategori_diskon,kode_promo:kode_promo,kode_merchant:kode_merchant,jenis_reservasi:jenis_reservasi
					},
					beforeSend:function(){
						$(".tunggu").show();  
					},
					success: function(msg)
					{
						$(".tunggu").hide();
						var link = "http://192.168.100.17/elladerma_kasir/reservasi/reservasi/print_invoice";

						$.ajax({
							type: "POST",
							url: link,
							data:{kode_reservasi:kode_reservasi},
							success: function(msg)
							{
							}
						});  
						setTimeout(function(){$('.sukses').html(msg);
							window.location = "http://192.168.100.17/elladerma_kasir/kasir/list_transaksi_hari_ini";
						},1500);      
					}
				});
			}
		}
		return false;
	}

</script>
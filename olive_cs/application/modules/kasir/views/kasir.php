<!-- back button -->
<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="#">Kasir</a></li>
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
					<span class="pull-left" style="font-size: 24px"> Kasir</span>
					<br><br>
				</div>
				<div class="panel-body">
					<form >
						<td style="background-color:#229fcd;" width="10%">
							<div class="">
								<div class="">
									<span class="jenis_member">
										<center>
											<div id="nextstep" onclick="nextStep()" class="btn purple">NEXT</div>
											<div id="cancelstep" onclick="unblock()" class="btn red">CANCEL</div>
											<div id="profil_customer" onclick="profil_customer()" class="btn yellow">PROFIL CUSTOMER</div>
										</center>
									</span>
								</div>
							</div>
						</td>
						<td style="background-color:#229fcd;" width="10%" id="div-member">
							<div class="">
								<div class="">
									<span class="jenis_member">
										<center>
											<div id="daftar_member" onclick="joinmember()" class="join_member btn green">Join Member</div>
											<div id="batal_member" onclick="canceljoin()" class="batal_member btn yellow">Cancel Join</div>
										</center>
									</span>
								</div>
							</div>
						</td>
					</tr>
				</form>
			</tbody>
		</table>
		<div id="tabel1">
			<table id="" class="table table-striped table-bordered table-advance table-hover">
				<tbody>
					<form id="panelForm">
						<tr>

							<input type="text" name="id_penjualan" id="id_penjualan" value="" hidden/>
							<input type="hidden" name="id_temp" id="id_temp" value="" hidden/>
							<td width="250px" style="background-color:#229fcd;">
								<select required class="form-control select2" id="menu" name="menu">
									<option value="">--Pilih Produk--</option>
									<option value="PR0004" >PR0004 - acne lotion</option>
									<option value="PR0007" >PR0007 - air mawar</option>
									<option value="PR0003" >PR0003 - Demacolin</option>
									<option value="PR0005" >PR0005 - Masker Naturgo</option>
									<option value="PR0001" >PR0001 - Panadol</option>
									<option value="PR0002" >PR0002 - Pembersih Wajah</option>
									<option value="PR0006" >PR0006 - tes</option>
								</select> 
							</td>

							<td width="100px" style="background-color:#229fcd;">
								<input type="text" name="qty" id="qty" class="form-control" placeholder="jumlah" onClick="this.select();" onkeyup="jumlah_qty()" />
								<input type="hidden" id="kode_transaksi" value="KAS_20180209020522" />
								<input type="hidden" id="kode_kasir" value="KAS_20180209020522" />
								<input type="hidden" name="qty" id="qty2" class="form-control" placeholder="jumlah">
							</td>

							<!-- -------------------------------------------------------------------------------- -->
							<td width="200px" style="background-color:#229fcd;">
								<input readonly="true" type="text" name="harga" id="harga" class="form-control" placeholder="harga">

							</td>
							<td width="150px" style="background-color:#229fcd;">
								<select hidden name="jenis_diskon" id="jenis_diskon" class="form-control">
									<option value="persen" selected="true">Persen</option>
									<option value="rupiah">Rupiah</option>
								</select>
							</td>

							<td width="100px" style="background-color:#229fcd;">
								<div class="input-icon right" id="form_diskon_item">
									<i class="fa">%</i>
									<input type="text" name="diskon" onkeyup="diskonpersen_cek()" id="diskon_item"  class="form-control" placeholder="Diskon Persen" value="0">
								</div>
								<div class="input-icon right" id="form_diskon_rupiah">
									<i class="fa">Rp.</i>
									<input type="text" name="diskon_rupiah" onkeyup="diskonrupiah_cek()" id="diskon_rupiah"  class="form-control" placeholder=" Diskon Rupiah" value="0">
								</div>
								<input type="hidden" name="kode_edit_penjualan" id="kode_edit_penjualan" />
							</td>
							<td width="200px" style="background-color:#229fcd;" id="terapis">

								<select  name="kode_terapis" id="kode_terapis" class="form-control select2">
									<option value="" selected="true">--Terapis--</option>
								</select>

							</td>
							<td width="100px" style="background-color:#229fcd;" >
								<div id="add" onclick="simpan_pesanan_temp()" class="btn purple">Add</div>
								<div id="update" onclick="simpan_pesanan_temp()" class="btn purple">Update</div>
							</td>
						</tr>
					</form>
				</tbody>
			</table>
		</div>

	</div>

	<div class="col-md-4">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Data Rekam Medik
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
					<a href="javascript:;" class="reload">
					</a>

				</div>
			</div>
			<div class="portlet-body">
				<div class="box-body">                 
					<form id="data_form" action="" method="post">
						<div class="box-body">
							<div style="overflow-y:scroll;height:100px">
								<center><h4 id="nama_customer"></h4></center>
								<table id="tabel" class="table table-bordered table-striped" style="font-size:1.5em;">
									<thead>
										<tr>
											<th>Tanggal Transaksi</th>
											<th>Treatment / Produk</th>
											<th>Qty</th>
										</tr>
									</thead>
									<tbody id="data_rekam_medik">
									</tbody>
									<tfoot>

									</tfoot>
								</table>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-8" >
		<div class="tabel2">
			<table style="white-space: nowrap; font-size: 1.5em;" id="data" class="table table-bordered  table-hover">
				<thead>
					<tr>
						<th style="background-color:#229fcd; color:white" class="text-center" width="50px">No.</th>
						<th style="background-color:#229fcd; color:white" class="text-center">Nama Produk</th>

						<th style="background-color:#229fcd; color:white" class="text-center" width="50px">Qty</th>
						<th style="background-color:#229fcd; color:white" class="text-center" width="125px">Harga</th>
						<th style="background-color:#229fcd; color:white" class="text-center" width="100px">Diskon</th>
						<th style="background-color:#229fcd; color:white" class="text-center" width="125px">Subtotal</th>
						<th style="background-color:#229fcd; color:white" class="text-center" width="125px">Terapis</th>
						<th style="background-color:#229fcd; color:white" class="text-center" width="170px">Action</th>
					</tr>
				</thead>
				<tbody id="tb_pesan_temp">
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
				<tfoot>
				</tfoot>
			</table>
		</div>

		<!---tabel daftar member dan periksa -->
		<div id="tab_lain">
			<table style="white-space: nowrap; font-size: 1.5em;" id="data" class="table table-bordered  table-hover">
				<thead>
					<tr>
						<th style="background-color:#229fcd; color:white" class="text-center" width="50px">No.</th>
						<th style="background-color:#229fcd; color:white" class="text-center">Nama Item</th>
						<th style="background-color:#229fcd; color:white" class="text-center" width="125px">Harga</th>
					</tr>
				</thead>
				<tbody id="tb_lain_temp">
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
				<tfoot>
				</tfoot>
			</table>
		</div>
		<!-- -->

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

	<div  style="margin-top: 5px;"  class="col-md-4" id="tabel3">
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

</div>
<div class="row">

	<div class="col-md-12">
		<input type="hidden" id="id_meja" value="" />
		<input type="hidden" id="hasil_meja" />
	</div>
</div>

<div id="data_pengiriman" class="row" style=" margin-top: -10px;">
	<fieldset>
		<div class="col-md-4">
			<div class="form-group">
				<label>Nama Penerima</label>
				<input placeholder="Nama" type="text" class="form-control" id="penerima" />
			</div>

			<div class="form-group">
				<label>Jam Pengiriman</label>
				<input placeholder="Jam Pengiriman" type="text" class="form-control timepicker" id="jam_kirim" />
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label>No. Telp</label>
				<input placeholder="No. Telp" type="text" class="form-control" id="no_telp" />
			</div>

			<div class="form-group">
				<label>Tanggal Pengiriman</label>
				<input placeholder="Tanggal" type="date" class="form-control" id="tgl_kirim" value="2018-02-09"/>
			</div>

		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label>Alamat</label>
				<textarea id="alamat" class="form-control" placeholder="Alamat"></textarea>
			</div>
		</div>
	</fieldset>

</div>

<div class="row text-center" id="tabel4">
	<div id="rupiah_bayar" style="margin-top:20px;font-size:35px;width: 100%;text-align: center;" class="text-center">

	</div>
	<br>
	<div class="col-lg-12">
		<div class="col-lg-6">

			<a style="text-decoration: none;" onclick="delDataall()"  class="bg-red btn col-md-12">
				<center><span style="font-size:35px; font-weight: bold; "><i style="font-size: 35px;" class="fa fa-close"></i> Batal Transaksi</span></center>  
			</a>
		</div>
		<div class="col-lg-6">

			<a style="text-decoration: none;" onclick="bayar()"  class="bg-green btn col-md-12">
				<center><span style="font-size:35px; font-weight: bold; "><i style="font-size: 35px;" class="fa fa-money"></i> Bayar</span></center>  
			</a>
		</div>
	</div>
	<br>



</div>
</div>

<!-- /.row (main row) -->
</section><!-- /.content -->
</div>

</section><!-- /.content -->

</div><!-- /.content-wrapper -->

</div>
<!--  -->
</div>
</section><!-- /.Left col -->      



</div><!-- /.row (main row) -->
</section><!-- /.content -->

<div id="modal-confirm-bayar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi Pembayaran</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan dengan nominal pembayaran tersebut ?</span>
				<input id="no" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button id="tidak" class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button id="confirm_ya" onclick="bayar()" class="btn green">Ya</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-confirm-piutang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi Piutang</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Maaf Hutang Melebihi Batas Plafon Member Anda !</span>
				<input id="no" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button id="confirm_ya" data-dismiss="modal" class="btn green">Mengerti</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Kasir Manual -->

<div id="modal-kasir-manual" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;"><i class="fa fa-plus"></i> Tambah Item</h4>
			</div>
			<div class="modal-body">


				<label>Nama Produk</label>
				<select name="nama_produk" id="nama_produk_manual" class="form-control select2">
					<option value="" selected="true">Pilih</option>
					<option value="BB0001">Scrub Pemutih</option>
					<option value="BB0002">Cairian Gosok</option>
					<option value="BB0003">extract bengkoang</option>
					<option value="BB0004">tisu</option>
					<option value="BB0005">tisu glondong</option>
				</select>
				<br><br>
				<label>QTY</label>
				<input type="text" name="qty_manual" id="qty_manual" class="form-control">
				<br>
				<label>Harga</label>
				<input type="text" name="harga_manual" id="harga_manual" class="form-control">
				<input id="id-delete" type="hidden">

			</div>
			<div class="sukses_manual"></div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn red" data-dismiss="modal" aria-hidden="true">Batal</button>
				<button onclick="simpan_manual()" id="simpan-data-ya" class="btn green">Simpan</button>
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
				<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan menghapus pesanan tersebut ?</span>
				<input id="id-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button type="" class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button onclick="delData()" id="del-data-ya" class="btn green">Ya</button>
			</div>
		</div>
	</div>
</div>
<div id="modal-bataltransaksi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi Batal Transaksi</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan membatalkan pesanan tersebut ?</span>
				<input id="id-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button type="" class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button onclick="delDataall()" id="del-data-ya" class="btn green">Ya</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-nextstep" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan Data tersebut ?</span>
				<input id="id-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button type="" class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button onclick="block()" id="del-data-ya" class="btn green">Ya</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-daftarmember" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Apakah anda yakin mendaftarkan menjadi member ?</span>
				<input id="id-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button type="" class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button onclick="joinmember()" id="del-data-ya" class="btn green">Ya</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-batalmember" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan Membatalkan pendaftaran tersebut ?</span>
				<input id="id-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button type="" class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button onclick="canceljoin()" id="del-data-ya" class="btn green">Ya</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-cancelstep" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan Membatalkan Data tersebut ?</span>
				<input id="id-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button type="" class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button onclick="unblock()" id="del-data-ya" class="btn green">Ya</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-taking-order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Masukkan Nota Taking Order</h4>
			</div>
			<div class="modal-body">

				<input id="nota_to" placeholder="Nomor Nota" class="form-control" type="text" />
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn red" data-dismiss="modal" aria-hidden="true">Cancel</button>
				<button id="cari_to" class="btn green">OK</button>
			</div>
		</div>
	</div>
</div>
<div  id="modal-hapus-barang" class="modal fade" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div style="width: 400px;" class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Pilih Barang<br><sub>(tekan <b>SPASI</b> untuk menampilkan opsi penjualan)</sub></h4>
			</div>
			<div class="modal-body">
				<select class="form-control select2" id="barang_hapus">

				</select>
			</div>

		</div>
	</div>
</div>




<script>
	$("#terapis").hide();

	function setting() {
		$('#modal_setting').modal('show');
	}
	function batal_transaksi() {
		$('#modal-bataltransaksi').modal('show');
	}
	function kasir_manual() {
		$('#modal-kasir-manual').modal('show');
	}
	$("#modal-kasir-manual").on('shown.bs.modal', function () {
		$("#simpan-data-ya").focus();
	});
	function konfirm_bayar(){
		$("#modal-confirm-bayar").modal('show');
		$("#confirm_ya").focus();
	}
	$("#modal-confirm-bayar").on('shown.bs.modal', function () {
		$("#confirm_ya").focus();
	});

	function taking_order(){
		$('#modal-taking-order').modal('show');
		$("#nota_to").focus();
	}
	function removeTreatment(){
    // alert("removeTreatment");
    $(".formperawatan").removeClass( "hidden");
}

function removeProduk(){
    // alert("removeTreatment");
    $(".formproduk").removeClass( "hidden");
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

$("#jenis_diskon_apotek").change(function(){
	if($("#jenis_diskon_apotek").val()=='rupiah'){
		$("#form_diskon_rupiah_apotek").show();
		$("#form_diskon_item_apotek").hide();
		$("#diskon_item_apotek").val('0');

	} else {
		$("#form_diskon_rupiah_apotek").hide();
		$("#form_diskon_item_apotek").show();
		$("#diskon_rupiah_apotek").val('0');
	}
});


$("#jenis_diskon_perawatan").change(function(){
	if($("#jenis_diskon_perawatan").val()=='rupiah'){
		$("#form_diskon_rupiah_perawatan").show();
		$("#form_diskon_item_perawatan").hide();
		$("#diskon_item_perawatan").val('0');

	} else {
		$("#form_diskon_rupiah_perawatan").hide();
		$("#form_diskon_item_perawatan").show();
		$("#diskon_rupiah_perawatan").val('0');
	}
});

$("#jenis_diskon_produk").change(function(){
	if($("#jenis_diskon_perawatan_produk").val()=='rupiah'){
		$("#form_diskon_rupiah_produk").show();
		$("#form_diskon_item_produk").hide();
		$("#diskon_item_produk").val('0');

	} else {
		$("#form_diskon_rupiah_produk").hide();
		$("#form_diskon_item_produk").show();
		$("#diskon_rupiah_produk").val('0');
	}
});


</script>
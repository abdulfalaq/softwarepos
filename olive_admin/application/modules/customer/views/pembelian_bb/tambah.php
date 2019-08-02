<!-- back button -->
<a href="<?php echo base_url('pembelian'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>">Pembelian</a></li>
		<li><a href="#">Pembelian</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Pembelian </h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<form id="simpan_pembelian">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading text-right">
						<span class="pull-left" style="font-size: 24px">Tambah Pembelian </span>
						<a href="<?php echo base_url('pembelian/pembelian_bb/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Pembelian</a>
						<a href="<?php echo base_url('pembelian/pembelian_bb/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Pembelian</a>
					</div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3">
									<h5>Kode Transaksi</h5>
									<input type="text" id="kode_transaksi" name="kode_transaksi" class="form-control" readonly>
									<input type="hidden" id="kode_unit_jabung" name="kode_unit_jabung" class="form-control" readonly>
								</div>
								<div class="col-md-3">
									<h5>Tanggal Transaksi</h5>
									<input type="text" class="form-control" id="tgl_tr" name="tgl_tr" value="<?= TanggalIndo(date('Y-m-d')) ?>" readonly>
								</div>
								<div class="col-md-6">
									<h5>Nota Referensi</h5>
									<input type="text" class="form-control" id="nota" name="nota" placeholder="Nota Referensi">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h5>Petugas</h5>
									<input type="text" id="petugas" name="petugas"  class="form-control" readonly>
									<input type="hidden" id="kode_petugas" name="kode_petugas"  class="form-control" readonly>
								</div>
								<div class="col-md-6">
									<h5>Supplier</h5>
									<input type="text" id="supplier" name="supplier"  class="form-control" readonly>
									<input type="hidden" id="kode_supplier" name="kode_supplier"  class="form-control" readonly>
								</div>
							</div><br>

							<div class="row" id="row_edit" style="display: none">
								<form id="form_edit">
									<hr><br>
									<div class="col-md-3">
										<h5>Nama Produk</h5>
										<input type="text" id="nama_produk" name="nama_produk" class="form-control" readonly>
										<input type="hidden" id="id_temp" name="id_temp" class="form-control" readonly>
									</div>
									<div class="col-md-2">
										<h5>QTY PO</h5>
										<input type="text" id="qty_po" name="qty_po" class="form-control" readonly>
									</div>
									<div class="col-md-2">
										<h5>QTY Penerimaan</h5>
										<input type="text" id="qty" name="qty" onkeyup="nominal_qty()" class="form-control" >
									</div>
									<div class="col-md-2">
										<h5>Satuan</h5>
										<input type="text" id="satuan" name="satuan" class="form-control" readonly>
									</div>
									<div class="col-md-2">
										<h5>Harga Satuan</h5>
										<input type="number" id="harga_satuan" name="harga_satuan" onkeyup="nominal_satuan()" class="form-control">
									</div>
									<div class="col-md-1">
										<a type="submit" class="btn btn-no-radius btn-info btn-md" onclick="simpan_edit()" style="margin-top: 35px">Simpan</a>
									</div>
								</form>
							</div><br>
							<hr>

							<div id="load_table_produk"></div>

							<div class="row">
								<div class="col-md-3">
									<h5>Jenis Diskon</h5>
									<select name="jenis_diskon" class="form-control" onchange="jenis_diskon_change()" id="jenis_diskon">
										<option value="persen">Persen</option>
										<option value="rupiah">Rupiah</option>
									</select>
								</div>
								<div class="col-md-3 ppn">
									<h5>PPN</h5>
									<select name="jenis_ppn" class="form-control" onchange="jenis_ppn_change()" id="jenis_ppn" >
										<option value="non_ppn">Non PPN</option>
										<option value="ppn">PPN</option>
									</select>
								</div>
								<div class="col-md-3">
									<h5>Pembayaran</h5>
									<select name="jenis_pembayaran" class="form-control" onchange="jenis_pembayaran_change()" id="jenis_pembayaran">
										<option value="cash">Cash</option>
										<option value="kredit">Kredit</option>
									</select>
								</div>
								<div class="col-md-3 kredit" style="display: none">
									<h5>DP</h5>
									<select name="jenis_kredit" class="form-control" onchange="jenis_kredit_change()" id="jenis_kredit" >
										<option value="dp">DP</option>
										<option value="non_dp">Non DP</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div id="persen">
										<h5>Diskon (%)</h5>
										<input type="text" class="form-control" onkeyup="diskon_persen()" id="input_persen" name="input_persen" placeholder="Diskon %">
									</div>
									<div id="rupiah" style="display: none">
										<h5>Diskon (Rp)</h5>
										<input type="text" class="form-control" onkeyup="diskon_rupiah()" id="input_rupiah" name="input_rupiah" placeholder="Diskon Rp">
									</div>
									<input type="hidden" id="persen_jadi">
								</div>
								<div class="col-md-3 ppn" id="bayar_ppn" style="display: none">
									<h5>Bayar PPN</h5>
									<input type="text" class="form-control" id="bayar_ppn_input" name="bayar_ppn" onkeyup="nominal_ppn()" placeholder="PPN (%)">
									<div id="nominal_ppn"></div>
								</div>
								<div class="col-md-3 div-ppn">
								</div>
								<div class="col-md-3 kredit" style="display: none">
								</div>						
								<div class="col-md-3 kredit" id="bayar_dp" style="display: none">
									<h5>Bayar DP</h5>
									<input type="text" class="form-control" id="bayar_dp_input" name="bayar_dp" onkeyup="nominal_dp()" placeholder="Bayar">
									<div id="nominal_dp"></div>
								</div>
							</div><br><br><br>
							<div id="box_tempo" class="kredit" style="display: none">
								<div id="data_propose_planting">
									<div class="row">
										<input type="hidden" class="jumlah" name="jumlah" value="1"/>
										<div class="parent">
											<div class="master_clone">
												<div class="sukses"></div>
												<div class="col-xs-12"> 
													<div class="row" style="margin-bottom:20px;"> 
														<div class="col-md-2"> 
															<label>Jatuh Tempo</label>
															<input type="date" name="jatuh_tempo[]" class="form-control kosong" placeholder="Name" required/>
														</div>
														<div class="col-md-3">
															<label>Jumlah Angsuran</label>
															<input type="text" name="angsuran[]" class="form-control kosong" placeholder="Angsuran" required/>
														</div>
														<div class="col-md-1"> 
															<button type="button" style="margin-top:28px;" class="btn btn-primary btn-block btn-clone" onclick="clone_grow('propose_planting')">
																<i class="fa fa-plus" aria-hidden="true"></i>
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<hr>	
							<div class="row" style="margin-top:20px;">
								<a class="btn btn-info btn-lg btn-no-radius pull-right" onclick="$('#modal-confirm').modal('show')"><i class="fa fa-send"></i> Simpan</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<div id="modal-kode-tr" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content" style="border-radius: 0;">
			<div class="modal-header" style="background-color: #0c7a23;color:white;border-bottom: 4px solid #fb8302;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Transaksi Pembelian</h4>
			</div>
			<div class="modal-body">
				<h5>Kode PO</h5>
				<select name="kode_po" class="form-control select2" id="kode_po">
					<option value="">-- Pilih Kode PO</option>
					<?php
					$get_unit = $this->db->get('setting')->row();
					$this->db->from('kan_suol.transaksi_po');
					$this->db->where('MONTH(kan_suol.transaksi_po.tanggal_input)', date('m'));
					$this->db->where('kan_suol.transaksi_po.status', 'valid');
					$this->db->where('kan_master.master_supplier.kode_unit_jabung',$get_unit->kode_unit);
					$this->db->join('kan_master.master_supplier', 'kan_suol.transaksi_po.kode_supplier = kan_master.master_supplier.kode_supplier'); 
					$get_tr = $this->db->get()->result();
					foreach ($get_tr as $value) { ?>
					<option value="<?php echo $value->kode_po ?>"><?php echo $value->kode_po ?> - <?php echo $value->nama_supplier ?></option>
					<?php }
					?>
				</select>
				<input type="hidden" id="kode_po_encript" value="">
			</div>
			<div class="modal-footer">
				<a href="<?= base_url('pembelian/pembelian_bb') ?>" class="btn btn-danger btn-no-radius btn-md" >Cancel</a>
				<a class="btn btn-info btn-no-radius btn-info btn-md" onclick="cari_transaksi_po()" >Cari</a>
			</div>
		</div>
	</div>
</div>

<div id="modal-confirm" class="modal fade" tabindex="-1" role="dialog" >
	<div class="modal-dialog">
		<div class="modal-content" style="border-radius: 0;">
			<div class="modal-header" style="background-color: #0c7a23;color:white;border-bottom: 4px solid #fb8302;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Confirmasi</h4>
			</div>
			<div class="modal-body">
				<h3>Apakah anda yakin ingin menyimpan data tersebut ?</h3>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-no-radius btn-md" data-dismiss="modal">Cancel</button>
				<a class="btn btn-info btn-no-radius btn-info btn-md" onclick="simpan_transaksi()" >Yakin</a>
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
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#modal-kode-tr').modal('show');
	$('#modal-kode-tr').modal({backdrop: 'static', keyboard: false})  
	$('.select2').select2();
});

function hapus(key) {
	$('#modal-hapus').modal('show');
}

function cari_transaksi_po(){
	kode_po = $('#kode_po').val();
	if (kode_po != '') {
		$.ajax({
			url: '<?php echo base_url('pembelian/pembelian_bb/get_transaksi_po'); ?>',
			type: 'post',
			data:{kode_po:kode_po},
			dataType:'Json',
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(response){
				$(".tunggu").hide();
				$('#modal-kode-tr').modal('hide');
				$('#kode_transaksi').val(response.kode_po);
				$('#petugas').val(response.nama_petugas);
				$('#kode_petugas').val(response.kode_petugas);
				$('#supplier').val(response.nama_supplier);
				$('#kode_supplier').val(response.kode_supplier);
				$('#kode_unit_jabung').val(response.kode_unit_jabung);
				$('#kode_po_encript').val(response.kode_po_encript);
				load_table_produk(response.kode_po);
			}
		});
	}
}

function load_table_produk(obj){
	var kode_po_encript=$('#kode_po_encript').val();
	$('#load_table_produk').load('<?php echo base_url() ?>pembelian/pembelian_bb/get_table_produk/'+kode_po_encript)
}

function edit_row(key){
	$.ajax({
		url: '<?php echo base_url('pembelian/pembelian_bb/get_edit_data'); ?>',
		type: 'post',
		data:{id:key},
		dataType:'Json',
		success: function(response){
			$("#row_edit").fadeIn('fast');
			$('#nama_produk').val(response.nama_bahan_baku);
			$('#qty_po').val(response.qty_po);
			$('#qty').val(response.qty);
			$('#satuan').val(response.nama);
			$('#harga_satuan').val(response.harga_satuan);
			$('#id_temp').val(response.id_temp);
		}
	});
}

function nominal_qty(){
	qty = $('#qty').val();
	if(parseInt(qty) < 0 || qty=='-'){
		alert("Cek Kembali Inputan QTY Penerimaan.");
		$('#qty').val('');
	}else{
		$('#qty').html(qty);
	}
}

function simpan_edit() {
	var nama_produk = $('#nama_produk').val();
	var qty_po 		= $('#qty_po').val();
	var qty 		= $('#qty').val();
	var satuan 		= $('#satuan').val();
	var harga_satuan= $('#harga_satuan').val();
	var id_temp 	= $('#id_temp').val();
	var kode_po 	= $('#kode_po').val();

	if (parseInt(qty) > parseInt(qty_po)) {
		alert('Cek Kembali Inputan QTY Penerimaan.');
	} else {
		$.ajax({
			url: '<?php echo base_url('pembelian/pembelian_bb/simpan_edit_temp'); ?>',
			type: 'post',
			data:{nama_produk:nama_produk,qty_po:qty_po,qty:qty,satuan:satuan,harga_satuan:harga_satuan,id_temp:id_temp},
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(hasil){
				$("#row_edit").hide();
				$(".tunggu").hide();
				$('#qty').val();
				load_table_produk(kode_po);				
			}
		});

		return false;
	}

}

function jenis_diskon_change(){
	jenis_diskon = $('#jenis_diskon').val();
	if (jenis_diskon == 'rupiah') {
		$('#rupiah').show();
		$('#persen').hide();
		$('#input_rupiah').val('');
		$('#input_persen').val('');
		diskon_persen()
		diskon_rupiah()
	}else if(jenis_diskon == 'persen'){
		$('#persen').show();
		$('#rupiah').hide();
		$('#input_rupiah').val('');
		$('#input_persen').val('');
		diskon_persen()
		diskon_rupiah()
	}else{
		$('#persen').show();
		$('#rupiah').hide();
		$('#input_rupiah').val('');
		$('#input_persen').val('');
		diskon_persen()
		diskon_rupiah()
	}
}

function nominal_satuan(){
	harga_satuan = $('#harga_satuan').val();
	if (harga_satuan < 0) {
		alert('Harga Satuan Tidak Boleh Kurang Dari 0');
		$('#harga_satuan').val('');
	}
}

function jenis_pembayaran_change(){
	jenis_pembayaran = $('#jenis_pembayaran').val();
	if (jenis_pembayaran == 'kredit') {
		$('.kredit').show();
	}else{
		$('.kredit').hide();
	}
}

function jenis_ppn_change(){
	jenis_ppn = $('#jenis_ppn').val();
	if (jenis_ppn == 'ppn') {
		$('#bayar_ppn').show();
		$('.div-ppn').hide();
	}else{
		$('#bayar_ppn').hide();
		$('.div-ppn').show();
	}
}

function jenis_kredit_change(){
	jenis_kredit = $('#jenis_kredit').val();
	if (jenis_kredit == 'non_dp') {
		$('#bayar_dp').hide();
	}else{
		$('#bayar_dp').show();
	}
}

function diskon_persen(){
	input_persen = $('#input_persen').val();
	subtotal 	 = $('#subtotal').val();
	grand_total  = $('#grand_total').val();

	if (input_persen <= 100 && input_persen >= 0) {
		diskon = (input_persen / 100 ) * subtotal;
		hasil_diskon = subtotal - diskon;
		$('#grand_total_text').text(toRp(hasil_diskon));
		$('#grand_total').val(hasil_diskon);
		$('#diskon_persen_col_text').text(input_persen+' %');
		$('#diskon_persen_col').val('');
		$('#diskon_rupiah_col').val(diskon);
		$('#diskon_rupiah_col_text').text(toRp(diskon));
		$('#diskon_rupiah_col').val('');
		$('#diskon_rupiah_col_text').text(toRp('0'));
	}else{
		$('#grand_total_text').text(toRp(subtotal));
		$('#grand_total').val(subtotal);
		$('#input_persen').val('0');
		$('#diskon_persen_col_text').text(' %');
		$('#diskon_persen_col').val('');
	}
}

function diskon_rupiah(){
	input_rupiah = $('#input_rupiah').val();
	subtotal 	 = $('#subtotal').val();
	grand_total  = $('#grand_total').val();

	if (parseInt(input_rupiah) <= parseInt(subtotal) && parseInt(input_rupiah) >= 0 && parseInt(input_rupiah) != '') {
		hasil_diskon = parseInt(subtotal) - parseInt(input_rupiah);
		hasil_diskon_persen = (parseInt(input_rupiah)/parseInt(subtotal))*100
		$('#grand_total_text').text(toRp(hasil_diskon));
		$('#grand_total').val(hasil_diskon);
		$('#diskon_rupiah_col').val(hasil_diskon);
		$('#diskon_rupiah_col_text').text(toRp(input_rupiah));
		$('#diskon_persen_col_text').text(hasil_diskon_persen.toFixed(0)+' %');
		$('#diskon_persen_col').val('');
	}else{
		$('#grand_total_text').text(toRp(subtotal));
		$('#grand_total').val(subtotal);
		$('#input_rupiah').val('');
		$('#diskon_rupiah_col').val('');
		$('#diskon_rupiah_col_text').text(toRp('0'));
		$('#diskon_persen_col_text').text(' %');
		$('#diskon_persen_col').val('');
	}
}

function nominal_ppn(){
	input_persen = $('#input_persen').val();
	input_rupiah = $('#input_rupiah').val();
	bayar_ppn 	 = $('#bayar_ppn_input').val();
	subtotal 	 = $('#subtotal').val();
	grand_total  = $('#grand_total').val();

	if(parseInt(bayar_ppn) < 0 || bayar_ppn=='-' || parseInt(bayar_ppn) > 100){
		alert("Nominal PPN Salah ..!");
		$('#bayar_ppn_input').val('');
	}else{
		$('#bayar_ppn_input').html(bayar_ppn);

		jenis_diskon = $('#jenis_diskon').val();
		if (jenis_diskon == 'persen') {
			diskon = (input_persen / 100 ) * subtotal;
			hasil_diskon = subtotal - diskon;
			ppn = (bayar_ppn / 100 ) * parseInt(hasil_diskon);
			hasil_ppn = (parseInt(hasil_diskon) + parseInt(ppn));
		}else{
			hasil_diskon = parseInt(subtotal) - parseInt(input_rupiah);
			ppn = (bayar_ppn / 100 ) * parseInt(hasil_diskon);
			hasil_ppn = (parseInt(hasil_diskon) + parseInt(ppn));
		}

		$('#grand_total_text').text(toRp(hasil_ppn));
		$('#grand_total').val(hasil_ppn);
		$('#diskon_ppn_col_text').text(bayar_ppn+' %');
		$('#diskon_ppn_col').val('');
	}
}

function nominal_dp(){
	bayar_dp 	= $('#bayar_dp_input').val();
	grand_total = $('#grand_total').val();
	if(parseInt(bayar_dp) < 0 || bayar_dp=='-'){
		alert("Nominal DP Salah ..!");
		$('#bayar_dp_input').val('');
	}else{
		if (parseInt(bayar_dp) > parseInt(grand_total)) {
			alert('Pembayaran DP Melebihi Total yang Harus di bayar.')
			$('#bayar_dp_input').val('');
		}else{
			$('#nominal_dp').html(toRp(bayar_dp));
		}
	}
}
function toRp(angka){
	var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
	var rev2    = '';
	for(var i = 0; i < rev.length; i++){
		rev2  += rev[i];
		if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
			rev2 += '.';
		}
	}
	return 'Rp. ' + rev2.split('').reverse().join('') + ',00';
}

function simpan_transaksi(){
	kode_transaksi 		= $('#kode_transaksi').val();
	kode_po 			= $('#kode_po').val();
	input_rupiah 		= $('#input_rupiah').val();
	nota 				= $('#nota').val();
	kode_supplier 		= $('#kode_supplier').val();
	jenis_diskon 		= $('#jenis_diskon').val();
	subtotal 			= $('#subtotal').val();
	diskon_persen_col 	= $('#diskon_persen_col').val();
	diskon_rupiah_col 	= $('#diskon_rupiah_col').val();
	diskon_ppn_col 	    = $('#diskon_ppn_col').val();
	grand_total 		= $('#grand_total').val();
	jenis_pembayaran 	= $('#jenis_pembayaran').val();
	jenis_kredit 		= $('#jenis_kredit').val();
	jenis_ppn 		    = $('#jenis_ppn').val();
	input_persen 		= $('#input_persen').val();
	jatuh_tempo 		= $('#jatuh_tempo').val();
	bayar_dp 			= $('#bayar_dp_input').val();
	bayar_ppn 			= $('#bayar_ppn_input').val();
	kode_petugas 		= $('#kode_petugas').val();
	if (nota != '') {
		$.ajax({
			url: '<?php echo base_url('pembelian/pembelian_bb/cek_nota'); ?>',
			type: 'post',
			data:{nota:nota},
			dataType:'Json',
			success: function(hasil){
				if (hasil.cek_nota == 'sudah_ada') {
					alert('No Nota Sudah Ada.')
				}else{
					if (jenis_kredit == 'dp' && parseInt(bayar_dp) > parseInt(grand_total) && parseInt(bayar_dp) <= 0) {
						alert('Pembayaran DP Salah.');
					}else{
						$.ajax({
							url: '<?php echo base_url('pembelian/pembelian_bb/simpan_pembelian'); ?>',
							type: 'post',
							data:$('#simpan_pembelian').serialize()+ '&kode_po=' + kode_po,
							beforeSend:function(){
								$(".tunggu").show();
							},
							success: function(hasil){
								$(".tunggu").hide();
								if (hasil == 'angsuran_melebihi') {
									$("#modal-confirm").modal('hide');
									alert('Jumlah Angsuran Melebihi Grand Total');
								}else{
									$(".alert_berhasil").show();
									$("#modal-confirm").modal('hide');
									setTimeout(function(){
										window.location="<?php echo base_url('pembelian/pembelian_bb/daftar');?>";
									},1500);
								}
							}
						});
					}
				}
			},
		});			
}else{
	alert('Harap Mengisi Nomor Nota');
}
return false;


}

</script>

<script>
function clone_grow(obj){
	form_id = $('#data_'+obj);

	jumlah = form_id.find('.jumlah');
	parent = form_id.find('.parent');
	tiruan = form_id.find('.master_clone').clone();
	button_clone = tiruan.find('.btn-clone');
	icon_button = button_clone.find('i');

	get_jumlah = parseInt(jumlah.val());
	jumlah.val(Math.round(get_jumlah + 1));

	tiruan.find('.kosong').each(function() {
		this.value= '';
	});
	tiruan.addClass('form-clone');
	tiruan.removeClass('master_clone');
	button_clone.attr('class','btn btn-danger btn-block');
	button_clone.attr('onclick','remove_clone(this)');
	icon_button.attr('class','fa fa-trash');

	parent.append(tiruan);

	$('input').focus(function(){
		hide_home_back();
	});
	$('input').blur(function(){
		show_home_back();
	});
	$('select').focus(function(){
		hide_home_back();
	});
	$('select').blur(function(){
		show_home_back();
	});
	$('textarea').focus(function(){
		hide_home_back();
	});
	$('textarea').blur(function(){
		show_home_back();
	});
}
function remove_clone(obj){
	jumlah = $(obj).parent().parent().parent().prev('input');
	clone = $(obj).parent().parent();
	garis = clone.prev('div');

	get_jumlah = parseInt(jumlah.val());
	jumlah.val(Math.round(get_jumlah - 1));

	garis.remove();
	clone.remove();
}
</script>
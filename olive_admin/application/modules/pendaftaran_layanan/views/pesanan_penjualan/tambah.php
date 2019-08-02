<style>
.padding_min {
	padding: 2px !important;
}

.box-tag {
	background-color: grey;
	color:white;
	font-family: segoe ui;
}
</style>
<a href="<?php echo base_url('penjualan'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
		<li><a href="#">Pesanan Penjualan</a></li>
		<li></li>
	</ol>
</div>
<?php
$get_setting=$this->db->get('setting');
$hasil_setting=$get_setting->row();
$kode_unit_jabung=@$hasil_setting->kode_unit;
?>
<div class="clearfix"></div>

<div class="container">
	<h1>Pesanan Penjualan </h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Pesanan Penjualan </span>
					<a href="<?php echo base_url('penjualan/pesanan_penjualan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Pesanan Penjualan</a>
					<a href="<?php echo base_url('penjualan/pesanan_penjualan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Pesanan Penjualan</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						
						<div class="row">
							<div class="col-md-8">
								<div class="row" style="background-color:white;padding: 10px;">
									<div class="col-md-4 padding_min">
										<input type="hidden" name="kode_pesanan" id="kode_pesanan" value="<?php echo 'PSN_'.date('ymdHis')?>">
										<select name="" id="pilih_member" onchange="select_member()" class="form-control select2">
											<option value="">- Pilih Member</option>
											<?php
											$this->db_master->where('kode_unit_jabung', $kode_unit_jabung);
											$get_member=$this->db_master->get('master_member');
											$hasil_member=$get_member->result();
											foreach ($hasil_member as $member) { ?>
											<option value="<?php echo @$member->kode_member;?>"><?php echo @$member->nama_pic.' - '.@$member->nama_perusahaan;?></option>
											<?php
										} ?>
									</select>
								</div>
								<div class="col-md-4 padding_min">
									<input type="text" class="form-control" placeholder="Nama" id="nama_member" readonly>
								</div>
								<div class="col-md-3 padding_min">
									<input type="text" class="form-control" placeholder="Kode Member" id="kode_member" readonly>
								</div>

								<div class="col-md-1 padding_min">
									<button onclick="lock_member()" id="lock_member" class="btn btn-warning btn-no-radius btn-md">LOCK </button>
									<button onclick="unlock_member()" style="display: none" id="cancel_member" class="btn btn-danger btn-no-radius btn-md">CANCEL </button>
								</div>
							</div>
							<div id="sukses"></div>
							<div class="row" style="background-color:white;padding: 10px;">
								<input type="hidden" id="id_opsi">
								<div class="col-md-3 padding_min">
									<select name="kode_produk" id="kode_produk" onchange="select_produk()" disabled class="form-control select2">
										<option value="">-- Pilih Produk</option>
										<?php 
										$get_produk = $this->db_master->get('master_produk')->result();
										foreach ($get_produk as $value) { ?>
										<option value="<?= $value->kode_produk ?>"><?= $value->nama_produk ?></option>
										<?php }
										?>
									</select>
								</div>
								<div class="col-md-1 padding_min">
									<input type="text" id="qty" class="form-control" readonly placeholder="QTY">
								</div>
								<div class="col-md-3 padding_min">
									<input type="text" id="harga" class="form-control" readonly placeholder="Harga">
									<input type="hidden" id="kode_satuan" >
								</div>
								<div class="col-md-1 padding_min">
									<select name="jenis_diskon" id="jenis_diskon" disabled onchange="change_diskon()" class="form-control">
										<option value="persen">%</option>
										<option value="rupiah">Rp</option>
									</select>
								</div>
								<div class="col-md-2 padding_min">
									<input type="text" readonly id="diskon_persen" class="form-control"  onkeyup="cek_persen()" placeholder="Persen">
									<input type="text" readonly style="display: none" id="diskon_rupiah" onkeyup="cek_rupiah()" class="form-control" placeholder="Rupiah">
								</div>
								<div class="col-md-2 padding_min">
									<input type="date" readonly id="tanggal_expired" class="form-control"  placeholder="Persen">
									
								</div>
								<div class="col-md-2 padding_min pull-right">
									<button disabled id="add_btn" onclick="add_item()" class="btn btn-info btn-no-radius btn-md pull-right btn-add"><i class="fa fa-plus"></i> Add</button>
									<button onclick="update_item()" class="btn btn-info btn-no-radius btn-md pull-right btn-update"><i class="fa fa-save"></i> Update</button>
								</div>
							</div>
							<div class="row" style="background-color:white;padding: 10px;">
								<div class="col-md-12 padding_min">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>No.</th>
												<th>Nama Produk</th>
												<th>QTY</th>
												<th>Harga</th>
												<th>Subtotal</th>
												<th>Diskon</th>
												<th>Expired Date</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody id="opsi_temp">
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12">
									<div class="box-tag" style="background-color: #c49f47;height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px; margin-top: 10px;">
										<span style="font-size:22px; " class="pull-right" id="text_total_pesanan"> Rp. 0,0</span>

										<p style="font-size: 18px;">Total Pesanan</p>
									</div>
									<input type="hidden" name="total_pesanan" id="total_pesanan" value="">
								</div>
							</div>							
						</div>
						<div class="row"><br>
							<div class="col-md-12">
								<button onclick="confrim_bayar()" class="btn btn-info btn-no-radius btn-block btn-lg">Simpan</button>
							</div>
						</div>
					</div>						
				</div>
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
				<input type="hidden" id="id_temp">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-danger" onclick="hapus_temp()"><i class="fa fa-trash"></i> Hapus Data</button>
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


<script type="text/javascript">
	function hapus(key) {
		$('#modal-hapus').modal('show');
	}
</script>

<script>
	$(document).ready(function() {
		$('.btn-update').hide();
		
	});
	function change_diskon(){
		jenis_diskon = $('#jenis_diskon').val()
		
		if (jenis_diskon == 'persen') {
			$('#diskon_persen').show();
			$('#diskon_rupiah').hide();
		}else{
			$('#diskon_persen').hide();
			$('#diskon_rupiah').show();
		}
		
	}

	function cek_persen(){
		diskon_persen = $('#diskon_persen').val();
		if (parseInt(diskon_persen) < 0 || parseInt(diskon_persen) > 100) {
			alert('Salah Mengisi Diskon');
			$('#diskon_persen').val('');
		}
	}
	function cek_rupiah(){
		diskon = $('#diskon_rupiah').val();
		if (parseInt(diskon) < 0 ) {
			alert('Pengisian Diskon Salah.');
			$('#diskon_rupiah').val('');
		}
	}

	function select_member(){
		var member = $('#pilih_member').val();
		$.ajax({
			url: '<?php echo base_url('penjualan/pesanan_penjualan/get_data_member'); ?>',
			type: 'post',
			data:{kode_member:member},
			dataType:'Json',
			success: function(response){
				$('#nama_member').val(response.nama_pic);
				$('#kode_member').val(response.kode_member);
			}
		});
	}
	function select_produk(){
		var kode_produk = $('#kode_produk').val();
		var kode_member = $('#kode_member').val();
		$.ajax({
			url: '<?php echo base_url('penjualan/pesanan_penjualan/get_data_produk'); ?>',
			type: 'post',
			data:{kode_produk:kode_produk,kode_member:kode_member},
			dataType:'Json',
			success: function(response){
				$('#harga').val(response.harga);
				$('#kode_satuan').val(response.kode_satuan);
			}
		});
	}

	function lock_member(){
		member = $('#pilih_member').val();
		if (member != '') {
			$('#kode_produk').attr('disabled',false);
			$('#qty').attr('readonly',false);
			$('#diskon_persen').attr('readonly',false);
			$('#diskon_rupiah').attr('readonly',false);
			$('#add_btn').attr('disabled',false);
			$('#jenis_transaksi').attr('disabled',false);
			$('#jenis_diskon').attr('disabled',false);
			$('#tanggal_expired').attr('readonly',false);

			$('#pilih_member').attr('disabled',true);
			$('#lock_member').hide();
			$('#cancel_member').show();
		}else{
			alert('Pilih Member !');
		}
	}
	function unlock_member(){
		
		$('#kode_produk').attr('disabled',true);
		$('#qty').attr('readonly',true);
		$('#diskon_persen').attr('readonly',true);
		$('#diskon_rupiah').attr('readonly',true);
		$('#add_btn').attr('disabled',true);
		$('#jenis_transaksi').attr('disabled',true);
		$('#jenis_diskon').attr('disabled',true);
		$('#tanggal_expired').attr('readonly',true);

		$('#pilih_member').attr('disabled',false);
		$('#lock_member').show();
		$('#cancel_member').hide();
		kode_penjualan = $('#kode_penjualan').val();

		$.ajax({
			url: '<?php echo base_url('penjualan/pesanan_penjualan/delete_all_temp'); ?>',
			type: 'post',
			data:{kode_penjualan:kode_penjualan},
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(response){
				load_temp();
				$(".tunggu").hide();

			}
		});
		
	}
	function load_temp(){
		kode_pesanan = $('#kode_pesanan').val();
		$('#opsi_temp').load("<?php echo base_url('penjualan/pesanan_penjualan/tabel_temp').'/';?>"+kode_pesanan);
		get_total_penjualan();
	}
	function add_item(){
		kode_pesanan = $('#kode_pesanan').val();
		kode_produk = $('#kode_produk').val();
		qty = $('#qty').val();
		kode_satuan = $('#kode_satuan').val();
		harga = $('#harga').val();
		jenis_diskon = $('#jenis_diskon').val();
		diskon_persen = $('#diskon_persen').val();
		diskon_rupiah = $('#diskon_rupiah').val();
		tanggal_expired = $('#tanggal_expired').val();
		
		if(kode_produk=='' || qty=='' || kode_satuan=='' || harga=='' || jenis_diskon=='' || tanggal_expired=='' ){
			alert('Silahkan Lengkapi From !');
		}else if(parseInt(qty) < 0){
			alert('QTY Salah !');
		}
		else{
			$.ajax({
				url: '<?php echo base_url('penjualan/pesanan_penjualan/add_item'); ?>',
				type: 'post',
				data:{
					kode_pesanan:kode_pesanan,
					kode_produk:kode_produk,
					qty:qty,
					kode_satuan:kode_satuan,
					harga:harga,
					jenis_diskon:jenis_diskon,
					diskon_persen:diskon_persen,
					diskon_rupiah:diskon_rupiah,
					tanggal_expired:tanggal_expired,
					
				},
				dataType:'Json',
				success: function(msg){
					if(msg.respon=='gagal'){
						$('#sukses').html("<div class='alert alert-danger'>Stok Tidak Mencukupi</div>");
						setTimeout(function(){$('#sukses').html('');},1500);  
					}else if(msg.respon=='produk_tersedia'){
						$('#sukses').html("<div class='alert alert-warning'>Produk Telah Tersedia</div>");
						setTimeout(function(){$('#sukses').html('');},1500);  
					}else{
						$('#kode_produk').val('').trigger('change');
						$('#qty').val('');
						$('#kode_satuan').val('');
						$('#harga').val('');
						$('#diskon_persen').val('');
						$('#diskon_rupiah').val('');
						$('#tanggal_expired').val('');
						load_temp();
					}
				}
			});
		}
		
	}

	function actEdit(id){
		$.ajax({
			url: '<?php echo base_url('penjualan/pesanan_penjualan/get_data_temp'); ?>',
			type: 'post',
			data:{id:id},
			dataType:'json',
			success: function(response){
				$('#kode_produk').val(response.kode_produk).trigger('change');
				$('#qty').val(response.jumlah);
				$('#kode_satuan').val(response.kode_satuan);
				$('#harga').val(response.harga_satuan);
				$('#diskon_persen').val(response.diskon_persen);
				$('#diskon_rupiah').val(response.diskon_rupiah);
				$('#tanggal_expired').val(response.tanggal_expired);
				$('#diskon_peritem').val(response.jenis_diskon);
				$('#id_opsi').val(response.id_temp);
				$('.btn-add').hide();
				$('.btn-update').show();
			}
		});
	}
	function update_item(){
		id_opsi = $('#id_opsi').val();
		kode_pesanan = $('#kode_pesanan').val();
		kode_produk = $('#kode_produk').val();
		qty = $('#qty').val();
		kode_satuan = $('#kode_satuan').val();
		harga = $('#harga').val();
		jenis_diskon = $('#jenis_diskon').val();
		diskon_persen = $('#diskon_persen').val();
		diskon_rupiah = $('#diskon_rupiah').val();
		tanggal_expired = $('#tanggal_expired').val();
		
		if(kode_produk=='' || qty=='' || kode_satuan=='' || harga=='' || jenis_diskon=='' || tanggal_expired=='' ){
			alert('Silahkan Lengkapi From !');
		}else if(parseInt(qty) < 0){
			alert('QTY Salah !');
		}
		else{
			$.ajax({
				url: '<?php echo base_url('penjualan/pesanan_penjualan/update_item'); ?>',
				type: 'post',
				data:{
					id_opsi:id_opsi,
					kode_pesanan:kode_pesanan,
					kode_produk:kode_produk,
					qty:qty,
					kode_satuan:kode_satuan,
					harga:harga,
					jenis_diskon:jenis_diskon,
					diskon_persen:diskon_persen,
					diskon_rupiah:diskon_rupiah,
					tanggal_expired:tanggal_expired,
					
				},
				dataType:'Json',
				success: function(msg){
					if(msg.respon=='gagal'){
						$('#sukses').html("<div class='alert alert-danger'>Stok Tidak Mencukupi</div>");
						setTimeout(function(){$('#sukses').html('');},1500);  
					}else if(msg.respon=='produk_tersedia'){
						$('#sukses').html("<div class='alert alert-warning'>Produk Telah Tersedia</div>");
						setTimeout(function(){$('#sukses').html('');},1500);  
					}else{
						$('#kode_produk').val('').trigger('change');
						$('#qty').val('');
						$('#kode_satuan').val('');
						$('#harga').val('');
						$('#diskon_persen').val('');
						$('#diskon_rupiah').val('');
						$('#tanggal_expired').val('');
						$('#id_opsi').val('');
						$('.btn-add').show();
						$('.btn-update').hide();
						load_temp();
					}
				}
			});
		}
		
	}

	function actDelete(id){
		$('#modal-hapus').modal('show');
		$('#id_temp').val(id);
	}
	
	function hapus_temp(){
		var id=$('#id_temp').val();
		$.ajax({
			url: '<?php echo base_url('penjualan/pesanan_penjualan/delete_temp'); ?>',
			type: 'post',
			data:{id:id},

			success: function(response){
				$('#modal-hapus').modal('hide');
				load_temp();

			}
		});
	}
	function get_total_penjualan(){
		var kode_penjualan=$('#kode_penjualan').val();
		var ongkir=$('#ongkir').val();
		$.ajax({
			url: '<?php echo base_url('penjualan/pesanan_penjualan/get_total_penjualan'); ?>',
			type: 'post',
			data:{kode_penjualan:kode_penjualan},
			dataType:'json',
			success: function(hasil){
				$('#total_pesanan').val(hasil.subtotal);
				$('#text_total_pesanan').html(toRp(hasil.subtotal));
				
			}
		});

	}
	function confrim_bayar(){
		total_pesanan 		= $('#total_pesanan').val();
		if(parseInt(total_pesanan) <=0 ||  total_pesanan==''){
			alert('Pesanan Penjualan Kosong !');
		}else{
			$('#modal-confirm').modal('show');
		}
	}
	function simpan_transaksi(){
		kode_pesanan = $('#kode_pesanan').val();		
		total_pesanan = $('#total_pesanan').val();		
		kode_member = $('#kode_member').val();		
		$.ajax({
			url: '<?php echo base_url('penjualan/pesanan_penjualan/simpan_transaksi'); ?>',
			type: 'post',
			data:{
				kode_pesanan:kode_pesanan,
				kode_member:kode_member,
				total_pesanan:total_pesanan
			},
			beforeSend:function(){
				$(".tunggu").show();
				$("#modal-confirm").modal('hide');
			},
			success: function(msg){
				$(".tunggu").hide();
				$(".alert_berhasil").show();
				
				setTimeout(function(){
					window.location="<?php echo base_url('penjualan/pesanan_penjualan/tambah');?>";
				},1500);
			}
		});
		
	}
	function toRp(angka){
		if(angka=='' || parseInt(angka) < 0 || angka==null){
			return 'Rp. 0';
		}else{
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
		
	}
</script>
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
		<li><a href="#">POS</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>POS </h1>

	<?php $this->load->view('menu_master'); ?>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail POS </span>
					<a href="<?php echo base_url('penjualan/pos/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah POS</a>
					<a href="<?php echo base_url('penjualan/pos/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data POS</a>
				</div>
				<div class="panel-body">					
					<div class="col-md-12">
						
						<?php
						$get_setting=$this->db->get('setting');
						$hasil_setting=$get_setting->row();
						$kode_unit_jabung=@$hasil_setting->kode_unit;

						$kode_penjualan=$this->uri->segment(4);
						$this->db->where('kode_penjualan', $kode_penjualan);
						$get_penjualan=$this->db->get('transaksi_penjualan');
						$hasil_penjualan=$get_penjualan->row();

						?>
						<input type="hidden" name="kode_penjualan" id="kode_penjualan" value="<?php echo @$hasil_penjualan->kode_penjualan;?>">
						<input type="hidden" name="kode_pesanan" id="kode_pesanan">
						<div class="row">
							<div class="col-md-8">
								<div class="row" style="background-color:white;padding: 10px;">
									<div class="col-md-4 padding_min">
										<select name="kategori_penjualan" disabled="" id="kategori_penjualan" class="form-control" onchange="change_kategori_penjualan()">
											<option <?php if(@$hasil_penjualan->kategori_penjualan=='non_member'){ echo "selected";}?> value="non_member">Non Member</option>
											<option <?php if(@$hasil_penjualan->kategori_penjualan=='member'){ echo "selected";}?> value="member">Member</option>
										</select>
									</div>
									<div class="col-md-6 padding_min" id="pilih_member">
										<select name="kode_member" id="kode_member" class="form-control select2" onchange="change_member()">
											<option value="">- Pilih Member</option>
											<?php
											$this->db_master->where('kode_unit_jabung', $kode_unit_jabung);
											$get_member=$this->db_master->get('master_member');
											$hasil_member=$get_member->result();
											foreach ($hasil_member as $member) {
												?>
												<option <?php if(@$hasil_penjualan->kode_member==@$member->kode_member){ echo "selected";}?> value="<?php echo @$member->kode_member;?>"><?php echo @$member->nama_pic.' - '.@$member->nama_perusahaan;?></option>
												<?php
											}
											?>
										</select>
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
												</tr>
											</thead>
											<tbody id="opsi_temp">
												<?php
												$kode_penjualan=$this->uri->segment(4);
												$this->db->where('kan_suol.opsi_transaksi_penjualan.kode_penjualan', $kode_penjualan);
												$this->db->from('kan_suol.opsi_transaksi_penjualan');
												$this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_penjualan.kode_produk = kan_master.master_produk.kode_produk', 'left');
												$this->db->join('kan_master.master_satuan', 'kan_master.master_produk.kode_satuan_stok = kan_master.master_satuan.kode', 'left');
												$get_temp=$this->db->get('');
												$hasil_temp=$get_temp->result();
												$no=1;
												foreach ($hasil_temp as $temp) {
													?>
													<tr>
														<td><?php echo $no++;?></td>
														<td><?php echo @$temp->nama_produk;?></td>
														<td><?php echo @$temp->jumlah.' '.@$temp->nama;?></td>
														<td><?php echo @format_rupiah($temp->harga_satuan);?></td>
														<td><?php echo @format_rupiah($temp->subtotal);?></td>
														<td>
															<?php 
															if(@$temp->jenis_diskon=='persen'){
																echo @$temp->diskon_persen.'%';
															}else{
																echo @format_rupiah($temp->diskon_rupiah);
															}
															?>
														</td>
														<td><?php echo @TanggalIndo($temp->tanggal_expired);?></td>
													</tr>
													<?php
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="input-group">
											<span class="input-group-addon"  id="basic-addon1">Jenis Diskon (All)</span>
											<select name="" id="jenis_all_diskon" onchange="change_all_diskon()" class="form-control input_transaksi">
												<option <?php if(@$hasil_penjualan->jenis_diskon=='persen'){ echo "selected";}?> value="persen">Persen (%)</option>
												<option <?php if(@$hasil_penjualan->jenis_diskon=='rupiah'){ echo "selected";}?> value="rupiah">Rupiah (Rp)</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="input-group" id="all_persen">
											<input type="number" id="all_diskon_persen"  class="form-control input_transaksi" value="<?php echo @$hasil_penjualan->diskon_persen;?>">
											<span class="input-group-addon" id="basic-addon1">%</span>
										</div>
										<div class="input-group" id="all_rupiah" style="display: none">
											<span class="input-group-addon" id="all_rupiah_input" id="basic-addon1">Rp.</span>
											<input type="number" id="all_diskon_rupiah"  class="form-control input_transaksi" value="<?php echo @$hasil_penjualan->diskon_rupiah;?>">
										</div>
									</div>
								</div>
								<div ></div>
							</div>
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-12">
										<div class="box-tag" style="background-color: #c49f47;height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
											<span style="font-size:22px; " class="pull-right" id="text_total_pesanan"> <?php echo @format_rupiah($hasil_penjualan->total_nominal);?></span>
											
											<p style="font-size: 18px;">Total Pesanan</p>
										</div>
										<input type="hidden" name="total_pesanan" id="total_pesanan" value="<?php echo @$hasil_penjualan->total_nominal;?>">
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="box-tag" style="background-color: #cb5a5e;height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
											<span style="font-size:22px; " class="pull-right" id="text_nominal_diskon"></span>
											
											<p style="font-size: 18px;">Discount</p>
										</div>
										<input type="hidden" name="nominal_diskon" id="nominal_diskon">
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="box-tag" style="background-color: #3598dc;height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
											<span style="font-size:22px; " class="pull-right" id="text_grantotal"><?php echo @format_rupiah($hasil_penjualan->grand_total);?></span>
											
											<p style="font-size: 18px;">Grand Total</p>
										</div>
										<input type="hidden" name="grandtotal" id="grandtotal" value="<?php echo @$hasil_penjualan->grand_total;?>">
									</div>
								</div>

								<div class="row" style="margin-top: 10px">
									<div class="col-md-12">
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1">Jenis Transaksi &nbsp</span>
											<select name="jenis_transaksi" id="jenis_transaksi" onchange="change_jenis_transaksi()" class="form-control input_transaksi">
												<option <?php if(@$hasil_penjualan->proses_pembayaran=='tunai'){ echo "selected";}?> value="tunai">Tunai</option>
												<option <?php if(@$hasil_penjualan->proses_pembayaran=='kredit'){ echo "selected";}?> value="kredit">Kredit</option>
												<option <?php if(@$hasil_penjualan->proses_pembayaran=='konsinyasi'){ echo "selected";}?> value="konsinyasi">Konsinyasi</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row" style="margin-top: 10px" id="input_jatuh_tempo">
									<div class="col-md-12">
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1">&nbsp&nbspJatuh Tempo&nbsp&nbsp&nbsp&nbsp</span>
											<input type="text" id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo" class="form-control input_transaksi" value="<?php echo @TanggalIndo($hasil_penjualan->tanggal_jatuh_tempo);?>">
										</div>
									</div>
								</div>
								<div class="row" style="margin-top: 10px">
									<div class="col-md-12">
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1">&nbsp&nbspOnkos Kirim &nbsp&nbsp&nbsp&nbsp</span>
											<input type="text"  onkeyup="cek_ongkir()" class="form-control input_transaksi" value="<?php echo @format_rupiah($hasil_penjualan->ongkos_kirim);?>">
											<input type="hidden" id="ongkir" name="ongkir"  value="<?php echo @$hasil_penjualan->ongkos_kirim;?>">
										</div>
									</div>
								</div>
								<div class="row" style="margin-top: 10px">
									<div class="col-md-12">
										<div class="input-group  input-group-lg">
											<span class="input-group-addon" id="basic-addon1">&nbsp&nbsp&nbsp&nbspDibayar&nbsp&nbsp&nbsp</span>
											<input type="text" onkeyup="cek_dibayar()" class="form-control input_transaksi" value="<?php echo @format_rupiah($hasil_penjualan->bayar);?>">
											<input type="hidden" id="dibayar" name="dibayar"  value="<?php echo @$hasil_penjualan->bayar;;?>">
										</div>
										
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="box-tag" style="margin-top:10px;background-color: #927dbd;height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
											<span style="font-size:22px; " class="pull-right" id="text_kembalian">Rp. 0,0</span>
											
											<p style="font-size: 18px;" id="label_kembalian">Kembalian</p>
										</div>
										<input type="hidden" name="kembalian" id="kembalian">
										<input type="hidden" name="hutang" id="hutang">
									</div>
								</div>

							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#kode_member').attr('disabled',true);
		$('.input_transaksi').attr('disabled',true);
		
		$('.select2').select2();
		cek_dibayar();
		change_all_diskon();
		change_jenis_transaksi();
	});
	
	function change_all_diskon(){
		jenis_all_diskon 	= $('#jenis_all_diskon').val();

		if (jenis_all_diskon == 'persen') {
			$('#all_persen').show();
			$('#all_rupiah').hide();
		}else{
			$('#all_persen').hide();
			$('#all_rupiah').show();
		}
		
		cek_diskon_input();
	}

	function change_diskon_item(){
		diskon_peritem = $('#diskon_peritem').val();

		if (diskon_peritem == 'persen') {
			$('#diskon_persen_item').show();
			$('#diskon_rupiah_item').hide();
			$('#diskon_rupiah_item').val('');
			$('#diskon_persen_item').val('');
		}else {
			$('#diskon_persen_item').hide();
			$('#diskon_rupiah_item').show();
			$('#diskon_rupiah_item').val('');
			$('#diskon_persen_item').val('');
		}
	}

	function change_kategori_penjualan(){
		kategori_penjualan = $('#kategori_penjualan').val();
		if(kategori_penjualan == 'member'){
			$('#kode_member').attr('disabled',false);
		}else{
			$('#kode_member').val('').trigger('change');
			$('#kode_member').attr('disabled',true);
		}
	}

	function change_member(){
		kode_member = $('#kode_member').val();
		$.ajax({
			url: '<?php echo base_url('penjualan/pos/get_data_member'); ?>',
			type: 'post',
			data:{kode_member:kode_member},
			dataType:'Json',
			success: function(response){
				$('#ongkir').val(response.ongkir);
				$('#ongkir').attr('readonly',true);
				cek_ongkir();
			}
		});
	}

	function cek_diskon_input(){
		jenis_all_diskon 	= $('#jenis_all_diskon').val();
		diskon_persen = $('#all_diskon_persen').val();
		diskon_rupiah = $('#all_diskon_rupiah').val();
		total_pesanan = $('#total_pesanan').val();
		if (jenis_all_diskon == 'persen' && (parseInt(diskon_persen) < 0 || parseInt(diskon_persen) > 100)) {
			alert('Pengisian Diskon Salah.');
			$('#all_diskon_persen').val('');
		}else if(jenis_all_diskon == 'rupiah' && (parseInt(diskon_rupiah) < 0 || parseInt(diskon_rupiah) > parseInt(total_pesanan))){
			alert('Pengisian Diskon Salah.');
			$('#all_diskon_rupiah').val('');
		}else{

			if(jenis_all_diskon == 'persen'){
				diskon_rp=(total_pesanan * diskon_persen) /100;
				$('#nominal_diskon').val(diskon_rp);
				$('#text_nominal_diskon').html(toRp(diskon_rp));
			}else{
				$('#nominal_diskon').val(diskon_rupiah);
				$('#text_nominal_diskon').html(toRp(diskon_rupiah));
			}

		}
		
	}
	function change_jenis_transaksi(){
		jenis_transaksi 	= $('#jenis_transaksi').val();

		if (jenis_transaksi == 'kredit') {
			$('#label_kembalian').html('Hutang');
			$('#input_jatuh_tempo').show();
		}else{
			$('#label_kembalian').html('Kembalian');
			$('#input_jatuh_tempo').hide();
		}
		
		cek_dibayar();
	}
	function cek_dibayar(){
		jenis_transaksi 	= $('#jenis_transaksi').val();
		dibayar 			= $('#dibayar').val();
		grandtotal 			= $('#grandtotal').val();
		if(parseInt(dibayar) < 0 || (jenis_transaksi == 'kredit' && parseInt(grandtotal) <= parseInt(dibayar))){
			alert('Nominal Pembayaran Salah !');
			//$('#dibayar').val('');
		}else{
			if (jenis_transaksi == 'kredit' ) {
				$('#hutang').val(grandtotal-dibayar);
				$('#text_kembalian').html(toRp(grandtotal-dibayar));
			}else if(jenis_transaksi == 'tunai' && parseInt(grandtotal) < parseInt(dibayar)){
				$('#text_kembalian').html(toRp(dibayar-grandtotal));
				$('#kembalian').val(dibayar-grandtotal);
			}
			else if(jenis_transaksi == 'konsinyasi' && parseInt(grandtotal) < parseInt(dibayar)){
				$('#text_kembalian').html(toRp(dibayar-grandtotal));
				$('#kembalian').val(dibayar-grandtotal);
			}
			$('#text_dibayar').html(toRp(dibayar));
		}

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
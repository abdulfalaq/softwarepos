

<a href="<?php echo base_url('supplier'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('supplier'); ?>">Suplier</a></li>
		<li><a href="<?php echo base_url('supplier/akun_supplier/daftar'); ?>">Akun Supplier</a></li>
		<li><a href="#">Detail Supplier</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Akun Supplier</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<?php 
	$kode_supplier=$this->uri->segment(4);
	$this->db->where('clouoid1_olive_gudang.transaksi_hutang.kode_supplier',$kode_supplier);
	$this->db->from('clouoid1_olive_gudang.transaksi_hutang');
	$this->db->join('clouoid1_olive_gudang.transaksi_pembelian', 'clouoid1_olive_gudang.transaksi_hutang.kode_transaksi = clouoid1_olive_gudang.transaksi_pembelian.kode_pembelian', 'left');
	$this->db->join('clouoid1_olive_master.master_supplier', 'clouoid1_olive_gudang.transaksi_hutang.kode_supplier = clouoid1_olive_master.master_supplier.kode_supplier', 'left');
	$get_hutang = $this->db->get()->row();
	?>	
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right" style="height: 55px">
					<span class="pull-left" style="font-size: 24px;margin-left: 620px"><?php echo $get_hutang->nama_supplier?></span>
				</div>
				
				<div class="panel-body">
					<form id="data_form"  method="post">
						<div class="box-body">            
							<div class="row">
								<div class="container" style="margin-left: 10px">
									<div class="row">
										<div class="" role="tabpanel" data-example-id="togglable-tabs">
											<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist" >
												<li role="presentation" class="" id="menu_setting" style="margin-bottom: 20px;">
													<a href="<?php echo base_url('supplier/akun_supplier/detail/'.$get_hutang->kode_supplier); ?>">Personal Data</a>
												</li>
												<li role="presentation" class="active" id="menu_pengajuan" style="margin-bottom: 20px;">
													<a href="<?php echo base_url('supplier/akun_supplier/hutang/'.$get_hutang->kode_supplier); ?>" >Hutang</a>
												</li>
												<li role="presentation" class="" id="menu_validasi" style="margin-bottom: 20px;">
													<a href="<?php echo base_url('supplier/akun_supplier/record/'); ?>">Record Transaksi</a>
												</li>
											</ul>
										</div>
									</div>
								</div><br>
								<div class="col-md-6">
									<div class="form-group">
										<label>Kode Transaksi</label>
										<input readonly="true" type="text" value="<?php echo $get_hutang->kode_transaksi?>" class="form-control" placeholder="Kode Transaksi" name="kode_pembelian" id="kode_pembelian" />
									</div>

									<div class="form-group">
										<label class="gedhi">Tanggal Transaksi</label>
										<input readonly="true" type="text" value="<?php echo @TanggalIndo($get_hutang->tanggal_transaksi)?>" class="form-control" placeholder=""  />
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Nota Referensi</label>
										<input readonly="true" type="text" value="<?php echo $get_hutang->nomor_nota?>" class="form-control" placeholder=""  />
									</div>
									<div class="form-group">
										<label>Supplier</label>
										<input readonly="true" type="text" value="<?php echo $get_hutang->nama_supplier?>" class="form-control" placeholder=""  />
									</div>
								</div>
								<div class="col-md-6">
									<label>Pembayaran</label>
									<div class="form-group">
										<select disabled="true" class="form-control" name="proses_pembayaran" id="proses_pembayaran">
											<option  value="cash">Cash</option>
											<option selected='true'  value="credit">Credit</option>
											<option  value="konsinyasi">Konsinyasi</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</form>
					<div class="sukses" ></div>
					<div id="list_transaksi_pembelian">
						<div class="box-body">
							<table id="tabel_daftar" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Jenis Bahan</th>
										<th>Nama bahan</th>
										<th>QTY</th>
										<th>Harga Satuan</th>
										<th>Subtotal</th>
									</tr>
								</thead>
								<tbody id="tabel_temp_data_transaksi">
									<?php
									if(@$get_hutang->kode_transaksi){
										$this->db->select('nama');
										$this->db->select('nama_bahan_baku');
										$this->db->select('nama_perlengkapan');
										$this->db->select('nama_produk');
										$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.id');
										$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.jumlah');
										$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.expired_date');
										$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.harga_satuan');
										$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.jenis_diskon');
										$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.diskon_item');
										$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.subtotal');
										$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.kategori_bahan');

										$this->db->where('kode_pembelian',@$get_hutang->kode_transaksi);
										$this->db->from('clouoid1_olive_gudang.opsi_transaksi_pembelian');
										$this->db->join('clouoid1_olive_master.master_bahan_baku', 'clouoid1_olive_gudang.opsi_transaksi_pembelian.kode_bahan = clouoid1_olive_master.master_bahan_baku.kode_bahan_baku', 'left');
										$this->db->join('clouoid1_olive_master.master_produk', 'clouoid1_olive_gudang.opsi_transaksi_pembelian.kode_bahan = clouoid1_olive_master.master_produk.kode_produk', 'left');
										$this->db->join('clouoid1_olive_master.master_perlengkapan', 'clouoid1_olive_gudang.opsi_transaksi_pembelian.kode_bahan = clouoid1_olive_master.master_perlengkapan.kode_perlengkapan', 'left');
										$this->db->join('clouoid1_olive_master.master_satuan', 'clouoid1_olive_gudang.opsi_transaksi_pembelian.kode_satuan = clouoid1_olive_master.master_satuan.kode', 'left');
										$pembelian = $this->db->get();
										$list_pembelian = $pembelian->result();
										$nomor = 1;  $total = 0;

										foreach($list_pembelian as $daftar){ 

											?> 
											<tr>
												<td><?php echo $nomor; ?></td>
												<td><?php echo @$daftar->kategori_bahan; ?></td>
												<td>
													<?php 
													if(@$daftar->kategori_bahan=='bahan baku'){
														echo @$daftar->nama_bahan_baku;
													}elseif (@$daftar->kategori_bahan=='produk') {
														echo @$daftar->nama_produk;
													}elseif (@$daftar->kategori_bahan=='perlengkapan') {
														echo @$daftar->nama_perlengkapan;
													}elseif (@$daftar->kategori_bahan=='kartu member') {
														echo 'kartu member';
													}
													?>  
												</td>
												<td><?php echo @$daftar->jumlah.' '.@$daftar->nama; ?></td>
												<td><?php echo format_rupiah(@$daftar->harga_satuan); ?></td>
												<td><?php echo format_rupiah(@$daftar->subtotal); ?></td>
											</tr>
											<?php 
											@$total = $total + @$daftar->subtotal;
											$nomor++; 
										} 
									}
									?>
									
									<tr>
										<td colspan="4"></td>
										<td style="font-weight:bold;">Total</td>
										<td><?php echo format_rupiah(@$total);?></td>
									</tr>
									<tr>
										<td colspan="4"></td>
										<td style="font-weight:bold;">Diskon (%)</td>
										<td id="tb_diskon"><?php echo (@$get_hutang->diskon_persen);?></td>

									</tr>
									<tr>
										<td colspan="4"></td>
										<td style="font-weight:bold;">Diskon (Rp)</td>
										<td id="tb_diskon_rupiah"><?php echo format_rupiah(@$get_hutang->diskon_rupiah);?></td>
									</tr>
									<tr>
										<td colspan="4"></td>
										<td style="font-weight:bold;">Grand Total</td>
										<td id="tb_grand_total"><?php echo format_rupiah(@$get_hutang->grand_total);?></td>

									</tr>
								</tbody>
								<tfoot>

								</tfoot>
							</table>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-2">
							<div class="input-group">
								<label>Sisa Hutang </label><br>
								<a><div style="text-decoration: none;background-color: #cb5a5e;color: white" class="btn red btn-lg"><i class="fa fa-tags"></i> <?php echo format_rupiah(@$get_hutang->sisa);?></div></a>
								<input type="hidden" id="nilai_sisa" value="<?php echo @$get_hutang->sisa; ?>">
							</div>
						</div>

					</div>

					<div class="row" <?php if(@$get_hutang->sisa==0) {echo 'style="display:none;"'; } else{} ?> style="margin-top: 100px;">

						<div class="col-md-3" id="div_dibayar">
							<label>Jenis Transaksi</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-money"></i></span>
								<select class="form-control" name="jenis_transaksi" id="jenis_transaksi">
									<option value="">--Pilih Jenis Transaksi--</option>
									<option value="Angsuran">Angsuran</option>
									<option value="Lunas">Lunas</option>
								</select>
							</div>
						</div>

						<div class="col-md-3" id="div_dibayar">
							<label>Dibayar</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-money"></i></span>
								<input type="number" class="form-control"  style="margin-right: 5px;" placeholder="Angsuran" name="angsuran" id="angsuran">
								<span class="input-group-addon" id="nilai_dibayar">Rp 0,00</span>
							</div>
						</div>

						<div class="col-md-3" id="tempo">
							<label>Jatuh Tempo</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-money"></i></span>
								<input type="date" class="form-control" placeholder="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo" id="tanggal_jatuh_tempo">
							</div>
						</div>

						<div class="col-md-2" style="padding:25px;">
							<div onclick="actbayar()" id="proses_hutang"  class="btn btn-success">Bayar</div>
						</div>


						<!--  -->
					</div>
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
				<h4 class="modal-title" style="color:#fff;">Konfirmasi Pembayaran</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:11pt">Apakah anda yakin akan membayar hutang tersebut sebesar <span id="utang"></span> ?</span>

			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn green" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button onclick="proses_hutang()" class="btn red">Ya</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#tempo").hide();
	});
	$("#jenis_transaksi").change(function(){
		var pilih = $("#jenis_transaksi").val();
		var sisa = $("#nilai_sisa").val();
		if(pilih=="Lunas"){
			$("#tempo").hide(100);
			$("#angsuran").val(sisa);
			$("#angsuran").attr('readonly',true);

			$("#nilai_dibayar").show();
		}else if(pilih=="Angsuran"){
			$("#tempo").show(100);
			$("#angsuran").val("");
			$("#nilai_dibayar").val("");
			$("#angsuran").attr('readonly',false);
			$("#nilai_dibayar").show();
			get_angsuran();
		}else if(pilih==""){
			$("#tempo").hide(100);
			$("#angsuran").attr('readonly',true);
			$("#angsuran").val();
			$("#nilai_dibayar").hide();
			$("#angsuran").val("");
			get_angsuran();
		}else{
			$("#tempo").hide(100);
			$("#angsuran").attr('readonly',true);
			$("#angsuran").val();
			$("#nilai_dibayar").hide();
			$("#angsuran").val("");
			get_angsuran();

		}
	});
	$("#angsuran").keyup(function(){
		var angsuran = $('#angsuran').val();
		var nilai_sisa = $('#nilai_sisa').val();
		var jumlah = parseInt(angsuran);
		var url = "<?php echo base_url().'supplier/akun_supplier/get_rupiah'; ?>";

		if ( jumlah < 0) {
			alert("Angsuran tidak boleh kurang dari 0 !");
			$('#angsuran').val(" ");
		}
		else if (parseInt(angsuran) >= parseInt(nilai_sisa) ) {
			alert('Angsuran Melebihi Atau Sama Dengan Sisa Hutang !, Silahkan Pilih Jenis Pembayaran Lunas.');
			$("#angsuran").val("");
			$("#nilai_dibayar").val("");
		}
		else{
			$.ajax({
				type: "POST",
				url: url,
				data: {angsuran:angsuran},
				success: function(rupiah) {              
					$("#nilai_dibayar").html(rupiah);

				}
			});
		}
	});
	function actbayar() {
		var nilai_dibayar = $("#nilai_dibayar").text();
		$("#utang").text(nilai_dibayar);
		$('#modal-confirm').modal('show');
	}
	function proses_hutang(){
		var kode_transaksi = $('#kode_pembelian').val();
		var nilai_sisa = $('#nilai_sisa').val();
		var jenis_transaksi = $('#jenis_transaksi').val();
		var angsuran = $("#angsuran").val();    
		var tanggal_jatuh_tempo = $("#tanggal_jatuh_tempo").val();      
		var url = "<?php echo base_url().'supplier/akun_supplier/simpan_hutang'?> ";

		if (jenis_transaksi == '') {
			alert("Pilih Jenis Transaksi Terlebih Dahulu !");
			$('#modal-confirm').modal('hide');
		}

		else if (angsuran == '') {
			alert("Angsuran harap di isi !");
			$('#modal-confirm').modal('hide');
		}
		else if(jenis_transaksi == 'Angsuran' && tanggal_jatuh_tempo == ''){
			alert('Field Jatuh Tempo wajib di isi !');
			$('#modal-confirm').modal('hide');
		}

		else{
			$.ajax({
				type: "POST",
				url: url,
				data: { 
					kode_transaksi:kode_transaksi,
					angsuran:angsuran,tanggal_jatuh_tempo:tanggal_jatuh_tempo,jenis_transaksi:jenis_transaksi
				},
				beforeSend:function(){
					$(".tunggu").show();  
				},
				dataType:'json',
				success: function(hasil)
				{
					$(".tunggu").hide(); 
					if(hasil.respon=='sukses'){
						$('#modal-confirm').modal('hide');
						$(".sukses").html('<div style="font-size:1.5em" class="alert alert-success">Berhasil Disimpan.</div>');   
						setTimeout(function(){
							$('.sukses').html('');                    
						},1500);
						window.location = "<?php echo base_url().'supplier/akun_supplier/hutang/'.@$kode_supplier; ?>"; 
					}else{
						$('#modal-confirm').modal('hide');
						$(".sukses").html(hasil);   
						setTimeout(function(){
							$('.sukses').html('');                    
						},1500);    
					}                  
				}
			}); 
		}

	}
</script>

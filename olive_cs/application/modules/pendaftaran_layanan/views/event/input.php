
<!-- back button -->
<a href="<?php echo base_url('penjualan'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
		<li><a href="#">Event</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Event </h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Event </span>
					<a href="<?php echo base_url('penjualan/event/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Event</a>
					<a href="<?php echo base_url('penjualan/event/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Event</a>
				</div>
				<?php
				$kode_event=$this->uri->segment(4);
				$this->db->where('kode_event', $kode_event);
				$get_event=$this->db->get('transaksi_penjualan_event');
				$hasil_event=$get_event->row();

				?>
				<div class="panel-body">
					<div class="col-md-12">
						<form id="data_form" onsubmit="return false;">
							<div class="row">
								<div class="col-md-6">
									<label for="">Nama Event</label>
									<input type="text" readonly="" id="nama_event" name="nama_event" value="<?php echo @$hasil_event->nama_event;?>" class="form-control">
									<input type="hidden" name="kode_event" id="kode_event" value="<?php echo @$hasil_event->kode_event;?>">
								</div>
								<div class="col-md-6">
									<label for="">Tanggal Event</label>
									<input type="date" readonly="" id="tanggal_event" name="tanggal_event" value="<?php echo @$hasil_event->tanggal;?>" class="form-control">
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama Produk</th>
												<th>QTY</th>
												<th>QTY Terjual</th>
												<th>Produk Rusak</th>
												<th>Sisa</th>
												<th>Exp Date</th>
												<th>Harga</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$kode_event=$this->uri->segment(4);
											$this->db->where('kan_suol.opsi_transaksi_penjualan_event.kode_event', $kode_event);
											$this->db->from('kan_suol.opsi_transaksi_penjualan_event');
											$this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_penjualan_event.kode_produk = kan_master.master_produk.kode_produk', 'left');
											$this->db->join('kan_master.master_satuan', 'kan_master.master_produk.kode_satuan_stok = kan_master.master_satuan.kode', 'left');
											$this->db->join('kan_master.master_harga_barang', 'kan_master.master_produk.kode_produk = kan_master.master_harga_barang.kode_barang', 'left');
											$get_temp=$this->db->get('');
											$hasil_temp=$get_temp->result();
											$no=1;
											foreach ($hasil_temp as $temp) {
												?>
												<tr>
													<td><?php echo $no++;?></td>
													<td><?php echo @$temp->nama_produk;?>
														<input type="hidden" id="kode_produk" value="<?php echo @$temp->kode_produk;?>">
														<input type="hidden" id="nama_satuan" value="<?php echo @$temp->nama;?>">
													</td>
													<td><?php echo @$temp->jumlah.' '.@$temp->nama;?>
														<input type="hidden" id="jumlah" value="<?php echo @$temp->jumlah;?>">
													</td>
													<td><input type="number" name="produk_terjual_<?php echo @$temp->kode_produk;?>" id="produk_terjual" value="0" class="form-control produk_terjual" onkeyup="hitung_sisa(this)"></td>
													<td><input type="number" name="produk_rusak_<?php echo @$temp->kode_produk;?>" id="produk_rusak" value="0" class="form-control" onkeyup="hitung_sisa(this)"></td>
													<td><div id="text_sisa"><?php echo @$temp->jumlah.' '.@$temp->nama;?></div>
														<input type="hidden" name="sisa_<?php echo @$temp->kode_produk;?>" id="sisa" value="<?php echo @$temp->jumlah;?>">
													</td>
													<td><?php echo @TanggalIndo($temp->tanggal_expired);?></td>
													<td>
														<select name="harga_<?php echo @$temp->kode_produk;?>" id="harga" class="form-control harga_produk">
															<option value="">-- Pilih Harga --</option>
															<option value="<?php echo @$temp->harga1;?>"><?php echo @format_rupiah($temp->harga1);?></option>
															<option value="<?php echo @$temp->harga2;?>"><?php echo @format_rupiah($temp->harga2);?></option>
															<option value="<?php echo @$temp->harga3;?>"><?php echo @format_rupiah($temp->harga3);?></option>
															<option value="<?php echo @$temp->harga4;?>"><?php echo @format_rupiah($temp->harga4);?></option>
															<option value="<?php echo @$temp->harga5;?>"><?php echo @format_rupiah($temp->harga5);?></option>
															<option value="<?php echo @$temp->harga6;?>"><?php echo @format_rupiah($temp->harga6);?></option>
															<option value="<?php echo @$temp->harga7;?>"><?php echo @format_rupiah($temp->harga7);?></option>
															<option value="<?php echo @$temp->harga8;?>"><?php echo @format_rupiah($temp->harga8);?></option>
															<option value="<?php echo @$temp->harga9;?>"><?php echo @format_rupiah($temp->harga9);?></option>
															<option value="<?php echo @$temp->harga10;?>"><?php echo @format_rupiah($temp->harga10);?></option>
														</select>
													</td>
												</tr>
												<?php
											}
											?>

										</tbody>
									</table>
								</div>
							</div><br>
						</form>
						<div class="row">
							<div class="col-md-12">
								<button onclick="confirm_simpan()" class="btn btn-lg btn-no-radius btn-info pull-right"><i class="fa fa-send"></i> SIMPAN</button>
							</div>
						</div>
					</div>
				</div>
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
				<button type="button" onclick="simpan_transaksi()" class="btn btn-success"><i class="fa fa-trash"></i> Simpan</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	function hitung_sisa(obj){
		tr = $(obj).parent().parent();
		jumlah=tr.find('input[id="jumlah"]').val();
		produk_terjual=tr.find('input[id="produk_terjual"]').val();
		produk_rusak=tr.find('input[id="produk_rusak"]').val();
		nama_satuan=tr.find('input[id="nama_satuan"]').val();

		total_keluar=parseInt(produk_terjual)+parseInt(produk_rusak);
		if(parseInt(produk_terjual) < 0 || parseInt(produk_terjual) > parseInt(jumlah)){
			alert('Jumlah Produk Terjual Salah ..!');
			tr.find('input[id="produk_terjual"]').val('');
			tr.find('input[id="sisa"]').val(jumlah - produk_rusak);
		}else if(parseInt(produk_rusak) < 0 || parseInt(produk_rusak) > parseInt(jumlah)){
			alert('Jumlah Produk Rusak Salah ..!');
			tr.find('input[id="produk_rusak"]').val('');
			tr.find('input[id="sisa"]').val(jumlah - produk_terjual);
		}else if(parseInt(total_keluar) > parseInt(jumlah)){
			alert('Jumlah Produk Keluar Salah ..!');
			tr.find('input[id="produk_terjual"]').val('');
			tr.find('input[id="produk_rusak"]').val('');
			tr.find('input[id="sisa"]').val('');
		}else{
			tr.find('input[id="sisa"]').val(jumlah - total_keluar);
			tr.find('div[id="text_sisa"]').html(jumlah - total_keluar+' '+ nama_satuan);
		}
	}
	function confirm_simpan(){
		var total = 0;
		$('.produk_terjual').each(function() {
			var isi = this.value;
			if (isi=='') {
				total += 1;
			}
		});
		$('.harga_produk').each(function() {
			var isi = this.value;
			if (isi=='') {
				total += 1;
			}
		});
		
		if(total==0){
			$('#modal-konfirmasi').modal('show');
		}else{
			alert('Silahkan Lengkapi From ..!');
		}
		
	}
	function simpan_transaksi(){
		$('#modal-konfirmasi').modal('hide');
		$.ajax({
			url: '<?php echo base_url('penjualan/event/input_transaksi'); ?>',
			type: 'post',
			data:$('#data_form').serialize(),
			beforeSend:function(){
				$(".tunggu").show();
			},
			dataType:'json',
			success: function(hasil){
				$(".tunggu").hide();
				
				$(".alert_berhasil").show();
				setTimeout(function(){
					window.location="<?php echo base_url('penjualan/event');?>";
				},1500);

			},
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
	}
</script>
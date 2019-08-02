<?php
$kode_member=$this->uri->segment(4);
$kode_transaksi=$this->uri->segment(5);
?>	
<a href="<?php echo base_url('/penjualan/piutang/detail/'.$kode_member); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
		<li><a href="#">Piutang</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Piutang </h1>
	<?php $this->load->view('menu_master'); ?>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Angsuran Piutang Konsinyasi</span>
					<a href="<?php echo base_url('penjualan/piutang/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Piutang Umum</a>
					<a href="<?php echo base_url('penjualan/piutang/daftar_konsinyasi'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Piutang Konsinyasi</a>
				</div>
				<?php
				$this->db->where('kan_suol.transaksi_penjualan.kode_penjualan', $kode_transaksi);
				$this->db->where('kan_suol.transaksi_penjualan.kode_member', $kode_member);
				$this->db->from('kan_suol.transaksi_penjualan');
				$this->db->join('kan_master.master_member', 'kan_suol.transaksi_penjualan.kode_member = kan_master.master_member.kode_member','left');
				$this->db->join('kan_kasir.transaksi_piutang', 'kan_suol.transaksi_penjualan.kode_penjualan = kan_kasir.transaksi_piutang.kode_piutang','left');
				$get_penjualan=$this->db->get();
				$hasil_penjualan=$get_penjualan->row();
				?>
				<div class="panel-body">
					<form id="data_form" onsubmit="return false;">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<h5>Kode transaksi</h5>
									<input type="text" class="form-control" name="kode_transaksi" id="kode_transaksi" readonly value="<?php echo @$hasil_penjualan->kode_penjualan;?>">
									<input type="hidden" name="kode_unit_jabung" id="kode_unit_jabung" value="<?php echo @$hasil_penjualan->kode_unit_jabung;?>">
									<input type="hidden" name="kode_member" id="kode_member" value="<?php echo @$hasil_penjualan->kode_member;?>">
								</div>
								<div class="col-md-6">
									<h5>Member</h5>
									<input type="text" class="form-control" readonly value="<?php echo @$hasil_penjualan->nama_pic.' - '.@$hasil_penjualan->nama_perusahaan;?>">
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<h5>Tanggal Transaksi</h5>
									<input type="text" class="form-control" readonly value="<?php echo @$hasil_penjualan->tanggal_penjualan;?>">
								</div>
								<div class="col-md-6">
									<h5>Pembayaran</h5>
									<input type="text" class="form-control" readonly value="<?php echo @$hasil_penjualan->proses_pembayaran;?>">
								</div>
							</div>

						</div>	
						<div class="col-md-12">
							<table class="table table-bordered" style="margin-top: 40px;">
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
									$this->db->where('kan_suol.transaksi_member_konsinyasi.kode_transaksi', $kode_transaksi);
									$this->db->from('kan_suol.transaksi_member_konsinyasi');
									$this->db->join('kan_master.master_produk', 'kan_suol.transaksi_member_konsinyasi.kode_produk = kan_master.master_produk.kode_produk', 'left');
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
											<td><?php echo @format_rupiah($temp->harga_satuan);?></td>
										</tr>
										<?php
									}
									?>

								</tbody>
							</table>
						</div>
						<br>
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
<div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog" >
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
	
	function hitung_sisa(obj){
		tr = $(obj).parent().parent();
		jumlah=tr.find('input[id="jumlah"]').val();
		produk_terjual=tr.find('input[id="produk_terjual"]').val();
		produk_rusak=tr.find('input[id="produk_rusak"]').val();
		nama_satuan=tr.find('input[id="nama_satuan"]').val();

		total_keluar=parseInt(produk_terjual)+parseInt(produk_rusak);
		if(parseInt(produk_terjual) < 0 || parseInt(produk_terjual) > parseInt(jumlah)){
			alert('Jumlah Produk Terjual Salah ..!');
			tr.find('input[id="produk_terjual"]').val(0);
			tr.find('input[id="sisa"]').val(jumlah - produk_rusak);
		}else if(parseInt(produk_rusak) < 0 || parseInt(produk_rusak) > parseInt(jumlah)){
			alert('Jumlah Produk Rusak Salah ..!');
			tr.find('input[id="produk_rusak"]').val(0);
			tr.find('input[id="sisa"]').val(jumlah - produk_terjual);
		}else if(parseInt(total_keluar) > parseInt(jumlah)){
			alert('Jumlah Produk Keluar Salah ..!');
			tr.find('input[id="produk_terjual"]').val(0);
			tr.find('input[id="produk_rusak"]').val(0);
			tr.find('input[id="sisa"]').val(0);
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
		
		if(total==0){
			$('#modal-konfirmasi').modal('show');
		}else{
			alert('Silahkan Lengkapi From ..!');
		}
		
	}
	function simpan_transaksi(){
		$('#modal-konfirmasi').modal('hide');
		$.ajax({
			url: '<?php echo base_url('penjualan/piutang/simpan_angsuran_konsinyasi'); ?>',
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
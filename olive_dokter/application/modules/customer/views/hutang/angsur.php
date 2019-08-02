<?php
$kode_supplier=$this->uri->segment(4);
$kode_transaksi=$this->uri->segment(5);
?>	
<a href="<?php echo base_url('/pembelian/hutang/detail/'.$kode_supplier); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>">Pembelian</a></li>
		<li><a href="#">Hutang</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Hutang </h1>
	<?php $this->load->view('menu_master'); ?>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Angsuran Hutang </span>
					<a href="<?php echo base_url('pembelian/hutang/detail/'.@$kode_supplier); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Hutang</a>
				</div>
				<?php
				$this->db->where('kan_suol.transaksi_pembelian.kode_po', $kode_transaksi);
				$this->db->where('kan_suol.transaksi_pembelian.kode_supplier', $kode_supplier);
				$this->db->from('kan_suol.transaksi_pembelian');
				$this->db->join('kan_master.master_supplier', 'kan_suol.transaksi_pembelian.kode_supplier = kan_master.master_supplier.kode_supplier');
				$this->db->join('kan_kasir.transaksi_hutang', 'kan_suol.transaksi_pembelian.kode_po = kan_kasir.transaksi_hutang.kode_hutang');
				$get_pembelian=$this->db->get();
				$hasil_pembelian=$get_pembelian->row();
				?>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<h5>Kode transaksi</h5>
								<input type="text" class="form-control" id="kode_transaksi" readonly value="<?php echo @$hasil_pembelian->kode_po;?>">
								<input type="hidden" id="kode_unit_jabung" value="<?php echo @$hasil_pembelian->kode_unit_jabung;?>">
								<input type="hidden" id="kode_supplier" value="<?php echo @$hasil_pembelian->kode_supplier;?>">
							</div>
							<div class="col-md-6">
								<h5>Nomor Nota</h5>
								<input type="text" class="form-control" readonly value="<?php echo @$hasil_pembelian->nomor_nota;?>">
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<h5>Tanggal Transaksi</h5>
								<input type="text" class="form-control" readonly value="<?php echo @$hasil_pembelian->tanggal_pembelian;?>">
							</div>
							<div class="col-md-6">
								<h5>Supplier</h5>
								<input type="text" class="form-control" readonly value="<?php echo @$hasil_pembelian->nama_supplier;?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<h5>Pembayaran</h5>
								<input type="text" class="form-control" readonly value="<?php echo @$hasil_pembelian->proses_pembayaran;?>">
							</div>
						</div>
					</div>	
					<div class="col-md-12" style="margin-top: 40px;">
						<table id="" class="table table-striped table-bordered">
							<thead>
								<tr style="background-color: #d3d3d3;">
									<th>No</th>
									<th>Nama Produk</th>
									<th>QTY</th>
									<th>Harga Satuan</th>
									<th>Subtotal</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$this->db->where('kan_suol.opsi_transaksi_pembelian.kode_pembelian', $kode_transaksi);
								$this->db->where('kan_suol.opsi_transaksi_pembelian.kode_supplier', $kode_supplier);
								$this->db->from('kan_suol.opsi_transaksi_pembelian');
								$this->db->join('kan_master.master_bahan_baku', 'kan_suol.opsi_transaksi_pembelian.kode_bahan_baku = kan_master.master_bahan_baku.kode_bahan_baku');
								$this->db->join('kan_master.master_satuan', 'kan_master.master_bahan_baku.kode_satuan_pembelian = kan_master.master_satuan.kode');

								$get_opsi=$this->db->get();
								$hasil_opsi=$get_opsi->result();
								$no=1;
								foreach ($hasil_opsi as $opsi) {
									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo $opsi->nama_bahan_baku;?></td>
										<td><?php echo $opsi->qty;?> <?php echo $opsi->nama;?></td>
										<td><?php echo @format_rupiah($opsi->harga_satuan);?></td>
										<td class="text-right"><?php echo @format_rupiah($opsi->qty * $opsi->harga_satuan);?></td>
									</tr>
									<?php
								}
								?>
								<tr>
									<th colspan="3"></th>
									<th>Total</th>
									<th class="text-right"><?php echo @format_rupiah($hasil_pembelian->nominal_total);?></th>
									<input type="hidden" name="subtotal" id="subtotal" value="<?php echo @$hasil_pembelian->nominal_total;?>" readonly>     
								</tr>
								<tr>
									<th colspan="3"></th>
									<th>Diskon (%)</th>
									<th class="text-right" id="diskon_persen_col_text"><?php echo @$hasil_pembelian->persentase_diskon;?> %</th>
									<input type="hidden" name="diskon_persen_col" id="diskon_persen_col">  
								</tr>
								<tr>
									<th colspan="3"></th>
									<th>Diskon (Rp)</th>
									<th class="text-right" id="diskon_rupiah_col_text"><?php echo @format_rupiah($hasil_pembelian->nominal_diskon);?></th>
									<input type="hidden" name="diskon_rupiah_col" id="diskon_rupiah_col">    
								</tr>
								<tr>
									<th colspan="3"></th>
									<th>Grand Total</th>
									<th class="text-right" id="grand_total_text"><?php echo @format_rupiah($hasil_pembelian->nominal_grand_total);?></th>
									<input type="hidden" name="grand_total" id="grand_total" value="<?php echo @$hasil_pembelian->nominal_grand_total;?>">    
								</tr>
							</tbody>
						</table>
					</div>	
					<div class="row">
						<div class="col-md-12">
							<div class="pull-right">
								<h5><b>Sisa Hutang</b></h5>
								<div class="btn btn-success btn-no-radius btn-lg">
									<i class="fa fa-tag"></i> <?php echo @format_rupiah($hasil_pembelian->sisa);?>
									<input type="hidden" name="sisa_hutang" id="sisa_hutang" value="<?php echo @$hasil_pembelian->sisa;?>">    
								</div>
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-2">
							<h5>Pilih Jenis Transaksi</h5>
							<select name="jenis_angsuran" class="form-control" onchange="get_jenis_angsuran()" id="jenis_angsuran">
								<option value="angsuran">Angsuran</option>
								<option value="lunas">Lunas</option>
							</select>
						</div>
						<div class="col-md-3">
							<h5>Dibayar</h5>
							<input type="number" id="dibayar" name="dibayar" onkeyup="cek_dibayar()" class="form-control" placeholder="Bayar">
							<div id="text_dibayar"></div>
						</div>
						<div class="col-md-2 jatuh_tempo">
							<h5>Tanggal Jatuh Tempo</h5>
							<input type="date" class="form-control" name="tanggal_jatuh_tempo" id="tanggal_jatuh_tempo">
						</div>
						<div class="col-md-2">
							<h5>Jenis Pembayaran</h5>
							<select name="jenis_pembayaran" class="form-control"  id="jenis_pembayaran">
								<option value="cash">Cash</option>
								<option value="transfer">Transfer</option>
							</select>
						</div>
						<div class="col-md-2">
							<a onclick="$('#modal-confirm').modal('show')" class="btn btn-info btn-md btn-no-radius" style="margin-top: 35px;"><i class="fa fa-send"></i> Bayar</a>
						</div>
						
					</div>
				</div>
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
				<a class="btn btn-info btn-no-radius btn-info btn-md" onclick="simpan_angsuran()" >Yakin</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function get_jenis_angsuran(){
		var jenis_angsuran=$('#jenis_angsuran').val();
		var sisa_hutang=$('#sisa_hutang').val();
		if(jenis_angsuran=='lunas'){
			$('#dibayar').val(sisa_hutang);
			$('#dibayar').attr('readonly',true);
			$('#text_dibayar').html(toRp(sisa_hutang));
			$('.jatuh_tempo').hide();
		}else{
			$('#dibayar').val(0);
			$('#dibayar').attr('readonly',false);
			$('#text_dibayar').html(toRp(0));
			$('.jatuh_tempo').show();
		}
	}
	function cek_dibayar(){
		var dibayar=$('#dibayar').val();
		var sisa_hutang=$('#sisa_hutang').val();
		if(parseInt(dibayar) > parseInt(sisa_hutang)){
			alert('Nominal Pembeyaran Melebihi Sisa ...!');
			$('#dibayar').val('');
			$('#text_dibayar').html(toRp(0));
		}else if(dibayar=='-' || parseInt(dibayar) < 0){
			alert('Nominal Pembeyaran Salah ...!');
			$('#dibayar').val('');
			$('#text_dibayar').html(toRp(0));
		}else{
			$('#text_dibayar').html(toRp(dibayar));
			
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
	function simpan_angsuran(){
		kode_transaksi 		= $('#kode_transaksi').val();
		kode_unit_jabung 	= $('#kode_unit_jabung').val();
		jenis_angsuran 		= $('#jenis_angsuran').val();
		dibayar 			= $('#dibayar').val();
		kode_supplier 		= $('#kode_supplier').val();
		jenis_pembayaran 	= $('#jenis_pembayaran').val();
		sisa_hutang 	= $('#sisa_hutang').val();
		tanggal_jatuh_tempo 	= $('#tanggal_jatuh_tempo').val();
		if (jenis_angsuran != '' || dibayar != '' || kode_supplier != '' || jenis_pembayaran != '') {
			$.ajax({
				url: '<?php echo base_url('pembelian/hutang/simpan_angsuran'); ?>',
				type: 'post',
				data:{  kode_transaksi:kode_transaksi,
					kode_unit_jabung:kode_unit_jabung,
					jenis_angsuran:jenis_angsuran,
					dibayar:dibayar,
					kode_supplier:kode_supplier,
					jenis_pembayaran:jenis_pembayaran,
					sisa_hutang:sisa_hutang,tanggal_jatuh_tempo:tanggal_jatuh_tempo},
					beforeSend:function(){
						$(".tunggu").show();
					},
					success: function(hasil){
						$(".tunggu").hide();
						$(".alert_berhasil").show();
						$("#modal-confirm").modal('hide');
						window.location="<?php echo base_url('pembelian/hutang/detail/'.@$kode_supplier); ?>";
					},
				});			
		}else{
			alert('Lengkapi Form ...!');
		}
		return false;

		
	}
</script>
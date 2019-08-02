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

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Pembelian </span>
					<a href="<?php echo base_url('pembelian/pembelian_bb/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Pembelian</a>
					<a href="<?php echo base_url('pembelian/pembelian_bb/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Pembelian</a>
				</div>
				<?php
				$kode_po=paramDecrypt($this->uri->segment(4));
				$this->db->where('kan_suol.transaksi_pembelian.kode_po', $kode_po);
				$this->db->order_by('kan_suol.transaksi_pembelian.id','DESC');
				$this->db->from('kan_suol.transaksi_pembelian');
				$this->db->join('kan_master.master_supplier', 'kan_suol.transaksi_pembelian.kode_supplier = kan_master.master_supplier.kode_supplier');
				$this->db->join('kan_master.master_user', 'kan_suol.transaksi_pembelian.kode_petugas = kan_master.master_user.kode_user');

				$get_transaksi=$this->db->get();
				$hasil_transaksi=$get_transaksi->row();
				?>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-3">
								<h5>Kode Transaksi</h5>
								<input type="text" id="kode_po" value="<?php echo @$hasil_transaksi->kode_po;?>" name="kode_po" class="form-control" readonly>
								<input type="hidden" id="kode_unit_jabung" name="kode_unit_jabung" class="form-control" value="<?php echo @$kode_unit;?>">

							</div>
							<div class="col-md-3">
								<h5>Tanggal Transaksi</h5>
								<input type="date" class="form-control" id="tgl_tr" name="tgl_tr" value="<?php echo @$hasil_transaksi->tanggal_pembelian;?>" readonly>
							</div>
							<div class="col-md-6">
								<h5>Nota Referensi</h5>
								<input type="text" value="<?php echo @$hasil_transaksi->nomor_nota;?>" class="form-control" id="nota" name="nota" readonly placeholder="Nota Referensi">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<h5>Petugas</h5>
								<input type="text" id="petugas" name="petugas" value="<?php echo @$hasil_transaksi->nama_user;?>" class="form-control" readonly>
								<input type="hidden" id="kode_petugas" name="kode_petugas"  class="form-control" readonly>
							</div>
							<div class="col-md-6">
								<h5>Supplier</h5>
								<input type="text" id="supplier" name="supplier" value="<?php echo @$hasil_transaksi->nama_supplier;?>" class="form-control" readonly>
								<input type="hidden" id="kode_supplier" name="kode_supplier"  class="form-control" readonly>
							</div>
						</div><br>
						<table id="" class="table table-striped table-bordered">
							<thead>
								<tr style="background-color: #d3d3d3;">
									<th>No</th>
									<th>Nama Produk</th>
									<th>QTY PO</th>
									<th>QTY Penerimaan</th>
									<th>Harga Satuan</th>
									<th>Subtotal</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 0;
								$master_subtotal = 0;
								$this->db->where('kode_pembelian', @$hasil_transaksi->kode_pembelian);
								$this->db->from('opsi_transaksi_pembelian');
								$get_opsi_po = $this->db->get()->result();
								foreach ($get_opsi_po as $value) { 
									$no++;	
									$get_BB = $this->db_master->get_where('master_bahan_baku', array('kode_bahan_baku' => $value->kode_bahan_baku))->row();
									$subtotal = $value->qty*$value->harga_satuan;
									$master_subtotal = $master_subtotal + $subtotal;
									?>
									<tr>
										<td><?php echo $no ?></td>
										<td><?php echo $get_BB->nama_bahan_baku ?></td>
										<td><?php echo $value->qty_po ?></td>
										<td><?php echo $value->qty ?></td>
										<td class="text-right"><?php echo format_rupiah($value->harga_satuan) ?></td>
										<td class="text-right"><?php echo format_rupiah($subtotal) ?></td>
										
									</tr>  
									<?php 
								} ?>
								<tr>
									<th colspan="4"></th>
									<th>Total</th>
									<th class="text-right"><?php echo format_rupiah($hasil_transaksi->nominal_total) ?></th>
									
								</tr>
								<tr>
									<th colspan="4"></th>
									<th>Diskon (%)</th>
									<th class="text-right" id="diskon_persen_col_text"><?php echo @$hasil_transaksi->persentase_diskon;?> %</th>
								</tr>
								<tr>
									<th colspan="4"></th>
									<th>Diskon (Rp)</th>
									<th class="text-right" id="diskon_rupiah_col_text"><?php echo format_rupiah(@$hasil_transaksi->nominal_diskon) ?></th>  
								</tr>
								<tr>
									<th colspan="4"></th>
									<th>PPN (%)</th>
									<th class="text-right" id="diskon_ppn_col_text"><?php echo @$hasil_transaksi->ppn ?> %</th>  
								</tr>
								<tr>
									<th colspan="4"></th>
									<th>Grand Total</th>
									<th class="text-right" id="grand_total_text"><?php echo format_rupiah(@$hasil_transaksi->nominal_grand_total) ?></th>
								</tr>
							</tbody>
						</table>
						
						<div class="row">
							<div class="col-md-3">
								<h5>Jenis Diskon</h5>
								<select name="jenis_diskon" class="form-control" disabled="" onchange="jenis_diskon_change()" id="jenis_diskon">
									<option <?php if(@$hasil_transaksi->jenis_diskon=='persen'){ echo"selected";}?> value="persen">Persen</option>
									<option <?php if(@$hasil_transaksi->jenis_diskon=='rupiah'){ echo"selected";}?> value="rupiah">Rupiah</option>
								</select>
							</div>
							<div class="col-md-3 ppn">
								<h5>PPN</h5>
								<select name="jenis_ppn" class="form-control" disabled="" onchange="jenis_ppn_change()" id="jenis_ppn" >
									<option <?php if(@$hasil_transaksi->jenis_ppn=='non_ppn'){ echo"selected";}?> value="non_ppn">Non PPN</option>
									<option <?php if(@$hasil_transaksi->jenis_ppn=='ppn'){ echo"selected";}?> value="ppn">PPN</option>
								</select>
							</div>
							<div class="col-md-3">
								<h5>Pembayaran</h5>
								<select name="pembayaran" class="form-control" disabled="" onchange="jenis_pembayaran_change()" id="jenis_pembayaran">
									<option <?php if(@$hasil_transaksi->proses_pembayaran=='cash'){ echo"selected";}?> value="cash">Cash</option>
									<option <?php if(@$hasil_transaksi->proses_pembayaran=='kredit'){ echo"selected";}?> value="kredit">Kredit</option>
								</select>
							</div>
							<div class="col-md-3 kredit" style="display: none">
								<h5>DP</h5>
								<select name="jenis_kredit" class="form-control" disabled="" onchange="jenis_kredit_change()" id="jenis_kredit" >
									<option <?php if(@$hasil_transaksi->jenis_kredit=='dp'){ echo"selected";}?> value="dp">DP</option>
									<option <?php if(@$hasil_transaksi->jenis_kredit=='non_dp'){ echo"selected";}?> value="non_dp">Non DP</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div id="persen">
									<h5>Diskon (%)</h5>
									<input type="text" class="form-control" disabled="" onkeyup="diskon_persen()" id="input_persen" name="input_persen" placeholder="Diskon %" value="<?php echo @$hasil_transaksi->persentase_diskon;?>">
								</div>
								<div id="rupiah" style="display: none">
									<h5>Diskon (Rp)</h5>
									<input type="text" class="form-control" disabled="" onkeyup="diskon_rupiah()" id="input_rupiah" name="input_rupiah" placeholder="Diskon Rp" value="<?php echo @$hasil_transaksi->nominal_diskon;?>">
								</div>
								<input type="hidden" id="persen_jadi">
							</div>
							<div class="col-md-3 ppn" id="bayar_ppn" style="display: none">
								<h5>Bayar PPN</h5>
								<input type="text" class="form-control" id="bayar_ppn_input" name="bayar_ppn" value="<?php echo @$hasil_transaksi->ppn;?>" onkeyup="nominal_ppn()" placeholder="PPN (%)" readonly>
								<div id="nominal_ppn"></div>
							</div>
							<div class="col-md-3 div-ppn">
							</div>
							<div class="col-md-3 kredit" id="jatuh_tempo_box" style="display: none">
								<h5>Jatuh Tempo</h5>
								<input type="date" class="form-control" disabled="" id="jatuh_tempo" name="jatuh_tempo" value="<?php echo @$hasil_transaksi->tanggal_jatuh_tempo;?>">
							</div>							
							<div class="col-md-3 kredit" id="bayar_dp" style="display: none">
								<h5>Bayar DP</h5>
								<input type="text" class="form-control" disabled="" id="bayar_dp" name="bayar_dp" placeholder="Bayar" value="<?php echo @$hasil_transaksi->bayar;?>">
							</div>
						</div><br>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		$('#modal-kode-tr').modal('show');
		$('#modal-kode-tr').modal({backdrop: 'static', keyboard: false})  
		$('.select2').select2();
		jenis_pembayaran_change();
		jenis_diskon_change();
		jenis_ppn_change()
		jenis_kredit_change();
	});


	function jenis_diskon_change(){
		jenis_diskon = $('#jenis_diskon').val();
		if (jenis_diskon == 'rupiah') {
			$('#rupiah').show();
			$('#persen').hide();
			$('#input_persen').val('');
		}else if(jenis_diskon == 'persen'){
			$('#persen').show();
			$('#rupiah').hide();
			$('#input_rupiah').val('');
		}else{
			$('#persen').show();
			$('#rupiah').hide();
			$('#input_rupiah').val('');
			$('#input_persen').val('');
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
		}else{
			$('#grand_total_text').text(toRp(subtotal));
			$('#grand_total').val(subtotal);
			$('#input_persen').val('0');
			$('#diskon_persen_col_text').text(' %');
			$('#diskon_persen_col').val('');
		}
	}

</script>










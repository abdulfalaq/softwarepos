
<!-- back button -->
<a href="<?php echo base_url('stok'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('stok'); ?>">Stok</a></li>
		<li><a href="#">Spoil</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Spoil Barang Dalam Proses</h1>

	<?php $this->load->view('menu_stok'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Spoil </span>
					<a href="<?php echo base_url('stok/spoil_bdp/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Spoil</a>
					<a href="<?php echo base_url('stok/spoil_bdp/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Spoil</a>
				</div>
				<?php
				$get_unit=$this->db->get('setting');
				$hasil_unit=$get_unit->row();
				$kode_spoil=$this->uri->segment(4);

				?>
				<div class="panel-body">
					<form id="data_form">
						<div class="row">
							<div class="col-md-12">
								<a class="btn btn-info"><i class="fa fa-barcode"></i> Kode Spoil : <?php echo @$kode_spoil;?></a>
								<a class="btn btn-info pull-right"><i class="fa fa-calendar"></i> Tanggal Spoil : <?php echo @TanggalIndo(date('Y-m-d'));?></a>
								<input type="hidden" name="kode_spoil" id="kode_spoil" value="<?php echo @$kode_spoil;?>">
								<input type="hidden" name="kode_unit" id="kode_unit" value="<?php echo @$hasil_unit->kode_unit;?>">
								<input type="hidden" name="tanggal_spoil" id="tanggal_spoil" value="<?php echo @date('Y-m-d');?>">
							</div>
						</div>
						<br>
						<div class="col-md-12 row">

							<table id="" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Bahan</th>
										<th>Nama Bahan</th>
										<th>Jumlah</th>
										<th>Jumlah Spoil</th>
										<th>Sisa</th>
										<th>Keterangan</th>
									</tr>
								</thead>
								<tbody>  
									<?php

									$this->db->where('kan_suol.opsi_transaksi_spoil_temp.kode_spoil', @$kode_spoil);
									$this->db->where('kan_suol.opsi_transaksi_spoil_temp.kode_unit_jabung', @$hasil_unit->kode_unit);
									$this->db->where('kan_suol.opsi_transaksi_spoil_temp.jenis_bahan','BDP');
									$this->db->from('kan_suol.opsi_transaksi_spoil_temp');
									$this->db->join('kan_master.master_barang_dalam_proses', 'kan_suol.opsi_transaksi_spoil_temp.kode_bahan = kan_master.master_barang_dalam_proses.kode_barang','left');
									$this->db->join('kan_master.master_satuan', 'kan_master.master_barang_dalam_proses.kode_satuan_stok = kan_master.master_satuan.kode','left');
									$get_opsi_temp=$this->db->get();
									$hasil_opsi_temp=$get_opsi_temp->result();
									$no=1;
									foreach ($hasil_opsi_temp as $opsi) {
										?>
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo @$opsi->kode_bahan;?></td>
											<td><?php echo @$opsi->nama_barang;?></td>
											<td><?php echo @$opsi->real_stok.' '.@$opsi->nama;?></td>
											<td class="text-center">
												<input name="jumlah_spoil_<?php echo @$opsi->kode_bahan;?>" id="jumlah_spoil_<?php echo @$opsi->kode_bahan;?>" type="number" onkeyup="hitung_sisa('<?php echo @$opsi->kode_bahan;?>')" class="form-control jumlah_spoil">
												<input type="hidden" name="real_stok_<?php echo @$opsi->kode_bahan;?>" id="real_stok_<?php echo @$opsi->kode_bahan;?>" value="<?php echo @$opsi->real_stok;?>">
											</td>
											<td><div id="sisa_<?php echo @$opsi->kode_bahan;?>"></div><?php echo @$opsi->nama;?></td>
											<td>
												<input name="keterangan_<?php echo @$opsi->kode_bahan;?>" id="keterangan_<?php echo @$opsi->kode_bahan;?>" type="text" class="form-control">
											</td>
										</tr>
										<?php
									}
									?>  

								</tbody>
							</table>

						</div>
						<div class="col-md-12">
							<a onclick="confirm_spoil()" class="opsi_perencanaan btn btn-no-radius btn-info btn-md pull-right"><i class="fa fa-send"></i> Simpan</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> <!-- //row -->
</div>



<div id="modal-kofirm" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Konfirmasi</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan menyimpan data ini ?</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-success" onclick="simpan_spoil()"><i class="fa fa-send"></i> Simpan</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">

	function hitung_sisa(kode_bahan){
		var jumlah_spoil=$('#jumlah_spoil_'+kode_bahan).val();
		var real_stok=$('#real_stok_'+kode_bahan).val();
		var sisa_stok=real_stok-jumlah_spoil;

		if(jumlah_spoil=='-' || parseInt(jumlah_spoil) < 0){
			alert("Jumlah Spoil Salah ..!");
			$('#jumlah_spoil_'+kode_bahan).val('');
		}else if(parseInt(sisa_stok) < 0){
			alert("Sisa Stok Kurang dari 0 ..!");
			$('#jumlah_spoil_'+kode_bahan).val('');
		}else{
			$('#sisa_'+kode_bahan).html(sisa_stok);
		}
	}

	function confirm_spoil() {
		var total_kosong = 0;
		$('.jumlah_spoil').each(function() {
			var num = this.value;
			if (num=='') {
				total_kosong =total_kosong +1;
			}
		});
		if(total_kosong > 0){
			alert('Lengkapi Form ..!');
		}else{
			$('#modal-kofirm').modal('show');
		}
	}
	function simpan_spoil(){
		var kode_spoil=$('#kode_spoil').val();
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'stok/spoil_bdp/simpan_transaksi_spoil' ?>",  
			cache :false,  
			data :$('#data_form').serialize(),
			beforeSend:function(){
				$(".tunggu").show();
				$('#modal-kofirm').modal('hide');   
			},
			success : function(data) { 
				$(".tunggu").hide();
				$(".alert_berhasil").show();
				setTimeout(function(){
					window.location="<?php echo base_url('stok/spoil_bdp/daftar');?>";
				},1500);
			},  
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
		return false;  
	}
</script>
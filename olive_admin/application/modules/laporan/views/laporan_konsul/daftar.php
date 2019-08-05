
<a href="<?php echo base_url('laporan'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('laporan'); ?>">Laporan</a></li>
		<li><a href="#">Laporan Konsul</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Laporan Konsul</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<br>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Laporan Konsul</span>
					<br>
					<br>
				</div>
				<div class="panel-body">
					<div class="box-body">            
						<div class="sukses" ></div>
						<div class="row">
							<div class="col-md-5" id="">
								<div class="input-group">
									<span class="input-group-addon">Tanggal Awal</span>
									<input type="date" class="form-control tgl" id="tgl_awal">
								</div>
							</div>
							<div class="col-md-5" id="">
								<div class="input-group">
									<span class="input-group-addon">Tanggal Akhir</span>
									<input type="date" class="form-control tgl" id="tgl_akhir">
								</div>
							</div>                        
							<div class="col-md-2 pull-left">
								<button style="margin-left: 5px" type="button" id="cetak_penjualan" class="btn btn-no-radius btn-info pull-right"><i class="fa fa-print"></i> Print</button>
								<a onclick="cari_stok_day()" style="width: 90px" type="button" class="btn btn-warning btn-no-radius pull-right" id="cari"><i class="fa fa-search"></i> Cari</a>
							</div>
						</div>
						<br>

						<br>
						<div class="col-md-12 row" id="load_table">
							
							<table class="table table-striped table-hover table-bordered" id="datatable"  style="font-size:1.0em;">
								<thead>
									<tr>
										<th width="50px;">No</th>
										<th>Kode Member</th>
										<th>Nama Member</th>
										<th>Dokter</th>
										<th>Anamnesa</th>
										<th>Tanggal Konsul</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 0;
									$this->db->from('clouoid1_olive_kasir.data_rekam_medik');
									$this->db->join('clouoid1_olive_master.master_member','clouoid1_olive_master.master_member.kode_member = clouoid1_olive_kasir.data_rekam_medik.kode_member','left');
									$this->db->join('clouoid1_olive_master.master_karyawan','clouoid1_olive_master.master_karyawan.kode_karyawan = clouoid1_olive_kasir.data_rekam_medik.kode_dokter','left');
									$this->db->order_by('clouoid1_olive_kasir.data_rekam_medik.id','DESC');
									$get_rekam_medis = $this->db->get()->result();
									foreach ($get_rekam_medis as $value) { $no++; ?>
									<tr>
										<td><?php echo $no ?></td>
										<td><?php echo $value->kode_member ?></td>
										<td><?php echo $value->nama_member ?></td>
										<td><?php echo $value->anamnesa ?></td>
										<td><?php echo $value->nama_karyawan ?></td>
										<td><?php echo tanggalIndo($value->tanggal_transaksi) ?></td>
									</tr>

									<?php }
									?>
								</tbody>                
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>    
</div>  

<script type="text/javascript">


function cari_stok_day(){
	tgl_awal  = $('#tgl_awal').val();
	tgl_akhir = $('#tgl_akhir').val();

	if (tgl_awal != '' && tgl_akhir != '') {
		$.ajax({
			url: '<?php echo base_url('laporan/laporan_konsul/load_data_cari'); ?>',
			type: 'post',
			data:{tgl_akhir:tgl_akhir,tgl_awal:tgl_awal},
			success: function(hasil){
				$('#load_table').html(hasil);
			}
		});
	}else{
		alert('Harap Mengisi Form.');
	}

}
</script>
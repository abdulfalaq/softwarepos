

<a href="<?php echo base_url('stok_persediaan/daftar'); ?>"><button class="button-back"></button></a>


<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('stok_persediaan'); ?>">Stok Persediaan</a></li>
		<li><a href="#">Detail Stok Persediaan Bahan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1> Detail Stok Persediaan Bahan </h1>
	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-left">
					<span  style="font-size: 24px">Detail Detail Stok Persediaan Bahan</span>
				</div>
				<div class="panel-body">
					<div class="portlet-body">
						<!------------------------------------------------------------------------------------------------------>
						<div class="row">

							<div class="col-md-5" id="">
								<div class="input-group">
									<span class="input-group-addon">Tanggal Awal</span>
									<input type="date" class="form-control tgl"  id="tgl_awal">
								</div>
							</div>
							<div class="col-md-5" id="">
								<div class="input-group">
									<span class="input-group-addon">Tanggal Akhir</span>
									<input type="date" class="form-control tgl" id="tgl_akhir">
								</div>
							</div>                        
							<div class="col-md-1 pull-left">
								<button  type="button" class="btn btn-info btn-no-radius pull-right" id="cari"><i class="fa fa-search"></i> Cari</button>
							</div>
						</div>
						<br>
					</div>

					<table id="datatable" class="table table-striped table-bordered">
						<thead>
							<tr width="100%">
								<th>No</th>
								<th>Tanggal Pembelian</th>
								<th>Nama Bahan</th>
								<th>Jumlah Stok</th>
								<th>Expired Date</th>
							</tr>
						</thead>
						<tbody>    
							<?php 
							$no = 1; 
							$kode = $this->uri->segment(4);
							$this->db->from('transaksi_stok tr_stok');
							$this->db->join('olive_master.master_bahan_baku mbb','tr_stok.kode_bahan = mbb.kode_bahan_baku','left');
							$this->db->order_by('tr_stok.id','DESC');
							$this->db->where('tr_stok.jenis_transaksi','pembelian');
							$this->db->where('tr_stok.kode_bahan',$kode);
							$get_gudang = $this->db->get()->result(); 
							foreach ($get_gudang as $value) { ?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo tanggalIndo($value->tanggal_transaksi) ?></td>
								<td><?php echo $value->nama_bahan_baku ?></td>
								<td><?php echo $value->stok_masuk ?></td>
								<td><?php echo tanggalIndo ($value->expired_date) ?></td>
							</tr>
						</tbody>
						<?php $no++; }
						?>		
					</table>
				</div>
			</div>
		</div>
	</div>
	<br>
</div>
</div>
</div>
</div>
</div>
</div>
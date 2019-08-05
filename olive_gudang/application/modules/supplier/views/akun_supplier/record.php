

<a href="<?php echo base_url('supplier'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('supplier'); ?>">Suplier</a></li>
		<li><a href="<?php echo base_url('supplier/akun_supplier/daftar'); ?>">Akun Supplier</a></li>
		<li><a href="<?php echo base_url('supplier/akun_supplier/detail'); ?>">Detail Supplier</a></li>
		<li><a href="#">Record Transaksi Supplier</a></li>
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
	$this->db->where('kode_supplier',$kode_supplier);
	$get_gudang2 = $this->db->get('clouoid1_olive_master.master_supplier')->row();
	?>	
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right" style="height: 55px">
					<span class="pull-left" style="font-size: 24px">Record Transaksi Supplier</span>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="container" style="margin-left: 10px">
							<div class="row">
								<div class="" role="tabpanel" data-example-id="togglable-tabs">
									<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist" >
										<li role="presentation" class="" id="menu_setting" style="margin-bottom: 20px;">
											<a href="<?php echo base_url('supplier/akun_supplier/detail/'.$get_gudang2->kode_supplier); ?>">Personal Data</a>
										</li>
										<li role="presentation" class="" id="menu_pengajuan" style="margin-bottom: 20px;">
											<a href="<?php echo base_url('supplier/akun_supplier/hutang/'.$get_gudang2->kode_supplier); ?>" >Hutang</a>
										</li>
										<li role="presentation" class="active" id="menu_validasi" style="margin-bottom: 20px;">
											<a href="<?php echo base_url('supplier/akun_supplier/record/'.$get_gudang2->kode_supplier); ?>">Record Transaksi</a>
										</li>
									</ul>
								</div>
							</div>
						</div><br>
						
					</div>
					<div class="box-body">            
						<div class="sukses" ></div>
						<table class="table table-striped table-hover table-bordered" id="datatable" >
							<thead>
								<tr>
									<th>No</th>
									<th>Tanggal</th>
									<th>Kode Transaksi</th>
									<th>Supplier</th>
									<th>Kode Produk</th>
									<th>Nama Produk</th>
									<th>Jumlah</th>
									<th>Harga</th>
									<th>Diskon</th>
									<th>Subtotal</th>
								</tr>
							</thead>
							<tbody id="scroll_data">
								<?php
								$this->db->select('nama_supplier');
								$this->db->select('nama');
								$this->db->select('nama_bahan_baku');
								$this->db->select('nama_perlengkapan');
								$this->db->select('nama_produk');

								$this->db->select('clouoid1_olive_gudang.transaksi_pembelian.tanggal_pembelian');
								$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.kode_pembelian');
								$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.jumlah');
								$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.harga_satuan');
								$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.jenis_diskon');
								$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.diskon_item');
								$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.subtotal');
								$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.kategori_bahan');
								$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.kode_bahan');

								$this->db->where('clouoid1_olive_gudang.transaksi_pembelian.kode_supplier', @$get_gudang2->kode_supplier);
								$this->db->order_by('clouoid1_olive_gudang.opsi_transaksi_pembelian.id', 'desc');
								$this->db->from('clouoid1_olive_gudang.opsi_transaksi_pembelian');
								$this->db->join('clouoid1_olive_gudang.transaksi_pembelian', 'clouoid1_olive_gudang.opsi_transaksi_pembelian.kode_pembelian = clouoid1_olive_gudang.transaksi_pembelian.kode_pembelian', 'left');
								$this->db->join('clouoid1_olive_master.master_bahan_baku', 'clouoid1_olive_gudang.opsi_transaksi_pembelian.kode_bahan = clouoid1_olive_master.master_bahan_baku.kode_bahan_baku', 'left');
								$this->db->join('clouoid1_olive_master.master_produk', 'clouoid1_olive_gudang.opsi_transaksi_pembelian.kode_bahan = clouoid1_olive_master.master_produk.kode_produk', 'left');
								$this->db->join('clouoid1_olive_master.master_perlengkapan', 'clouoid1_olive_gudang.opsi_transaksi_pembelian.kode_bahan = clouoid1_olive_master.master_perlengkapan.kode_perlengkapan', 'left');
								$this->db->join('clouoid1_olive_master.master_satuan', 'clouoid1_olive_gudang.opsi_transaksi_pembelian.kode_satuan = clouoid1_olive_master.master_satuan.kode', 'left');
								$this->db->join('clouoid1_olive_master.master_supplier', 'clouoid1_olive_gudang.transaksi_pembelian.kode_supplier = clouoid1_olive_master.master_supplier.kode_supplier', 'left');
								$data_record=$this->db->get()->result();
								
								$no=1;
								foreach ($data_record as $record) {
									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo @TanggalIndo($record->tanggal_pembelian);?></td>
										<td><?php echo @$record->kode_pembelian;?></td>
										<td><?php echo @$record->nama_supplier;?></td>
										<td><?php echo @$record->kode_bahan;?></td>
										<td>
											<?php 
											if(@$record->kategori_bahan=='bahan baku'){
												echo @$record->nama_bahan_baku;
											}elseif (@$record->kategori_bahan=='produk') {
												echo @$record->nama_produk;
											}elseif (@$record->kategori_bahan=='perlengkapan') {
												echo @$record->nama_perlengkapan;
											}elseif (@$record->kategori_bahan=='kartu member') {
												echo 'kartu member';
											}
											?>  
										</td>
										<td><?php echo $record->jumlah;?></td>
										<td><?php echo @format_rupiah($record->harga_satuan);?></td>
										<td><?php if(@$record->jenis_diskon=='Rupiah'){echo @format_rupiah($record->diskon_item);}else{echo @$record->diskon_item.' %'; }; ?></td>
										<td><?php echo @format_rupiah($record->subtotal);?></td>
									</tr>
									<?php
								}
								?>
								
							</tbody>
						</table>
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
				<input type="hidden" id="kode_peralatan">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>
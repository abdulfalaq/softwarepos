
<!-- back button -->
<a href="<?php echo base_url('pembelian'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>">Pembelian</a></li>
		<li><a href="#">PO Supplier</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>PO Supplier </h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Validasi PO Supplier </span>
					<br><br>
				</div>
				<?php
				$user = $this->session->userdata('astrosession');
				?>
				<?php
				$kode_po=paramDecrypt($this->uri->segment(4));
				$this->db->select('kan_suol.transaksi_po.kode_po, kan_suol.transaksi_po.kode_supplier, kan_suol.transaksi_po.tanggal_input,kan_suol.transaksi_po.tanggal_barang_datang,kan_suol.transaksi_po.status');
				$this->db->select('kan_master.master_user.nama_user');

				$this->db->where('kan_suol.transaksi_po.kode_po',$kode_po);
				$this->db->from('kan_suol.transaksi_po');
				$this->db->join('kan_master.master_user', 'kan_suol.transaksi_po.kode_petugas = kan_master.master_user.kode_user ');
				$get_po = $this->db->get();
				$hasil_po=$get_po->row();
				?>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-2">
							<label>Kode Transaksi</label>
							<input type="text" name="kode_transaksi"  id="kode_transaksi" value="<?php echo @$hasil_po->kode_po;;?>" class="form-control transaksi_po"  readonly="">

						</div>
						<div class="col-md-2">
							<label>Tanggal Transaksi</label>
							<input type="date" name="tanggal_transaksi" id="tanggal_transaksi" value="<?php echo @$hasil_po->tanggal_input;;?>" class="form-control transaksi_po" readonly="">
						</div>
						<div class="col-md-2">
							<label>Operator</label>
							<input type="text" name="operator" id="operator" value="<?php echo @$hasil_po->nama_user; ?>" class="form-control transaksi_po" readonly="">
							<input type="hidden" name="kode_petugas" id="kode_petugas" value="" class="form-control transaksi_po" readonly="">
						</div>
						<div class="col-md-2">
							<label>Supplier</label>
							<select class="form-control transaksi_po" name="kode_supplier" id="kode_supplier" disabled="">
								<option value="">- Pilih Supplier -</option>
								<?php
								$get_supplier=$this->db_master->get('master_supplier');
								$hasil_supplier=$get_supplier->result();
								foreach ($hasil_supplier as $supplier) {
									?>
									<option <?php if(@$hasil_po->kode_supplier==$supplier->kode_supplier){ echo "selected";} ?> value="<?php echo $supplier->kode_supplier?>"><?php echo $supplier->nama_supplier?></option>
									<?php
								}
								?>
							</select>
						</div>
						<div class="col-md-2">
							<label>Tanggal Barang Datang</label>
							<input type="date" name="tanggal_transaksi" id="tanggal_transaksi" value="<?php echo @$hasil_po->tanggal_barang_datang;?>" class="form-control transaksi_po" readonly="">
						</div>
					</div>
					<hr><br>
					
					<br>
					<table id="" class="table table-striped table-bordered ">
						<thead>
							<tr>
								<th width="5%">No</th>
								<th>Nama Bahan</th>
								<th>QTY</th>
								
							</tr>
						</thead>

						<tbody id="data_temp">
							<?php
							$kode_po=paramDecrypt($this->uri->segment(4));
							$this->db->select('kan_suol.opsi_transaksi_po.id, kan_suol.opsi_transaksi_po.qty');
							$this->db->select('kan_master.master_bahan_baku.nama_bahan_baku, kan_master.master_satuan.nama');

							$this->db->where('kan_suol.opsi_transaksi_po.kode_po', $kode_po);
							$this->db->from('kan_suol.opsi_transaksi_po');
							$this->db->join('kan_master.master_bahan_baku', 'kan_suol.opsi_transaksi_po.kode_bahan_baku = kan_master.master_bahan_baku.kode_bahan_baku ');
							$this->db->join('kan_master.master_satuan', 'kan_master.master_bahan_baku.kode_satuan_pembelian = kan_master.master_satuan.kode ');
							$get_opsi_po = $this->db->get();
							$hasil_opsi_po=$get_opsi_po->result();
							$no=1;
							foreach ($hasil_opsi_po as $opsi) {
								?>
								<tr>
									<td><?php echo $no++;?></td>
									<td><?php echo @$opsi->nama_bahan_baku;?></td>
									<td><?php echo @$opsi->qty.' '.@$opsi->nama;?></td>

								</tr>  
								<?php
							}
							?>
						</tbody>
					</table>
					<br>
					<br>
					<div class="col-md-2">
						<label>Status</label>
						<br>
						<?php
						if(@$hasil_po->status=='valid'){
							?>
							<a class="btn btn-icon btn-block waves-effect btn-no-radius waves-light btn-success m-b-5">Valid</a>
							<?php
						}else{
							?>
							<a class="btn btn-icon btn-block waves-effect btn-no-radius waves-light btn-danger m-b-5">Ditolak</a>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- //row -->
</div>

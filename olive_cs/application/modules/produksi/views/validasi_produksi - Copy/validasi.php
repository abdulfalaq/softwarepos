
<!-- back button -->
<a href="<?php echo base_url('admin'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('produksi'); ?>">Produksi</a></li>
		<li><a href="#">Validasi Produk</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Validasi Produksi </h1>
	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Validasi Produksi </span>

					<a href="<?php echo base_url('produksi/validasi_produksi/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Validasi Produksi</a>
				</div>
				<div class="panel-body">
					<form id="data_form" method="post">
						<div class="row">
							<div class="col-md-2 text-right">
								<label>Kode Transaksi</label>
							</div>
							<?php
							$kode_produksi = $this->uri->segment(4);
							$this->db->where('kode_produksi', $kode_produksi);
							$get_produksi = $this->db->get('transaksi_produksi');
							$hasil = $get_produksi->row();
							?>
							<div class="col-md-6">
								<input type="text" readonly="" name="kode_produksi" required id="kode_produksi" value="<?php echo @$hasil->kode_produksi;?>" class="form-control">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2 text-right">
								<label>Tanggal Transaksi</label>
							</div>
							<div class="col-md-6">
								<input type="date" readonly="" name="tanggal_transaksi" required id="tanggal_transaksi" value="<?php echo @$hasil->tanggal_produksi;?>" class="form-control">
							</div>
						</div>
						<hr><br>
						<div class="col-md-12" style="margin-top: 20px;">
							<table id="" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th style="width: 70px;">No</th>
										<th>Produk</th>
										<th>QTY</th>
										<th>Barang Rusak</th>
										<th>Sample Uji</th>
									</tr>
								</thead>

								<tbody id="data_opsi_temp">
									<?php
									$kode_produksi = $this->uri->segment(4);
									$this->db->where('kan_suol.opsi_transaksi_produksi.kode_produksi', $kode_produksi);
									$this->db->from('kan_suol.opsi_transaksi_produksi');
									$this->db->join('kan_master.master_barang_dalam_proses', 'kan_suol.opsi_transaksi_produksi.kode_bahan = kan_master.master_barang_dalam_proses.kode_barang', 'left');
									$this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_produksi.kode_bahan = kan_master.master_produk.kode_produk', 'left');
									$this->db->join('kan_master.master_satuan', 'kan_suol.opsi_transaksi_produksi.kode_satuan = kan_master.master_satuan.kode', 'left');
									$get_opsi = $this->db->get()->result();
									$nomor = 1;  
									$total = 0;

									foreach($get_opsi as $list){ 
										?> 
										<tr>
											<td><?php echo $nomor++; ?></td>
											<td>
												<?php 
												if($list->kategori_bahan == 'Produk'){
													echo $list->nama_produk;
												} else{
													echo $list->nama_barang;
												}
												?>
											</td>
											<td><?php echo @$list->jumlah.' '.$list->alias;?></td>
											<td><?php echo @$list->barang_rusak.' '.$list->alias;?></td>
											<td><?php echo @$list->sample_uji.' '.$list->alias;?></td>
											<input type="hidden" name="id[]" id="id[]" value="<?php echo $list->id_opsi?>">
										</tr>
										<?php } ?>

									</tbody>
								</table>
							</div>
							<!-- ---------------------------------------------------------------------------- -->
							<div class="row">
								<div class="col-sm-12">
									<div class="panel panel-default">
										<div class="panel-heading text-right">
											<span class="pull-left" style="font-size: 20px">DATA UJI</span>
											<br>
										</div>
										<div class="panel-body">
											<div class="row">
												<?php
												$get_setting = $this->db->get('setting');
												$hasil_setting = $get_setting->row();

												$this->db->where('kode_unit_jabung', $hasil_setting->kode_unit);
												$this->db->where('kode_produksi', $kode_produksi);
												$data_uji=$this->db->get('transaksi_produksi');
												$hasil_data_uji=$data_uji->row();
												?>
												<div class="col-md-12">
													<table id="tabel_analisa" class="table table-bordered table-striped" style="width:50%;">
														<tr>
															<td style="text-align: center;width:25%;"><label>Tanggal</label></td>
															<td >
																<input type="text" class="form-control" readonly name="tanggal_uji" id="tanggal_uji" required value="<?php echo tanggalIndo(@$hasil_data_uji->tanggal_uji); ?>" >
															</td>
														</tr>
														<tr>
															<td style="text-align: center;"><label>JENIS SAMPEL</label></td>

															<td><input type="text"  name="jenis_sampel" class='form-control' id="jenis_sampel" value="<?php echo @$hasil_data_uji->jenis_sample; ?>" readonly required placeholder="Jenis sampel" /></td>

														</tr>              
													</table>
												</div>
												<div class="col-md-12" id="tabel_temp_uji">

													<label>HASIL ANALISA :</label>

													<?php
													$get_setting = $this->db->get('setting');
													$hasil_setting = $get_setting->row();

													$this->db->where('kode_unit_jabung', $hasil_setting->kode_unit);
													$this->db->where('kode_produksi', $kode_produksi);
													$analisa=$this->db->get('opsi_transaksi_produksi');
													$hasil_analisa=$analisa->result();

													$this->db->where('kan_suol.opsi_transaksi_produksi.kode_produksi', $kode_produksi);
													$this->db->from('kan_suol.opsi_transaksi_produksi');
													$this->db->join('kan_master.master_barang_dalam_proses', 'kan_suol.opsi_transaksi_produksi.kode_bahan = kan_master.master_barang_dalam_proses.kode_barang', 'left');
													$this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_produksi.kode_bahan = kan_master.master_produk.kode_produk', 'left');
													$get_nama_produk = $this->db->get()->result();
													?>

													<table id="tabel_hasil_analisa" class="table table-bordered table-striped" style="<?php if(count($get_nama_produk) > 5){ echo "display:block;";}?> overflow-x:auto; ">
														<tr>
															<?php
															foreach ($get_nama_produk as $nama) {
																?>
																<th colspan="3" style="text-align: center;">
																	<label>
																		<?php if($nama->kategori_bahan == 'Produk'){
																			echo $nama->nama_produk;
																		} else{
																			echo $nama->nama_barang;
																		};?>

																	</label>
																</th>
																<?php } ?>
															</tr>

															<tr>
																<?php
																foreach ($hasil_analisa as $item) {
																	?>
																	<td width="200px"><label>PH</label></td>
																	<td style="text-align: center;" width="1%" ><label>:</label></td> 
																	<td><label><input style="width:100px" type="text" class='form-control' name="ph_<?php echo $item->kode_bahan;?>" value="<?php echo $item->ph;?>" required placeholder="PH" /></label></td> 
																	<?php
																}
																?>
															</tr>
															<tr>
																<?php
																foreach ($hasil_analisa as $item) {
																	?>
																	<td width="200px"><label>FAT</label></td>
																	<td style="text-align: center;" width="1%" ><label>:</label></td> 
																	<td><label><input style="width:100px" type="text" class='form-control' name="fat_<?php echo $item->kode_bahan;?>" value="<?php echo $item->fat;?>" required placeholder="FAT" /></label></td> 
																	<?php
																}
																?>
															</tr>
															<tr> 
																<?php
																foreach ($hasil_analisa as $item) {
																	?>
																	<td width="200px"><label>Protein</label></td>
																	<td style="text-align: center;" width="1%" ><label>:</label></td> 
																	<td><label><input style="width:100px" type="text" class='form-control' name="protein_<?php echo $item->kode_bahan;?>" value="<?php echo $item->protein;?>" required placeholder="Protein" /></label></td> 
																	<?php
																}
																?>
															</tr>
															<tr>
																<?php
																foreach ($hasil_analisa as $item) {
																	?>
																	<td width="200px"><label>Keasaman</label></td>
																	<td style="text-align: center;" width="1%" ><label>:</label></td> 
																	<td><label><input style="width:100px" type="text" class='form-control' name="keasaman_<?php echo $item->kode_bahan;?>" value="<?php echo $item->keasaman;?>" required placeholder="Keasaman" /></label></td> 
																	<?php
																}
																?>
															</tr>
															<tr> 
																<?php
																foreach ($hasil_analisa as $item) {
																	?>
																	<td width="200px"><label>Coliform</label></td>
																	<td style="text-align: center;" width="1%" ><label>:</label></td> 
																	<td><label><input style="width:100px" type="text" class='form-control' name="coliform_<?php echo $item->kode_bahan;?>" value="<?php echo $item->coliform;?>" required placeholder="Coliform" /></label></td> 
																	<?php
																}
																?>
															</tr>
															<tr>
																<?php
																foreach ($hasil_analisa as $item) {
																	?>
																	<td width="200px"><label>Reduktase</label></td>
																	<td style="text-align: center;" width="1%" ><label>:</label></td> 
																	<td><label><input style="width:100px" type="text" class='form-control' name="reduktase_<?php echo $item->kode_bahan;?>" value="<?php echo $item->reduktase;?>" required placeholder="Reduktase" /></label></td> 
																	<?php
																}
																?>
															</tr>
															<tr> 
																<?php
																foreach ($hasil_analisa as $item) {
																	?>
																	<td width="200px"><label>TPC</label></td>
																	<td style="text-align: center;" width="1%" ><label>:</label></td> 
																	<td><label><input style="width:100px" type="text" class='form-control' name="tpc_<?php echo $item->kode_bahan;?>" value="<?php echo $item->tpc;?>" required placeholder="TPC" /></label></td> 
																	<?php
																}
																?>
															</tr>
															<tr> 
																<?php
																foreach ($hasil_analisa as $item) {
																	?>
																	<td width="200px"><label>Alkohol</label></td>
																	<td style="text-align: center;" width="1%" ><label>:</label></td> 
																	<td><label><input style="width:100px" type="text" class='form-control' name="alkohol_<?php echo $item->kode_bahan;?>" value="<?php echo $item->alkohol;?>" required placeholder="Alkohol" /></label></td> 
																	<?php
																}
																?>
															</tr>
															<tr>
																<?php
																foreach ($hasil_analisa as $item) {
																	?>
																	<td width="200px"><label>BJ</label></td>
																	<td style="text-align: center;" width="1%" ><label>:</label></td> 
																	<td><label><input style="width:100px" type="text" class='form-control' name="bj_<?php echo $item->kode_bahan;?>" value="<?php echo $item->bj;?>" required placeholder="BJ" /></label></td> 
																	<?php
																}
																?>
															</tr>
														</table>

													</div>
													<div class="col-md-12">

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- ---------------------------------------------------------------------------- -->

								<div class="row">
									<div class="col-sm-12">
										<div class="panel panel-default">
											<div class="panel-heading text-right">
												<span class="pull-left" style="font-size: 20px">RELEASE PRODUCT</span>
												<br>
											</div>
											<div class="panel-body">
												<div class="row">
													<div class="col-md-12" id="tabel_temp_rilis_produk">
														<?php
														$get_setting = $this->db->get('setting');
														$hasil_setting = $get_setting->row();

														$this->db->where('kode_unit_jabung', $hasil_setting->kode_unit);
														$this->db->where('kode_produksi', $kode_produksi);
														$release=$this->db->get('opsi_transaksi_produksi');
														$hasil_release=$release->result();

														foreach ($hasil_release as $item_release) {
															?>
															<label>RELEASE PRODUCT</label>
															<table id="tabel_release_produk" class="table table-bordered table-striped" style="">
																<tr>
																	<td style="text-align: center;"><label>Status</label></td>

																	<td colspan="3">
																		<select id="" name="<?php echo "status_rilis".$item_release->id_opsi; ?>"  class="form-control <?php echo "status_rilis".$item_release->id_opsi; ?>" required>
																			<option value="">-- Status -- </option>
																			<option value="NORMAL">NORMAL</option>
																			<option value="HOT SHIPMENT">HOT SHIPMENT</option>
																			<option value="EXCEPTIONAL RELEASE">EXCEPTIONAL RELEASE</option>
																		</select>
																	</td>
																</tr>
																<tr>
																	<td style="text-align: center;width:25%;"><label>Tanggal</label></td>
																	<td colspan="3">
																		<div class="input-group">
																			<input type="date" class="form-control" name="tanggal_rilis_<?php echo @$item_release->kode_bahan;?>" required id="tanggal" value="<?php echo @$item_release->tanggal_rilis; ?>" >
																			<span class="input-group-btn">
																				<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
																			</span>
																		</div>
																	</td>
																</tr>
																<tr>
																	<?php
																	$this->db->where('kan_suol.opsi_transaksi_produksi.kode_produksi', $kode_produksi);
																	$this->db->where('kan_suol.opsi_transaksi_produksi.kode_bahan', $item_release->kode_bahan);
																	$this->db->from('kan_suol.opsi_transaksi_produksi');
																	$this->db->join('kan_master.master_barang_dalam_proses', 'kan_suol.opsi_transaksi_produksi.kode_bahan = kan_master.master_barang_dalam_proses.kode_barang', 'left');
																	$this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_produksi.kode_bahan = kan_master.master_produk.kode_produk', 'left');
																	$nama_produk_release = $this->db->get()->row();
																	?>
																	<td style="text-align: center;"><label>Produk</label></td>
																	<td colspan="3" ><input type="text" name="produk_<?php echo @$item_release->kode_bahan;?>" value="<?php if($nama_produk_release->kategori_bahan == 'Produk'){ echo $nama_produk_release->nama_produk; } else{ echo $nama_produk_release->nama_barang; };?>" class='form-control' id="produk" required placeholder="produk" /></td>
																</tr> 
																<tr>
																	<td style="text-align: center;width:25%;"><label>Tanggal Produksi</label></td>
																	<td colspan="3" >
																		<div class="input-group">
																			<input type="date" class="form-control" name="tanggal_produksi_<?php echo @$item_release->kode_bahan;?>" id="tanggal_produksi" value="<?php echo @$item_release->tanggal_produksi; ?>" required>
																			<span class="input-group-btn">
																				<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
																			</span>
																		</div>
																	</td>
																</tr>
																<tr>
																	<td style="text-align: center;width:25%;"><label>Tanggal Exprd</label></td>
																	<td colspan="3" >
																		<div class="input-group">
																			<input type="date" class="form-control" name="tanggal_exprd_<?php echo @$item_release->kode_bahan;?>" id="tanggal_exprd" value="<?php echo @$item_release->tanggal_expired; ?>" required>
																			<span class="input-group-btn">
																				<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
																			</span>
																		</div>
																	</td>
																</tr>
																<tr >
																	<td rowspan="2" style="text-align: center;"><label>REVIEW CRITERIA</label></td>
																	<td colspan="3" style="text-align: center;"><label><div id="header_rilis_<?php echo @$item_release->kode_bahan;?>"></div></label></td>

																</tr> 
																<tr>
																	<td style="text-align: center;width:5%; "><label>Yes</label></td>
																	<td style="text-align: center;width:5%;"><label>No</label></td>
																	<td style="text-align: center;"><label>Remarks</label></td>


																</tr>             
																<tr>
																	<td style="text-align: center;"><label>1.Spesifikasi Bahan Baku</label></td>
																	<td style="text-align: center;width:5%; "><label><input type="radio" name="nilai_bahan_<?php echo $item_release->kode_bahan;?>" value="Yes" <?php if($item_release->spesifikasi_bb=='Yes'){ echo "checked";}?> > </label></td>
																	<td style="text-align: center;width:5%; "><label><input type="radio" name="nilai_bahan_<?php echo $item_release->kode_bahan;?>" value="No" <?php if($item_release->spesifikasi_bb=='No'){ echo "checked";}?> > </label></td>
																	<td style="text-align: center;"><input type="text" name="spbb_<?php echo @$item_release->kode_bahan;?>" value="<?php echo @$item_release->remark_spesifikasi_bb; ?>" class='form-control' id="spbb"  required/></td>
																</tr> 
																<tr>
																	<td style="text-align: center;"><label>2.Spesifikasi Kemasan</label></td>
																	<td style="text-align: center;width:5%; "><label><input type="radio" name="nilai_kemasan_<?php echo $item_release->kode_bahan;?>" value="Yes" <?php if($item_release->spesifikasi_kemasan=='Yes'){ echo "checked";}?> > </label></td>
																	<td style="text-align: center;width:5%; "><label><input type="radio" name="nilai_kemasan_<?php echo $item_release->kode_bahan;?>" value="No" <?php if($item_release->spesifikasi_kemasan=='No'){ echo "checked";}?> > </label></td>
																	<td style="text-align: center;"><input type="text" name="spk_<?php echo @$item_release->kode_bahan;?>" value="<?php echo @$item_release->remark_spesifikasi_kemasan; ?>" class='form-control' id="spk"  required/></td>
																</tr> 
																<tr>
																	<td style="text-align: center;"><label>3.Kesesuaian Prosedur Proses</label></td>
																	<td style="text-align: center;width:5%; "><label><input type="radio" name="nilai_prosedur_<?php echo $item_release->kode_bahan;?>" value="Yes" <?php if($item_release->kpp=='Yes'){ echo "checked";}?> > </label></td>
																	<td style="text-align: center;width:5%; "><label><input type="radio" name="nilai_prosedur_<?php echo $item_release->kode_bahan;?>" value="No" <?php if($item_release->kpp=='No'){ echo "checked";}?> > </label></td>
																	<td style="text-align: center;"><input type="text" name="kpp_<?php echo @$item_release->kode_bahan;?>" value="<?php echo @$item_release->remark_kpp; ?>" class='form-control' id="kpp"  required/></td>
																</tr> 
																<tr>
																	<td style="text-align: center;"><label>4.Hasil Analisa</label></td>
																	<td style="text-align: center;width:5%; "><label><input type="radio" name="nilai_hasil_analisa_<?php echo $item_release->kode_bahan;?>" value="Yes" <?php if($item_release->hasil_analisa=='Yes'){ echo "checked";}?> > </label></td>
																	<td style="text-align: center;width:5%; "><label><input type="radio" name="nilai_hasil_analisa_<?php echo $item_release->kode_bahan;?>" value="No" <?php if($item_release->hasil_analisa=='No'){ echo "checked";}?> > </label></td>
																	<td style="text-align: center;"><input type="text" name="ha_<?php echo @$item_release->kode_bahan;?>" value="<?php echo @$item_release->remark_hasil_analisa; ?>" class='form-control' id="ha" required /></td>
																</tr> 

															</table>

															<table id="tabel_problem" class="table table-bordered table-striped" style="">
																<tr>
																	<td colspan="3" style="text-align: center;"><label>Kegagalan Produksi</label></td>
																</tr>
																<tr>
																	<td style="text-align: center;width:10%;"><label>#</label></td>
																	<td style="text-align: center;"><label>PROBLEM</label></td>
																	<td style="text-align: center;"><span class="glyphicon glyphicon-ok"></span></td>
																</tr>
																<?php
																$proble_str=explode("|", $item_release->kegagalan_produksi);
																?>
																<tr>
																	<td style="text-align: center;width:10%;"><label>1.</label></td>
																	<td ><label>Listrik Padam</label></td>
																	<td style="text-align: center;"><input type="checkbox" value="Listrik Padam" name="listrik_padam_<?php echo @$item_release->kode_bahan;?>" <?php if(@$proble_str[0]=='Listrik Padam'){ echo "checked";}?> ></td>

																</tr>
																<tr>
																	<td style="text-align: center;width:10%;"><label>2.</label></td>
																	<td  style="text-align: center;"><label>TABEL PERALATAN</label></td>
																	<td style="text-align: center;"></td>
																</tr>
																<tr>
																	<td style="text-align: center;width:10%;"><label>a.</label></td>
																	<td style=""><label>Voltage Turun</label></td>
																	<td style="text-align: center;"><input type="checkbox" value="Voltage Turun" name="voltage_turun_<?php echo @$item_release->kode_bahan;?>" <?php if(@$proble_str[1]=='Voltage Turun'){ echo "checked";}?> ></td>
																</tr>
																<tr>
																	<td style="text-align: center;width:10%;"><label>b.</label></td>
																	<td style=""><label>Pompa Susah</label></td>
																	<td style="text-align: center;"><input type="checkbox" value="Pompa Susah" name="pompa_susah_<?php echo @$item_release->kode_bahan;?>" <?php if(@$proble_str[2]=='Pompa Susah'){ echo "checked";}?> ></td>
																</tr> 
																<tr>
																	<td style="text-align: center;width:10%;"><label>c.</label></td>
																	<td style=""><label>Kompresor Bermasalah</label></td>
																	<td style="text-align: center;"><input type="checkbox" value="Kompresor Bermasalah" name="kompresor_bermasalah_<?php echo @$item_release->kode_bahan;?>" <?php if(@$proble_str[3]=='Kompresor Bermasalah'){ echo "checked";}?> ></td>
																</tr>
																<tr>
																	<td style="text-align: center;width:10%;"><label>d.</label></td>
																	<td style=""><label>Mesin Packing</label></td>
																	<td style="text-align: center;"><input type="checkbox" value="Mesin Packing" name="mesin_packing_<?php echo @$item_release->kode_bahan;?>" <?php if(@$proble_str[4]=='Mesin Packing'){ echo "checked";}?> ></td>
																</tr>              
															</table>
															<?php } ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- ---------------------------------------------------------------------------- -->

									<div class="col-md-12">
										<button type="submit" class="opsi_perencanaan btn btn-lg btn-no-radius btn-info btn-md pull-right"><i class="fa fa-send"></i> Simpan</button>
									</div>
								</form>
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
							<h4 class="modal-title" style="color:#fff;">Konfirmasi Validasi Produksi</h4>
						</div>
						<div class="modal-body">
							<span style="font-weight:bold; font-size:12pt">Apakah anda yakin memvalidasi produksi?</span>
							<input id="id-delete" type="hidden">
						</div>
						<div class="modal-footer" style="background-color:#eee">
							<button class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
							<button onclick="simpan_validasi()"  class="btn green">Ya</button>
						</div>
					</div>
				</div>
			</div>

			<script type="text/javascript">

			$('#data_form').submit(function(){
				$("#modal-confirm").modal('show');
				return false;
			});

			function simpan_validasi(){
				$.ajax({
					url: '<?php echo base_url('produksi/validasi_produksi/validasi_status'); ?>',
					type: 'post',
					data: $('#data_form').serialize(),
					beforeSend: function(response){
						$('#modal-confirm').modal('hide');
						$('.tunggu').show();
					},
					success: function(response){
						$('.tunggu').hide();
					// 	$('.alert_berhasil').show();
					// 	setTimeout(function(){
					// 		$('.alert_berhasil').hide();
					// 		window.location="<?php echo base_url('produksi/validasi_produksi');?>";
					// 	},1500);
					}			
				});
			}

			
			</script>
<div id="load_tabel">
	<table id="datatable" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Kode</th>
				<th>Nama</th>
				<th>QTY</th>
				<th>HPP</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody id="tabel_temp_paket">
			<?php
			$data = $this->input->post();
			$this->db->from('clouoid1_olive_master.opsi_master_paket');

			$this->db->select('clouoid1_olive_master.opsi_master_paket.id');
			$this->db->select('clouoid1_olive_master.opsi_master_paket.kode_paket');
			$this->db->select('clouoid1_olive_master.opsi_master_paket.hpp');
			$this->db->select('clouoid1_olive_master.opsi_master_paket.jenis_produk');
			$this->db->select('clouoid1_olive_master.master_produk.nama_produk');
			$this->db->select('clouoid1_olive_master.master_perawatan.nama_perawatan');
			$this->db->select('clouoid1_olive_master.opsi_master_paket.qty');
			$this->db->join('clouoid1_olive_master.master_perawatan',' clouoid1_olive_master.master_perawatan.kode_perawatan = clouoid1_olive_master.opsi_master_paket.kode_treatment','left');
			$this->db->join('clouoid1_olive_master.master_produk',' clouoid1_olive_master.master_produk.kode_produk = clouoid1_olive_master.opsi_master_paket.kode_produk','left');
			$this->db->where('clouoid1_olive_master.opsi_master_paket.kode_paket',$data['kode_paket']);
			$this->db->order_by('clouoid1_olive_master.opsi_master_paket.id','DESC');
			$get_sapi = $this->db->get()->result();

			$hpp=0;
			$no = 0;
			foreach ($get_sapi as $value) { ?>
			<?php 
			$hpp+=@$value->hpp * @$value->qty;
			$no++; ?>
			<tr>
				<th><?= $no ?></th>
				<th><?= $value->kode_paket ?></th>
				<th>
					<?php if($value->jenis_produk == 'treatment'){
						echo ($value->nama_perawatan);
					}else {
						echo ($value->nama_produk);
					}
					?>
				</th>
				<th><?= $value->qty ?></th>
				<th><?= format_rupiah($value->hpp) ?></th>
				<th>
					<a onclick="actEdit('<?php echo $value->id ?>')" style="background-color: #f0ad4e;color:white" class="btn btn-no-radius"><i class="fa fa-pencil"></i></a>
					<a onclick="actDelete('<?php echo $value->id ?>')" style="background-color: #c9302c;color:white" class="btn btn-no-radius"><li class="fa fa-remove"></li></a>
				</th>
			</tr>
			<?php } ?>
		</tbody>
		<tfoot>

		</tfoot>
	</table>
</div>
<script type="text/javascript">
	var hpp='<?php echo $hpp;?>';
	$('#hpp').val(hpp);
</script>
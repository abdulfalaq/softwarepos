<table id="datatable" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>No</th>
			<th>Kode</th>
			<th>Jenis Produk</th>
			<th>Nama</th>
			<th>QTY</th>
			<th>HPP</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id="tabel_temp_paket">
		<?php
		$data = $this->input->post();
		$this->db->from('clouoid1_olive_master.opsi_master_paket_temp');

		$this->db->select('clouoid1_olive_master.opsi_master_paket_temp.hpp');
		$this->db->select('clouoid1_olive_master.opsi_master_paket_temp.kode_paket');
		$this->db->select('clouoid1_olive_master.opsi_master_paket_temp.id');
		$this->db->select('clouoid1_olive_master.opsi_master_paket_temp.jenis_produk');
		$this->db->select('clouoid1_olive_master.opsi_master_paket_temp.qty');
		$this->db->select('clouoid1_olive_master.opsi_master_paket_temp.hpp');
		$this->db->select('clouoid1_olive_master.master_perawatan.nama_perawatan');
		$this->db->select('clouoid1_olive_master.master_produk.nama_produk');

		$this->db->join('clouoid1_olive_master.master_produk',' clouoid1_olive_master.master_produk.kode_produk = clouoid1_olive_master.opsi_master_paket_temp.kode_produk','left');
		$this->db->join('clouoid1_olive_master.master_perawatan',' clouoid1_olive_master.master_perawatan.kode_perawatan = clouoid1_olive_master.opsi_master_paket_temp.kode_treatment','left');
		$this->db->where('clouoid1_olive_master.opsi_master_paket_temp.kode_paket',$data['kode_paket']);
		$this->db->order_by('clouoid1_olive_master.opsi_master_paket_temp.id','DESC');
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
			<th><?= $value->jenis_produk ?></th>
			<th>
				<?php if($value->jenis_produk == 'treatment'){
					echo ($value->nama_perawatan);
				}else if($value->jenis_produk == 'produk') {
					echo ($value->nama_produk);
				}else{
					echo (@$value->nama_perawatan);
					echo (@$value->nama_produk);
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
		<?php 
		$sub_total = $value->qty * $value->hpp;
	}
	?>
</tbody>
</table>
<script type="text/javascript">
	var hpp='<?php echo $hpp;?>';
	$('#hpp').val(hpp);
</script>


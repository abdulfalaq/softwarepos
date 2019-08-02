
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Data Koperasi</a></li>
		<li><a href="#">Produk</a></li>
		<li><a href="#">Simpanan</a></li>
		<li>Tabungan</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
		<h1>Tabungan</h1>

		<?php $this->load->view('menu_setting'); ?>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading text-right">
						<span class="pull-left" style="font-size: 24px">Data Produk Tabungan</span>
						<a href="<?php echo base_url('setting/produk_simpanan_sukarela/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Produk</a>
						<a href="<?php echo base_url('setting/produk_simpanan_sukarela'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Produk</a>
					</div>
					<div class="panel-body">
						<table id="datatables" class="table table-bordered table-blue">
							<thead>
								<tr>
									<th rowspan="2">No</th>
									<th rowspan="2">Nama Produk</th>
									<th rowspan="2">Kode Produk</th>
									<th colspan="2">Jasa Tabungan</th>
									<th rowspan="2">Action</th>
								</tr>
								<tr>
									<th>Tahun</th>
									<th>Hari</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$nomor = 1;
								$this->db->order_by('id','desc');
								$sql = $this->db->get('master_produk_tabungan');
								$result = $sql->result();
								foreach($result as $data){
								?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $data->nama_produk; ?></td>
									<td><?php echo $data->kode_produk; ?></td>
									<td><?php echo $data->jasa_per_tahun; ?>%</td>
									<td><?php echo $data->jasa_per_hari; ?>%</td>
									<td align="center" width="130px">
										<a href="<?php echo base_url('setting/produk_simpanan_sukarela/edit')."/".$data->id; ?>" data-toggle="tooltip" title="Edit" class="btn btn-warning" onclick="edit(<?php echo $data->id; ?>)"><i class="fa fa-edit"></i></a>
										<a href="#" data-toggle="tooltip" title="Hapus" class="btn btn-danger" onclick="hapus('<?php echo $data->id ?>');"><i class="fa fa-trash"></i></a>
									</td>
								</tr>			
								<?php
								$nomor++;
								}
								?>
							</tbody>
						</table>					
					</div>
				</div>
			</div>
		</div> <!-- //row -->
</div>



<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Alert</h4>
      </div>
      <div class="modal-body text-center">
      <input type="hidden" id="secret_id">
        <h2>Anda yakin akan menghapus data ini?</h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
        <button type="button" onclick="act_delete()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
	function hapus(key) {
		$('#modal-hapus').modal('show');
		$('#secret_id').val(key);
	}
	function act_delete(){
		$.ajax({
			url: '<?php echo base_url('setting/produk_simpanan_sukarela/act_delete'); ?>',
			type: 'post',
			data: {id:$('#secret_id').val()},
			success: function(response){
				$('#modal-hapus').modal('hide');
				window.location.href='';
			}			
		});
	}
</script>
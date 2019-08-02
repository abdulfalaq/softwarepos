
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Data Koperasi</a></li>
		<li><a href="#">Produk</a></li>
		<li><a href="#">Simpanan</a></li>
		<li>Simpanan Pokok</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
		<h1>Produk Simpanan Pokok</h1>

		<?php $this->load->view('menu_setting'); ?>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading text-right">
						<span class="pull-left" style="font-size: 24px">Data Produk Simpanan Pokok</span>
						<a href="<?php echo base_url('setting/produk_simpanan_pokok/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Produk</a>
						<a href="<?php echo base_url('setting/produk_simpanan_pokok'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Produk</a>
					</div>
					<div class="panel-body">
						<table id="datatables" class="table table-bordered table-blue">
							<thead>
								<th width="70px">No</th>
								<th>Kode Simpanan</th>
								<th>Nominal</th>
								<th>Tanggal Aktivasi</th>
								<th>Action</th>
							</thead>
							<tbody>
								<?php
								$nomor = 1;
								$this->db->order_by('id','desc');
								$sql = $this->db->get('master_simpanan_pokok');
								$item = $sql->result();
								foreach ($item as $item) {
								?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $item->kode; ?></td>
									<td><?php echo @format_rupiah($item->nominal_simpanan_pokok); ?></td>
									<td><?php echo @tanggalIndo($item->tanggal_aktivasi); ?></td>
									<td align="center" width="100px">
										<a href="<?php echo @base_url('setting/produk_simpanan_pokok/edit')."/".$item->id; ?>" data-toggle="tooltip" title="Edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>
										<a href="#" data-toggle="tooltip" title="Hapus" onclick="hapus(<?php echo $item->id; ?>)" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
      <input type="hidden" id="secret_id" name="id">
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
			url: '<?php echo base_url('setting/produk_simpanan_pokok/act_delete'); ?>',
			type: 'post',
			data: {id:$('#secret_id').val()},
			success: function(response){
				$('#modal-hapus').modal('hide');
				window.location.href='';
			}			
		});
	}
</script>
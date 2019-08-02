
<!-- back button -->
<a href="<?php echo base_url('penjualan'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
		<li><a href="#">Event</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Event</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Event </span>
					<a href="<?php echo base_url('penjualan/event/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Event</a>
					<a href="<?php echo base_url('penjualan/event/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Event</a>
				</div>
				<div class="panel-body">
					<div>
						<table class="table table-bordered table-striped" id="datatable">
							<thead>
								<tr>
									<th >No.</th>
									<th>Tanggal</th>
									<th>Event</th>
									<th>Nama Event</th>
									<th style="width:20%">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$this->db->order_by('id', 'desc');
								$get_event=$this->db->get('transaksi_penjualan_event');
								$hasil_event=$get_event->result();
								$no=1;
								foreach ($hasil_event as $event) {
									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo @TanggalIndo($event->tanggal);?></td>
										<td><?php echo @$event->kode_event;?></td>
										<td><?php echo @$event->nama_event;?></td>
										<td>
											
											<?php if(@$event->status=='proses'){
												?>
												<a href="<?php echo base_url('penjualan/event/input/'.@$event->kode_event); ?>" class="btn btn-warning btn-no-radius btn-md"><i class="fa fa-pencil"></i> Input</a>
												<?php
											}else{
												?>
												<a href="<?php echo base_url('penjualan/event/detail/'.@$event->kode_event); ?>" class="btn btn-info btn-no-radius btn-md"><i class="fa fa-search"></i> Detail</a>
												<?php
											}?>
											
										</td>
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
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
	$(document).ready(function(){
		$('#datatable').dataTable();
	});

	function hapus(key) {
		$('#modal-hapus').modal('show');
	}
</script>
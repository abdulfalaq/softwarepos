<a href="<?php echo base_url('admin/dashboard'); ?>"><button class="button-back"></button></a>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li>Master</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Master</h1>
	<?php $this->load->view('menu_master'); ?>
</div>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>OLIVE KASIR</title>
  <link rel="icon" href="<?php echo base_url(); ?>assets/images/logo_kasir/logo.png" type="image/gif">

  <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/css/astro.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/swal/sweetalert.css" rel="stylesheet" type="text/css" />

  <!--DATATABLE-->
  <link href="<?php echo base_url(); ?>assets/datatables/DataTables-1.10.16/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/datatables/Responsive-2.2.0/css/responsive.bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/datatables/Responsive-2.2.0/css/responsive.dataTables.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/select2/css/select2.css '?>"/>
  <!--//DATATABLE-->


  <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
  <style>
  body{
    overflow-x: hidden;
  }
</style>
</head>

<body> 
  <div class="tunggu" style="z-index:9999999999999999; background:rgba(255,255,255,0.8); width:100%; height:100%; position:fixed; top:0; left:0; text-align:center; padding-top:18%; display: none; " >
    <img src="<?php echo base_url() ?>assets/images/loading.gif"/>
  </div>

  <div class="alert_berhasil" style="z-index:9999999999999999; background:rgba(255,255,255,0.8); width:100%; height:100%; position:fixed; top:0; left:0; text-align:center; padding-top:18%; display: none; " >
    <img src="<?php echo base_url() ?>assets/images/check.png"/>
  </div>
  
  <header class="header">
    <div class="col-sm-4 logo">
      <a href="<?php echo base_url(); ?>">
        <h2><img src="<?php echo base_url(); ?>assets/images/logo_kasir/logo.png" alt="Olive"></h2>
      </a>
    </div>
    <div class="col-sm-8">
      <div class="dropdown pull-right" style="font-family:calibri">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          <i class="fa fa-angle-down"></i> 
          <?php   
          $user     = $this->session->userdata('astrosession');
          echo " ".ucwords($user->uname); 
          ?>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <li><a href="<?php echo base_url('kasir/tutup_kasir'); ?>">Tutup Kasir</a></li>
          <li><a href="<?php echo base_url('admin/logout'); ?>">Log Out</a></li>
        </ul>
      </div>      
    </div>
  </header>
  <div class="push-down clearfix"></div>


  <!-- MAIN CONTENT -->
  <div class="main-content">
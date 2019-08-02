<input type="date" id="jasa_terakhir" value="" style="display: none">
<input type="date" id="tanggal_hari_ini" value="<?php echo date('Y-m-d') ?>" style="display: none">
<div class="container">
  <div class="col-sm-3">
    <a href="<?php echo base_url().'dokter'; ?>">
      <div class="button-menu" data-mh="button-menu">
        <div class="col-xs-3"><img class="pull-left" src="<?php echo base_url(); ?>assets/images/icon/gear.png"></div>
        <div class="col-xs-9"><h3>Dokter</h3></div>
      </div>
    </a>
  </div>
  <div class="clearfix"></div>



  <script type="text/javascript">
    $(document).ready(function(){
      reloader_jasa();
      pembayaran_pajak();
      reloader_penyusutan();
      setInterval(function(){
        reloader_jasa();
        reloader_penyusutan();
        pembayaran_pajak();
      },5000);
    })


  </script>
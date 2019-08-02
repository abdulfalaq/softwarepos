<?php 
$this->db->order_by('id','DESC');
$get_gudang = $this->db->get('transaksi_retur')->result();
$total_retur=count($get_gudang);
?>


<!-- back button -->
<a href="<?php echo base_url('retur'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
    <li><a href="<?php echo base_url('retur'); ?>">Retur</a></li>
    <li><a href="#">Tambah Retur</a></li>
    <li></li>
  </ol>
</div>

<div class="clearfix"></div>

<div class="container">
  <?php $this->load->view('menu_setting'); ?>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading text-right">
          <span class="pull-left" style="font-size: 24px">Retur Pembelian</span>
          <br><br>
        </div>
        <div class="panel-body">
          <a style="padding:13px; margin-bottom:10px;width: 190px" class="btn btn-warning pull-right" ><i class="fa fa-list"></i> Total Transaksi Retur <?php echo $total_retur;?></a> 
          <br><br>
          <div class="box-body">            

            <div class="sukses" ></div>
            <div class="row">
              <br><br>
              <div class="col-md-5" id="">
                <div class="input-group">
                  <span class="input-group-addon">Tanggal Awal</span>
                  <input type="text" class="form-control tgl" id="tgl_awal">
                </div>
              </div>

              <div class="col-md-5" id="">
                <div class="input-group">
                  <span class="input-group-addon">Tanggal Akhir</span>
                  <input type="text" class="form-control tgl" id="tgl_akhir">
                </div>
              </div>                        
              <div class="col-md-2 pull-left">
                <button style="width: 190px" type="button" class="btn btn-success pull-right" id="cari"><i class="fa fa-search"></i> Cari</button>
              </div>
              <br>
              <br>
              <div class="col-sm-12">
                <br>
                <div id="" style="margin-top: 2 0px">
                  <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode Retur</th>
                        <th>Nomor Nota</th>
                        <th>Total Nominal</th>
                        <th>Status Retur</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="cari_transaksi">
                      <?php 
                      $no = 0;
                      foreach ($get_gudang as $value) { 
                        $no++; ?>
                        <tr>
                          <td><?= $no ?></td>
                          <td><?= $value->kode_retur ?></td>
                          <td><?= $value->nomor_nota ?></td>
                          <td><?= $value->total_nominal ?></td>
                          <td><?= $value->status_retur ?></td>
                          <td><?= $value->grand_total ?></td>
                          <td align="center">
                            <a href="<?php echo base_url('retur/tambah_retur/detail/'.$value->kode_retur ) ?>" class="btn btn-primary"><i class="fa fa-search"></i> </a>
                            <?php if(@$value->status_retur=='menunggu'){
                              ?>
                              <a href="<?php echo base_url('retur/tambah_retur/edit/'.$value->kode_retur ) ?>" class="btn btn-danger"><i class="fa fa-pencil"></i> </a>
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
    </div>
  </div>
</div>

<script src="<?php echo base_url();?>component/lib/jquery.min.js"></script>
<script src="<?php echo base_url();?>component/lib/zebra_datepicker.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>component/lib/css/default.css"/>
<script type="text/javascript">

  $('.tgl').Zebra_DatePicker({});


  $('#cari').click(function(){
    var tgl_awal =$("#tgl_awal").val();
    var tgl_akhir =$("#tgl_akhir").val();
    if (tgl_awal=='' || tgl_akhir==''){ 
      alert('Masukan Tanggal Awal & Tanggal Akhir..!')
    }
    else{
      $.ajax( {  
        type :"post",  
        url : "<?php echo base_url()?>retur/tambah_retur/cari_retur",  
        cache :false,
        beforeSend:function(){
          $(".tunggu").show();  
        },  
        data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir},
        beforeSend:function(){
          $(".tunggu").show();  
        },
        success : function(data) {
          $(".tunggu").hide();  
          $("#cari_transaksi").html(data);
        },  
        error : function(data) {  

        }  
      });
    }

  });
</script>

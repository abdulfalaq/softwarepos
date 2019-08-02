
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Data Koperasi</a></li>
		<li><a href="#">Akun</a></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Akun</h1>

	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">


      <form id="data_form"  method="post">
       <fieldset style="margin-bottom: 28px;">
        <legend>Input Akun</legend>
        <div class="col-sm-2">
          <label>Akun</label>
          <input type="hidden" name="id" id="id" />
          <select class="form-control" name="no_akun" id="no_akun">
            <option value="">-- Pilih --</option>
            <option value="101">Pemasukan</option>
            <option value="102">Pengeluaran</option>
          </select>
        </div>
        <div class="col-sm-2">
         <label>No Sub Akun</label>
         <input type="text" name="no_sub_akun" id="no_sub_akun" class="form-control" required="">
       </div>
       <div class="col-sm-3">
        <label>Nama Sub Akun</label>
        <input type="text" name="nama_sub_akun" id="nama_sub_akun" class="form-control" required="">
      </div>
      <div class="col-sm-2">
        <label>Kategori</label>
        <select class="form-control" name="kategori" id="kategori">
          <option value="">-- Pilih --</option>
          <option value="Kas">Kas</option>
          <option value="Aktiva Tetap">Aktiva Tetap</option>
          <option value="Dana-Dana">Dana-Dana</option>
          <option value="Modal">Modal</option>
        </select>
      </div>
      <div class="col-sm-2">
       <label>&nbsp;</label>
       <button type="submit"  style="margin-top: 25px;" class="btn btn-primary" id='btn_simpan'>Simpan</button>
     </div>
   </fieldset>
 </form>

 <?php
 $member = $this->db->get('setting_akun_keuangan');
 $hasil_member = $member->result();
 ?>

 <table id="datatables" class="table table-bordered table-blue">
  <thead>
   <th width="60px">No</th>
   <th>Akun</th>
   <th>No Sub Akun</th>
   <th>Nama Sub Akun</th>
   <th>Kategori</th>
   <th width="100px">Action</th>
 </thead>
 <tbody>
   <?php
   $nomor = 1;

   foreach($hasil_member as $daftar){ ?> 
   <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $daftar->nama_akun; ?></td>
    <td><?php echo $daftar->no_sub_akun; ?></td>
    <td><?php echo $daftar->nama_sub_akun; ?></td>
    <td><?php echo $daftar->kategori; ?></td>
    <td align="center"><?php if(@$daftar->akses!='readonly'){ echo get_edit_delete($daftar->id); } ?></td>
  </tr>
  <?php $nomor++; } ?>
</tbody>

</table>
</div>
</div> <!-- //row -->
</div>

<div id="modal-confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:grey">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title" style="color:#fff;">Konfirmasi Hapus Data</h4>
      </div>
      <div class="modal-body">
        <span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan menghapus data tersebut ?</span>
        <input id="id-delete" type="hidden">
      </div>
      <div class="modal-footer" style="background-color:#eee">
        <button class="btn green" data-dismiss="modal" aria-hidden="true">Tidak</button>
        <button onclick="delData()" class="btn red">Ya</button>
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
		$('#update_btn').hide();
	});

	function update() {
		$('#simpan_btn').hide();
		$('#update_btn').show();
	}

	function hapus(key) {
		$('#modal-hapus').modal('show');
	}

	$('#update_btn').click(function(){
		$('#update_btn').hide();
		$('#simpan_btn').show();
	});
</script>

<script type="text/javascript">
	$(function () {
      //jika tombol Send diklik maka kirimkan data_form ke url berikut
      $("#data_form").submit( function() { 
       var id= $('#id').val(); 
       if(id!=""){
        var url ="<?php echo base_url() . 'setting/setting_akun_keuangan/simpan_edit'; ?>";
      }else{
       var url = "<?php echo base_url() . 'setting/setting_akun_keuangan/simpan_tambah'; ?>";
     }

     $.ajax( {  
      type :"post", 
      url:url,
      cache :false,  
      data :$(this).serialize(),
      beforeSend:function(){
        $(".tunggu").show();  
      },
      success : function(data) { 
        $('#id').val(''); 
        $(".tunggu").hide();  
        if(data ==1){
          $(".sukses").html(data); 
          $(".sukses").html('<div class="alert alert-success">Data Berhasil Disimpan</div>');  
          setTimeout(function(){$('.sukses').html('');
            window.location.reload();},1000); 
        }
        else{

          $(".sukses").html(data);
        }

      },  
      error : function() {  
        alert("Data gagal dimasukkan.");  
      }  
    });
     return false;                          
   });   

    });

  function actEdit(Object) {
    var id = Object;
    var url = '<?php echo base_url().'setting/setting_akun_keuangan/get_edit'; ?>';
    $.ajax({
      type: "POST",
      url: url,
      data: {
        id: id
      },
      dataType:'json',
      success: function(msg) {
        $('#id').val(msg.id);
        $('#no_akun').val(msg.no_akun);
        $('#no_sub_akun').val(msg.no_sub_akun);
        $('#no_sub_akun').attr('readonly',true);
        $('#no_akun').attr('disabled',true);
        $('#nama_sub_akun').val(msg.nama_sub_akun);
        $('#kategori').val(msg.kategori);
        $('#btn_simpan').html("Edit");
      },
    });
  }
  function actDelete(Object) {
    $('#id-delete').val(Object);
    $('#modal-confirm').modal('show');
  }
  function delData() {
    var id = $('#id-delete').val();
    var url = '<?php echo base_url().'setting/setting_akun_keuangan/hapus'; ?>';
    $.ajax({
      type: "POST",
      url: url,
      data: {
        id: id
      },
      success: function(msg) {
        $('#modal-confirm').modal('hide');
            // alert(id);
            window.location.reload();
          }
        });
    return false;
  }

  $(".ngeload").click(function(){
    if(parseInt($(".pagenum").val()) <= parseInt($(".rowcount").val())) {
      var pagenum = parseInt($(".pagenum").val()) + 1;
      $(".pagenum").val(pagenum);
      load_table(pagenum);
    }
  })


  function load_table(page){
    $.ajax({
      type: "POST",
      url: "<?php echo base_url() . 'setting/setting_akun_keuangan/get_daftar_supplier' ?>",
      data: ({  page:$(".pagenum").val()}),
      beforeSend: function(){
        $(".tunggu").show();  
      },
      success: function(msg)
      {
        $(".tunggu").hide();
        $("#scroll_data").append(msg);

      }
    });
  }

</script>
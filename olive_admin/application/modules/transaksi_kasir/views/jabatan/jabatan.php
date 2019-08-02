
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Data Koperasi</a></li>
		<li><a href="#">Kepengurusan</a></li>
		<li>Jabatan</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Jabatan</h1>

	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">

			<?php
			$param = $this->uri->segment(4);
        //echo $param;
			if(!empty($param)){
				$supplier = $this->db->get_where('master_jabatan',array('id'=>$param));
				$hasil_data = $supplier->row();
          //echo $hasil_bahan_baku->kode_barang;
			}    
			?>

      <form id="data_form"  method="post">
       <fieldset style="margin-bottom: 28px;">
        <legend>Input Jabatan</legend>
        <div class="col-sm-5">
          <label>Kode Jabatan</label>
          <input type="hidden" name="id" value="<?php echo @$hasil_data->id ?>" />

          <?php
          $this->db->select_max('id');
          $get_max_bahan_baku = $this->db->get('master_jabatan');
          $max_bahan_baku = $get_max_bahan_baku->row();

          $this->db->where('id', $max_bahan_baku->id);
          $get_bahan_baku = $this->db->get('master_jabatan');
          $bahan_baku = $get_bahan_baku->row();
          $nomor = substr(@$bahan_baku->kode_jabatan, 3);

                // $ambil_setting = $this->db->get('master_setting');
                // $hasil_setting = $ambil_setting->row();
                // $ks = $hasil_setting->kode_jabatan;

          $nomor = $nomor + 1;
          $string = strlen($nomor);
          if($string == 1){
            $kode_jabatan = 'J'.'000'.$nomor;
          } else if($string == 2){
            $kode_jabatan = 'J'.'00'.$nomor;
          } else if($string == 3){
            $kode_jabatan = 'J'.'_0'.$nomor;
          } else if($string == 4){
            $kode_jabatan = 'J'.'BB_'.$nomor;
          } 
          ?>   

          <input readonly type="text" class="form-control"  value="<?php if(!empty($uri)){echo @$hasil_data->kode_jabatan; }else{ echo $kode_jabatan;} ?>"   name="kode_jabatan" id="kode_jabatan" />
        </div>
        <div class="col-sm-5">
         <label>Nama Jabatan</label>
         <input type="hidden" name="id" id="id" />
         <input type="text" name="nama_jabatan" id="nama_jabatan" class="form-control" required="">
       </div>
       <div class="col-sm-2">
         <label>&nbsp;</label>
         <!-- <button type="submit" id="btn_simpan" class="btn btn-block btn-danger"><i class="fa fa-plus"></i> SIMPAN</button> -->
         <button type="submit"  style="margin-top: 25px;" class="btn btn-primary" id='btn_simpan'>Simpan</button>

         <!-- <button type="submit" id="update_btn" class="btn btn-block btn-warning"><i class="fa fa-edit"></i> UPDATE</button> -->
       </div>
     </fieldset>
   </form>

   <?php
   $this->db->limit(25,0);
   $this->db->order_by('kode_jabatan',"desc");
   $member = $this->db->get('master_jabatan');
   $hasil_member = $member->result();
   ?>

   <table id="datatables" class="table table-bordered table-blue">
    <thead>
     <th width="60px">No</th>
     <th>Kode Jabatan</th>
     <th>Nama Jabatan</th>
     <th width="100px">Action</th>
   </thead>
   <tbody>
     <?php
     $nomor = 1;

     foreach($hasil_member as $daftar){ ?> 
     <tr>
      <td><?php echo $nomor; ?></td>
      <td><?php echo $daftar->kode_jabatan; ?></td>
      <td><?php echo $daftar->nama_jabatan; ?></td>
      <td align="center">
        <a onclick="actEdit('<?php echo $daftar->id; ?>')" class="btn btn-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
        <a onclick="actDelete('<?php echo $daftar->id; ?>')" class="btn btn-danger" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></a>

      </td>

						<!-- <td align="center">
							<button onclick="update(0)" type="button" class="btn btn-warning" data-toggle="tooltip" title="Update"><i class="fa fa-edit"></i></button>
							<button onclick="hapus(0)" type="button" class="btn btn-danger" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></button>
						</td> -->
					</tr>
				</tbody>
				<?php $nomor++; } ?>
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
        var url ="<?php echo base_url() . 'setting/kepengurusan_jabatan/simpan_edit'; ?>";
      }else{
       var url = "<?php echo base_url() . 'setting/kepengurusan_jabatan/simpan_tambah'; ?>";
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
        // data=parseInt(data); 
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
    var url = '<?php echo base_url().'setting/kepengurusan_jabatan/get_edit'; ?>';
    $.ajax({
      type: "POST",
      url: url,
      data: {
        id: id
      },
      dataType:'json',
      success: function(msg) {
        $('#id').val(msg.id);
        $('#kode_jabatan').val(msg.kode_jabatan);
        $('#nama_jabatan').val(msg.nama_jabatan);
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
    var url = '<?php echo base_url().'setting/kepengurusan_jabatan/hapus'; ?>';
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

  function actDelete(Object) {
    $('#id-delete').val(Object);
    $('#modal-confirm').modal('show');
  }
  function delData() {
    var id = $('#id-delete').val();
    var url = '<?php echo base_url().'setting/kepengurusan_jabatan/hapus'; ?>';
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
      url: "<?php echo base_url() . 'setting/kepengurusan_jabatan/get_daftar_supplier' ?>",
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
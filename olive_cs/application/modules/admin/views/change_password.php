<?php
$user = $this->session->userdata('astrosession');
$id = $user->id;
?>

<script type="text/javascript">
$(function () {  
    $('form input').on('keypress', function(e) {
      return e.which !== 13;
    });  

  $(".select2").select2();

  $("#data_form").submit( function() {    
    $.ajax( {  
      type :"post",  
      url : "<?php echo base_url() . 'admin/simpan_change_password' ?>",  
      cache :false,  
      data :$(this).serialize(),
       beforeSend:function(){
          $(".tunggu").show();  
        },
 success : function(data) {  
        $(".sukses").html(data);   
        setTimeout(function(){$('.sukses').html('');window.location = "<?php echo base_url() . 'admin' ?>";},1500);              
      },  
      error : function() {  
        alert("Data gagal dimasukkan.");  
      }  
    });
    return false;          
  });   

});
</script>


<div class="">
  <div class="page-content">
    
      <div class="row">      

        <div class="col-xs-12">
          <!-- /.box -->
          <div class="portlet box blue">
            <div class="portlet-title">
              <div class="caption">
                CHANGE PASSWORD
              </div>
              <div class="tools">
                <a href="javascript:;" class="collapse">
                </a>
                <a href="javascript:;" class="reload">
                </a>                
              </div>
            </div>
            <div class="portlet-body">

              <!------------------------------------------------------------------------------------------------------>             

              <div class="box-body">            
                <div id="toast-container" class="toast-top-right sukses" aria-live="polite" role="alert"></div>
                <form method="post" id="data_form"> 

                  <table class="table table-striped table-hover" border="0">

                    <tr>
                      <td width="80">New Password</td>
                      <td width="10">:</td>
                      <td width="450">
                        <input type="hidden" name="id" id="no_lab" class="form-control" value="<?php echo $id ?>" />
                        <input type="password" name="pass_baru" id="no_lab" class="form-control" required />
                      </td>
                    </tr>                      

                  </tbody>                
                </table>
                <div class="box-footer clearfix">
                  <button type="submit" class="pull-right btn btn-default" id="sendEmail">Change <i class="fa fa-arrow-circle-right"></i></button>
                </div>
              </form>
            </div>

            <!------------------------------------------------------------------------------------------------------>

          </div>
        </div>
      </div><!-- /.col -->
    </div>
  </div>    
</div>  

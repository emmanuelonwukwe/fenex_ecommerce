<?php
  function showMsg($msg, $msgtype){
    switch($msgtype){
      case 1: ?>
        <!--success alert iv-->
        <div class="alert alert-success alert-dismissible">
          <a href="#" onclick="$('.alert').fadeOut(1000)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Great!</strong>
          <?php echo $msg ; ?>
        </div>

      <!--warning alert div-->
      <?php
        break;
        case 2: 
      ?>
      <div class="alert alert-danger alert-dismissible">
        <a href="#" onclick="$('.alert').hide(1000)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error!</strong>
        <?php echo $msg ; ?>
      </div>

    <?php break; } //end of switch 
  } 
?>


<?php function ajaxDemo($id){ ?>
  <div class="ajax-demo container text-center" style=background:skyblue>
    <p id="ajax-loader<?= $id ?>" ><span class="fa fa-spin"><i class='fa fa-globe'></i></span></p>
    <p id="ajax-error<?= $id ?>" style="color:maroon;font-weight:bold" ></p>
    <p id="ajax-success<?= $id ?>" style=color:green;font-weight:bold >@if(Session::has('success')) {{  Session::get('success')}} @endif</p>
  </div>
<?php } ?>
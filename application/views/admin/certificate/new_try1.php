<!DOCTYPE html>
<html>
<head>
  <title>Certificate-Create</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ; ?>">
      <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ; ?>"></script>

    <!-- jQuery 3 -->
    <script src="<?= base_url('assets/') ?>jquery/dist/jquery.min.js"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('assets/') ?>jquery-ui/jquery-ui.min.js"></script>
    <style type="text/css">
      .name{
        position:absolute;font-size: 14px;
      }
    </style>
</head>
<body>
  <div class="row" style="height: 100vh;"  >
    <div class="col-3" style="height: 100vh;background-color: #ccc">
        <div class="p-3" >
          <a class="btn btn-outline-warning" >Back</a>
          <hr>
          <form>
            <div class="form-group">
              <label>
                Select file
              </label>
              <input type="file" class="form-control-file" id="selectImg" name="">
            </div>
            <hr>
            <div class="form-group">
              <label>
                Name
              </label>
              <input type="number" class="form-control" id="size" min="14" name="">
            </div>
          </form>
        </div>
    </div>
    <div class="col-9" style="height: 100vh;" >
      <br>
        <div  class="d-flex" style="width: 800px; height:500px;background-color: #f0f0f0;" >
            <img src=""  id="certy"  style="width: 800px; height:500px;">
            <p id="name" class="name" >Name</p>
        </div>
    </div>
  </div>




  <script type="text/javascript">
      $(document).ready(() =>{
        $('#selectImg').change(function() {
          readURL(this);
        });
      });

      function readURL(input) {
      // alert("hello"); return false;
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        // $('#certy').css('background-image', `url('{e.target.result}')`);
        $('#certy').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
    }
  }

      $('#size').change(()=>{
        var resize = new Array('p','.name');
        let fontSize = $('#size').val()+'px !important';
        // alert(fontSize);
        // $('.name').css('font-size',fontSize);
        document.getElementById("name").style.fontSize = fontSize ;
        // $('.name').html('working');
      });
  </script>
</body>
</html>
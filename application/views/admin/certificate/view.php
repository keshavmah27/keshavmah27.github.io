<?php
// var_dump($data->certi_name_to) ;
// $topName;
if($data->certi_name_to > 0){
	$topName = (int)$data->certi_name_to - 10;
}
if($data->certi_name_left > 0){
	$leftName = (int)$data->certi_name_left -20;
}
if($data->certi_url_top>0){
	$urlTop = (int)$data->certi_url_top- 10;
}
if($data->certi_url_left>0){
	$urlLeft = (int)$data->certi_url_left - 20;
}
if($data->certi_id_top > 0){
	$idTop = (int)$data->certi_id_top -10;
}
if($data->certi_id_left > 0){
	$idLeft = (int)$data->certi_id_left -20;
}
if($data->include_class == '1'){
	if($data->certi_class_top > 0){
		$classTop = (int)$data->certi_class_top -10;
	}
	if($data->certi_class_left > 0){
		$classLeft = (int)$data->certi_class_left -20;
	}
}
// var_dump($top);
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		View Certification
	</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<style type="text/css">
	*{
		margin: 0;
		padding: 0;
	}
	body{
		width: 100vw;
		height: 100vh;
		overflow: auto;
	}
</style>
</head>
<body >
	<div class="" style="width: 800px; height:500px;" id="printarea">
		 <img src="<?php echo base_url('uploads/custom_certifications/').$data->certi_image; ?>"  id="certy"  style="width: 800px; height:500px;">
		<div style="width: 800px; position: absolute !important; font-size: <?= $data->certi_name_size.'px'?>; top: <?= $topName.'px'?>; left: <?= $leftName.'px'?>; color: <?= $data->certi_name_color ?>; font-style: normal;font-family: <?= $data->certi_name_font ?>;text-align: <?= $data->certi_name_align.'!important' ?>;">Test Name</div>
		<div style="width: 800px; position: absolute !important; font-size: <?= $data->certi_url_size.'px'?>; top: <?= $urlTop.'px'?>; left: <?= $urlLeft.'px'?>; color: <?= $data->certi_url_color ?>; font-family: <?= $data->certi_url_font ?>;" >Https://about.me</div>
		<div style="width: 800px; position: absolute !important; font-size: <?= $data->certi_id_size.'px'?>; top: <?= $idTop.'px'?>; left: <?= $idLeft.'px'?>; color: <?= $data->certi_id_color ?>; font-family: <?= $data->certi_id_font ?>;" >xxxxxxx</div> 
		<?php if($data->include_class == '1'){ ?>
		<div style="width: 800px; position: absolute !important; font-size: <?= $data->certi_class_size.'px'?>; top: <?= $classTop.'px'?>; left: <?= $classLeft.'px'?>; color: <?= $data->certi_class_color ?>; font-family: <?= $data->certi_class_font ?>;text-align: <?= $data->certi_class_align.'!important' ?>;" >class</div> 
		<?php } ?>
	</div>
	<br>
	<br>
	<div class="text-center">
		<button class="btn btn-primary" onclick="printPageArea('printarea');" >Save</button>
	</div>
	<script type="text/javascript">
		
		function printPageArea(areaID){
		    var printContent = document.getElementById(areaID);
		    var WinPrint = window.open('', '', 'width=900,height=650');
		    WinPrint.document.write(printContent.innerHTML);
		    WinPrint.document.close();
		    WinPrint.focus();
		    WinPrint.print();
		    WinPrint.close();
		}
	</script>
</body>
</html>
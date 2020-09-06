<?php 
	$controller = $this->uri->segment(1);
	$function = $this->uri->segment(2)	
?>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="<?php echo base_url('Certification/upload'); ?>" <?php if($function == 'upload'){ echo 'style="color:white;"'; }?> >Upload Certifications</a>
  <a href="<?php echo base_url('Certification'); ?>" <?php if($controller == 'Certification' && $function == '' ){ echo 'style="color:white;"'; } ?> >View Certifications</a>
  <a href="#">Share Certifications</a>
  <a href="<?php echo base_url('Certification/request'); ?>" <?php if($function == 'request'){ echo 'style="color:white;"'; }?> >Request Certifications</a>
  <a href="#">Contact</a>
</div>
<br>

<?php $this->load->view('layouts/slidebar') ?>
<div class="container mt-3 mb-3" >
	<h3>Edit Certifications
		<button class="btn btn-primary" onclick="openNav()" style="font-size:20px;cursor:pointer;float: right;">&#9776; Menu</button></h3>
</div>
<hr>
<div class="container mb-5" style="min-height: 70vh;" >
	<form id="certification_edit_form" action="<?php echo base_url('Certification/update') ?>" method="post" enctype="multipart/form-data" >
		<input type="hidden" name="id" value="<?php echo $certi->id; ?>" >
	     <div class="form-group" >
	     	<label>Certification Name</label>
	     	<input type="text" name="name" class="form-control" value="<?php echo $certi->certi_name; ?>" >
	     </div> 
	      <div class="form-group" >
	     	<label>Issueing organization</label>
	     	<input type="text" name="organization" class="form-control" value="<?php echo $certi->organization; ?>"  >
	     </div> 
	     <div class="row" >
	     	<div class="form-group col-sm-6" >
		     	<label>Issue date</label>
	     		<input type="date" name="issue" class="form-control" value="<?php echo $certi->issue; ?>" >
	     	</div>
	     <!-- </div> -->
	     	<div class="form-group col-sm-6" >
		     	<label>Expiration date</label>
	     		<input type="date" name="expire" class="form-control" value="<?php echo $certi->expire; ?>" >
	     	</div>
	     </div>
	     <div class="form-group" >
	     	<label>Credential ID</label>
	     	<input type="text" name="cred_id" class="form-control" value="<?php echo $certi->cred_id; ?>" >
	     </div> 
	      <div class="form-group" >
	     	<label>Credential URL</label>
	     	<input type="text" name="cred_url" class="form-control" value="<?php echo $certi->cred_url; ?>" >
	     </div> 
	      <div class="form-group" >
	     	<label>Image</label>
	     	<input type="file" name="image" class="form-control" >
	     	<br>
	     	<img src="<?php echo base_url('uploads/user_certifications/thumb/').$certi->image ?>" width="500" height="300">
	     </div> 
	     <div class="form-group" >
	     	<input type="submit" name="" class="btn btn-primary" value="Submit">
	     </div>
	 </form>	
</div>
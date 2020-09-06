<?php $this->load->view('layouts/slidebar') ?>
<div class="container mt-3 mb-3" >
	<h3>Upload certifications
		<button class="btn btn-primary" onclick="openNav()" style="font-size:20px;cursor:pointer;float: right;">&#9776; Menu</button></h3>
</div>
<hr>
<div class="container mb-5" style="min-height: 70vh;" >
	<form id="certification_form" action="<?php echo base_url('Certification/create') ?>" method="post" enctype="multipart/form-data" >
	     <div class="form-group" >
	     	<label>Certification Name</label>
	     	<input type="text" name="name" class="form-control" >
	     </div> 
	      <div class="form-group" >
	     	<label>Issueing organization</label>
	     	<input type="text" name="organization" class="form-control" >
	     </div> 
	     <div class="row" >
	     	<div class="form-group col-sm-6" >
		     	<label>Issue date</label>
	     		<input type="date" name="issue" class="form-control" >
	     	</div>
	     <!-- </div> -->
	     	<div class="form-group col-sm-6" >
		     	<label>Expiration date</label>
	     		<input type="date" name="expire" class="form-control" >
	     	</div>
	     </div>
	     <div class="form-group" >
	     	<label>Credential ID</label>
	     	<input type="text" name="cred_id" class="form-control" >
	     </div> 
	      <div class="form-group" >
	     	<label>Credential URL</label>
	     	<input type="text" name="cred_url" class="form-control" >
	     </div> 
	      <div class="form-group" >
	     	<label>Image</label>
	     	<input type="file" name="image" class="form-control" >
	     </div> 
	     <div class="form-group" >
	     	<input type="submit" name="" class="btn btn-primary" value="Submit">
	     </div>
	 </form>	
     <hr>
</div>
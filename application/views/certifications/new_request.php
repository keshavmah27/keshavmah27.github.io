<?php $this->load->view('layouts/slidebar') ?>
<div class="container mt-3 mb-3" >
	<h3>New Certifications Request
		<button class="btn btn-primary" onclick="openNav()" style="font-size:20px;cursor:pointer;float: right;">&#9776; Menu</button></h3>
</div>
<hr>
<div class="container mb-5" style="min-height: 50vh;" >
	<?php if($this->session->flashdata('success')){ ?>
		<div class="alert alert-success" >
			<p class="text-success" >
		   		<?php echo $this->session->flashdata('success'); ?>
			</p>
		</div>
	<?php }else if($this->session->flashdata('error')){  ?>
		<div class="alert alert-danger" >
			<p class="text-danger" >
	    		<?php echo $this->session->flashdata('error'); ?>
	    	</p>
		</div>
	<?php }else if($this->session->flashdata('warning')){  ?>
		<div class="alert alert-warning" >
			<p class="text-warning" >
	    		<?php echo $this->session->flashdata('warning'); ?>
	    	</p>
		</div>
	<?php }else if($this->session->flashdata('info')){  ?>
		<div class="alert alert-info" >
			<p class="text-info" >
		    	<?php echo $this->session->flashdata('info'); ?>
		    </p>
		</div>
	<?php } ?>

	<div class="container">
		<a href="javascript:void(0)" ><small>Click for more info <span class="primary-color" >(i)</span></small></a>
		<form action="<?= base_url('Certification/createRequest') ?>" method="post" enctype="multipart/form-data" id="requestForm" >
			<div class="col-sm-12 form-group" >
				<label for="spreed_sheet" >Spreed sheet (csv or excel)</label>
				<input type="file" class="form-control-file"  name="sheet">
			</div>
			<hr>
			<fieldset class="container" >
					<div class="col-sm-12 form-group" >
						<label for="spreed_sheet" >Certificate Photo</label>
						<input type="file" class="form-control-file"  name="certi_photo">
					</div>
					<div class="text-dark col-sm-12 text-center">
						Or
					</div>
					<div class="col-sm-12 form-group" >
						<label>Select our certification</label>
					</div>
			</fieldset>
			<hr>
			<div class="col-sm-12 form-group" >
				<label for="message" >Message</label>
				<textarea class="form-control" placeholder="Enter your message here for more requirement...." name="message" ></textarea>			
			</div>
			<div class="col-sm-12 form-group" >
				<button type="submit" class="btn btn-primary" >Raise Request</button>
			</div>
		</form>
	</div>
</div>
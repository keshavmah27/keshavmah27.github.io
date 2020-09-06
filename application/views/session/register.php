<?php $this->load->view('session/header'); ?>

	<div class="row view-body" >
		<div class="col-md-6 col-lg-6 primary" align="center">
			<img src="https://cdni.iconscout.com/illustration/premium/thumb/free-registration-desk-1886554-1598085.png" style="padding: 50px;" >
		</div>
		<div class="col-md-6 col-lg-6" align="center" >
			<div class="col-sm-6 center" >
				<h4>Create a new account</h4>
				<hr>
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
				<form method="post" action="<?php echo base_url('User/createUser') ?>" id="registerForm" >
					<div class="form-group">
						<input type="text" name="fname" required placeholder="First name" class="form-control" >
					</div>
					<div class="form-group">
						<input type="text" name="lname" required placeholder="Last name" class="form-control" >
					</div>
					<div class="form-group">
						<input type="email" name="email" required placeholder="Email address" class="form-control" >
					</div>
					<div class="form-group">
						<input type="password" name="password" id="password" required placeholder="Password" class="form-control" >
					</div>
					<div class="form-group">
						<input type="password" name="cnf_password" required placeholder="Confirm password" class="form-control" >
					</div>
					<div class="form-group" align="left">
						<div class="form-check">
						    <input type="checkbox" class="form-check-input" id="exampleCheck1">
						    <label class="form-check-label" for="exampleCheck1">Privacy policy and Term & Conditions</label>
						</div>
					</div>
					<div class="form-group">
						<input type="submit" value="Register" class="btn btn-primary form-control" >
					</div>
				</form>
				<a href="<?php echo base_url('User/login');?>"><i>Already have an account.</i></a>
			</div>
		</div>
	</div>

<?php $this->load->view('session/footer'); ?>
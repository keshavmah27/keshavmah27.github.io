<?php $this->load->view('session/header'); ?>

	<div class="row view-body" >
		<div class="col-md-6 col-lg-6 primary" align="center">
			<img src="https://cdn0.iconfinder.com/data/icons/ordergan-mobile-activity/1440/Icon_illustration_E-commerce_Desktop_Login-512.png" style="padding: 50px;" >
		</div>
		<div class="col-md-6 col-lg-6" align="center" >
			<div class="col-sm-6 center" >
				<h4>Sign in</h4>
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
				<form  id="createSession" method="post" action="<?php echo base_url('User/createSession') ?>" >
					<div class="form-group">
						<input type="email" name="email" placeholder="Email address" value="<?= get_cookie('email_certy') ?>" class="form-control" >
					</div>
					<div class="form-group">
						<input type="password" name="password" placeholder="Password" value="<?=  get_cookie('password_certy') ?>" class="form-control" >
					</div>
					<div class="form-group" align="left">
						<div class="form-check">
						    <input type="checkbox" name="remember" <?php if(get_cookie('email_certy')) echo 'checked'; ?> class="form-check-input" id="exampleCheck1">
						    <label class="form-check-label" for="exampleCheck1">Remember me</label>
						</div>
					</div>
					<div class="form-group">
						<input type="submit" value="Login" class="btn btn-primary form-control" >
					</div>
					<div class="form-group" align="right" >
						<a href="" >Forgot password</a>
					</div>
				</form>
				<a href="<?php echo base_url('User/register');?>"><i>Create a new account.</i></a>
			</div>
		</div>
	</div>

<?php $this->load->view('session/footer'); ?>
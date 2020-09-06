<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ; ?>">
</head>
<body>
	<div class="row" >
		<div class="col-6 offset-3 border mt-5 p-2 rounded" >
			<form action="<?php echo base_url('admin/Login/signIn');?>"  method="post" >
				<div class="" >
					<h2 class="text-center" >Admin Login</h2>
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
					<hr>
					<div class="row align-middle">
						<div class="form-group col-sm-3 text-center ">
							<label class="" >Email Address</label>
						</div>
						<div class="form-group col-sm-9" >
							<input type="email" required class="form-control" value="<?= get_cookie('email_admin') ?>"  name="email">
						</div>
					</div>
					<div class="row align-middle ">
						<div class="form-group col-sm-3 text-center">
							<label class="" >Password</label>
						</div>
						<div class="form-group col-sm-9" >
							<input type="password" required class="form-control" value="<?=  get_cookie('password_admin') ?>" name="password">
						</div>
					</div>
					<div class="container form-group" align="left">
						<div class="form-check">
						    <input type="checkbox" name="remember" <?php if(get_cookie('email_admin')) echo 'checked'; ?> class="form-check-input" id="exampleCheck1">
						    <label class="form-check-label" for="exampleCheck1">Remember me</label>
						</div>
					</div>
					<hr>
					<div class="row form-group ">
						<div class="col-12 ml-3">
							<button type="submit" class="btn btn-primary" >Login</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>
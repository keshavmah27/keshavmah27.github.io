<?php $this->load->view('layouts/slidebar') ?>
<div class="container mt-3 mb-3" >
	<h3>  Certification Details
		<button class="btn btn-primary" onclick="openNav()" style="font-size:20px;cursor:pointer;float: right;">&#9776; Menu</button></h3>
</div>
<hr>
<div class="container mb-5" style="min-height: 70vh;" >

	<div class="row mb-3" >
		<div class="col-sm-6" >
			<b>
				Certification Name :
			</b>  <?php echo $certi->certi_name; ?>
		</div>
		<div class="col-sm-6" >
			<b>
				Organization :
			</b>  <?php echo $certi->organization; ?>
		</div>
	</div>
	<div class="row mb-3">	
		<div class="col-sm-6" >
			<b>
				Name on certificate :
			</b>  <?php echo $_SESSION['user_session']->fname.' '.$_SESSION['user_session']->lname; ?>
		</div>
		<div class="col-sm-6" >
			<b>
				Credential Id :
			</b>  <?php echo $certi->cred_id; ?>
		</div>
	</div>
	<div class="row mb-3">	
		<div class="col-sm-12" >
			<b>
				Credential Url :
			</b>  <a href="<?php echo $certi->cred_url;?>"><?php echo $certi->cred_url;?></a>
		</div>
	</div>
	<div class="row mb-3" >
		<div class="col-sm-6" >
			<b>
				Issuing Date :
			</b>  <?php echo date('Y F, d',strtotime($certi->issue)); ?>
		</div>
		<div class="col-sm-6" >
			<b>
				Expiry Date :
			</b>  <?php if(!empty($certi->expire)) {echo date('Y F, d',strtotime($certi->expire));}else{
				echo "Not Expire";
			} ?>
		</div>
	</div>
	<div class="row mb-3" >
		<div class="col-sm-12" >
			<b>
				Certificate Image :
			</b>
		</div>
		<br>
		<div class="col-sm-6" >
			<img src="<?php echo base_url('uploads/user_certifications/thumb/').$certi->image ?>" width="500" height="300">
		</div>
		<div class="col-sm-6" >
			<br><br>
			<a class="btn text-white" style="background-color: #09788a" ><i class="fa fa-linkedin" ></i> &nbsp;Share on linkedin</a> <br><br>
			<a class="btn btn-info text-white" ><i class="fa fa-twitter" ></i> &nbsp;Share on twitter</a>
			<br><br>
			<a class="btn btn-primary text-white" ><i class="fa fa-facebook" ></i> &nbsp;Share on facebook</a>
		</div>
	</div>
</div>
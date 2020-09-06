<?php $this->load->view('layouts/slidebar') ?>
<div class="container mt-3 mb-3" >
	<h3>Certifications
		<button class="btn btn-primary" onclick="openNav()" style="font-size:20px;cursor:pointer;float: right;">&#9776; Menu</button></h3>
</div>
<hr>
<div class="container mb-5" style="min-height: 70vh;" >
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
	<table id="myTable" class="table-bordered" > 
		<thead>
			<th>Id</th>
			<th>Image</th>
			<th>Certification Name</th>
			<th>Organization</th>
			<th>Status</th>
			<th>Cerdential ID</th>
			<th>Cerdential Url</th>
			<th>Action</th>
		</thead>
		<tbody>
			<?php 
				$i= 1;
			foreach ($certies as $key => $value) {
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><img src="<?php echo base_url('uploads/user_certifications/thumb/').$value->image ?>" width="100" height="100" ></td>
				<td><?php echo $value->certi_name ?></td>
				<td><?php echo $value->organization ?></td>
				<td><?php  $status = strtotime($value->expire) >= strtotime(date('y-m-d'))? true: false; ?> 		<?php if($status){
						echo "<p class='badge bg-success text-white' >Active</p>";
					}else{
						echo "<p class='badge bg-danger text-white' >Expired</p>";
					} ?> 
				</td>
				<td><?php echo $value->cred_id ?></td>
				<td><a href="<?php echo $value->cred_url ?>">View</a></td>
				<td><a class="btn btn-secondary btn-sm text-white" href="<?php echo base_url('Certification/edit/').$value->id; ?>" ><i class="fa fa-pencil " ></i></a>&nbsp;<a class="btn btn-success btn-sm text-white" href="<?php echo base_url('Certification/view/').$value->id; ?>" ><i class="fa fa-eye " ></i></a>
					&nbsp;<a class="btn btn-danger btn-sm text-white" href="<?php echo base_url('Certification/delete/').$value->id; ?>" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash " ></i></a>
				</td>
			</tr>
			<?php	
				} 
			?>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	$(document).ready( function () {
	    $('#myTable').DataTable();
	} );
</script>
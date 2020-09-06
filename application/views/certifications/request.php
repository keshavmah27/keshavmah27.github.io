<?php $this->load->view('layouts/slidebar') ?>
<div class="container mt-3 mb-3" >
	<h3>Certifications Request
		<button class="btn btn-primary" onclick="openNav()" style="font-size:20px;cursor:pointer;float: right;">&#9776; Menu</button></h3>
</div>
<hr>
<div class="container mb-5" style="min-height: 70vh;" >
	<a href="<?= base_url('Certification/newRequest') ?>" class="btn btn-success mb-3 text-white" >Create New Request</a>
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
	<?php #print_r($data);?>
	<table id="myTable" class="table-bordered" > 
		<thead>
			<th>Id</th>
			<th>Requset Id</th>
			<th>certificate image</th>
			<th>Status</th>
			<th>Sheet</th>
			<th>Message</th>
			<th>Action</th>
		</thead>
		<tbody>
			<?php 
			$i= 1;
			foreach ($data as $key => $value) {
			?>
			<tr>
				<td><?= $i ?></td>
				<td><?= $value->req_id ?></td>
				<td>
					<?php   
						if($value->certi_photo){
					?>
							<img src="<?= base_url('uploads/custom_certifications/').$value->certi_photo ?>" width='150' height='100' style="object-fit: cover" >
							<?php
						}else{
						?>
							<img src="<?= base_url('assets/images/no_image.png')?>" width='150' height='100' style="object-fit: cover" >
					<?php }
					?>
				</td>
				<td>
					<?php  
						if($value->status == '0'){
							echo '<span class="badge bg-warning text-white" ><small>Pending</small></span>';
						}else if($value->status == '1'){
							echo '<span class="badge bg-success text-white" ><small>Completed</small></span>';
						}
						else if($value->status == '3'){
							echo '<span class="badge bg-danger text-white" ><small>Canceled</small></span>';
						}else{
							echo '<span class="badge bg-secondary text-white" ><small>Something wrong!</small></span>';
						}
					?>
				</td>
				<td>
					<a  href="<?=  base_url('uploads/sheets/').$value->sheet ?>" >View Sheet</a>
				</td>
				<td>
					<?= $value->message ?>
				</td>
				<td>
					<a href="<?= base_url('Certification/cancelRequest/').$value->req_id ?>" class="btn btn-danger btn-sm" ><i class="fa fa-minus-circle fa-fw" ></i>Cancel</a>
				</td>
			</tr>
			<?php	
			$i++;
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
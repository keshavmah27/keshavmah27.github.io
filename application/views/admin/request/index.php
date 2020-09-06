  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- header -->
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Request Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Request Management</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- header end -->

    <section class="content">
      <div class="container">
        <div class="card p-4  table-responsive">
           <table id="myTable" class="table table-bordered" > 
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
							<a class="btn btn-warning btn-sm" onclick="setId(<?= $value->id ?>);"  data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-pencil fa-fw" ></i>Change status</a>
							<a class="btn btn-info btn-sm" href="<?= base_url('admin/Request/view/').$value->req_id ?>"><i class="fa fa-microchip fa-fw" ></i>Process</a>
						</td>
					</tr>
					<?php	
					$i++;
						} 
					?>
				</tbody>
			</table>
     	</div>
      </div>
    </section>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop"  data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="staticBackdropLabel">Change status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?= base_url('admin/Request/changeStatus') ?>" >
	      <div class="modal-body">
	        <div class="container">
	        	<div class="card p-4">
	        		<u>Change status to</u>
	        		<br>
	        		<input type="hidden" id="certy_id" value="" name="c_id">
	        		<select class="form-control" name="status" placeholder="Select status" >
	        			<option>Select Status</option>
	        			<option value="1" >Completed</option>
	        			<option value="0" >In Progress</option>
	        			<option value="2" >Failed</option>
	        			<option value="3" >Canceled</option>
	        		</select>
	        	</div>
	        </div>
	      </div>
	      <div class="modal-footer bg-dark">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Change</button>
	      </div>
      </form>
    </div>
  </div>
</div>

</div>

<script type="text/javascript">
  $(document).ready( function () {
      $('#myTable').DataTable();
  } );
  let setId = (id) =>{
  	// alert(id);
  	$('#certy_id').val(id);
  }
</script>



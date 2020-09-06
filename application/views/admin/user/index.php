<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- header -->
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">User Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Management</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- header end -->

    <section class="content">
    	<div class="container-fluid mb-2">
    		<a href="<?php echo base_url('admin/User/new') ?>" class="btn btn-primary" target="_blank" >Create User</a>
    	</div>
      <div class="container">
        <div class="card p-4">
            <table id="myTable" class="table table-hover table-stripe" >
            <thead>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Type</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php $i=1; foreach ($data as $key => $value) {?>
                <tr>
                  <td><?= $i ?></td>
                  <td><?= $value->fname.' '.$value->lname ?></td>
                  <td><?= $value->email ?></td>
                  <td><?php if($value->role == '0'){ echo 'Normal User'; }else{ echo 'Organiser'; } ?></td>
                  <td>
                  	<a class="btn text-white btn-info btn-sm" ><i class="fa fa-eye fa-fw" ></i></a>&nbsp;<a class="btn text-white btn-warning btn-sm" ><i class="fa fa-pencil fa-fw" ></i></a>&nbsp;
                  	<a class="btn text-white btn-danger btn-sm" ><i class="fa fa-trash fa-fw" ></i></a></td>
                </tr>
              <?php $i++; } ?>
            </tbody>
        </table>
      </div>
      </div>
        
      
    </section>

</div>
  <!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready( function () {
      $('#myTable').DataTable();
  } );
</script>
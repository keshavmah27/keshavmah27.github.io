  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- header -->
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Certificate Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Certificate Management</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- header end -->

    <section class="content">
    	<div class="container-fluid mb-2">
    		<a href="<?php echo base_url('admin/Certificate/new') ?>" class="btn btn-primary" target="_blank" >Create new</a>
    	</div>
      <div class="container">
        <div class="card p-4">
            <table id="myTable" class="table table-hover table-stripe" >
            <thead>
              <th>ID</th>
              <th>Cid</th>
              <th>Type</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php $i=1; foreach ($data as $key => $value) {?>
                <tr>
                  <td><?= $i ?></td>
                  <td><?= $value->cid ?? 'N/A' ?></td>
                  <td><?php if($value->details_create_for == '0'){ echo 'Created By Us.'; }else{ echo 'Created by Org.'; } ?></td>
                  <td>
                    <?php if($value->req_id) {?>
                      <a href="<?= base_url('admin/Certificate/view2/').$value->id ?>" target="_blank" class="btn btn-sm btn-outline-info"><i class="fa fa-eye fa-fw" ></i>View</a>
                    <?php  } else{ ?>
                      <a href="<?= base_url('admin/Certificate/view/').$value->id ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye fa-fw" ></i>View</a>
                    <?php } ?>
                    <a class="btn btn-sm btn-outline-danger" href="<?= base_url('admin/Certificate/deleteCerty/').$value->id ?>"><i class="fa fa-trash" ></i></a>
                  </td>
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
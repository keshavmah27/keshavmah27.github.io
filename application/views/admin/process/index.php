  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
		<!-- header -->
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Generate Certificate</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Make Process</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- header end -->

    <section class="content">
    	<div class="card col-sm-6 p-5 offset-sm-3" >
    		<form action="<?= base_url('admin/CertificateCreate/processRequest') ?>" method="post" >
	    		<input type="" class="form-control" required name="req_id" placeholder="Enter Request Id">
	    		<br>
	    		<button class="btn btn-success"  type="submit" >Process</button>
    		</form>
    	</div>
    </section>
</div>
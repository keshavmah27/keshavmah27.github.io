<?php $this->load->view('layouts/slidebar') ?>
<div class="container mt-3 mb-3" >
    <h3>Dashboard
        <button class="btn btn-primary" onclick="openNav()" style="font-size:20px;cursor:pointer;float: right;">&#9776; Menu</button></h3>
</div>
<hr>
	<!-- <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span> -->
	<div class="container" style="min-height: 70vh;" >
	   <div class="row mb-3">
            <div class="col-xl-3 col-sm-6 py-2">
                <div class="card bg-success text-white h-100">
                    <div class="card-body bg-success">
                        <div class="rotate">
                            <i class="fa fa-certificate fa-4x"></i>
                        </div>
                        <h6 class="text-uppercase">Certifications</h6>
                        <h1 class="display-4"><?php echo $certificate; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 py-2">
                <div class="card text-white bg-danger h-100">
                    <div class="card-body bg-danger">
                        <div class="rotate">
                            <i class="fa fa-money fa-4x"></i>
                        </div>
                        <h6 class="text-uppercase">Plans</h6>
                        <h1 class="display-4">87</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 py-2">
                <div class="card text-white bg-info h-100">
                    <div class="card-body bg-info">
                        <div class="rotate">
                            <i class="fa fa-twitter fa-4x"></i>
                        </div>
                        <h6 class="text-uppercase">Tweets</h6>
                        <h1 class="display-4">125</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 py-2">
                <div class="card text-white bg-warning h-100">
                    <div class="card-body">
                        <div class="rotate">
                            <i class="fa fa-share fa-4x"></i>
                        </div>
                        <h6 class="text-uppercase">Shares</h6>
                        <h1 class="display-4">36</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
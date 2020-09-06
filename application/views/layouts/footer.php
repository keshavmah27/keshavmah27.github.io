	   <!-- FOOTER -->
      <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>&copy; 2017-2018 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>
      </main>
      </body>
	
	<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ; ?>"></script>
	<script src="<?php echo base_url('assets/dist/js/custom.js') ; ?>"></script>
	<script src="<?= base_url('assets/') ?>dist/js/jquery.validate.js"></script>
	<script src="<?= base_url('assets/') ?>dist/js/validation_rules.js"></script>
	<script type="text/javascript" src="<?= base_url('assets/') ?>DataTables/datatables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<script type="text/javascript">
	<?php if($this->session->flashdata('success')){ ?>
	    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
	<?php }else if($this->session->flashdata('error')){  ?>
	    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
	<?php }else if($this->session->flashdata('warning')){  ?>
	    toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
	<?php }else if($this->session->flashdata('info')){  ?>
	    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
	<?php } ?>
	</script>
	<script>
		function openNav() {
		  document.getElementById("mySidenav").style.width = "250px";
		}

		function closeNav() {
		  document.getElementById("mySidenav").style.width = "0";
		}
</script>
	
</html>
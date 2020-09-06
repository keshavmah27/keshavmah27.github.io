	<script src="<?php echo base_url('assets/dist/js/jquery.min.js') ; ?>"></script>
	<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ; ?>"></script>
	<script src="<?php echo base_url('assets/dist/js/custom.js') ; ?>"></script>
	<script src="<?= base_url('assets/') ?>dist/js/jquery.validate.js"></script>
	<script src="<?= base_url('assets/') ?>dist/js/validation_rules.js"></script>
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
	</body>
</html>
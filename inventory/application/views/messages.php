<?php 
	if ($this->session->has_userdata('warning')) { ?>  
		<div class="alert alert-warning alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<i class="icon fa fa-ban"></i> <?=$this->session->flashdata('warning'); ?>
		</div>
<?php } ?>

<?php 
	if ($this->session->has_userdata('sukses')) { ?>  
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<i class="icon fa fa-check"></i> <?=$this->session->flashdata('sukses'); ?>
		</div>
<?php } ?>

<?php 
	if ($this->session->has_userdata('error')) { ?>  
		<div class="alert alert-error alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<i class="icon fa fa-ban"></i> <?=strip_tags(str_replace('</p>', '', $this->session->flashdata('error'))); ?>
		</div>
<?php } ?>
<?php echo validation_errors('<div class="alert alert-warning">','</div>'); ?>

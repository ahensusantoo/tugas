<section class="content-header">
	<h1>
		<small>Data Kategory</small>
	</h1>

	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-archive"></i></a></li>
		<li>Product</li>
		<li class="active">Kategory</li>
	</ol>
</section>

<!-- main content -->
<section class="content">
	
	<div class="box">
		<div class="box-header">
			<h3 class="box-title"><?=ucfirst($page)?> Kategory</h3>
			<div class="pull-right btn-flat">
				<a href="<?php echo site_url('kategory') ?>" class="btn btn-warning">
					<i class="fa fa-undo"> Back</i>
				</a>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<?php
					//notifikasi error
					echo validation_errors('<div class="alert alert-warning">','</div>');

					//notifikasi saat gagal login
					if($this->session->flashdata('warning')){
					  echo '<div class="alert alert-warning">';
					  echo $this->session->flashdata('warning');
					  echo '</div>';
					}

					 //notifikasi logout
					if($this->session->flashdata('sukses')){
					  echo '<div class="alert alert-success">';
					  echo $this->session->flashdata('sukses');
					  echo '</div>';
					}
				?>		
					<form action="<?=site_url('kategory/process')?>" method="post">
						<div class="form-group">
							<label>Kategory Name *</label>
							<input type="hidden" name="id" value="<?=$row->kategory_id?>">
							<input type="text" name="kategory_name" placeholder="Nama Kategory" id="nama_kategory" value="<?=$row->nama_kategory?>" class="form-control" required>
						</div>
						
						<div class="form-group">
							<button type="submit" name="<?= $page ?>" class="btn btn-success  btn-flat"><i class="fa fa-paper-plane">Save</i></button>
							<button type="reset" class="btn btn-warning  btn-flat">Reset</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
	
</section>
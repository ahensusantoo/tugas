<section class="content-header">
	<h1>
		<small>Data Supplier</small>
	</h1>

	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-user"></i></a></li>
		<li class="active">Supplier</li>
	</ol>
</section>

<!-- main content -->
<section class="content">
	
	<div class="box">
		<div class="box-header">
			<h3 class="box-title"><?=ucfirst($page)?> Supplier</h3>
			<div class="pull-right btn-flat">
				<a href="<?php echo site_url('supplier') ?>" class="btn btn-warning">
					<i class="fa fa-undo"> Back</i>
				</a>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<?php $this->view('messages') ?>
					<form action="<?=site_url('supplier/process')?>" method="post">
						<div class="form-group <?=form_error('kode_supplier') ? 'has-error' : null?>">
							<label>Kode Supplier *</label>
							<input type="hidden" name="id" value="<?=$row->supplier_id?>">
							<input type="text" name="kode_supplier" placeholder="Nama Lengkap" id="kode_supplier" value="<?=$row->kode_supplier?>" class="form-control" required>
							<?=form_error('kode_supplier')?>
						</div>

						<div class="form-group">
							<label>Supplier Name *</label>
							<input type="text" name="nama_supplier" placeholder="Nama Supplier" id="supplier_name" value="<?=$row->nama_supplier?>" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Nomor Telepon *</label>
							<input type="number" name="phone" placeholder="Nomor Telepon" id="phone" value="<?=$row->phone?>" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Alamat *</label>
							<textarea name="alamat" placeholder="Alamat" id="alamat" class="form-control" required><?=$row->alamat?></textarea>
						</div>

						<div class="form-group">
							<label>Description *</label>
							<textarea name="desc" placeholder="Description" id="description" class="form-control"><?=$row->deskripsi?></textarea>
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
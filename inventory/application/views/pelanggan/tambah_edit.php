<section class="content-header">
	<h1>
		<small>Data Pelanggan</small>
	</h1>

	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-user"></i></a></li>
		<li class="active">Pelanggan</li>
	</ol>
</section>

<!-- main content -->
<section class="content">
	
	<div class="box">
		<div class="box-header">
			<h3 class="box-title"><?=ucfirst($page)?> Pelanggan</h3>
			<div class="pull-right btn-flat">
				<a href="<?php echo site_url('pelanggan') ?>" class="btn btn-warning">
					<i class="fa fa-undo"> Back</i>
				</a>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<?php $this->view('messages') ?>
					<form action="<?=site_url('pelanggan/process')?>" method="post">
						<div class="form-group">
							<label>Kode Pelanggan *</label>
							<input type="hidden" name="id" value="<?=$row->pelanggan_id?>">
							<input type="text" name="kode_pelanggan" placeholder="Kode Pelanggan" id="kode_pelanggan" value="<?=$row->kode_pelanggan?>" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Nama Pelanggan *</label>
							<input type="text" name="nama_pelanggan" placeholder="Nama Lengkap" id="nama_pelanggan" value="<?=$row->nama_pelanggan?>" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Nomor Telepon *</label>
							<input type="number" name="phone" placeholder="Nomor Telepon" id="phone" value="<?=$row->phone?>" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Addres </label>
							<textarea name="addres" placeholder="Addres" id="addres" class="form-control"><?=$row->alamat?></textarea>
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
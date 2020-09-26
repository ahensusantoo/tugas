<section class="content-header">
	<h1>Units
		<small>Satuan Barang</small>
	</h1>

	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-archive"></i></a></li>
		<li>Product</li>
		<li class="active">Unit</li>
	</ol>
</section>

<!-- main content -->
<section class="content">

	<?php $this->view('messages') ?>
	
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Data Unit</h3>
			<div class="pull-right btn-flat">
				<a href="<?php echo site_url('unit/add') ?>" class="btn btn-primary">
					<i class="fa fa-plus"> Create</i>
				</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<?php
				//notifikasi error
				echo validation_errors('<div class="alert alert-warning">','</div>');

			?>

			
			<table  class="table table-bodered table-striped" id="table1">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Satuan</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					<?php $no =1; foreach ($row->result() as $key => $unit) { ?>
						<tr>
							<td style="width: 5px"><?php echo $no++  ?></td>
							<td><?php echo $unit->nama_unit ?></td>
							<td class="text-center" width="160px">
								<a href="<?php echo site_url('unit/update/'.$unit->unit_id) ?>" class="btn btn-success btn-xs">
									<i class="fa fa-pencil"> Update</i>
								</a>
								<a href="<?php echo site_url('unit/delete/'.$unit->unit_id) ?>" onclick="return confirm('apakah anda yakin ingin menghapus data ?')" class="btn btn-danger btn-xs">
									<i class="fa fa-pencil"> Delete</i>
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>

		</div>
	</div>
	
</section>
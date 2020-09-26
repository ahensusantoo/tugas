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
			<h3 class="box-title">Data Pelanggan</h3>
			<div class="pull-right btn-flat">
				<a href="<?php echo site_url('pelanggan/add') ?>" class="btn btn-primary">
					<i class="fa fa-user-plus"> Create</i>
				</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<?php $this->view('messages') ?>
			<table  class="table table-bodered table-striped" id="table1">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode</th>
						<th>Nama</th>
						<th>Phone</th>
						<th>alamat</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					<?php $no =1; foreach ($row->result() as $key => $pelanggan) { ?>
						<tr>
							<td style="width: 5px"><?php echo $no++  ?></td>
							<td><?php echo $pelanggan->kode_pelanggan ?></td>
							<td><?php echo $pelanggan->nama_pelanggan ?></td>
							<td><?php echo $pelanggan->phone ?></td>
							<td><?php echo $pelanggan->alamat ?></td>
							<td class="text-center" width="160px">
								<a href="<?php echo site_url('pelanggan/update/'.$pelanggan->pelanggan_id) ?>" class="btn btn-success btn-xs">
									<i class="fa fa-pencil"> Update</i>
								</a>
								<a href="<?php echo site_url('pelanggan/delete/'.$pelanggan->pelanggan_id) ?>" onclick="return confirm('apakah anda yakin ingin menghapus data ?')" class="btn btn-danger btn-xs">
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
<section class="content-header">
	<h1>
		<small>Detail Barang</small>
	</h1>

	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-archive"></i></a></li>
		<li>Repost</li>
		<li class="active">Stock</li>
	</ol>
</section>

<section class="content">

	<?php $this->view('messages') ?>
	
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Data Stock In</h3>
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
						<th>Kode Item</th>
						<th>Nama Barang</th>
						<th>Stock In</th>
						<th>Stock Out</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no =1; foreach ($row as $key => $detail) { ?>
						<tr>
							<td style="width: 5px"><?php echo $no++  ?></td>
							<td><?php echo $detail->kode_item ?></td>
							<td><?php echo $detail->nama_item ?></td>
							<td><?php echo $detail->nama_item ?></td>
							<td><?php echo indo_date($stock->date) ?></td>
							<td class="text-center" width="160px">
								<a class="btn btn-primary btn-xs" id="dtl" data-toggle="modal" data-target="#modal-detail"
									data-kode_item	= "<?=$stock->kode_item?>"
									data-nama_item	= "<?=$stock->nama_item?>"
									data-qty	= "<?=$stock->qty?>"
									data-nama_supplier	= "<?=$stock->nama_supplier?>"
									data-detail	= "<?=$stock->detail?>"
									data-date	= "<?=indo_date($stock->date)?>"
									data-user	= "<?=$stock->username?>"
								>
									<i class="fa fa-eye"> Detail</i>
								</a>
								<a href="<?php echo site_url('stock/in/delete/'.$stock->stock_id.'/'.$stock->item_id) ?>" onclick="return confirm('apakah anda yakin ingin menghapus data ?')" class="btn btn-danger btn-xs">
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

<section class="content-header">
	<h1>Stock Out
		<small>Barang Keluar</small>
	</h1>

	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-archive"></i></a></li>
		<li>Transaction</li>
		<li class="active">Stock Out</li>
	</ol>
</section>


<!-- main content -->
<section class="content">

	<?php $this->view('messages') ?>
	
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Data Stock Out</h3>
			<div class="pull-right btn-flat">
				<a href="<?php echo site_url('stock/out/add') ?>" class="btn btn-primary">
					<i class="fa fa-user-plus"> Create</i>
				</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<?php
				//notifikasi error
				echo validation_errors('<div class="alert alert-warning">','</div>');

			?>

			<?php echo form_open('stock/stock_in_data');?>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
                          	<label	for="tgl_awal">Dari Tanggal</label>
                            <input type="date" name="tgl_awal" id="tgl_awal" value="" class="form-control ">       
                    </div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
                          	<label	for="tgl_akhir">Sampai Tanggal</label>
                            <input type="date" name="tgl_akhir" id="tgl_akhir" value="" class="form-control ">       
                    </div>
				</div>

				<div class="col-md-3 float-right">
	                <div>	
	                    <button type="submit" value="cari_taggal" name="cari_tanggal" class="btn btn-primary btn-flat">
	                    	<i class="fa fa-search"> Filter</i>
	                    </button>
	                </div>
	            </div>
			</div>
			<?php echo form_close();?>

			
			<table  class="table table-bodered table-striped" id="table1">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>QTY</th>
						<th>Info</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no =1; foreach ($row as $key => $stock) { ?>
						<tr>
							<td style="width: 5px"><?php echo $no++  ?></td>
							<td><?php echo $stock->kode_item ?></td>
							<td><?php echo $stock->nama_item ?></td>
							<td><?php echo $stock->qty ?></td>
							<td><?php echo $stock->detail ?></td>
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
								<a href="<?php echo site_url('stock/out/delete/'.$stock->stock_id.'/'.$stock->item_id) ?>" onclick="return confirm('apakah anda yakin ingin menghapus data ?')" class="btn btn-danger btn-xs">
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


<div class="modal fade" id="modal-detail">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hodden="true">&times;</span>
				</button>
				<h4 class="modal-title">Stock In Detail </h4>
			</div>
			<div class="modal-body table-responsive">
				<table class="table table-bodered no-margin">
						<tr>
							<th style="">Kode Item</th>
							<td><span id="kode_item"></span></td>
						</tr>

						<tr>
							<th style="">Nama Item</th>
							<td><span id="item_name"></span></td>
						</tr>

						<tr>
							<th style="">QTY</th>
							<td><span id="qty"></span></td>
						</tr>

						<!-- <tr>
							<th style="">Supplier Name</th>
							<td><span id="supplier_name"></span></td>
						</tr> -->

						<tr>
							<th style="">Detail</th>
							<td><span id="detail"></span></td>
						</tr>

						<tr>
							<th style="">Date</th>
							<td><span id="date"></span></td>
						</tr>

						<tr>
							<th style="">User</th>
							<td><span id="user"></span></td>
						</tr>

					</thead>
					<tbody>
						
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$(document).on('click', '#dtl', function(){
			var kode_item 		= $(this).data('kode_item');
			var item_name 		= $(this).data('nama_item');
			var qty 			= $(this).data('qty');
			// var supplier_name 	= $(this).data('nama_supplier');
			var detail 			= $(this).data('detail');
			var date 			= $(this).data('date');
			var user 			= $(this).data('user');
			$('#kode_item').text(kode_item);
			$('#item_name').text(item_name);
			$('#qty').text(qty);
			// $('#supplier_name').text(supplier_name);
			$('#detail').text(detail);
			$('#date').text(date);
			$('#user').text(user);

			$('#modal-item').modal('hide');
		})
	})
</script>
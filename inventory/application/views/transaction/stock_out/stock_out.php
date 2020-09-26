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
	
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">ADD STOCK BARANG</h3>
			<div class="pull-right btn-flat">
				<a href="<?php echo site_url('stock/out') ?>" class="btn btn-warning">
					<i class="fa fa-undo"> Back</i>
				</a>
			</div>
		</div>
		<div class="box-body">
			<?php $this->view('messages') ?>

			<div class="row">
				<div class="col-md-4 col-md-offset-4">
		
					<form action="<?=site_url('stock/process')?>" method="post">
						<div class="form-group">
							<label>Date *</label>
							<input type="date" name="date" value="<?=date('Y-m-d')?>" class="form-control" required>
						</div>

						<div>
							<label for="kode_item">Kode Barang *</label>
						</div>
						<div class="form-group input-group">
							<input type="hidden" name="item_id" id="item_id">
							<input type="text" name="kode_item" id="kode_item" class="form-control" required autofocus>
							<span class="input-group-btn">
								<button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
									<i class="fa fa-search"></i>
								</button>
							</span>
						</div>

						<div class="form-group">
							<label for="nama_item">Nama Barang *</label>
							<input type="text" name="nama_item" id="nama_item" class="form-control" readonly>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<label for="nama_unit">Item Unit</label>
									<input type="text" name="nama_unit" id="nama_unit" value="-" class="form-control" readonly>
								</div>
								<div class="col-md-6">
									<label for="stock">Initial Stock</label>
									<input type="text" name="stock" id="stock" value="-" class="form-control" readonly>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="detail">Detail *</label>
							<input type="text" name="detail" id="detail" class="form-control" placeholder="Pembelian / Rusak / Cacat" required>
						</div>

						<div class="form-group">
							<label for="detail">QTY *</label>
							<input type="number" name="qty" id="qty" class="form-control" required>
						</div>
						
						<div class="form-group">
							<button type="submit" name="out_add" class="btn btn-success  btn-flat"><i class="fa fa-paper-plane">Save</i></button>
							<button type="reset" class="btn btn-warning  btn-flat">Reset</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
	
</section>


<div class="modal fade" id="modal-item">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hodden="true">&times;</span>
				</button>
				<h4 class="modal-title">Select Produk Item </h4>
			</div>
			<div class="modal-body table-responsive">
				<table class="table table-bodered table-striped" id="table1" style="width: 100%">
					<thead>
						<tr>
							<td>Kode Barang</td>
							<td>Nama Barang</td>
							<td>Unit</td>
							<td>Price</td>
							<td>Stock</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($item as $key => $item) { ?>
						<tr>
							<td><?php echo $item->kode_item ?></td>
							<td><?php echo $item->nama_item ?></td>
							<td><?php echo $item->nama_unit ?></td>
							<td><?php echo indo_currency($item->price) ?></td>
							<td><?php echo $item->stock ?></td>
							<td>
								<button class="btn btn-xs btn-info" id="select"
									data-id="<?=$item->item_id?>"
									data-kode_item="<?=$item->kode_item?>"
									data-nama_item="<?=$item->nama_item?>"
									data-nama_unit="<?=$item->nama_unit?>"
									data-stock="<?=$item->stock?>"

								>
									<i class="fa fa-check"></i>Select
								</button>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$(document).on('click', '#select', function(){
			var item_id 	= $(this).data('id');
			var kode_item 	= $(this).data('kode_item');
			var nama_item 		= $(this).data('nama_item');
			var unit_name 	= $(this).data('nama_unit');
			var stock 		= $(this).data('stock');
			$('#item_id').val(item_id);
			$('#kode_item').val(kode_item);
			$('#nama_item').val(nama_item);
			$('#nama_unit').val(unit_name);
			$('#stock').val(stock);

			$('#modal-item').modal('hide');
		})
	})
</script>
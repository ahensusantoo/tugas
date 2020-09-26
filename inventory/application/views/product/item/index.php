<section class="content-header">
	<h1>Items
		<small>Data Barang</small>
	</h1>

	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-archive"></i></a></li>
		<li>Product</li>
		<li class="active">Items</li>
	</ol>
</section>

<!-- main content -->
<section class="content">

	<?php $this->view('messages') ?>
	
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Data Product Item</h3>
			<div class="pull-right btn-flat">
				<a href="<?php echo site_url('item/add') ?>" class="btn btn-primary">
					<i class="fa fa-user-plus"> Create</i>
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
						<th>Kode Item</th>
						<th>Product Name</th>
						<th>kategory</th>
						<th>unit</th>
						<th>Price</th>
						<th>Stock</th>
						<th>Image</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					<!-- <?php $no =1; foreach ($row->result() as $key => $item) { ?>
						<tr>
							<td style="width: 3px"><?php echo $no++  ?></td>
							<td>
								<?php echo $item->barcode ?></br>
								<a href="<?php echo site_url('item/barcode_qrcode/'.$item->item_id) ?>" class="btn btn-primary btn-xs">
									Generete <i class="fa fa-barcode"></i>
								</a>
							</td>
							<td><?php echo $item->nama_item ?></td>
							<td><?php echo $item->nama_kategory?></td>
							<td><?php echo $item->nama_unit?></td>
							<td><?php echo $item->price?></td>
							<td><?php echo $item->stock ?></td>
							<td>
								<?php if($item->image != null) { ?>
									<img src="<?= base_url('uploads/product/'.$item->image) ?>" style="width: 50px">
								<?php } ?>
							</td>

							<td class="text-center" width="160px">
								<a href="<?php echo site_url('item/update/'.$item->item_id) ?>" class="btn btn-success btn-xs">
									<i class="fa fa-pencil"> Update</i>
								</a>
								<a href="<?php echo site_url('item/delete/'.$item->item_id) ?>" onclick="return confirm('apakah anda yakin ingin menghapus data ?')" class="btn btn-danger btn-xs">
									<i class="fa fa-trash"> Delete</i>
								</a>
							</td>
						</tr>
					<?php } ?>-->
				</tbody>
			</table>
 
		</div>
	</div>
	
</section>

<script>
		$(document).ready(function(){
			$('#table1').DataTable({
				"processing": true,
       			"serverSide": true,
        		"ajax": { 
        			"url"  : "<?=site_url('item/get_ajax')?>",
        			"type" : "POST"
        		},
        		"columnDefs" 	: [
        			{
        			"targets" 	: [5, 6],
        			"className" : 'text-right'
        			},
        			{
        			"targets" 	: [7, -1],
        			"className" : 'text-right'
        			},
        			{
        			"targets" 	: [0, 7, -1],
        			"oderable"  : false
        			}
        		],
        		"order": []
			})
		})
	</script>
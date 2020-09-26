<section class="content-header">
	<h1>Mutasi Stock
		<small>Detail Barang Masuk dan Keluar</small>
	</h1>

	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-archive"></i></a></li>
		<li>Transaction</li>
		<li class="active">Mutasi Stock</li>
	</ol>
</section>

<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Data Stock Out</h3>
		</div>
		<div class="row">
            <div class="col-md-12"> 
                <div class="box box-widget">
                    <div class="box-body table-responsive"> 
                        <table class="table table-boredered table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice</th>
                                    <th>Pelanggan</th>
                                    <th>Grand Total</th>
                                    <th>User</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="sale_table">
                                <?php $no = 1;
									if ($sale->num_rows() > 0 ) {
										foreach ($sale->result() as $key => $sale) { ?>
											<tr>
												<td><?=$no++?>.</td>
												<td><?=$sale->invoice?></td>
												<td><?=$sale->nama_pelanggan?></td>
												<td><?=$sale->final_price?></td>
												<td><?=$sale->username?></td>
												<td><?=indo_date($sale->date)?></td>
												<td class="text-center" width="160px">
													<a class="btn btn-primary btn-xs" id="dtl" data-toggle="modal" data-target="#modal-detail"
														data-invoice		= "<?=$sale->invoice?>"
														data-nama_pelanggan	= "<?=$sale->nama_pelanggan?>"
														data-date	= "<?=indo_date($sale->date)?>"
														data-user	= "<?=$sale->username?>"
													>
														<i class="fa fa-eye"> Detail</i>
													</a>
													<!-- <a href="<?php echo site_url('sale/in/delete/'.$sale->sale_id.'/'.$sale->item_id) ?>" onclick="return confirm('apakah anda yakin ingin menghapus data ?')" class="btn btn-danger btn-xs">
														<i class="fa fa-pencil"> Delete</i>
													</a> -->
												</td>
											</tr>
											<?php 
										}
									}
									else{
										echo 
											'<tr>
												<td colspan="8" class="text-center">Belum ada data pembelian</td>	
											</tr>';
									}
								?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
	</div>
</section>

<!-- modal add item -->
<div class="modal fade" id="modal-detail">
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
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($item as $key => $item) { ?>
                        <tr>
                            <td><?php echo $item->kode_item ?></td>
                            <td><?php echo $item->nama_item ?></td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-info" id="print"
                                    data-id="<?=$item->item_id?>"
                                    data-kode_item="<?=$item->kode_item?>"
                                    data-namaitem="<?=$item->nama_item?>"
                                >
                                    <i class="fa fa-check"></i>Print
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

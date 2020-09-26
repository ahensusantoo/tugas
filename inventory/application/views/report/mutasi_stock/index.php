<section class="content-header">
	<h1>
		<small>Data Barang Masuk/Keluar</small>
	</h1>

	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-archive"></i></a></li>
		<li>Repost</li>
		<li class="active">Stock</li>
	</ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="box box-widget"> 
                <div class="box-body">
                    
                    <form action="<?php echo site_url('report/mutasi_stock')  ?>" method="post">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align : top "> 
                                    <label for="Date"> Dari Tanggal  </label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="date" id="date" name="tgl_awal" value="<?=date('Y-m-d')?>" class="form-control ">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                               <td style="vertical-align : top "> 
                                    <label for="Date"> Sampai Tanggal  </label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="date" id="date" name="tgl_akhir" value="<?=date('Y-m-d')?>" class="form-control ">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                            	<td style="vertical-align : top "> 
                                    <label for="Date"> Kode Barang  </label>
                                </td>
                            	<td>
                                    <div class="form-group input-group">
                                        <input type="hidden" id="item_id">
                                        <input type="kode_item" id="kode_item" name="kode_item" class="form-control ">
                                            <span class="input-group-btn"> 
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-item">
                                               		<i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                    </div>
                                </td>	
                            </tr>

                            <tr>
                            	<td></td>
                                <td>
                                    <div>
                                        <button type="submit" id="cari_tanggal" name="cari_tanggal" class="btn btn-primary btn-block">
                                            <i class="fa fa-search"></i> Cari Data
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Note : Untuk menghitung jumlah stock out atau in belum jalan.</h3>
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
                        <th>jumlah</th>
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
                            <td><?php echo $detail->nama_item ?></td>
                            <td><?php echo $detail->nama_item ?></td>
                            <td><?php echo $detail->nama_item ?></td>
                            <td class="text-center" width="160px">
                                <a href="#" class="btn btn-success">
                                    <i class="fa fa-print">Print</i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>

</section>

<!-- modal add item -->
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
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($item as $key => $item) { ?>
                        <tr>
                            <td><?php echo $item->kode_item ?></td>
                            <td><?php echo $item->nama_item ?></td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-info" id="select"
                                    data-id="<?=$item->item_id?>"
                                    data-kode_item="<?=$item->kode_item?>"
                                    data-namaitem="<?=$item->nama_item?>"
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

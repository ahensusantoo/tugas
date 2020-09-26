<section class="content-header">
	<h1>Items
		<small>Data Barang</small>
	</h1>

	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-archive"></i></a></li>
		<li class="active">Items</li>
	</ol>
</section>

<!-- main content -->
<section class="content">
	
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Barcode Generator</h3>
			<div class="pull-right btn-flat">
				<a href="<?php echo site_url('item') ?>" class="btn btn-warning">
					<i class="fa fa-undo"> Back</i>
				</a>
			</div>
		</div>
		<div class="box-body">
			<?php
				$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
				echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->barcode, $generator::TYPE_CODE_128)) . '" style="width: 200px">';
			?>
			<br>
			<?php echo $row->barcode ?>
		</div>
	</div>

	<!-- untuk menampilkan QR code bisa ambil script -->
	<!-- view name file : qrcode paste di bawah ini. -->
	<!-- note php versi 7 keatas -->

</section>
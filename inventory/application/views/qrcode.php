/*
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">QR Code Generator	<i class="fa fa-qrcode"></i></h3>
		</div>
		<div class="box-body">
			<?php
				$qrCode = new Endroid\QrCode\QrCode($row->barcode);
				$qrCode->writeFile('uploads/qrcode/item-'.$row->barcode.'.png');
			?>
			<img src="<?=base_url('uploads/qrcode/item-'.$row->barcode.'.png')?>" style="width: 200px">
		</div>
	</div>
*/

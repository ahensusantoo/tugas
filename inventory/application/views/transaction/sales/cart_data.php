<?php $no = 1;
	if ($cart->num_rows() > 0 ) {
		foreach ($cart->result() as $key => $cart) { ?>
			<tr>
				<td><?=$no++?>.</td>
				<td><?=$cart->kode_item?></td>
				<td><?=$cart->nama_item?></td>
				<td class="text-center"><?=$cart->price_cart?></td>
				<td class="text-right"><?=$cart->qty?></td>
				<td class="text-right"><?=$cart->discount_item?></td>
				<td class="text-right" id="total"><?=$cart->total?></td>
				<td class="text-center" width="160px">
					<button id="update_cart" data-toggle="modal" data-target="#modal-item-update"
						data-cartid="<?=$cart->cart_id?>"
                        data-kodeitem="<?=$cart->kode_item?>"
                        data-product="<?=$cart->nama_item?>"
                        data-price="<?=$cart->price_cart?>"
                        data-qty="<?=$cart->qty?>"
                        data-discount="<?=$cart->discount_item?>"
                        data-total="<?=$cart->total?>"
                        class="btn btn-primary btn-xs">
                        	<i class="fa fa-pencil"></i>Update
					</button>
					<button id="delete_cart" data-cartid="<?=$cart->cart_id ?>" class="btn btn-danger btn-xs">
						<i class="fa fa-trash"></i>Delete
					</button>
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

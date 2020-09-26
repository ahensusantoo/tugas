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
	<?php $this->view('messages') ?>
	
	<div class="box">
		<div class="box-header">
			<h3 class="box-title"><?=ucfirst($page)?> Item</h3>
			<div class="pull-right btn-flat">
				<a href="<?php echo site_url('item') ?>" class="btn btn-warning">
					<i class="fa fa-undo"> Back</i>
				</a>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<!-- <?php $this->view('messages') ?> -->

					<?php echo form_open_multipart('item/process'); ?>
						<div class="form-group">
							<label>Kode Barang *</label>
							<input type="hidden" name="id" value="<?=$row->item_id?>">
							<input type="text" name="kode_item" placeholder="kode Item" id="kode_item" value="<?=$row->kode_item?>" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Kategory *</label>
							<select name="kategory" class="form-control" required="">
								<option value="">--PILIH--</option>
								<?php foreach ($kategory->result() as $key => $kategory) { ?>
									<option value="<?=$kategory->kategory_id?>" <?=$kategory->kategory_id == $row->kategory_id ? 'selected' : null ?> ><?=$kategory->nama_kategory?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group">
							<label>Units *</label>
							<?php echo form_dropdown('unit', $unit, $selectedunit, 
								['class' => 'form-control','required' => 'required']) ?>
							</select>
						</div>

						<div class="form-group">
							<label for="product_name">Product Name *</label>
							<input type="text" name="product_name" placeholder="Nama Item" id="product_name" value="<?=$row->nama_item?>" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Price *</label>
							<input type="number" name="price" placeholder="Harga" id="price" value="<?=$row->price?>" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Deskripsi </label>
							<textarea name="deskripsi" placeholder="Deskripsi" id="deskripsi" class="form-control"><?=$row->deskripsi?></textarea>
						</div>


						<div class="form-group">
							<label>Image</label>
							<?php if ($page == 'update'){
								if ($row->image != null ) { ?>
									<div style="margin-bottom:5px">
										<img src="<?= base_url('uploads/product/'.$row->image) ?>" style="width: 50px">
									</div>
								<?php } 
							} ?>
							<input type="file" name="image" placeholder="Image" id="image" value="<?=$row->price?>" class="form-control">
							<small>(biarkan kosong jika tidak <?=$page=='update' ? 'ganti' : 'ada' ?>)</small>
						</div>
						
						<div class="form-group">
							<button type="submit" name="<?= $page ?>" class="btn btn-success  btn-flat"><i class="fa fa-paper-plane">Save</i></button>
							<button type="reset" class="btn btn-warning  btn-flat">Reset</button>
						</div>

					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
	
</section>
<section class="content-header">
	<h1>
		<small>Data Supplier</small>
	</h1>

	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-user"></i></a></li>
		<li class="active">Supplier</li>
	</ol>
</section>

<!-- main content -->
<section class="content">
	
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Data Supplier</h3>
			<div class="pull-right btn-flat">
				<a href="<?php echo site_url('supplier/add') ?>" class="btn btn-primary">
					<i class="fa fa-user-plus"> Create</i>
				</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<?php $this->view('messages') ?>
			
			<table  class="table table-bodered table-striped" id="table1">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode supplier</th>
						<th>Nama Supplier</th>
						<th>Phone</th>
						<th>Addres</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no =1; foreach ($row->result() as $key => $supplier) { ?>
						<tr>
							<td style="width: 5px"><?php echo $no++  ?></td>
							<td><?php echo $supplier->kode_supplier ?></td>
							<td><?php echo $supplier->nama_supplier?></td>
							<td><?php echo $supplier->phone ?></td>
							<td><?php echo $supplier->alamat ?></td>
							<td><?php echo $supplier->deskripsi ?></td>
							<td class="text-center" width="160px">
								<a href="<?php echo site_url('supplier/update/'.$supplier->supplier_id) ?>" class="btn btn-success btn-xs">
									<i class="fa fa-pencil"> Update</i>
								</a>
								<!-- <a href="<?php echo site_url('supplier/delete/'.$supplier->id_supplier) ?>" onclick="return confirm('apakah anda yakin ingin menghapus data ?')" class="btn btn-danger btn-xs">
									<i class="fa fa-pencil"> Delete</i>
								</a> -->

								<a href="#modalDelete" data-toggle="modal" onclick="$('#modalDelete #formDelete').attr('action', '<?php echo site_url('supplier/delete/'.$supplier->supplier_id) ?>')" class="btn btn-danger btn-xs">
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

<div class="modal fade" id="modalDelete">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hodden="true">&times;</span>
				</button>
				<h4 class="modal-title">Yakin Ingin menghapus Data ini ?</h4>
			</div>
			<div class="modal-footer table-responsive">
				<form id="formDelete" action="" method="post">
					<button class="btn btn-default" data-dismiss="modal">Tidak</button>
					<button class="btn btn-danger" type="submit">Hapus</button>
				</form>
			</div>
		</div>
	</div>
</div>
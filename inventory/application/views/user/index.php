<section class="content-header">
	<h1>
		<small>User</small>
	</h1>

	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-users"></i></a></li>
		<li class="active">User</li>
	</ol>
</section>

<!-- main content -->
<section class="content">
	
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Data User</h3>
			<div class="pull-right btn-flat">
				<a href="<?php echo site_url('user/add') ?>" class="btn btn-primary">
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
						<th>Username</th>
						<th>Level</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					<?php $no =1; foreach ($row->result() as $key => $user) { ?>
						<tr>
							<td style="width: 5px"><?php echo $no++  ?></td>
							<td><?php echo $user->username ?></td>
							<td>
								<?php if($user->level == 1){
									echo "Administrator";
								} ?>
								<?php if($user->level == 2){
									echo "Fakturi";
								} ?>
								<?php if($user->level == 3){
									echo "Logistik";
								} ?>
							</td>
							<td class="text-center" width="160px">
								<form action="<?=site_url('user/delete')?>" method="post">
									<a href="<?php echo site_url('user/update/'.$user->user_id) ?>" class="btn btn-success btn-xs">
										<i class="fa fa-pencil"> Update</i>
									</a>
									<input type="hidden" name="user_id" value="<?=$user->user_id?>">
									<button onclick="return confirm('apakah anda yakin ingin menghapus data ?')" class="btn btn-danger btn-xs">
										<i class="fa fa-trash"></i>	 Delete
									</button>
								</form>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>

		</div>
	</div>
	
</section>
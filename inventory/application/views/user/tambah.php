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
			<h3 class="box-title">Tambah Data User</h3>
			<div class="pull-right btn-flat">
				<a href="<?php echo site_url('user') ?>" class="btn btn-warning">
					<i class="fa fa-undo"> Back</i>
				</a>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<?php $this->view('messages') ?>
					<form action="<?php echo site_url('user/add') ?>" method="post">
						
						<div class="form-group <?=form_error('username') ? 'has-error' : null?>">
							<label>Username *</label>
							<input type="text" name="username" placeholder="Username" id="username" value="<?=set_value('username')?>" class="form-control">
							<?=form_error('username')?>
						</div>

						<div class="form-group <?=form_error('password') ? 'has-error' : null?>">
							<label>Password *</label>
							<input type="password" name="password" placeholder="Password" id="password" value="" class="form-control">
							<?=form_error('password')?>
						</div>

						<div class="form-group <?=form_error('passconf') ? 'has-error' : null?>">
							<label>Password Confirmasi *</label>
							<input type="password" name="passconf" placeholder="Password Confirmasi" id="passconf" value="" class="form-control">
							<?=form_error('passconf')?>
						</div>

						<div class="form-group <?=form_error('level') ? 'has-error' : null?>">
							<label>level *</label>
							<select name="level" value="<?=set_value('level')?>" class="form-control">
								<option value="">-- Pilih --</option>
								<option value="1" <?=set_value('level') == 1 ? "selected" : null ?> >Administrator</option>
								<option value="2" <?=set_value('level') == 2 ? "selected" : null ?> >Fakturis</option>
								<option value="3" <?=set_value('level') == 3 ? "selected" : null ?> >Logistik</option>
							</select>
							<?=form_error('level')?>
						</div>


						<div class="form-group">
							<button type="submit" class="btn btn-success  btn-flat"><i class="fa fa-paper-plane">Save</i></button>
							<button type="reset" class="btn btn-warning  btn-flat">Reset</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
	
</section>
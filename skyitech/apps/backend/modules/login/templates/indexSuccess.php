<?php include_partial('global/showError')?>
<style type="text/css">
.mainDiv{ border:none; }
</style>
<?php echo form_tag('/login/index',array('name'=>'loginForm', 'method'=>'post')) ?>
<div class="welcome">Welcome to the admin of <?php echo sfConfig::get('app_sitename') ?></div>
<table class="login">
<tbody>
	<tr>
		<th>User Name:</th>
		<td>
			<?php echo input_tag('username', '', array ('size' => 20,)) ?>
		</td>
	</tr>
	<tr>
		<th>Password:</th>
		<td>
			<?php echo input_password_tag('password', '', array ( 'size' => 20,)) ?>
		</td>
	</tr>
	<tr>
		<th></th>
		<td>
			<?php
				echo submit_tag('Login',  array ('name' => 'login',));
			?>
		</td>
	</tr>
</tbody>
</table>

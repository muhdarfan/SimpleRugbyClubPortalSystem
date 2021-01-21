<?php
if (empty($_GET['id'])) {
	header("location: {$_SERVER['PHP_SELF']}");
}

$ID = intval($_GET['id']);
?>
<h4>Editing ID: #<?php echo $ID; ?></h4>
<hr />
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
	<input type="hidden" name="editID" value="<?php echo $ID; ?>">
	<?php
	if ($_GET['view'] == 'admin') {
		$DB->where('adminID', $ID);
		$User = $DB->getOne('tbl_admin');
		?>
		<div class="form-group">
			<label for="inputUsername">Username</label>
			<input type="text" class="form-control" id="inputUsername" name="eUsername" placeholder="Username" value="<?php echo $User['adminUsername']; ?>" required>
		</div>

		<div class="form-group">
			<label for="inputEmail">Email</label>
			<input type="email" class="form-control" id="inputEmail" name="eEmail" placeholder="Email" value="<?php echo $User['adminEmail']; ?>" required>
		</div>

		<div class="form-group">
			<label for="inputPassword">Password</label>
			<input type="password" class="form-control" id="inputPassword" name="ePassword" placeholder="Password" value="<?php echo $User['adminPass']; ?>" required>
		</div>
		<?php
	} elseif ($_GET['view'] == 'application') {
		$DB->where('userID', $ID);
		$User = $DB->getOne('tbl_application');

		?>
		<div class="form-group">
			<label for="inputUsername">Username</label>
			<input type="text" class="form-control" id="inputUsername" name="eName" placeholder="Full Name" value="<?php echo $User['name']; ?>" required>
		</div>

		<div class="form-group">
			<label for="inputMatric">Matric</label>
			<input type="text" class="form-control" id="inputMatric" name="eMatric" placeholder="Matric" value="<?php echo $User['userNoMatric']; ?>" required>
		</div>

		<div class="form-group">
			<label for="inputEmail">Email</label>
			<input type="email" class="form-control" id="inputEmail" name="eEmail" placeholder="Email" value="<?php echo $User['userEmail']; ?>" required>
		</div>

		<div class="form-group">
			<label for="inputPhone">Phone</label>
			<input type="tel" class="form-control" id="inputPhone" name="ePhone" placeholder="Phone" value="<?php echo $User['userPhone']; ?>" required>
		</div>
		<?php
	}
	?>

	<div class="text-center">
		<button type="submit" class="btn btn-large btn-primary">Save</button>
	</div>
</form>

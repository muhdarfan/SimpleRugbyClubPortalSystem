<h4>Add New Data</h4>
<hr />
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
	<?php
	if ($_GET['view'] == 'admin') {
		?>
		<div class="form-group">
			<label for="inputUsername">Username</label>
			<input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username" required>
		</div>

		<div class="form-group">
			<label for="inputEmail">Email</label>
			<input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" required>
		</div>

		<div class="form-group">
			<label for="inputPassword">Password</label>
			<input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" required>
		</div>
		<?php
	} elseif ($_GET['view'] == 'application') {
		?>
		<div class="form-group">
			<label for="inputUsername">Full Name</label>
			<input type="text" class="form-control" id="inputUsername" name="name" placeholder="Full name" required>
		</div>

		<div class="form-group">
			<label for="inputMatric">Matric</label>
			<input type="text" class="form-control" id="inputMatric" name="matric" placeholder="Matric" required>
		</div>

		<div class="form-group">
			<label for="inputEmail">Email</label>
			<input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" required>
		</div>

		<div class="form-group">
			<label for="inputPhone">Phone</label>
			<input type="tel" class="form-control" id="inputPhone" name="phone" placeholder="Phone" required>
		</div>
		<?php
	}
	?>

	<div class="text-center">
		<button type="submit" name="add" class="btn btn-large btn-primary">Add</button>
	</div>
</form>

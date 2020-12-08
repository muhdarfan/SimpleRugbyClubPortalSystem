<?php
include "../core.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$Err = Array();
	
	if (isset($_POST['matric'])) {
		$Name = htmlspecialchars($_POST['username']);
		$Email = htmlspecialchars($_POST['email']);
		$Phone = htmlspecialchars($_POST['phone']);
		$Matric = htmlspecialchars($_POST['matric']);

		if (!(empty($Name) && empty($Email) && empty($Phone) )) {
			if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
				$Err = Array('danger', 'Email is invalid!');
			} elseif (strlen($Name) < 4 || strlen($Name) > 32) {
				$Err = Array('danger', 'Username must be at least 3 characters long.!');
			} else {
				$uArray = Array(
					'username' => $Name,
					'userEmail' => $Email,
					'userPhone' => $Phone
				);

				$DB->where("userNoMatric", $Matric);
				$DB->where("userID", intval($_SESSION['id']));

				if ($DB->update('tbl_users', $uArray)) {
					$_SESSION['message'] = Array('success', 'Your information has been successfully updated!');
					header("LOCATION: home.php");
				} else {
					$Err = Array('danger', 'Failed to update information. Contact administrator!');
				}
			}
		}
	}

	if (isset($_POST['pass']) && isset($_POST['cPass']) && !(empty($_POST['pass']) && empty($_POST['cPass']))) {
		$Pass = $_POST['pass'];
		$Pass2 = $_POST['cPass'];

		if ($Pass == $Pass2) {
			$DB->where("userID", intval($_SESSION['id']));
			$DB->update('tbl_users', Array('userPass' => $Pass));
		} else {
			$Err = Array('danger', 'Password mismatch!');
		}
	}

	$_SESSION['message'] = $Err;
}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo $User->username; ?> - Home</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<link rel="stylesheet" href="../assets/css/main.css" />    
</head>
<body>
	<div class="header">
		<section class="container">
			<img src="../assets/img/logo.png" alt="logo" />
			<h1>Persatuan Ragbi UMP</h1>
		</section>
	</div>

	<nav class="navbar navbar-default">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Brand</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="active"><a href="/">Home <span class="sr-only">(current)</span></a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li><a href="../">Back to Main Page</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $User->username ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<?php if (!empty($_SESSION['message'])) { ?>
		<div class="alert alert-<?php echo $_SESSION['message'][0] ?>" role="alert">
			<?php echo $_SESSION['message'][1] ?>
		</div>
		<?php unset($_SESSION['message']); } ?>
		
		<div class="row">
			<!-- Main Content -->
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-body">
						<form class="form-horizontal" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
							<h3>Personal Detail</h3>
							<div class="form-group">
								<label class="col-sm-2 control-label">Matric Number</label>
								<div class="col-sm-10">
									<input type="hidden" name="matric" value="<?php echo $User->userNoMatric; ?>" />
									<p class="form-control-static"><?php echo $User->userNoMatric; ?></p>
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputUsername" class="col-sm-2 control-label">Username</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="username" id="inputUsername" placeholder="Username" value="<?php echo $User->username; ?>" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-sm-2 control-label">Email</label>
								<div class="col-sm-10">
									<input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email" value="<?php echo $User->userEmail; ?>" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="phoneNumberInput" class="col-sm-2 control-label">Phone Number</label>
								<div class="col-sm-10">
									<input type="tel" class="form-control" name="phone" id="phoneNumberInput" placeholder="Phone Number" value="<?php echo $User->userPhone; ?>" required>
								</div>
							</div>

							<hr />
							<h3>Password</h3>
							<div class="form-group">
								<label for="inputPassword" class="col-sm-2 control-label">Password</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" name="pass" id="inputPassword" placeholder="Password">
								</div>
							</div>

							<div class="form-group">
								<label for="inputcPassword" class="col-sm-2 control-label">Confirm Password</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" name="cPass" id="inputcPassword" placeholder="Confirm Password">
								</div>
							</div>
							

							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-success">Save</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
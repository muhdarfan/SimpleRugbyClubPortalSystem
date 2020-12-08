<?php
include '../core.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$err = "";
	
	if(!(empty($_POST['title']) || empty($_POST['content']) || $_FILES['image']['error'] > 0)) {
		$Title = htmlspecialchars($_POST['title']);
		$Desc = $_POST['desc'];
		$Content = $_POST['content'];

		$Target = BASE . "/assets/img/news/" . basename($_FILES['image']['name']);

		if (in_array($_FILES['image']['type'], $Config['Site']['allowedFileType'])) {
			if (move_uploaded_file($_FILES['image']['tmp_name'], $Target)) {
				$Data = Array(
					'title' => $Title,
					'desc' => $Desc,
					'date' => date('Y/m/d H:i:s'),
					'img_url' => basename($_FILES['image']['name']),
					'content' => $Content
				);
				
				$stmt = $DB->insert('tbl_news', $Data);
				
				if ($stmt) {
					header("location: {$_SERVER['PHP_SELF']}");
				} else {
					$err = "An error has been occured. Please contact administrator.";
				}
			} else {
				$err = "Failed to upload image. Contact administrator!";
			}
		} else {
			$err = "Only jpg, gif, and png files are allowed.";
		}
	} elseif (isset($_POST['editID']) && isset($_POST['eTitle']) && isset($_POST['eDesc']) && isset($_POST['eContent'])) { 
		$ID = intval($_POST['editID']);
		$Title = htmlspecialchars($_POST['eTitle']);
		$Desc = $_POST['eDesc'];
		$Content = $_POST['eContent'];

		$Data = Array(
			'title' => $Title,
			'desc' => $Desc,
			'content' => $Content
		);
		
		if (!empty($_FILES['eImage']['name'])) {
			if ($_FILES['eImage']['error'] == 0) {
				$Target = BASE . "/assets/img/news/" . basename($_FILES['eImage']['name']);

				if (in_array($_FILES['eImage']['type'], $Config['Site']['allowedFileType'])) {
					if (move_uploaded_file($_FILES['eImage']['tmp_name'], $Target)) {
						$Data['img_url'] = basename($_FILES['eImage']['name']);
					} else {
						$err = "Fail to upload image. Contact administrator! [move_uploaded_file]";
					}
				} else {
					$err = "Only jpg, gif, and png files are allowed.";
				}
			} else {
				print_r($_FILES);
				$err = "Fail to upload image. Contact administrator! [". $_FILES['eImage']['error'] . "]";
			}
		}

		$DB->where('newsID', $ID);
		$stmt = $DB->update('tbl_news', $Data);

		if ($stmt) {
			header("location: {$_SERVER['PHP_SELF']}");
		} else {
			$err = "An error has been occured. Please contact administrator.";
		}
	} else {
		$err = "Please fill in the form.";
	}

	if (!empty($err)) {
		$_SESSION['errMessage'] = $err;
	}
}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo $User->adminUsername; ?> - Home</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../assets/css/main.css" />
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">

		<div class="page-header" style="border-bottom: 1px #000 solid;">
			<h1>UMP Rugby Club <small>Admin Panel</small></h1>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="#">
							<img alt="Brand" width="20" height="20" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAB+0lEQVR4AcyYg5LkUBhG+1X2PdZGaW3btm3btm3bHttWrPomd1r/2Jn/VJ02TpxcH4CQ/dsuazWgzbIdrm9dZVd4pBz4zx2igTaFHrhvjneVXNHCSqIlFEjiwMyyyOBilRgGSqLNF1jnwNQdIvAt48C3IlBmHCiLQHC2zoHDu6zG1iXn6+y62ScxY9AODO6w0pvAqf23oSE4joOfH6OxfMoRnoGUm+de8wykbFt6wZtA07QwtNOqKh3ZbS3Wzz2F+1c/QJY0UCJ/J3kXWJfv7VhxCRRV1jGw7XI+gcO7rEFFRvdYxydwcPsVsC0bQdKScngt4iUTD4Fy/8p7PoHzRu1DclwmgmiqgUXjD3oTKHbAt869qdJ7l98jNTEblPTkXMwetpvnftA0LLHb4X8kiY9Kx6Q+W7wJtG0HR7fdrtYz+x7iya0vkEtUULIzCjC21wY+W/GYXusRH5kGytWTLxgEEhePPwhKYb7EK3BQuxWwTBuUkd3X8goUn6fMHLyTT+DCsQdAEXNzSMeVPAJHdF2DmH8poCREp3uwm7HsGq9J9q69iuunX6EgrwQVObjpBt8z6rdPfvE8kiiyhsvHnomrQx6BxYUyYiNS8f75H1w4/ISepDZLoDhNJ9cdNUquhRsv+6EP9oNH7Iff2A9g8h8CLt1gH0Qf9NMQAFnO60BJFQe0AAAAAElFTkSuQmCC">
						</a>
					</div>
					
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li><a href="home.php">Home</a></li>
							<li class="active"><a href="news.php">News</a></li>
							<li><a href="gallery.php">Gallery</a></li>
							<li><a href="users.php">Users</a></li>
						</ul>

						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $User->adminUsername; ?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="profile.php">Edit Profile</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="logout.php">Logout</a></li>
								</ul>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div>
			</nav>
		</div>

		<?php
		if (isset($_SESION['errMessage'])) {
			echo "<div class='alert alert-danger' role='alert'>{$_SESION['errMessage']}</div>";
			unset($_SESSION['errMessage']);
		}
		?>

		<div class="row">
			<!-- Main Content -->
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-body">
						<h3>News <a href="news.php?action=add" class="btn btn-primary pull-right">Add</a></h3>
						<hr />
						<?php
						if (isset($_GET['action'])) {
							switch($_GET['action']) {
								case "view":
								$DB->where('newsID', 1);
								break;

								case "add":
								require_once 'frame/addNews.php';
								break;
								
								case "edit":
								if (empty($_GET['id'])) {
									header("location: {$_SERVER['PHP_SELF']}");
								}
								require_once 'frame/editNews.php';
								break;
								
								case "delete":
								if (empty($_GET['id'])) {
									header("LOCATION: {$_SERVER['PHP_SELF']}");
								}

								$DB->where('newsID', intval($_GET['id']));
								$DB->delete('tbl_news');
								echo "<div class='alert alert-danger' role='alert'>News has been deleted.</div>";
								break;
							}

							echo "<hr />";
						}

						$News = $DB->get("tbl_news");
						if (count($News) > 0) {
							?>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th style="width: 5%;">#</th>
										<th>Title</th>
										<th>Desc</th>
										<th style="width: 20%;">Published Date</th>
										<th style="width: 20%;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$count = 0;
									foreach($News as $NewsData) {
										$count++;
										echo "<tr>";
										echo "<th scope='row'>{$count}</th>";
										echo "<td>{$NewsData['title']}</td>";
										echo "<td>{$NewsData['desc']}</td>";
										echo "<td>{$NewsData['date']}</td>";
										echo "<td class='text-center'><div class='btn-group' role='group'><a href='news.php?action=edit&id={$NewsData['newsID']}' class='btn btn-success' role='button'>Edit</a><a href='news.php?action=delete&id={$NewsData['newsID']}' class='btn btn-danger btn-delete' role='button'>Delete</a></div></td>";
										echo "</tr>";
									}
									?>
								</tbody>
							</table>
							<?php
						} else {
							echo "No data to be displayed.";
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
	<!-- include summernote css/js -->
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#inputContent').summernote({
				height: 300,
				minHeight: 300,
				maxHeight: null
			});
		});

		$(".btn-delete").click(function() {
			return confirm("Are you sure want to delete this news?");
		});

		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#previewImage').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}
	</script>
</body>
</html>
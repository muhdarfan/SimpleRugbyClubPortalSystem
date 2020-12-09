<?php
include 'core.php';
?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>UMP Rugby Club</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
	<?php include 'includes/header.php'; ?>

	<div class="container">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Gallery</h3>
			</div>

			<div class="panel-body">
                <?php
                if (isset($_GET['view'])) {
                    $DB->where('album_id', intval($_GET['view']));

                }
				$Albums = $DB->get("tbl_albums");

				if (count($Albums) > 0) {
					echo '<div class="row">';
					foreach ($Albums as $Album) {
						?>
						<div class="col-sm-6 col-md-4">
							<div class="thumbnail">
								<a href="?view=<?php echo $Album['album_id']; ?>">
									<img src="" title="<?php echo $Album['album_name']; ?>" onerror="this.onerror=null;this.src='http://placehold.it/500x300'">
								</a>
								<div class="caption text-center">
									<h3><?php echo $Album['album_name'] ?></h3>
									<p><?php echo $Album['album_desc']; ?></p>
								</div>
							</div>
						</div>
						<?php
					}
					echo '</div>';
				} else {
					echo "No albums to be displayed.";
				}
				?>
			</div>
		</div>

	</div>

	<?php include 'includes/footer.php'; ?>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>

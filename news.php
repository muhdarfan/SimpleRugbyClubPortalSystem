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
		<?php
		if (isset($_GET['id'])) {
			$DB->where('newsID', intval($_GET['id']));
			$News = $DB->getOne('tbl_news');
			?>
			<div class="panel panel-default">
				<div class="panel-body">
					<h2><?php echo $News['title']; ?></h2><hr />
					<img src="assets/img/news/<?php echo $News['img_url']; ?>" class="img-rounded" width="100%" height="360">
					<p class="text-center text-muted"><?php echo $News['desc']; ?></p>
					<p class="text-justify">
						<?php echo $News['content']; ?>
					</p>
					<hr />
					<p class="pull-right"><small>Posted at <?php echo $News['date'] ?></small></p>
				</div>
			</div>
			<?php
		} else {
			?>

			<div class="page-header" style="border-bottom: 1px #20639B solid;">
				<h1 style="color: #fff">NEWS <br /><small style="color: #fff">All your Latest Team News, Exclusive Columns and Match Reports</small></h1>
			</div>

			<ul class="list-group list-group-flush">
				<?php
				$page = (isset($_GET['page']) ? intval($_GET['page']) : 1);
				$DB->pageLimit = 10;
				$DB->orderBy("date", "Desc");
				$News = $DB->arraybuilder()->paginate("tbl_news", $page);

				foreach ($News as $NewsData) {
					?>
					<li class='list-group-item' style="background-color: #eee;">
						<div class="media">
							<div class="media-left media-middle">
								<a href="?id=<?php echo $NewsData['newsID']; ?>">
									<img class="media-object hidden-xs" src="assets/img/news/<?php echo $NewsData['img_url']; ?>" style="width: 320px; height: 200px;">
									<img class="media-object visible-xs-block" src="assets/img/news/<?php echo $NewsData['img_url']; ?>" style="width: 64px; height: 64px;">
								</a>
							</div>

							<div class="media-body" style="padding: 10px;">
								<a href="?id=<?php echo $NewsData['newsID']; ?>"><h1 class="media-heading"><?php echo $NewsData['title']; ?></h1></a>
								<p><?php echo $NewsData['desc']; ?></p>
								<p><a href="?id=<?php echo $NewsData['newsID']; ?>"><small>Read More</small> <span>&#187;</span></a></p>
							</div>
						</div>
					</li>
					<?php
				}

				echo "showing $page out of " . $DB->totalPages;
				?>
			</ul>
			<?php
		}
		?>
	</div>

	<?php include 'includes/footer.php'; ?>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="assets/js/blueimp-gallery.min.js"></script>
</body>
</html>

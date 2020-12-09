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
		<section class="section-white">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<?php
					$DB->orderBy("date", "Desc");
					$News = $DB->get("tbl_news", 5);
					$count = 0;
					foreach($News as $NewsData) {
						echo "<li data-target='#carousel-example-generic' data-slide-to='{$count}' class='" . ($count == 0 ? 'active' : '') . "'></li>";
						$count++;
					}
					?>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<?php
					$count = 0;
					foreach ($News as $NewsData) { ?>
						<div class="item <?php echo ($count == 0) ? 'active' : ''; $count++; ?>">
							<a href="news.php?id=<?php echo $NewsData['newsID']; ?>"><img src="assets/img/news/<?php echo $NewsData['img_url']; ?>" title="<?php echo $NewsData['title']; ?>" alt="<?php echo $NewsData['title']; ?>" onerror="this.onerror=null;this.src='http://placehold.it/800x400'"></a>
							<div class="carousel-caption">
								<h2><?php echo $NewsData['title']; ?><br /><small style="color: #eef;"><?php echo $NewsData['desc']; ?></small></h2>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</section>

		<h1 style="color: #fff;">Next Match</h1>
		<div class="row match-list">
			<div class="col-xs-6 col-md-3">
				<div class="thumbnail">
					<img src="http://placehold.it/190x120" >
					<div class="caption">
						<p class="text-center">...</p>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="thumbnail">
					<img src="http://placehold.it/190x120" >
					<div class="caption">
						<p class="text-center">...</p>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="thumbnail">
					<img src="http://placehold.it/190x120" >
					<div class="caption">
						<p class="text-center">...</p>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="thumbnail">
					<img src="http://placehold.it/190x120" >
					<div class="caption">
						<p class="text-center">...</p>
					</div>
				</div>
			</div>
		</div>

	</div>

	<?php include 'includes/footer.php'; ?>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function(){
			$('#Carousel').carousel({
				interval: 5000
			})
		})

	</script>
</body>
</html>

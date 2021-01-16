<?php
include 'core.php';
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>UMP Rugby Club</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
          integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css"/>
</head>
<body>
<?php include 'includes/header.php'; ?>

<div class="container">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Gallery <?php echo(isset($_GET['view']) ? "<a class='pull-right' href='gallery.php'>Back</a>" : ""); ?></h3>
        </div>

        <div class="panel-body">
            <?php
            $Albums = array_filter(glob('assets/img/gallery/*'), 'is_dir');

            if (isset($_GET['view']) && $_GET['view'] == 'uploads') {
                $DB->where('approved', '1');
                $Photos = $DB->get('tbl_photos');

                foreach ($Photos as $Photo) {
                    ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img src="assets/img/uploads/<?php echo $Photo['photo_name']; ?>"
                                 title="<?php echo $Photo['photo_name']; ?>"
                                 onerror="this.onerror=null;this.src='http://placehold.it/500x300'"
                                 style="width: 500px;height: 250px">
                            <div class="caption text-center">
                                <?php echo "Uploaded by {$Photo['uploader_name']} at {$Photo['uploaded_date']}"; ?>
                                <hr/>
                                <p><?php echo $Photo['photo_comment']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } elseif (isset($_GET['view']) && intval($_GET['view']) < count($Albums)) {
                $Images = glob($Albums[$_GET['view']] . "/*.{jpg,jpeg,png,gif}", GLOB_BRACE);
                foreach ($Images as $img) {
                    ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img src="<?php echo $img; ?>" title="<?php echo substr($img, strrpos($img, '/') + 1) ?>"
                                 onerror="this.onerror=null;this.src='http://placehold.it/500x300'"
                                 style="width: 500px;height: 250px">
                        </div>
                    </div>
                    <?php
                }
            } else {
                for ($i = 0; $i < count($Albums); $i++) {
                    $AlbumName = substr($Albums[$i], strrpos($Albums[$i], '/') + 1);
                    $ThumbnailSrc = Utils::GetRandomImage($Albums[$i]);
                    ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <a href="?view=<?php echo $i; ?>">
                                <img src="<?php echo $ThumbnailSrc; ?>" title="<?php echo $AlbumName; ?>"
                                     onerror="this.onerror=null;this.src='http://placehold.it/500x300'"
                                     style="width: 500px;height: 300px">
                            </a>
                            <div class="caption text-center">
                                <hr/>
                                <a href="?view=<?php echo $i; ?>"><h3><?php echo $AlbumName; ?></h3></a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <a href="?view=uploads">
                            <img src="<?php echo Utils::GetRandomImage("assets/img/uploads/"); ?>" title="User uploads"
                                 onerror="this.onerror=null;this.src='http://placehold.it/500x300'"
                                 style="width: 500px;height: 300px">
                        </a>
                        <div class="caption text-center">
                            <hr/>
                            <a href="?view=uploads"><h3>User uploads</h3></a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>

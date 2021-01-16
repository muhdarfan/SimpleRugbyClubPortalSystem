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
            <h3 class="panel-title">Upload</h3>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <?php
                    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['comment'])) {
                        $Name = htmlspecialchars($_POST['name']);
                        $Email = htmlspecialchars($_POST['email']);
                        $Comment = htmlspecialchars($_POST['comment']);

                        $Target = BASE . "/assets/img/uploads/";
                        $temp = explode(".", $_FILES["image"]["name"]);
                        $newfilename = round(microtime(true)) . '.' . end($temp);

                        if (!(empty($Name) || empty($Email) || $_FILES['image']['error'] > 0)) {
                            if (in_array($_FILES['image']['type'], $Config['Site']['allowedFileType'])) {
                                if (move_uploaded_file($_FILES['image']['tmp_name'], $Target . $newfilename)) {
                                    $Data = array(
                                        'photo_name' => $newfilename,
                                        'photo_comment' => $Comment,
                                        'uploader_name' => $Name,
                                        'uploader_email' => $Email,
                                        'approved' => '0',
                                        'uploaded_date' => $DB->now()
                                    );

                                    $stmt = $DB->insert('tbl_photos', $Data);

                                    if ($stmt) {
                                        $_SESSION['success'] = true;
                                        header("location: {$_SERVER['PHP_SELF']}?result=success");
                                        exit();
                                    } else {
                                        $MSG = "An error has been occured. Please contact administrator.";
                                    }
                                } else {
                                    $MSG = "Failed to upload image. Contact administrator!";
                                }
                            } else {
                                $MSG = "Only jpg, gif, and png files are allowed.";
                            }
                        } else {
                            // Error
                        }
                    }
                    if (isset($_SESSION['success'])) {
                        echo "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close'' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						Your photo has been successfully uploaded and waiting for admin approval. Thank you for your patience!</div>";
                        unset($_SESSION['success']);
                    }

                    if (!empty($MSG)) {
                        echo "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close'' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						{$MSG}</div>";
                    }
                    ?>

                    <form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="name" placeholder="Name" required>
                            <span class="glyphicon glyphicon-user form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                            <span class="glyphicon glyphicon-envelope form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="form-group">
                                    <label for="inputImage">Image</label>
                                    <input type="file" name="image" id="inputImage" accept="image/*"
                                           onchange="readURL(this);">
                                    <p class="help-block">Best resolution of image is 800px x 400px.</p>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <img id="previewImage" src="http://placehold.it/800x400"
                                     onerror="this.onerror=null;this.src='http://placehold.it/800x400'"
                                     class="img-thumbnail" style="width:100%;">
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="comment" rows="3" style="resize: none;"
                                      placeholder="Comment"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Modal -->
<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Image preview</h4>
            </div>
            <div class="modal-body">
                <img src="" id="imagepreview" style="width: 100%; height: 400px;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script>
    $("#previewImage").on("click", function () {
        $('#imagepreview').attr('src', $('#previewImage').attr('src')); // here asign the image to the modal when the user click the enlarge link
        $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
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

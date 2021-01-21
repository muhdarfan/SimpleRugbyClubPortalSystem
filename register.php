<?php
include "core.php";
if (isset($_SESSION['user']))
    header("Location: home.php");
$MSG = array();

if (isset($_POST['name']) && isset($_POST['stud_id']) && isset($_POST['email']) && isset($_POST['phone'])) {
    $Email = htmlspecialchars($_POST['email']);
    $Name = htmlspecialchars($_POST['name']);
    $Matric = htmlspecialchars($_POST['stud_id']);
    $Phone = htmlspecialchars($_POST['phone']);

    if (!(empty($Name) || empty($Matric) || empty($Phone))) {
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $MSG = array('danger', 'Please enter a valid email address');
        } elseif (strlen($Name) < 3 || strlen($Name) > 64) {
            $MSG = array('danger', "Name must be more than 4 characters long.");
        } else {
            $DB->orWhere("userEmail", $Email);
            $DB->orWhere("userNoMatric", $Matric);

            if (!$DB->has("tbl_application")) {
                $stmt = $DB->insert('tbl_application', array(
                    'name' => $Name,
                    'userNoMatric' => $Matric,
                    'userEmail' => $Email,
                    'userPhone' => "60" . $Phone,
                ));

                if ($stmt) {
                    $_SESSION['success'] = true;
                    header("LOCATION: {$_SERVER['PHP_SELF']}?result=success");
                    exit();
                } else {
                    print_r($DB->trace);
                    $MSG = array('danger', "An error has been occurred while querying. Contact administrator.");
                }
            } else {
                $MSG = array("danger", "You already submitted an application!");
            }
        }
    } else {
        $MSG = array("danger", "Please fill in the blanks.");
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>UMP Rugby Club - Register</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
          integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css"/>
</head>
<body>
<?php include 'includes/header.php'; ?>

<div class="container">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Register new application</h3>
        </div>

        <div class="panel-body">

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <?php
                    if (isset($_SESSION['success'])) {
                        echo "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close'' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						Your application has been submitted! Thank you for registering...</div>";
                        unset($_SESSION['success']);
                    }

                    if (!empty($MSG)) {
                        echo "<div class='alert alert-{$MSG[0]} alert-dismissible' role='alert'><button type='button' class='close'' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						{$MSG[1]}</div>";
                    }
                    ?>

                    <form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="name" placeholder="Name" required>
                            <span class="glyphicon glyphicon-user form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                            <span class="glyphicon glyphicon-envelope form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="stud_id" placeholder="Student ID" required>
                            <span class="glyphicon glyphicon-qrcode form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="input-group">
                                <span class="input-group-addon">+60</span>
                                <input type="text" class="form-control" name="phone" placeholder="Phone Number"
                                       required>
                                <span class="glyphicon glyphicon-phone form-control-feedback" aria-hidden="true"></span>
                            </div>

                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>

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

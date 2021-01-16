<?php
include "core.php";
if (isset($_SESSION['user']))
    header("Location: home.php");
$MSG = array();

if (isset($_POST['name']) && isset($_POST['stud_id']) && isset($_POST['email']) && isset($_POST['phone'])) {
    $Email = htmlspecialchars($_POST['email']);
    $User = htmlspecialchars($_POST['name']);
    $Matric = htmlspecialchars($_POST['stud_id']);
    $Phone = htmlspecialchars($_POST['phone']);

    if (!(empty($User) || empty($Matric) || empty($Pass) || empty($Pass2) || empty($Phone))) {
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {

        } elseif (strlen($User) < 4 || strlen($User) > 32) {

        } else {

            /*
            $DB->where("username", $User);
            $DB->orWhere("userEmail", $Email);
            $DB->orWhere("userNoMatric", $Matric);

            if (!$DB->has("tbl_users")) {
                if ($Pass == $Pass2) {
                    $DB->insert('tbl_users', Array(
                        'username' => $User,
                        'userNoMatric' => $Matric,
                        'userEmail' => $Email,
                        'userPass' => $Pass,
                        'userPhone' => $Phone,
                    ));
                    $MSG = Array('success', "Your account has been created! Please sign in to continue...");
                } else {
                    $MSG = Array("danger", "Password is mismatch!");
                }
            } else {
                $MSG = Array("danger", "Username/Email/Matric has already been used!");
            }
            */
        }
    } else {
        $MSG = array("danger", "Username/Password can't be empty!");
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
                            <input type="text" class="form-control" name="phone" placeholder="Phone Number" required>
                            <span class="glyphicon glyphicon-phone form-control-feedback" aria-hidden="true"></span>
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

<?php
include '../core.php';
if (isset($_SESSION['admin']))
    header("LOCATION: home.php");

$Error = "";

if (isset($_POST['username']) && isset($_POST['password'])) {
    $User = htmlspecialchars($_POST['username']);
    $Pass = htmlspecialchars($_POST['password']);

    if (!(empty($User) || empty($Pass))) {
        $DB->where("(adminUsername = ? or adminEmail = ?)", Array($User, $User));
        $DB->where('adminPass', $Pass);
        $Res = $DB->getOne("tbl_admin", Array('adminID'));

        if ($Res['adminID']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['admin'] = true;
            $_SESSION['aID'] = $Res['adminID'];

            header("LOCATION: home.php");
        } else {
            $Error = "User/Pass is invalid.";
        }
    } else {
        $Error = "User/Pass can't be empty.";
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>UMP Rugby Club - Admin Login</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
          integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/login.css"/>
</head>
<body>
<div class="container">
    <div class="col-md-4">
        <h1 class="text-center">Admin Login</h1>

        <div class="panel panel-default" style="padding-top: 10px;">
            <div class="panel-body">
                <p class="text-center">Sign in to start your session.</p>
                <?php
                if ($Error != "") {
                    echo "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close'' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    {$Error}</div>";
                }
                ?>

                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                        <span class="glyphicon glyphicon-user form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <span class="glyphicon glyphicon-eye-close form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

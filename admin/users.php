<?php
include '../core.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['view'])) {
        switch ($_GET['view']) {
            case 'user':
                if ($_GET['action'] == 'add') {
                    $AddData = array(
                        'username' => htmlspecialchars($_POST['username']),
                        'userNoMatric' => htmlspecialchars($_POST['matric']),
                        'userEmail' => $_POST['email'],
                        'userPass' => $_POST['password'],
                        'userPhone' => $_POST['phone'],
                    );

                    $DB->insert('tbl_users', $AddData);
                } elseif ($_GET['action'] == 'edit') {
                    $ID = intval($_POST['editID']);

                    $Username = htmlspecialchars($_POST['eUsername']);
                    $Email = htmlspecialchars($_POST['eEmail']);
                    $Matric = htmlspecialchars($_POST['eMatric']);
                    $Phone = $_POST['ePhone'];

                    $DB->where('userID', $ID);
                    $DB->update('tbl_users', array(
                        'username' => $Username,
                        'userNoMatric' => $Matric,
                        'userEmail' => $Email,
                        'userPhone' => $Phone,
                        'userPass' => $_POST['ePassword']
                    ));
                }
                break;

            case 'admin':
                if ($_GET['action'] == 'add') {
                    $AddData = array(
                        'adminUsername' => $_POST['username'],
                        'adminPass' => $_POST['password'],
                        'adminEmail' => $_POST['email']
                    );

                    $DB->insert('tbl_admin', $AddData);
                } elseif ($_GET['action'] == 'edit') {
                    $ID = intval($_POST['editID']);
                    $Username = htmlspecialchars($_POST['eUsername']);
                    $Email = htmlspecialchars($_POST['eEmail']);

                    $DB->where('adminID', $ID);
                    $DB->update('tbl_admin', array(
                        'adminUsername' => $Username,
                        'adminEmail' => $Email
                    ));
                }
                break;
        }
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $User->adminUsername; ?> - Home</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
          integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/main.css"/>
</head>
<body>
<div class="container">

    <div class="page-header" style="border-bottom: 1px #000 solid;">
        <h1>UMP Rugby Club <small>Admin Panel</small></h1>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <img alt="Brand" width="20" height="20"
                             src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAB+0lEQVR4AcyYg5LkUBhG+1X2PdZGaW3btm3btm3bHttWrPomd1r/2Jn/VJ02TpxcH4CQ/dsuazWgzbIdrm9dZVd4pBz4zx2igTaFHrhvjneVXNHCSqIlFEjiwMyyyOBilRgGSqLNF1jnwNQdIvAt48C3IlBmHCiLQHC2zoHDu6zG1iXn6+y62ScxY9AODO6w0pvAqf23oSE4joOfH6OxfMoRnoGUm+de8wykbFt6wZtA07QwtNOqKh3ZbS3Wzz2F+1c/QJY0UCJ/J3kXWJfv7VhxCRRV1jGw7XI+gcO7rEFFRvdYxydwcPsVsC0bQdKScngt4iUTD4Fy/8p7PoHzRu1DclwmgmiqgUXjD3oTKHbAt869qdJ7l98jNTEblPTkXMwetpvnftA0LLHb4X8kiY9Kx6Q+W7wJtG0HR7fdrtYz+x7iya0vkEtUULIzCjC21wY+W/GYXusRH5kGytWTLxgEEhePPwhKYb7EK3BQuxWwTBuUkd3X8goUn6fMHLyTT+DCsQdAEXNzSMeVPAJHdF2DmH8poCREp3uwm7HsGq9J9q69iuunX6EgrwQVObjpBt8z6rdPfvE8kiiyhsvHnomrQx6BxYUyYiNS8f75H1w4/ISepDZLoDhNJ9cdNUquhRsv+6EP9oNH7Iff2A9g8h8CLt1gH0Qf9NMQAFnO60BJFQe0AAAAAElFTkSuQmCC">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="home.php">Home <span class="sr-only">(current)</span></a></li>
                        <li><a href="news.php">News</a></li>
                        <li><a href="gallery.php">Gallery</a></li>
                        <li class="active"><a href="users.php">Users</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false"><?php echo $User->adminUsername; ?> <span
                                        class="caret"></span></a>
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

    <div class="row">
        <!-- Left Sidebar  -->
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                        <li role="presentation"
                            class="<?php echo (isset($_GET['view']) && $_GET['view'] == 'user') ? 'active' : '' ?>"><a
                                    href="?view=user">User</a></li>
                        <li role="presentation"
                            class="<?php echo (isset($_GET['view']) && $_GET['view'] == 'admin') ? 'active' : '' ?>"><a
                                    href="?view=admin">Admin</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
                    $Data = array();
                    if (isset($_GET['view'])) {
                        if (isset($_GET['action'])) {
                            switch ($_GET['action']) {
                                case "add":
                                    include 'frame/addUser.php';
                                    break;
                                case "edit":
                                    include 'frame/editUser.php';
                                    break;
                                case "delete":
                                    break;
                                default:
                                    header("LOCATION: users.php");
                                    break;
                            }
                        } else {
                            switch ($_GET['view']) {
                                case "user":
                                    $Data = $DB->get("tbl_users", null, array('userID as id', 'username', 'userNoMatric', 'userEmail as email'));
                                    break;

                                case "admin":
                                    $Data = $DB->get("tbl_admin", null, array('adminID as id', 'adminUsername as username', 'adminEmail as email'));
                                    break;
                            }

                            if (count($Data) > 0) {
                                ?>
                                <h3><?php echo strtoupper($_GET['view']); ?> <a
                                            href="<?php echo "?view={$_GET['view']}&action=add"; ?>"
                                            class="btn btn-primary pull-right">Add</a></h3>
                                <hr/>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%;">#</th>
                                        <?php echo ($_GET['view'] == 'user' || $_GET['view'] != 'admin') ? "<th>Matric</th>" : '' ?>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th style="width: 25%;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 0;
                                    foreach ($Data as $uData) {
                                        $count++;
                                        echo "<tr>";
                                        echo "<th scope='row'>{$count}</th>";
                                        echo (isset($uData['userNoMatric'])) ? "<td>{$uData['userNoMatric']}</td>" : "";
                                        echo "<td>{$uData['username']}</td>";
                                        echo "<td>{$uData['email']}</td>";
                                        echo "<td class='text-center'><div class='btn-group' role='group'><a href='?view={$_GET['view']}&action=edit&id={$uData['id']}' class='btn btn-success' role='button'>Edit</a><a href='?view={$_GET['view']}&action=delete&id={$uData['id']}' class='btn btn-danger btn-delete' role='button'>Delete</a></div></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <?php
                            } else {
                                echo "No data to be displayed.";
                            }
                        }
                    } else {
                        echo "Click any button on the left side.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"
        integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd"
        crossorigin="anonymous"></script>
</body>
</html>

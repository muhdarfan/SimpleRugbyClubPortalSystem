<?php
include '../core.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case "add":
                $Name = $_POST['name'];
                $Desc = $_POST['desc'];

                $stmt = $DB->insert("tbl_albums", array(
                    "album_name" => htmlspecialchars($_POST['name']),
                    "album_desc" => htmlspecialchars($_POST['desc'])
                ));

                if ($stmt) {
                    header("LOCATION: {$_SERVER['SCRIPT_NAME']}");
                }
                break;

            case "edit":
                $DB->where("album_id", $_GET['id']);
                $stmt = $DB->update("tbl_albums", array(
                    "album_name" => htmlspecialchars($_POST['eName']),
                    "album_desc" => htmlspecialchars($_POST['eDesc'])
                ));

                if ($stmt) {
                    header("LOCATION: {$_SERVER['SCRIPT_NAME']}");
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

    <title><?php echo $Admin->adminUsername; ?> - Home</title>

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
                        <li><a href="home.php">Home</a></li>
                        <li><a href="news.php">News</a></li>
                        <li class="active"><a href="gallery.php">Gallery</a></li>
                        <li><a href="users.php">Users</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false"><?php echo $Admin->adminUsername; ?> <span
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
        <!-- Main Content -->
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Gallery Albums</h2>
                    <hr/>
                    <div class="pull-right">
                        <a href="?action=add" class="btn btn-default">Add Album</a>
                        <a class="btn btn-default">Add Photo</a>
                    </div>
                    <br/><br/>
                    <?php
                    if (isset($_GET['action'])) {
                        $ID = ($_GET['action'] != "add" ? intval($_GET['id']) : 0);

                        switch ($_GET['action']) {
                            case "add":
                                include "frame/addAlbum.php";
                                break;

                            case "edit":
                                $DB->where('album_id', $ID);
                                $AlbumData = $DB->getOne('tbl_albums');

                                if (empty($AlbumData))
                                    header("LOCATION: gallery.php");

                                include "frame/editAlbum.php";
                                break;

                            case "delete":
                                $DB->where('album_id', $ID);
                                $DB->delete('tbl_albums');
                                header("LOCATION: gallery.php");
                                break;
                        }
                    } else {
                        $Albums = $DB->get('tbl_albums');

                        if (count($Albums) > 0) {
                            ?>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th>Album Name</th>
                                    <th style="width: 20%;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 0;
                                foreach ($Albums as $Album) {
                                    $count++;
                                    echo "<tr>";
                                    echo "<th scope='row'>{$count}</th>";
                                    echo "<td>{$Album['album_name']}</td>";
                                    echo "<td class='text-center'><div class='btn-group' role='group'><a href='?action=edit&id={$Album['album_id']}' class='btn btn-success' role='button'>Edit</a><a href='?action=delete&id={$Album['album_id']}' class='btn btn-danger btn-delete' role='button'>Delete</a></div></td>";
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
<script>
    $(".btn-delete").click(function () {
        return confirm("Are you sure want to delete this album?");
    });
</script>
</body>
</html>

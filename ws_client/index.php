<?php
session_start();
include_once 'Controller/GenreController.php';
include_once 'Controller/BookController.php';
include_once 'Controller/GenreUpdateController.php';
include_once 'util/Utility.php';
include_once 'util/ViewUtil.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta name="author" content="Yosmart Pangidoan Barakhiel (1772022)">
    <meta name="description" content="PHP Navigation and PHP Data Object (PDO)">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemrograman Web 2</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.18/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.18/datatables.min.js"></script>
    <script type="text/javascript" src="js/my_js.js"></script>
</head>
<body>
<div class="page">
    <?php
//    if($_SESSION['user_logged'])
//    {
        ?>
        <header>
            <h2>PHP Navigation 6 PDO</h2>
        </header>
        <nav>
            <ul>
                <li><a href="?menu=hm">Home</a></li>
                <li><a href="?menu=at">About</a></li>
                <li><a href="?menu=gr">Genre</a></li>
                <li><a href="?menu=bk">Book</a></li>
                <li><a href="?menu=out">Logout</a></li>
            </ul>
        </nav>
        <main>
            <?php
            $targetMenu = filter_input(INPUT_GET, 'menu');
            switch ($targetMenu) {
                case 'hm';
                    include_once 'view/home.php';
                    break;
                case 'at';
                    include_once 'view/About.php';
                    break;
                case 'gr';
                    $genreContoller = new GenreController();
                    $genreContoller->index();
                    break;
                case 'gru';
                    $genreUpdateContoller = new GenreUpdateController();
                    $genreUpdateContoller->index();
                    break;
                case 'bk';
                    $bookContoller = new BookController();
                    $bookContoller->index();
                    break;
                case 'out';
                    session_destroy();
                    header("location:index.php");
                    break;
                default;
                    include_once 'view/home.php';
            }
            ?>
        </main>
        <footer>
            Pemrograman Web 2 &copy;2019
        </footer>
        <?php
//    } else
//    {
//        include_once 'view/Login.php';
//    }
    ?>
</div>
</body>
<script type="text/javascript">
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
</html>

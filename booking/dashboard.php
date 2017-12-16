<?php
session_start();
if(!isset($_SESSION['id'])){
    header("Location: index.php");
}

use App\classes\Login;

if(isset($_GET['status'])){
    if($_GET['status'] == 'logout') {
        require '../vendor/autoload.php';
        $message = Login::userLogout();
        $_SESSION['message'] = $message;
    }
}

?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "utf-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <title>Vechical Booking</title>
    <link href = "../assets/admin/css/bootstrap.min.css" rel = "stylesheet">
</head>
<body>
<?php include './includes/header.php';?>

<h3 style="text-align: center" >Welcome to vechical Booking<h3>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../assets/admin/js/bootstrap.min.js"></script>
</body>
</html>
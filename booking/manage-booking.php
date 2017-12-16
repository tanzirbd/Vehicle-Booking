<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ./index.php");
}
require '../vendor/autoload.php';
use App\classes\Login;
use App\classes\Booking;

if(isset($_GET['status'])){
    if($_GET['status'] == 'logout') {
        $message = Login::userLogout();
        $_SESSION['message'] = $message;
    }
}
 $queryResult=Booking::getAllBookingInfo();

$deleteMessage = '';
if (isset($_GET['status'])) {
    $id = $_GET['id'];
    $deleteMessage = Booking::deleteBookinginfo($id);
    $_SESSION['deleteMessage'] = $deleteMessage;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Booking</title>
    <link href="../assets/admin/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'includes/header.php'; ?>
<div class="container" style="margin-top: 80px;" >
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <h3 class="text-center text-primary">Manage Booking Information</h3>
                    <h3 class="text-center text-success"><?php
                        if (isset($_SESSION['updateMessage'])) {
                            echo $_SESSION['updateMessage'];
                            unset($_SESSION['updateMessage']);
                        }
                        ?>
                    </h3>
                    <h3 class="text-center text-danger"><?php
                        if (isset($_SESSION['deleteMessage'])) {
                            echo $_SESSION['deleteMessage'];
                            unset($_SESSION['deleteMessage']);}
                        ?>
                    </h3>
                    <hr/>

                    <tr class="info text-primary">
                        <th>SL No</th>
                        <th>Destination</th>
                        <th>Car Number</th>
                        <th>Booking Time</th>
                        <th>Return Time</th>
                        <th>Pickup From</th>
                        <th>Passengers</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $i=1;
                    while ($booking = mysqli_fetch_assoc($queryResult)) { ?>
                        <tr>
                            <td class="text-center"><?php echo $i; ?></td>
                            <td><?php echo $booking['destination']; ?></td>
                            <td><?php echo $booking['carNumber']; ?></td>
                            <td><?php echo $booking['bookingTime']; ?></td>
                            <td><?php echo $booking['returnTime']; ?></td>
                            <td><?php echo $booking['pickupFrom']; ?></td>
                            <td><?php echo $booking['passengers']; ?></td>
                            <td>
<!--                                <a href="view-blog.php?id=--><?php //echo $booking['id']; ?><!--" class="btn btn-primary btn-xs" title="View Blog Details">-->
<!--                                    <span class="glyphicon glyphicon-zoom-in"></span>-->
<!--                                </a>-->

                                <a href="edit-booking.php?id=<?php echo $booking['id']; ?>" class="btn btn-info btn-xs" title="Edit Booking Info">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                <a href="?status=delete&&id=<?php echo $booking['id']; ?>" class="btn btn-danger btn-xs" title="Delete Booking" onclick="return confirm('Are you sure to delete Booking ID: <?php echo $booking['id']; ?>');">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>
                        </tr>
                        <?php  $i++;  } ?>

                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../assets/admin/js/bootstrap.min.js"></script>
</body>
</html>



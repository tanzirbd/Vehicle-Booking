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
$bookingId = $_GET['id'];
$queryResult =Booking::selectBookingInfoByBookingId($bookingId);
$bookingInfo = mysqli_fetch_assoc($queryResult);

if (isset($_POST['btn'])){
    $updateMessage = Booking::updateBookingInfo($_POST, $bookingId);
    $_SESSION['updateMessage'] = $updateMessage;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Booking</title>
    <!--   <link href="../assets/admin/css/bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.css"> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker-standalone.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>



</head>
<body>
<?php include './includes/header.php';?>
<div class="container" style="margin-top: 80px; ">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data" name="editBookingForm">
                <h3 class="text-center text-primary">Edit Booking</h3>
                <hr/>
                <h3 class="text-center text-success"><?php  ?></h3>

                <div class="form-group">

                    <label for="inputLocation" class="col-sm-2 control-label">Location Name</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="inputPublicationStatus" name="destination" required>
                            <option disabled="disabled">---Select Location Name---</option>
                            <option value="location1">Location 1</option>
                            <option value="location2">Location 2</option>
                            <option value="location3">Location 3</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">

                    <label for="inputCarNumber" class="col-sm-2 control-label">Car Number</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="inputPublicationStatus" name="car_number" required>
                            <option disabled="disabled">---Select Car Number---</option>
                            <option value="car1">Car 1</option>
                            <option value="car2">Car 2</option>
                            <option value="car3">car 3</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">

                    <label for="inputPassengers" class="col-sm-2 control-label">Number of Passengers</label>
                    <div class="col-sm-10">

                        <input type="number" class="form-control" value="<?php echo $bookingInfo['passengers']; ?>" name="passenger" maxlength="15" required >
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPickupFrom" class="col-sm-2 control-label">Pickup Location</label>
                    <div class="col-sm-10">
                        <select class="form-control " id="inputPublicationStatus" name="pickup_from" required>
                            <option disabled="disabled">---Pick Up From---</option>
                            <option value="location1">Location 1</option>
                            <option value="location2">Location 2</option>
                            <option value="location3">Location 3</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputBookingTime" class="col-sm-2 control-label">Booking Time</label>
                    <div class='col-sm-4'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker6'>
                                <input type='text' class="form-control" value="<?php echo $bookingInfo['bookingTime'];?>" name="booking_time" required />
                                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                            </div>
                        </div>
                    </div>

                    <label for="inputReturnTime" class="col-sm-2 control-label">Return Time</label>
                    <div class='col-sm-4'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker7'>
                                <input type='text' class="form-control" value="<?php echo $bookingInfo['returnTime'];?>" name="return_time" required />
                                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="btn" class="btn btn-success btn-block">Save Booking Info</button>
        </div>
    </div>
    </form>
</div>
</div>
</div>

<!---->
<!--<script src="../assets/admin/js/jquery-3.2.1.js"></script>-->
<!--<script src="../assets/admin/js/bootstrap.min.js"></script>-->

<script type="text/javascript">
    $(function () {
        $('#datetimepicker6').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
        });
        $('#datetimepicker7').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            format: 'YYYY-MM-DD HH:mm:ss',
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);

        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });

    });



    document.forms['editBookingForm'].elements['destination'].value = '<?php echo $bookingInfo['destination']; ?>';
    document.forms['editBookingForm'].elements['car_number'].value = '<?php echo $bookingInfo['carNumber']; ?>';
    document.forms['editBookingForm'].elements['pickup_from'].value = '<?php echo $bookingInfo['pickupFrom']; ?>';

</script>

</body>
</html>


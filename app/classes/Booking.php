<?php
/**
 * Created by PhpStorm.
 * User: Tanzir Altaf
 * Date: 10/12/2017
 * Time: 12:17 AM
 */

namespace App\classes;
use App\classes\Database;

class Booking
{
    protected function queryExecution($sql, $status = NULL) {
        $link = Database::db_connect();
        if (mysqli_query($link, $sql)) {
            if ($status) {
                $queryResult = mysqli_query($link, $sql);
                return $queryResult;
            }
            $message = "Booking info saved successfully!!!";
            return $message;
        } else {
            die("Query Problem " . mysqli_error($link));
        }
    }

    public function saveAllBookingInfo($data) {
        $query="SELECT * FROM bookings WHERE bookingTime >='$data[booking_time]' AND returnTime <='$data[return_time]' AND carNumber ='$data[car_number]'";

        if(mysqli_num_rows(mysqli_query(Database::db_connect(),$query)) !=1){
            $sql = "INSERT INTO bookings (userId,destination, carNumber, bookingTime, returnTime, pickupFrom, passengers) VALUES ( '$_SESSION[id]','$data[destination]', '$data[car_number]', '$data[booking_time]','$data[return_time]','$data[pickup_from]','$data[passenger]')";
            $message = Booking::queryExecution($sql);
            return $message;
        }
        else{
            $message='This Car is already booked in this time';
        return $message;
        }
    }

    public function getAllBookingInfo() {
        $sql = "SELECT * FROM bookings WHERE userId=$_SESSION[id] ORDER BY id DESC";
        $status = 'select';
        $queryResult = Booking::queryExecution($sql, $status);
        return $queryResult;
    }

    public function selectBookingInfoByBookingId($bookingId) {
        $sql = "SELECT * FROM bookings WHERE id = '$bookingId' ";
        $status = 'select';
        $queryResult = Booking::queryExecution($sql, $status);
        return $queryResult;
    }

    public function updateBookingInfo($data, $bookingId) {
        $query="SELECT * FROM bookings WHERE bookingTime >='$data[booking_time]' AND returnTime <='$data[return_time]' AND carNumber ='$data[car_number]'";

        if(mysqli_num_rows(mysqli_query(Database::db_connect(),$query)) !=1){
            $sql = "UPDATE bookings SET destination = '$data[destination]', carNumber = '$data[car_number]',bookingTime = '$data[booking_time]',pickupFrom = '$data[pickup_from]', passengers = '$data[passenger]' WHERE id = '$bookingId' ";
            Booking::queryExecution($sql);
            header("Location: ../booking/manage-booking.php");

            session_start();
            $updateMessage = "Booking ID $bookingId: is updated successfully !!!";
            return $updateMessage;
        }
        else{
            $updateMessage='This Car is already booked in this time';
            return $updateMessage;
        }


    }

    public function deleteBookingInfo($id) {
        $sql = "DELETE FROM bookings WHERE id = '$id' ";
        Booking::queryExecution($sql);
//        session_start();
        $deleteMessage = "Booking ID $id: is deleted successfully !!!";
        return $deleteMessage;
    }


}
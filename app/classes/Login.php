<?php


namespace App\classes;
use App\classes\Database;

class Login
{
    public function loginCheck($data)
    {
        $email = $data['userEmail'];
        $password = md5($data['password']);
        $link = Database::db_connect();
        $sql = "SELECT * FROM users WHERE userEmail = '$email' AND password = '$password' ";
        if(mysqli_query($link, $sql)){
            $queryResult = mysqli_query($link, $sql);
            $userInfo = mysqli_fetch_assoc($queryResult);
            if($userInfo){
                session_start();
                $_SESSION['id'] = $userInfo['id'];
                $_SESSION['userEmail'] = $userInfo['UserEmail'];

                header("Location: booking/dashboard.php");
            }else{
                $message = "Please use valid email address & password";
                return $message;
            }
        } else {
            die("Query Problem" . mysqli_error($link));
        }
    }

    public function userLogout(){
        unset($_SESSION['id']);

        header("Location: ../index.php");

        session_start();
        $message = "You have successfully logged out";
        return $message;
    }

}
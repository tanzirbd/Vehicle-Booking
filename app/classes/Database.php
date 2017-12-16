<?php
/**
 * Created by PhpStorm.
 * User: Tanzir Altaf
 * Date: 09/12/2017
 * Time: 3:40 PM
 */

namespace App\classes;
use App\classes\Login;

class Database
{
    public function db_connect(){
        $hostName = 'localhost';
        $userName = 'root';
        $password = '';
        $dbName = 'nit_angola';
        $link = mysqli_connect($hostName, $userName, $password, $dbName);
        return $link;
    }
}

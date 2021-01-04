<?php
include "../functions.php";

class users
{
    public $db;

    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if (mysqli_connect_errno()) {
            echo "Error: Nu se poate conecta la baza de date.";
            exit;
        }
    }

    /*** Login ***/
    public function check_login($emailusername, $password)
    {

        $password = md5($password);
        $sql2 = "SELECT id from admins WHERE uemail='$emailusername' or uname='$emailusername' and upass='$password'";
        //verific daca username exista
        $result = mysqli_query($this->db, $sql2);
        $user_data = mysqli_fetch_array($result);
        $count_row = $result->num_rows;

        if ($count_row == 1) {
            // folosesc sesiune
            $_SESSION['login'] = true;
            $_SESSION['id'] = $user_data['id'];
            return true;
        } else {
            return false;
        }
    }

    /*** afisare username sau fullname ***/
    public function get_fullname($uid)
    {
        $sql3 = "SELECT fullname FROM admins WHERE uid = $uid";
        $result = mysqli_query($this->db, $sql3);
        $user_data = mysqli_fetch_array($result);
        echo $user_data['fullname'];
    }

    /*** start session ***/
    public function get_session()
    {
        return $_SESSION['login'];
    }

    public function user_logout()
    {
        $_SESSION['login'] = FALSE;
        session_destroy();
    }
}


?>
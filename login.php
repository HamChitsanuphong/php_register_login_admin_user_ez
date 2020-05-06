<?php

    session_start();
    require('connections/db_hamterit.php');

    if(isset($_POST['btn_login'])){

        $username = $_POST['txt_username'];
        $password = $_POST['txt_password'];
        $password = md5($password);

        $sql = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn,$sql);
                    
        if ($result->num_rows == 1) {
            $row = mysqli_fetch_array($result);

            $_SESSION["userid"] = $row["userid"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["user_level"] = $row["user_level"];
    
            if ($_SESSION["user_level"] == "admin"){ 
                echo "<script> alert('Login successfully, Welcome admin!'); </script>";
                header ('Refresh: 0; url=admin.php');
            } else { 
                echo "<script> alert('Login successfully, Welcome member!'); </script>";
                header ('Refresh: 0; url=home.php');
            }
        } else {
            echo "<script> alert('Username or Password already exists, Try again!'); </script>";
            header ('Refresh: 0; url=login.php');
        }

    }

?>

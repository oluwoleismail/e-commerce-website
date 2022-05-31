<?php 
    session_start();

    if(empty($email)){
        echo "Your email is required!";
    }
    else{
        if(empty($password)){
            echo "Your password is required!";
        }
        else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo "Your Email is not Valid!";
            }
            else{
                $sql = "SELECT * FROM users where email = '".$email."'";
                $query = mysqli_query($this->makeDB(), $sql);

                if($row = mysqli_fetch_assoc($query)){
                    $your_pass = password_verify($password, $row["password"]);

                    if($your_pass === false){
                        echo "Incorrect Password!";
                    }
                    else{
                        if($your_pass === true){
                            $_SESSION["user_id"] = $row["user_id"];
                            $_SESSION["user_firstname"] = $row["firstname"];
                            $_SESSION["user_lastname"] = $row["lastname"];
                            $_SESSION["user_email"] = $row["email"];
                            $_SESSION["user_homeaddress"] = $row["home"];
                            $_SESSION["user_phonenumber"] = $row["phone"];
                            $_SESSION["joined_date"] = $row["date"];
                            $_SESSION["status"] = $row["status"];

                            echo "success";
                        }
                    }
                }
                else{
                    $sqladmin = "SELECT * FROM admin WHERE username = '".$email."' or email = '".$email."'";
                    $queryadmin = mysqli_query($this->makeDB(), $sqladmin);

                    if($admin = mysqli_fetch_assoc($queryadmin)){
                        $checkpassword = "abduladmin%%#@00$%";
                        if($admin["password"] != $password){
                            echo "Invalid Admin Password!";
                        }else{
                            $_SESSION["admin_id"] = $admin["admin_id"];
                            $_SESSION["holder"] = $admin["holder"];
                            echo "admin success";
                        }
                    }
                    else{
                        echo "Incorrect Email!";
                    }
                }
            }
        }
    }
?>
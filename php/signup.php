<?php 


if(empty($name)){
    echo "Your name is required!";
}
else{
    $explode_name = explode(" ", $name);
    $count_array = count($explode_name);

    if($count_array < 2){
        echo "Your Lastname is Required!";
    }else{
        if($count_array > 2){
            echo "Only your firstname and lastname!";
        }
        else{
            $firstname = $explode_name[0];
            $lastname = $explode_name[1];
                if(!preg_match("/^[a-zA-Z\-]*$/",$firstname) || !preg_match("/^[a-zA-Z\-]*$/",$lastname)){
                    echo "Invalid name Characters!";
                }
                else{
                    if(empty($email)){
                        echo "Your Email is Required!";
                    }
                    else{
                        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                            echo "Email is invalid!";
                        }
                        else{
                            $sql = "SELECT * FROM users where email = '".$email."'";
                            $query = mysqli_query($this->makeDB(), $sql);
                            $count = mysqli_num_rows($query);
                            if($count > 0){
                                echo "Email is being used!";
                            }else{
                                if(empty($password)){
                                    echo "Please Set your Password!";
                                }
                                else{
                                    if(empty($re_pass)){
                                        echo "Please confirm your password!";
                                    }
                                    else{
                                        if($password != $re_pass){
                                            echo "Passwords do not match!";
                                        }
                                        else{
                                            if(empty($home)){
                                                echo "Your home address is required!";
                                            }
                                            else{
                                                if(empty($phone)){
                                                    echo "Your Phone Number is required!";
                                                }
                                                else{
                                                    $agree = filter_input(INPUT_POST, 'agree', FILTER_SANITIZE_STRING);
                    
                                                    if($agree){
                                                        $status = "offline";
                                                        date_default_timezone_set('UTC');
                

                                                        if(strlen(date("j") > 1)){
                                                            $day = "j";
                                                        }else{
                                                            $day = "0j";
                                                        }

                                                        // $joined_date = date("F $day, Y");
                                                        $joined_date = time();
                                                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                                                        $profile_picture = "[]";
                                                        $sql = "INSERT into users (firstname, lastname, email, password, home, phone, date, status, profile_picture) 
                                                        values('$firstname', '$lastname', '$email', '$hashed_password', '$home', '$phone', '$joined_date', '$status', '$profile_picture')";
                                                        $query = mysqli_query($this->makeDB(), $sql) or die("Invalid Sql");
                                                        if($query){
                                                            echo "success";
                                                        }

                    
                                                        
                                                    }
                                                    else{
                                                        echo "You need to accept the terms and conditions!";
                                                    }
                                                }
                                            }
                                        }
                                        
                                    }
                                }
                            }
                        }
                    }
                }
        }
    }
    


}
?>
<?php 
include_once "../../db/index.php";

//Get All Fields data
$name = mysqli_real_escape_string($db, $_POST["name"]);

$email = mysqli_real_escape_string($db, $_POST["email"]);
$password = mysqli_real_escape_string($db, $_POST["pass"]);
$re_pass = mysqli_real_escape_string($db, $_POST["re_pass"]);
$home = mysqli_real_escape_string($db, $_POST["home"]);
$phone = mysqli_real_escape_string($db, $_POST["phone"]);

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
                            $query = mysqli_query($db, $sql);
                            $count = mysqli_num_rows($query);
                            if($count > 0){
                                echo "Email is being used!";
                            }else{
                                if(empty($pass)){
                                    echo "Please Set your Password!";
                                }
                                else{
                                    if(empty($re_pass)){
                                        echo "Please confirm your password!";
                                    }
                                    else{
                                        if($pass != $re_pass){
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
                
                                                        $joined_date = date("F 0j, Y");
                                                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                                                        $sql = "INSERT into users (firstname, lastname, email, password, home, phone, date, status) 
                                                        values('$firstname', '$lastname', '$email', '$hashed_password', '$home', '$phone', '$joined_date', '$status')";
                                                        $query = mysqli_query($db, $sql);
                                                        
                                                        echo "success";
                    
                                                        
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
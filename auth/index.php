<?php 
        if(isset($_GET["login"])){
            $title = "Akmar.Org - Login";
        }
        if(isset($_GET["signup"])){
            $title = "Akmar.Org - Signup";
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title; ?></title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .signup .error-text{
            width:auto;
            background:#ac2615;
            border-top-left-radius:20px;
            border-top-right-radius:20px;
            color:white;
            font-weight:bold;
            text-align:center;
            padding:.5em;
            display:none;
        }
        .sign-in .error-text{
            width:auto;
            background:#ac2615;
            border-top-left-radius:20px;
            border-top-right-radius:20px;
            color:white;
            font-weight:bold;
            text-align:center;
            padding:.5em;
            display:none;
        }
        @media screen and (max-width:576px){
            .signup-image, .signin-image{
                display:none!important;
            }
            .nav-control{
                display:flex;
                justify-content:center;
                align-items:center;
            }
        }
        form a{
            text-decoration:none;
            color:black;
            transition: all 0.6s ease;
        }
        form a:hover{
            color:rgb(197, 123, 4);
        }
    </style>
</head>
<body>

    <div class="main">

        
        


        <?php 
        if(isset($_GET["login"])){
            if(isset($_GET["msg"])){
                $msg = "<div class=\"error-text\" style=\"display:block;\">You have to login first!</div>";
            }else{
                $msg = "";
            }
            echo "<section class=\"sign-in\" style=\"margin-top:-9em;\">
            <div class=\"container\">
                $msg
                <div class=\"error-text\"></div>
                <div class=\"signin-content\">
                    <div class=\"signin-image\">
                        <figure><img src=\"images/signin-image.jpg\" alt=\"sing up image\"></figure>
                        <a href=\"?signup\" class=\"signup-image-link\">Create an account</a>
                    </div>

                    <div class=\"signin-form\">
                        <h2 class=\"form-title\">Sign in</h2>
                        <form method=\"POST\" class=\"register-form\" id=\"login-form\">
                            <div class=\"form-group\">
                                <label for=\"your_email\"><i class=\"zmdi zmdi-account material-icons-name\"></i></label>
                                <input type=\"text\" name=\"your_email\" id=\"your_email\" placeholder=\"Your Email\"/>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"your_pass\"><i class=\"zmdi zmdi-lock\"></i></label>
                                <input type=\"password\" name=\"your_pass\" id=\"your_pass\" placeholder=\"Password\"/>
                            </div>
                            <div class=\"form-group form-button\">
                                <input type=\"submit\" name=\"signin\" id=\"signin\" class=\"form-submit\" value=\"Log in\"/>
                            </div>
                            <input type=\"hidden\" value=\"login\" name=\"type\"/>

                            <div class=\"d-block d-md-block nav-control text-center\"><a href=\"../\">Home</a>&nbsp; | &nbsp; <a href=\"../auth/?signup\">Signup</a></div>
                        </form>
                        <div class=\"social-login\">
                            <span class=\"social-label\">Or login with</span>
                            <ul class=\"socials\">
                                <li><a href=\"#\"><i class=\"display-flex-center zmdi zmdi-facebook\"></i></a></li>
                                <li><a href=\"#\"><i class=\"display-flex-center zmdi zmdi-twitter\"></i></a></li>
                                <li><a href=\"#\"><i class=\"display-flex-center zmdi zmdi-google\"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>";
        }else{
            if(isset($_GET["signup"])){
                echo '<section class="signup" style="margin-top:-9em;">
                <div class="container">
                    <div class="error-text"></div>
                    <div class="signup-content">
                        <div class="signup-form">
                            <h2 class="form-title">Sign up</h2>
                            <form method="POST" class="register-form" id="register-form">
                                <div class="form-group">
                                    <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                    <input type="text" name="name" id="name" placeholder="Your Name"/>
                                </div>
                                <div class="form-group">
                                    <label for="email"><i class="zmdi zmdi-email"></i></label>
                                    <input type="email" name="email" id="email" placeholder="Your Email"/>
                                </div>
                                <div class="form-group">
                                    <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                    <input type="password" name="pass" id="pass" placeholder="Password"/>
                                </div>
                                <div class="form-group">
                                    <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                    <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                                </div>
                                <div class="form-group">
                                    <label for="home"><i class="zmdi zmdi-home"></i></label>
                                    <input type="home" name="home" id="home" placeholder="Your Address"/>
                                </div>
                                <div class="form-group">
                                    <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                                    <input type="phone" name="phone" id="phone" placeholder="Your Phone Number"/>
                                </div>
                                <div class="form-group">
                                    <label for="phone"><i class="zmdi zmdi-my-location"></i></label>
                                    <input type="text" name="location" id="phone" placeholder="Your Location (e.g Lagos, Nigeria)"/>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="agree" id="agree-term" class="agree-term" />
                                    <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                                </div>
                                <div class="form-group form-button">
                                    <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                                </div>
                                <input type="hidden" value="signup" name="type"/>
                                <div class="d-block d-md-block nav-control text-center"><a href="../">Home</a>&nbsp; | &nbsp; <a href="../auth/?login">Login</a></div>
                            </form>
                        </div>
                        <div class="signup-image" style="display:flex; justify-content:center; align-items:center;">
                            <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        </div>
                    </div>
                </div>
            </section>';
            }else{
                header("Location: ../");
                exit();
            }
        }
        ?>
        <!-- Sign in  Form -->
        
        
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/signup.js"></script>
    <script src="js/login.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
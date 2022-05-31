<?php
session_start();
if(empty($adTitle)){
  echo "Ad title cannot be empty!";
}else{
  if(empty($adType)){
    echo "You need to select an ad type!";
  }else{
    if(empty($adCategory)){
      echo "You need to select an ad category!";
    }else{
      if(empty($subCategory)){
        echo "You need to select an ad subcategory!";
      }else{
        if(empty($prodDetails)){
          echo "Please input details about your ad!";
        }else{
          if(strlen($prodDetails) < 50){
            echo "Details about Ad not detailed enough!";
          }else{
            if(empty($proPrice)){
              echo "Please input product price!";
            }else{
              if(!preg_match("/^[0-9\,]+$/", $proPrice)){
                echo "Invalid Price Input!";
              }else{
                if(substr($proPrice, -1) === ","){
                  echo "Invalid Price Input!";
                }else{
                  if(empty($proImage)){
                    echo "Please select some images to upload!";
                  }else{
                    if(count($proImage) < 3){
                      echo "Please select more images!";
                    }else{
                      if(empty($sellerName)){
                        echo "Please input your seller name!";
                      }else{
                        if(empty($sellerNumber)){
                          echo "Please input your seller number!";
                        }else{
                          if(empty($sellerEmail)){
                            echo "Please input your seller email!";
                          }else{
                            if(!filter_var($sellerEmail, FILTER_VALIDATE_EMAIL)){
                              echo "Invalid Seller Email input!";
                            }else{
                              if(empty($sellerAddress)){
                                echo "Please input your seller address!";
                              }else{
                                $agree = filter_input(INPUT_POST, 'terms', FILTER_SANITIZE_STRING);
                                
                                if($agree){
                                  $proPrice = str_replace(',', '', $proPrice);
                                  $array = ["$proImage[0]", "$proImage[1]", "$proImage[2]"];
                                  $arrayImage = json_encode($array);
                                  $date = time();
                                  $sql = "INSERT into categories (name, category, subcategory, date_added, status) VALUES ('".$adTitle."', '".$adCategory."', '".$subCategory."', '".$date."', 'Active')";
                                  $query = mysqli_query($this->makeDB(), $sql) or die("Invalid SQL");
      
                                  if($query){
                                    $user_id = $_SESSION["user_id"];
                                    $sql = "INSERT into product_postings (user_id, details, Location, poster, price, images, ratings) VALUES ('$user_id', '$prodDetails', 'Dhaka Bangladesh', '$sellerName', '$proPrice', '$arrayImage', '0')";
                                    $query = mysqli_query($this->makeDB(), $sql) or die("invalid sql");
                                    if($query){
                                      echo "success";
                                    }
                                  }
                                }else{
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
      }
    }
  }
}
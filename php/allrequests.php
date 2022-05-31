<?php
require_once "../classes.php";
require_once "if_posts.php";

if(isset($_GET["login"])){
new Login($email, $password);
}

if(isset($_GET["signup"])){
  new Register($email, $password, $re_pass, $home, $phone, $name);
}

if(isset($_GET["newAD"])){
  new AD($adTitle, $adType, $adCategory, $subCategory, $prodDetails, $proPrice, $proImage, $sellerName, $sellerNumber, $sellerEmail, $sellerAddress);
}


if(isset($_GET["saverating"])){
  new SaveRating($rating, $product_id);
}

if(isset($_GET["getsubcat"])){
  $category = $_POST["category"];
  new getSubCat($category);
}
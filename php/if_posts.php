<?php
$database = new Database();
if(isset($_POST["adTitle"])){$adTitle = mysqli_real_escape_string($database->makeDB(), $_POST["adTitle"]);}else{
  $adTitle = "";
}
if(isset($_POST["adType"])){$adType = mysqli_real_escape_string($database->makeDB(), $_POST["adType"]);}else{
  $adType = "";
}
if(isset($_POST["adCategory"])){$adCategory = mysqli_real_escape_string($database->makeDB(), $_POST["adCategory"]);}else{
  $adCategory = "";
}
if(isset($_POST["subCategory"])){$subCategory = mysqli_real_escape_string($database->makeDB(), $_POST["subCategory"]);}else{$subCategory = "";}
if(isset($_POST["prodDetails"])){$prodDetails = mysqli_real_escape_string($database->makeDB(), $_POST["prodDetails"]);}else{
  $prodDetails = "";
}
if(isset($_POST["proPrice"])){$proPrice = mysqli_real_escape_string($database->makeDB(), $_POST["proPrice"]);}else{
  $proPrice = "";
}
if(isset($_POST["images"])){$proImage = $_POST["images"];}else{
  $proImage = "";
}
if(isset($_POST["sellerName"])){$sellerName = mysqli_real_escape_string($database->makeDB(), $_POST["sellerName"]);}
if(isset($_POST["sellerNumber"])){$sellerNumber = mysqli_real_escape_string($database->makeDB(), $_POST["sellerNumber"]);}
if(isset($_POST["sellerEmail"])){$sellerEmail = mysqli_real_escape_string($database->makeDB(), $_POST["sellerEmail"]);}
if(isset($_POST["sellerAddress"])){$sellerAddress = mysqli_real_escape_string($database->makeDB(), $_POST["sellerAddress"]);}
// if(isset($_POST["adfeature"])){$adfeature = mysqli_real_escape_string($database->makeDB(), $_POST["adfeature"]);}


if(isset($_POST["your_email"])){
  $email = mysqli_real_escape_string($database->makeDB(), $_POST["your_email"]);
}else{
  if(isset($_POST["email"])){
    $email = mysqli_real_escape_string($database->makeDB(), $_POST["email"]);
  }else{
    $email = "";
  }
}

if(isset($_POST["your_pass"])){
  $password = mysqli_real_escape_string($database->makeDB(), $_POST["your_pass"]);
}else{
  if(isset($_POST["pass"])){
    $password = mysqli_real_escape_string($database->makeDB(), $_POST["pass"]);
  }else{
    $password = "";
  }
}

if(isset($_POST["re_pass"])){
  $re_pass = mysqli_real_escape_string($database->makeDB(), $_POST["re_pass"]);
}else{
  $re_pass = "";
}

if(isset($_POST["home"])){
  $home = mysqli_real_escape_string($database->makeDB(), $_POST["home"]);
}else{
  $home = "";
}

if(isset($_POST["phone"])){
  $phone = mysqli_real_escape_string($database->makeDB(), $_POST["phone"]);
}else{
  $phone = "";
}

if(isset($_POST["name"])){
$name = mysqli_real_escape_string($database->makeDB(), $_POST["name"]);
}else{
  $name = "";
}

// Set type for Operation
if(isset($_POST["type"])){
  $type = mysqli_real_escape_string($database->makeDB(), $_POST["type"]);
}

if(isset($_POST["rating"])){$rating = $_POST["rating"];}
if(isset($_POST["product_id"])){$product_id = $_POST["product_id"];}
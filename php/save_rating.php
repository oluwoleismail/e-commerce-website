<?php 
  session_start();

  if(isset($_SESSION["user_id"])){

    $user_id = $_SESSION["user_id"];

    $sql = "SELECT * FROM ratings where product_id = \"$product_id\" AND user_id = \"$user_id\"";
    $query = mysqli_query($this->makeDB(), $sql);
    if(mysqli_num_rows($query) > 0){
      echo "rated";
    }else{
      $sql = "INSERT into ratings (user_id, product_id, rating) VALUES('".$user_id."', '".$product_id."', '".$rating."')";
      $query = mysqli_query($this->makeDB(), $sql);
      
      if($query){
        $ratingVal = $this->getRating($product_id);
        $sql = "UPDATE product_postings SET ratings = \"$ratingVal\" WHERE post_id = '".$product_id."'";
        $query = mysqli_query($this->makeDB(), $sql);
        if($query){
          echo "Success";
        }
      }
    }

  }else{
    echo "fail";
  }
?>
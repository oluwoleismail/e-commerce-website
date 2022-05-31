<?php 

$sql = "SELECT * FROM categories JOIN product_postings ON categories.category_id = product_postings.post_id WHERE categories.status = 'Active' AND product_postings.ratings >= 3.5 ORDER BY categories.category_id DESC limit 0, 20";
$result = mysqli_query($this->makeDB(), $sql);

if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_array($result)){
    $imageArray = $row["images"];
    $cat = $row["category"];
    $product_id = $row["post_id"];
    $date = $row["date_added"];
    $day = date("j", $date);
    $st_array = ["1", "21", "31"];
        $nd_array = ["2", "22"];
        $th_array = ["4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "24", "25", "26", "27", "28", "29", "30"];
        $rd_array = ["3", "23"];

        if(in_array($day, $st_array)){
          $day = $day."st";
        }else{
          if(in_array($day, $nd_array)){
            $day = $day."nd";
          }else{
            if(in_array($day, $th_array)){
              $day = $day."th";
            }else{
              if(in_array($day, $rd_array)){
                $day = $day."rd";
              }
            }
          }
        }
    $month = date("F", $date);
    $date_added = $day." ".$month;

    $sql = "SELECT * FROM category WHERE category.cat_id = '".$cat."'";
    $query = mysqli_query($this->makeDB(), $sql);
    if($getCat = mysqli_fetch_assoc($query)){
      $category = $getCat["category"];
    }

    $rating = $this->getRating($product_id);
    $details = $this->trunc($row["details"], 20);
    $title = $this->trunc($row["name"], 10);
    $titleSearch = str_replace(' ', '+', $row["name"]);
    $imagedecode = json_decode($imageArray, true);

    for($i=0; $i<count($imagedecode); $i++){
      $image = $imagedecode[0];
    }

    
    echo "<div class='col-sm-12 col-lg-4'>
<div class='product-item bg-light'>
<div class='card'>
<div class='thumb-content'>
<!-- <div class='price'>$200</div> -->
<a href='ad/?title=$titleSearch'>
<img class='card-img-top img-fluid' src='$image' alt='Card image cap' style='height:350px; object-fit: cover;' />
</a>
</div>
<div class='card-body'>
<h4 class='card-title'><a href='ad/?title=$titleSearch'>$title</a></h4>
<ul class='list-inline product-meta'>
  <li class='list-inline-item'>
    <a href='single.html'><i class='fa fa-folder-open-o'></i>$category</a>
  </li>
  <li class='list-inline-item'>
    <a href='#'><i class='fa fa-calendar'></i>$date_added</a>
  </li>
</ul>
<p class='card-text'>$details...</p>
<div class='product-ratings my-2 flex' data-score='$rating'>

</div>
</div>
</div>
</div>
</div>";
  }
}


?>










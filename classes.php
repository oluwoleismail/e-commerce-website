<?php 

class Database
{
  public function makeDB(){
    $db = mysqli_connect("localhost", "root", "", "akmar.org");

    if($db){
      return $db;
    }else{
      $error_db = die("Connection Error");
      return $error_db;
    }
  }

  public function trunc($phrase, $max_words){
      $phrase_array = explode(' ',$phrase);
      if(count($phrase_array) > $max_words && $max_words > 0)
        $phrase = implode(' ', array_slice($phrase_array, 0, $max_words)).'...';
      return $phrase;
  }

  public function getRating($product_id){
    $sql5 = "SELECT * FROM ratings WHERE product_id = '$product_id' and rating = 5";
    $query5 = mysqli_query($this->makeDB(), $sql5);

    $sql4 = "SELECT * FROM ratings WHERE product_id = '$product_id' and rating = 4";
    $query4 = mysqli_query($this->makeDB(), $sql4);

    $sql3 = "SELECT * FROM ratings WHERE product_id = '$product_id' and rating = 3";
    $query3 = mysqli_query($this->makeDB(), $sql3);
    
    $sql2 = "SELECT * FROM ratings WHERE product_id = '$product_id' and rating = 2";
    $query2 = mysqli_query($this->makeDB(), $sql2);

    $sql1 = "SELECT * FROM ratings WHERE product_id = '$product_id' and rating = 1";
    $query1 = mysqli_query($this->makeDB(), $sql1);

    if(mysqli_num_rows($query5) > 0){
      $query5 = mysqli_num_rows($query5);
    }else{
      $query5 = 0;
    }
    if(mysqli_num_rows($query4) > 0){
      $query4 = mysqli_num_rows($query4);
    }
    else{
      $query4 = 0;
    }
    if(mysqli_num_rows($query3) > 0){
      $query3 = mysqli_num_rows($query3);
    }
    else{
      $query3 = 0;
    }
    if(mysqli_num_rows($query2) > 0){
      $query2 = mysqli_num_rows($query2);
    }
    else{
      $query2 = 0;
    }
    if(mysqli_num_rows($query1) > 0){
      $query1 = mysqli_num_rows($query1);
    }
    else{
      $query1 = 0;
    }
    $count = $query1*1 + $query2*2 + $query3*3 + $query4*4 + $query5*5;
    $total = $query1 + $query2 + $query3 + $query4 + $query5;
    if($count != 0){
      $fiveStartScore = $count / $total;
    }else{
      $fiveStartScore = 0;
    }
    




    return $fiveStartScore;

  }

  public function checkIfRated($product_id, $user_id){
    $sql3 = "SELECT * FROM ratings where product_id = \"$product_id\" AND user_id = \"$user_id\"";
    	$query3 = mysqli_query($this->makeDB(), $sql3);
			if(mysqli_num_rows($query3) > 0){
				echo "<div class=\"text-center\">You have rated this product already!.</div>";
			}else{
        echo "<div class=\"starrr\"></div>";
      }
  }

  public function getHomeCat($category){

    $sql = "SELECT * FROM category WHERE category = '".$category."'";
    $query = mysqli_query($this->makeDB(), $sql);
    if(mysqli_num_rows($query) > 0){
      while($row = mysqli_fetch_array($query)){
        $subCatArray = json_decode($row["sub_category"], true);
      }
    }else{
      $count = 0;
    }
      echo '<ul class="category-list" >';
      for($i = 0; $i < count($subCatArray); $i++){
        $object = $subCatArray[$i];
        $obj = $subCatArray[$i];
        if($obj == "fast-food"){
          $obj = "Fast Food";
        }
        if($obj == "It"){
          $obj = "It Jobs";
        }
        if($obj == "Men"){
          $obj = "Men's Wears";
        }
        if($obj == "Women"){
          $obj = "Women's Wears";
        }
        if($obj == "Kid"){
          $obj = "Kid's Wears";
        }
        if($obj == "Part"){
          $obj = "Part-Time";
        }
        if($obj == "Full"){
          $obj = "Full-Time";
        }
        if($obj == "Kitchen"){
          $obj = "Kitchen Cabinets";
        }
        $sql = "SELECT * FROM categories INNER JOIN category on categories.category = category.cat_id WHERE categories.subcategory = \"$object\" AND category.category = \"$category\"";
        $query = mysqli_query($this->makeDB(), $sql);
        $total = mysqli_num_rows($query);
        $categorySearch = str_replace(" ", "+", $category);

        echo "<li><a href=\"category/?category=$categorySearch&subcategory=$object\">$obj <span>$total</span></a></li>";
      }
      echo '</ul>';  

  }

  public function getCatResults($subcategory){
    $sql = "SELECT * FROM categories INNER JOIN product_postings on categories.category_id = product_postings.post_id WHERE categories.subcategory = '$subcategory'";
    $query = mysqli_query($this->makeDB(), $sql);
    $queryvertical = mysqli_query($this->makeDB(), $sql);

    if(mysqli_num_rows($query) > 0){
      echo "<div class=\"product-grid-list\">
      <div class=\"row mt-30\">";
      while($rowhorizontal = mysqli_fetch_array($query)){
        $title = $rowhorizontal["name"];
        $titleSearch = str_replace(" ", "+", $title);
        $imageArray = $rowhorizontal["images"];
        $imagedecode = json_decode($imageArray, true);
        $rating = $rowhorizontal["ratings"];
        $category = $rowhorizontal["category"];
        $details = $this->trunc($rowhorizontal["details"], 20);
        $sqlcat = "SELECT * FROM category WHERE cat_id = \"$category\"";
        $querycat = mysqli_query($this->makeDB(), $sqlcat);
        if($getCat = mysqli_fetch_array($querycat)){
          $category = $getCat["category"];
        }
        $date =$rowhorizontal["date_added"];
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
        $date = $day." ".$month;
        for($i = 0; $i<count($imagedecode); $i++){
          $image = $imagedecode[0];
        }
        echo "
          <div class=\"col-sm-12 col-lg-4 col-md-6\">
            <!-- product card -->
      <div class=\"product-item bg-light\">
      <div class=\"card\">
        <div class=\"thumb-content\">
          <!-- <div class=\"price\">$200</div> -->
          <a href=\"../ad/?title=$titleSearch\">
            <img class=\"card-img-top img-fluid\" src=\"$image\" alt=\"Card image cap\">
          </a>
        </div>
        <div class=\"card-body\">
            <h4 class=\"card-title\"><a href=\"../ad/?title=$titleSearch\">$title</a></h4>
            <ul class=\"list-inline product-meta\">
              <li class=\"list-inline-item\">
                <a href=\"\"><i class=\"fa fa-folder-open-o\"></i>$category</a>
              </li>
              <li class=\"list-inline-item\">
                <a href=\"\"><i class=\"fa fa-calendar\"></i>$date</a>
              </li>
            </ul>
            <p class=\"card-text\">$details...</p>
            <div class=\"product-ratings flex my-2\" data-score=\"$rating\">

            </div>
        </div>
      </div>
      </div>
      </div>
      ";
      }
      echo "</div>
      </div>";


      while($rowvertical = mysqli_fetch_array($queryvertical)){
        $title = $rowvertical["name"];
        $titleSearch = str_replace(" ", "+", $title);
        $imageArray = $rowvertical["images"];
        $imagedecode = json_decode($imageArray, true);
        $rating = $rowvertical["ratings"];
        $category = $rowvertical["category"];
        $details = $rowvertical["details"];
        $sqlcat = "SELECT * FROM category WHERE cat_id = \"$category\"";
        $querycat = mysqli_query($this->makeDB(), $sqlcat);
        if($getCat = mysqli_fetch_array($querycat)){
          $category = $getCat["category"];
        }
        $date = $rowvertical["date_added"];
        $day = date("j", $date)."th";
        $month = date("F", $date);
        $date = $day." ".$month;
        for($i = 0; $i<count($imagedecode); $i++){
          $image = $imagedecode[0];
        }
        echo "<div class=\"ad-listing-list mt-20\">
        <div class=\"row p-lg-3 p-sm-5 p-4\">";
        echo "
        <div class=\"col-lg-4 align-self-center\">
        <a href=\"../ad/?title=$titleSearch\">
            <img src=\"$image\" class=\"img-fluid\" alt=\"\">
        </a>
    </div>
    <div class=\"col-lg-8\">
        <div class=\"row\">
            <div class=\"col-lg-6 col-md-10\">
                <div class=\"ad-listing-content\">
                    <div>
                        <a href=\"../ad/?title=$titleSearch\" class=\"font-weight-bold\">$title</a>
                    </div>
                    <ul class=\"list-inline mt-2 mb-3\">
                        <li class=\"list-inline-item\"><a href=\"\"> <i class=\"fa fa-folder-open-o\"></i> $category</a></li>
                        <li class=\"list-inline-item\"><a href=\"\"><i class=\"fa fa-calendar\"></i> $date</a></li>
                    </ul>
                    <p class=\"pr-5\">$details</p>
                </div>
            </div>
            <div class=\"col-lg-6 align-self-center\">
                <div class=\"product-ratings flex float-lg-right pb-3\" data-score=\"$rating\">

                </div>
            </div>
        </div>
    </div>
      ";
      echo "</div>
      </div>";
            }
      

    }else{
      echo "<div class=\"my-5 text-center\">Oops! No results found!</div>";
    }
  }
}

class Login extends Database
{
  public function __construct($email, $password){
      require_once "php/login.php";
  }
}

class Register extends Database
{
    public function __construct($email, $password, $re_pass, $home, $phone, $name){
      require_once "php/signup.php";
  }
}

class CategorySearch extends Database
{
    public function __construct($subcategory){
      require_once "php/category-search.php";
  }
}

class Category extends Database
{
    public function __construct($sub, $option){
      require_once "php/category.php";
  }
}


class AD extends Database
{
  public function __construct($adTitle, $adType, $adCategory, $subCategory, $prodDetails, $proPrice, $proImage, $sellerName, $sellerNumber, $sellerEmail, $sellerAddress){
    require_once "php/newad.php";
  }
}

class TrendingAd extends Database
{
  public function __construct(){
    require_once "php/trendingad.php";
  }
}

class getAd extends Database
{
  public function __construct($category){
    require_once "php/get_ad.php";
  }
}

class SaveRating extends Database
{
  public function __construct($rating, $product_id){
    require_once "php/save_rating.php";
  }
}

class getSubCat extends Database
{
  public function __construct($category){
    require_once "php/get_subcat.php";
  }
}

class HomeCategory extends Database
{
  public function __construct(){
    require_once "php/home_categories.php";
  }
}

class getUserAds extends Database
{
  public function __construct($user_id){
    require_once "php/get_userads.php";
  }
}


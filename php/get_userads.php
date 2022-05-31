<?php 
$sql = "SELECT * FROM product_postings INNER JOIN categories on product_postings.post_id = categories.category_id WHERE user_id = \"$user_id\" ORDER BY post_id DESC";
$query = mysqli_query($this->makeDB(), $sql);

if(mysqli_num_rows($query) > 0){
  while($row = mysqli_fetch_array($query)){
    $title = $row["name"];
    $titleSearch = str_replace(' ', '+', $row["name"]);
    $adID = $row["post_id"];
    $imageArray = $row["images"];
    $imagedecode = json_decode($imageArray, true);
    $date = $row["date_added"];
    $day = date("j", $date);
    $month = substr(date("F", $date), 0, 3);
    $year = date("Y", $date);
    $date = $month." ".$day.","." ".$year;
    $status = $row["status"];
    $location = $row["Location"];
    for($i=0; $i<count($imagedecode); $i++){
      $image = $imagedecode[0];
    }
    $category = $row["category"];
    $sqlcat = "SELECT * FROM category where category.cat_id = \"$category\"";
    $querycat = mysqli_query($this->makeDB(), $sqlcat);
    while($getCat = mysqli_fetch_array($querycat)){
      $category = $getCat["category"];
    }
    echo "    <tr>
    <td class=\"product-thumb\">
      <img width=\"80px\" height=\"auto\" src=\"$image\" alt=\"$title\"></td>
    <td class=\"product-details\">
      <h3 class=\"title\">$title</h3>
      <span class=\"add-id\"><strong>Ad ID:</strong> $adID</span>
      <span><strong>Posted on: </strong><time>$date</time> </span>
      <span class=\"status active\"><strong>Status: </strong>$status</span>
      <span class=\"location\"><strong>Location: </strong>$location</span>
    </td>
    <td class=\"product-category\"><span class=\"categories\">$category</span></td>
    <td class=\"action\" data-title=\"Action\">
      <div class=\"\">
        <ul class=\"list-inline justify-content-center\">
          <li class=\"list-inline-item\">
            <a data-toggle=\"tooltip\" data-placement=\"top\" title=\"view\" class=\"view\" href=\"../ad/?title=$titleSearch\">
              <i class=\"fa fa-eye\"></i>
            </a>
          </li>
          <li class=\"list-inline-item\">
            <a class=\"edit\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\" href=\"\">
              <i class=\"fa fa-pencil\"></i>
            </a>
          </li>
          <li class=\"list-inline-item\">
            <a class=\"delete\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\" href=\"\">
              <i class=\"fa fa-trash\"></i>
            </a>
          </li>
        </ul>
      </div>
    </td>
  </tr>";
  }
}
?>
    

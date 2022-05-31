<?php
session_start(); 
	if(!isset($_SESSION["user_id"])){
    header("Location: ../auth?login&msg");
    exit();
  }else{
    require_once "../classes.php";
    $user_id = $_SESSION["user_id"];

    $database = new Database();
    $sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
    $query = mysqli_query($database->makeDB(), $sql);
    if($row = mysqli_fetch_assoc($query)){
      $username = $row["firstname"]." ".$row["lastname"];
      $usernumber = $row["phone"];
      $useremail = $row["email"];
      $useraddress = $row["home"];
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Classimax</title>

  <!-- FAVICON -->
  <link href="../img/favicon.png" rel="shortcut icon">
  <!-- PLUGINS CSS STYLE -->
  <!-- <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet"> -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap-slider.css">
  <!-- Font Awesome -->
  <link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Owl Carousel -->
  <link href="../plugins/slick-carousel/slick/slick.css" rel="stylesheet">
  <link href="../plugins/slick-carousel/slick/slick-theme.css" rel="stylesheet">
  <!-- Fancy Box -->
  <link rel="stylesheet" href="../plugins/tailwind/tailwind.min.css">
  <link href="../plugins/fancybox/jquery.fancybox.pack.css" rel="stylesheet">
  <link href="../plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">
  <!-- CUSTOM CSS -->


  <link href="../css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="dropzone.min.css">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body class="body-wrapper">


  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <nav class="navbar navbar-expand-lg navbar-light navigation">
            <a class="navbar-brand" href="../">
              <img src="../images/logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto main-nav ">
                <li class="nav-item active">
                  <a class="nav-link" href="../">Home</a>
                </li>
                <li class="nav-item dropdown dropdown-slide">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="">Dashboard<span><i
                        class="fa fa-angle-down"></i></span>
                  </a>

                  <!-- Dropdown list -->
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="../dashboard/">Dashboard</a>
                    <a class="dropdown-item" href="dashboard-my-ads.html">Dashboard My Ads</a>
                    <a class="dropdown-item" href="dashboard-favourite-ads.html">Dashboard Favourite Ads</a>
                    <a class="dropdown-item" href="dashboard-archived-ads.html">Dashboard Archived Ads</a>
                    <a class="dropdown-item" href="dashboard-pending-ads.html">Dashboard Pending Ads</a>
                  </div>
                </li>
                <li class="nav-item dropdown dropdown-slide">
                  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    Pages <span><i class="fa fa-angle-down"></i></span>
                  </a>
                  <!-- Dropdown list -->
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="../about/">About Us</a>
                    <a class="dropdown-item" href="../contact/">Contact Us</a>
                    <a class="dropdown-item" href="../profile/">User Profile</a>
                    <a class="dropdown-item" href="404.html">404 Page</a>
                    <a class="dropdown-item" href="package.html">Package</a>
                    <a class="dropdown-item" href="single.html">Single Page</a>
                    <a class="dropdown-item" href="store.html">Store Single</a>
                    <a class="dropdown-item" href="single-blog.html">Single Post</a>
                    <a class="dropdown-item" href="blog.html">Blog</a>

                  </div>
                </li>
                <li class="nav-item dropdown dropdown-slide">
                  <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    Listing <span><i class="fa fa-angle-down"></i></span>
                  </a>
                  <!-- Dropdown list -->
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="category.html">Ad-Gird View</a>
                    <a class="dropdown-item" href="ad-listing-list.html">Ad-List View</a>
                  </div>
                </li>
              </ul>

							
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link login-button" href="../logout/">Logout</a>
                </li>
              </ul>

            </div>
          </nav>
        </div>
      </div>
    </div>
  </section>

  <section class="ad-post bg-gray py-5">
    <div class="container postAd">
      <form method="POST" role="form" enctype="multipart/form-data">
        <!-- Post Your ad start -->
        <fieldset class="border border-grey p-4 mb-5">
          <div class="row">
            <div class="col-lg-12">
              <h3>Post Your ad</h3>
            </div>
            <div class="col-lg-6">
              <h6 class="font-weight-bold pt-4 pb-1">Title Of Ad:</h6>
              <input type="text" name="adTitle" class="c border w-100 p-2 bg-white text-capitalize"
                placeholder="Ad title goes here..">
              <h6 class="font-weight-bold pt-4 pb-1">Ad Type:</h6>
              <div class="row px-3">
                <div class="col-lg-4 mr-lg-4 my-2 rounded bg-white">
                  <input type="radio" name="adType" value="personal" id="personal">
                  <label for="personal" class="py-2">Personal</label>
                </div>
                <div class="col-lg-4 mr-lg-4 my-2 rounded bg-white ">
                  <input type="radio" name="adType" value="business" id="business">
                  <label for="business" class="py-2">Business</label>
                </div>
              </div>
              <h6 class="font-weight-bold pt-4 pb-1">Description:</h6>
              <textarea name="prodDetails" id="" class="border p-3 w-100 outline-none" rows="7"
                placeholder="Write details about your product"></textarea>
            </div>
            <div class="col-lg-6">
              <h6 class="font-weight-bold pt-4 pb-1">Select Ad Category:</h6>
              <select name="adCategory" id="inputGroupSelect" class="w-100 cat" onchange = "getCategory()">
                <option selected disabled>Select category</option>
                <option value="1">Electronics</option>
                <option value="2">Food</option>
                <option value="3">Real Estate</option>
                <option value="4">Shoppings</option>
                <option value="5">Jobs</option>
                <option value="6">Vehicles</option>
                <option value="7">Pets</option>
                <option value="8">Services</option>
              </select>

              <div class="subcat">

              </div>

              <div class="price">
                <h6 class="font-weight-bold pt-4 pb-1">Item Price (&#8358; NGN):</h6>
                <div class="row px-3">
                  <div class="col-lg-4 mr-lg-4 rounded bg-white my-2 ">
                    <input type="text" name="proPrice" class="border-0 py-2 w-100 price outline-none" placeholder="Price" id="price">
                  </div>
                  <div class="col-lg-4 mrx-4 rounded bg-white my-2 ">
                    <input type="checkbox" value="Negotiable" id="Negotiable" name="negotiable">
                    <label for="Negotiable" class="py-2">Negotiable</label>
                  </div>
                </div>
              </div>
              <div class="choose-file text-center my-4 py-4 rounded">
                <!-- <label for="file-upload">
                  <span class="d-block font-weight-bold text-dark">Select files to upload</span>
                  <span class="d-block"><i class="fa fa-chevron-down"></i></span>
                  <span class="d-block btn bg-primary text-white my-3 select-files">Select files</span>
                  <span class="d-block">Maximum upload file size: 500 KB</span>
                </label> -->
                <div class="zoneDrop">
                <div class="dImage hidden" id="dImage"></div>
                <div class="rounded-lg dropzone dZone w-full" id="mydropzone"></div>
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        <!-- Post Your ad end -->

        <!-- seller-information start -->
        <fieldset class="border p-4 my-5 seller-information bg-gray">
          <div class="row">
            <div class="col-lg-12">
              <h3>Seller Information</h3>
            </div>
            <div class="col-lg-6">
              <h6 class="font-weight-bold pt-4 pb-1">Seller Name:</h6>
              <input type="text" placeholder="Contact name" value = "<?php echo $username; ?>" class="border w-100 p-2 outline-none" name="sellerName" readonly>
              <h6 class="font-weight-bold pt-4 pb-1">Seller Number:</h6>
              <input type="text" placeholder="Contact Number" value = "<?php echo $usernumber; ?>" class="border w-100 p-2 outline-none" name="sellerNumber" readonly>
            </div>
            <div class="col-lg-6">
              <h6 class="font-weight-bold pt-4 pb-1">Seller Email:</h6>
              <input type="email" placeholder="name@yourmail.com" value = "<?php echo $useremail; ?>" class="border w-100 p-2 outline-none" name="sellerEmail" readonly>
              <h6 class="font-weight-bold pt-4 pb-1">Seller Address:</h6>
              <input type="text" placeholder="Your address" value = "<?php echo $useraddress; ?>" class="border w-100 p-2 outline-none" name="sellerAddress" readonly>
            </div>
            <!-- <div class="col-12">
                    <label for="ingredients" class="form-label">Ingredients</label><br>
                    <small>Example: Brand: Apple</small>
                    <div class="ingredientList">
                        <div class="ingredientDiv mb-1">
                            
                            <input type="text" name="ingredients" class="form-control">
                        </div>
                    </div>
                </div> -->

            <!-- <div class="col-12">
                <button type="button" class="btn btn-primary d-block mt-2 text-white hover:text-white focus:text-white" id="addIngredientsBtn">+ Specification</button>
            </div> -->
          </div>
          

        </fieldset>
        <!-- seller-information end-->

        <!-- ad-feature start -->
        <!-- <fieldset class="border bg-white p-4 my-5 ad-feature bg-gray">
          <div class="row">
            <div class="col-lg-12">

              <h3 class="pb-3">Make Your Ad Featured
                <span class="float-right"><a class="text-right font-weight-normal text-success" href="#">What
                    is featured ad ?</a></span>
              </h3>

            </div>
            <div class="col-lg-6 my-3">
              <span class="mb-3 d-block">Premium Ad Options:</span>
              <ul>
                <li>
                  <input type="radio" id="regular-ad" name="adfeature" value="regular" checked>
                  <label for="regular-ad" class="font-weight-bold text-dark py-1">Regular Ad</label>
                  <span>$00.00</span>
                </li>
                <li>
                  <input type="radio" id="Featured-Ads" value="featured" name="adfeature">
                  <label for="Featured-Ads" class="font-weight-bold text-dark py-1">Top Featured Ads</label>
                  <span>$59.00</span>
                </li>
                <li>
                  <input type="radio" id="urgent-Ads" value="urgentads" name="adfeature">
                  <label for="urgent-Ads" class="font-weight-bold text-dark py-1">Urgent Ads</label>
                  <span>$79.00</span>
                </li>
              </ul>
            </div>
            <div class="col-lg-6 my-3">
              <span class="mb-3 d-block">Please select the preferred payment method:</span>
              <ul>
                <li>
                  <input type="radio" id="bank-transfer" name="adpayment" checked>
                  <label for="bank-transfer" class="font-weight-bold text-dark py-1">Direct Bank Transfer</label>
                </li>
                <li>
                                <input type="radio" id="Cheque-Payment" name="adpayment">
                                <label for="Cheque-Payment" class="font-weight-bold text-dark py-1">Cheque Payment</label>
                            </li>
                <li>
                  <input type="radio" id="Credit-Card" name="adpayment">
                  <label for="Credit-Card" class="font-weight-bold text-dark py-1">Credit Card</label>
                </li>
              </ul>
            </div>
          </div>
        </fieldset> -->
        <!-- ad-feature start -->

        <!-- submit button -->
        <div class="checkbox d-inline-flex">
          <input type="checkbox" id="terms-&-condition" name="terms" class="mt-1">
          <label for="terms-&-condition" class="ml-2">By click you must agree with our
            <span> <a class="text-success" href="../terms-condition.html">Terms & Condition and Posting
                Rules.</a></span>
          </label>
        </div>
        <button type="submit" id="submit-all" class="submit btn btn-primary d-block mt-2 text-white hover:text-white focus:text-white" name="post-ad">Post Your Ad</button>
      </form>
      <!-- <form id="my-awesome-dropzone" class="dropzone">
        This is where the previews
        <div class="dImage"></div>
    <button type="submit" class="sImage">Submit</button>
      </form> -->
 
    </div>
  </section>
  <!--============================
=            Footer            =
=============================-->

  <footer class="footer section section-sm">
    <!-- Container Start -->
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-7 offset-md-1 offset-lg-0">
          <!-- About -->
          <div class="block about">
            <!-- footer logo -->
            <img src="images/logo-footer.png" alt="">
            <!-- description -->
            <p class="alt-color">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
              incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
              laboris nisi ut aliquip ex ea commodo consequat.</p>
          </div>
        </div>
        <!-- Link list -->
        <div class="col-lg-2 offset-lg-1 col-md-3">
          <div class="block">
            <h4>Site Pages</h4>
            <ul>
              <li><a href="#">Boston</a></li>
              <li><a href="#">How It works</a></li>
              <li><a href="#">Deals & Coupons</a></li>
              <li><a href="#">Articles & Tips</a></li>
              <li><a href="../terms-condition.html">Terms & Conditions</a></li>
            </ul>
          </div>
        </div>
        <!-- Link list -->
        <div class="col-lg-2 col-md-3 offset-md-1 offset-lg-0">
          <div class="block">
            <h4>Admin Pages</h4>
            <ul>
              <li><a href="category.html">Category</a></li>
              <li><a href="single.html">Single Page</a></li>
              <li><a href="store.html">Store Single</a></li>
              <li><a href="single-blog.html">Single Post</a>
              </li>
              <li><a href="blog.html">Blog</a></li>



            </ul>
          </div>
        </div>
        <!-- Promotion -->
        <div class="col-lg-4 col-md-7">
          <!-- App promotion -->
          <div class="block-2 app-promotion">
            <div class="mobile d-flex">
              <a href="">
                <!-- Icon -->
                <img src="../images/footer/phone-icon.png" alt="mobile-icon">
              </a>
              <p>Get the Dealsy Mobile App and Save more</p>
            </div>
            <div class="download-btn d-flex my-3">
              <a href="#"><img src="../images/apps/google-play-store.png" class="img-fluid" alt=""></a>
              <a href="#" class=" ml-3"><img src="../images/apps/apple-app-store.png" class="img-fluid" alt=""></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Container End -->
  </footer>
  <!-- Footer Bottom -->
  <footer class="footer-bottom">
    <!-- Container Start -->
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-12">
          <!-- Copyright -->
          <div class="copyright">
            <p>Copyright © <script>
              var CurrentYear = new Date().getFullYear()
              document.write(CurrentYear)
              </script>. All Rights Reserved, theme by <a class="text-primary" href="https://themefisher.com"
                target="_blank">themefisher.com</a></p>
          </div>
        </div>
        <div class="col-sm-6 col-12">
          <!-- Social Icons -->
          <ul class="social-media-icons text-right">
            <li><a class="fa fa-facebook" href="https://www.facebook.com/themefisher" target="_blank"></a></li>
            <li><a class="fa fa-twitter" href="https://www.twitter.com/themefisher" target="_blank"></a></li>
            <li><a class="fa fa-pinterest-p" href="https://www.pinterest.com/themefisher" target="_blank"></a></li>
            <li><a class="fa fa-vimeo" href=""></a></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Container End -->
    <!-- To Top -->
    <div class="top-to">
      <a id="top" class="" href="#"><i class="fa fa-angle-up"></i></a>
    </div>
  </footer>

  <!-- JAVASCRIPTS -->
  <script src="../plugins/jQuery/jquery.min.js"></script>
  <script src="../plugins/bootstrap/js/popper.min.js"></script>
  <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
  <script src="../plugins/bootstrap/js/bootstrap-slider.js"></script>
  <!-- tether js -->
  <script src="../plugins/tether/js/tether.min.js"></script>
  <script src="../plugins/raty/jquery.raty-fa.js"></script>
  <script src="../plugins/slick-carousel/slick/slick.min.js"></script>
  <script src="../plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>
  <script src="../plugins/fancybox/jquery.fancybox.pack.js"></script>
  <!-- <script src="../plugins/smoothscroll/SmoothScroll.min.js"></script> -->
  <!-- google map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places">
  </script>
  <script src="../plugins/google-map/gmap.js"></script>
  <script src="../js/script.js"></script>
  <script src="js/post-ad.js"></script>
  <script src="js/dropzone.min.js"></script>
  <script>
    function getCategory(){
      $.ajax({
        method: "POST",
        url: "../php/allrequests.php?getsubcat",
        data: {'category': $(".cat").val()},
        success: function(data){
          $(".subcat").html(data);
          $('.s-cat').niceSelect();
          // console.log(data);
        }
      })
    }


    // $('.subcat').click(function(){
    //   $.ajax({
    //     method: "POST",
    //     url: "../php/allrequests.php?getsubcat",
    //     data: {'category':}
    //   })
    // })

    var dZone = document.querySelector(".dZone");

    dZone.addEventListener("dragenter", function(){
      dZone.className += " shadow-xl"
    })

    dZone.addEventListener("dragleave", function(){
      dZone.classList.remove("shadow-xl")
    })

    dZone.addEventListener("drop", function(){
      dZone.classList.add("shadow-xl")
    })

    dZone.addEventListener("mouseover", function(){
      dZone.classList.add("shadow-xl")
    })

    dZone.addEventListener("mouseout", function(){
      dZone.classList.remove("shadow-xl")
    })

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("div#mydropzone", {
      url: "../php/allrequests.php?upload",
      autoProcessQueue: false,
      parallelUploads: 3,
      maxFiles: 3,
      addRemoveLinks: true,
      acceptedFiles: ".jpeg,.jpg,.png,.gif",
      accept:function(file, done){
        // console.log(file);
        // console.log("Uploaded")
        done();
      },
      removedfile: function(file){
        file.previewElement.remove();
        // console.log(file.name)
        var reader = new FileReader();
            reader.onload = function (e) {
              let dataURL = e.target.result;
              // $(`.dImage input[value=${e.target.result}]`).remove();
              console.log(dataURL);
              let removedMach = `input[value='${dataURL}']`;
              if(document.querySelector(removedMach).remove()){
                
              };
            }
            reader.readAsDataURL(file);
        
      },
      init: function(){
        myDropzone = this;
        var submitButton = document.querySelector("button[type=submit]")
        submitButton.addEventListener("click", function(e) {
          e.preventDefault();
          if(myDropzone.getQueuedFiles().length >= 3){

            const formPostAdd = document.querySelector(".postAd form"),
            postAdButton = formPostAdd.querySelector("button");
            formPostAdd.onsubmit = (e) =>{
                e.preventDefault();
            }

            let xhr = new XMLHttpRequest();
            let done = XMLHttpRequest.DONE;

            xhr.open("POST", "../php/allrequests.php?newAD", true);
            xhr.onload = () =>{
                if(xhr.readyState === done){
                    if(xhr.status === 200){
                        let data = xhr.response;
                        if(data == "success"){
                          // myDropzone.processQueue();
                         if($("form").trigger('reset')){
                           alert("Successfully added your ad!");
                           myDropzone.removeAllFiles();
                         };
                        }else{
                          alert(data);
                        }
                    }
                }
            }
            let formdata = new FormData(formPostAdd);
            xhr.send(formdata);
            
          }else{
          

  
              const formPostAdd = document.querySelector(".postAd form"),
            postAdButton = formPostAdd.querySelector("button");
            formPostAdd.onsubmit = (e) =>{
                e.preventDefault();
            }

            let xhr = new XMLHttpRequest();
            let done = XMLHttpRequest.DONE;

            xhr.open("POST", "../php/allrequests.php?newAD", true);
            xhr.onload = () =>{
                if(xhr.readyState === done){
                    if(xhr.status === 200){
                        let data = xhr.response;
                        alert(data);
                        // if(data == "Please select some images to upload!"){
                        //   alert("Not enough files to upload")
                        // }else{
                        //   alert(data);
                        // }
                    }
                }
            }
            let formdata = new FormData(formPostAdd);
            xhr.send(formdata);
       


            // alert("Not enough files! or Files Existing")
            // $(".dImage input").remove();
            // myDropzone.removeAllFiles();
            // window.location.reload();

          }
        })
        
        this.on("maxfilesexceeded", function(file, message){
          // alert("Max Files Exceeded")
          this.removeAllFiles();
          this.addFile(file)
        })

        this.on("error", function(file, message, xhr){
          if(xhr == null) this.removeFile(file);
          alert(message)
          return;
        })


          this.on("addedfile", function(file){

          var reader = new FileReader();
            reader.onload = function (e) {

              var input = document.createElement("input");
              input.setAttribute("value", e.target.result)
              input.setAttribute("name", "images[]")
              input.setAttribute("id", "imageID")
              var dImage = document.querySelector(".dImage");
              dImage.append(input)
            };
            reader.readAsDataURL(file);
          // 

        })
        
        
        }
    
        

      
    });
  </script>
</body>

</html>
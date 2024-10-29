<?php
session_start();
if ($_SESSION['userrole'] != "Customer") {
  header("location:../Views/login.php ");
}
require_once("../Controlles/Productcontroller.php");
require_once("../Models/product.php");
require_once("../Controlles/Dbcontroller.php");
require_once("../Models/cart.php");

$cart = new cart();
$UserId = $_SESSION['userid'];

$cat = 0;
$Productcontroller = new Productcontroller();
$products = $Productcontroller->getallproducts();
$cats = $Productcontroller->getallcategorys();

$category = $Productcontroller->get("category");
$merchant = $Productcontroller->get("merchants");
$donation = $Productcontroller->get("donation");
$errmsg = "";
if(isset($_POST["search"])){
  $_SESSION['search']=$_POST["search"];
header("location: ../Views/search.php");
}

if (isset($_POST['add'])) {
  $product_id =   $_POST['product_id'];
  //$quantity = $_POST['quantity'];

  // Set user ID and add item to cart
  $cart->setUserId($UserId);
  $cart->setItems($product_id);
  if (!$cart->userHaspro($UserId, $product_id))
    $cart->addtocart($UserId, $product_id);
    //$cart->ubdatetocart($UserId, $product_id,0);
}
if(isset($_GET["logout"])){
  require_once("../Controlles/Authcontroller.php");
    $auth=new Authcontroller;
    $auth->logout();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Raleway">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="cus_home.css">
  <script type="module" crossorigin src="assets/index.8742a0a0.js"></script>
  <link rel="modulepreload" href="assets/vendor.0e76e1a6.js">
  <link rel="stylesheet" href="assets/index.a155cde7.css">
  <link rel="stylesheet" href="assets/index.fca86069.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script type="module" crossorigin src="assets/index.ff8f4572.js"></script>
  <link rel="modulepreload" href="assets/vendor.688a9bfa.js">
</head>

<body style="overflow-x: hidden;background:#fffae8; ">
  <style>
    .fashion-slider-button {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
    }

    @media (max-width: 641px) {
      .fashion-slider-button {

        transform: none;
        text-align: center;
        margin-top: 10px;
        /* Adjust this value as needed */
      }
    }
  </style>

<nav class="navbar navbar-expand-lg navbar-light fixed-top row d-flex flex-row" style="background: transparent;">
    
    <a class="navbar-brand ml-lg-5 ml-md-2 d-flex flex-row" href="#">
      <div class="pyramid-loader">
      <div class="wrapper">
        <span class="side side1"></span>
        <span class="side side2"></span>
        <span class="side side3"></span>
        <span class="side side4"></span>
        <span class="shadow"></span>
      </div>  
    </div><h3 class=" d-none d-lg-block text-white" >Egy Loyality</h3>
   </a>
   <div class="InputContainer ">
    <form method="post">
      <input placeholder="Search.." id="input" class="input_seachnav" name="search" type="text">
    </form>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto mr-3">
        <li class="nav-item">
  <a class="nav-link text-white textnav" href="cus_home.php">Home</a>
        </li>
        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Hi,<?php echo $_SESSION["username"];?>&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
            </svg>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="view_profile.php">My profile</a>
            <a class="dropdown-item" href="myorder.php">My orders</a>
            <div class="dropdown-divider"></div>
            <form action="" method = "GET">
                    <button class="dropdown-item" href="myorder.php" name="logout">Log out</button>
                  </form>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="contactus.php">Contact Us&nbsp;
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-inbound" viewBox="0 0 16 16">
                  <path d="M15.854.146a.5.5 0 0 1 0 .708L11.707 5H14.5a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 1 0v2.793L15.146.146a.5.5 0 0 1 .708 0m-12.2 1.182a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
              </svg>
          </a>
      </li>
        <li class="nav-item">
            <div class="nav-link text-white textnav"  data-toggle="collapse" data-target=".navbar-collapse" ><?php echo $_SESSION["points"]." Points";?>
                
            </div>
          </li>
        <li class="nav-item">
          <a class="nav-link text-white textnav" href="cart.php" tabindex="-1" aria-disabled="true" >My cart&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
              <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
            </svg></a>
        </li>
      </ul>
    </div>
  </nav>
  <!--end of nav -->

  <!--start of sliders -->
  <div id="app" style="height: 100vh; margin-top: 0;">
    <!-- Fashion slider container -->
    <div class="fashion-slider">
      <div class="swiper">
        <div class="swiper-wrapper">
          <!-- configure slide color with "data-slide-bg-color" attribute #9FA051 -->
          <div class="swiper-slide" data-slide-bg-color="#20c997">
            <!-- slide title wrap -->
            <div class="fashion-slider-title" data-swiper-parallax="-130%">
              <!-- slide title text -->
              <div class="fashion-slider-title-text">Lego</div>
            </div>
            <!-- slide image wrap -->
            <div class="fashion-slider-scale">
              <!-- slide image -->
              <img src="images/LEGO-bricks.webp">
            </div>
          </div>
          <!-- configure slide color with "data-slide-bg-color" #9B89C5attribute -->
          <div class="swiper-slide" data-slide-bg-color="#9FA051">
            <!-- slide title wrap -->
            <div class="fashion-slider-title" data-swiper-parallax="-130%">
              <!-- slide title text -->
              <div class="fashion-slider-title-text">Crate&Barrel</div>
            </div>
            <!-- slide image wrap -->
            <div class="fashion-slider-scale">
              <!-- slide image -->
              <img src="images/960x0.webp">
            </div>
          </div>
          <!-- configure slide color with "data-slide-bg-color" attribute -->
          <div class="swiper-slide" data-slide-bg-color="#8ea9d0">
            <!-- slide title wrap -->
            <div class="fashion-slider-title" data-swiper-parallax="-130%">
              <!-- slide title text -->
              <div class="fashion-slider-title-text">Lululemon</div>
            </div>
            <!-- slide image wrap -->
            <div class="fashion-slider-scale">
              <!-- slide image -->
              <img src="images/mszpKaQVG4Uknnw8Er3TTW-1200-80.jpg">
            </div>
          </div>
          <!-- configure slide color with "data-slide-bg-color"#D7A594 attribute -->
          <div class="swiper-slide" data-slide-bg-color=" #9B89C5">
            <!-- slide title wrap -->
            <div class="fashion-slider-title" data-swiper-parallax="-130%">
              <!-- slide title text -->
              <div class="fashion-slider-title-text">Entertainment venues</div>
            </div>
            <!-- slide image wrap -->
            <div class="fashion-slider-scale">
              <!-- slide image -->
              <img src="images/The-Vic-Theatre.jpg">
            </div>
          </div>
          <!-- configure slide color with "data-slide-bg-color"#D7A594 attribute -->
          <div class="swiper-slide" data-slide-bg-color=" #02194d">
            <!-- slide title wrap -->
            <div class="fashion-slider-title" data-swiper-parallax="-130%">
              <!-- slide title text -->
              <div class="fashion-slider-title-text">Hotel Chains</div>
            </div>
            <!-- slide image wrap -->
            <div class="fashion-slider-scale">
              <!-- slide image -->
              <img src="images/shutterstock_160468445.jpg">
            </div>
          </div>
          <!-- configure slide color with "data-slide-bg-color"#D7A594 attribute -->
          <div class="swiper-slide" data-slide-bg-color="#83929d">
            <!-- slide title wrap -->
            <div class="fashion-slider-title" data-swiper-parallax="-130%">
              <!-- slide title text -->
              <div class="fashion-slider-title-text">Cinemas</div>
            </div>
            <!-- slide image wrap -->
            <div class="fashion-slider-scale">
              <!-- slide image -->
              <img src="images/IMG1553_ScreenXRobina_EVT_110823_S01_0022_Panorama-1SHARKS-2200x1200.jpeg">
            </div>
          </div>

        </div>

        <!-- right/next navigation button -->
        <div class="fashion-slider-button-prev fashion-slider-button">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 350 160 90">
            <g class="fashion-slider-svg-wrap">
              <g class="fashion-slider-svg-circle-wrap">
                <circle cx="42" cy="42" r="40"></circle>
              </g>
              <path class="fashion-slider-svg-arrow" d="M.983,6.929,4.447,3.464.983,0,0,.983,2.482,3.464,0,5.946Z">
              </path>
              <path class="fashion-slider-svg-line" d="M80,0H0"></path>
            </g>
          </svg>
        </div>
        <!-- left/previous navigation button -->
        <div class="fashion-slider-button-next fashion-slider-button">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 350 160 90">
            <g class="fashion-slider-svg-wrap">
              <g class="fashion-slider-svg-circle-wrap">
                <circle cx="42" cy="42" r="40"></circle>
              </g>
              <path class="fashion-slider-svg-arrow" d="M.983,6.929,4.447,3.464.983,0,0,.983,2.482,3.464,0,5.946Z">
              </path>
              <path class="fashion-slider-svg-line" d="M80,0H0"></path>
            </g>
          </svg>
        </div>
      </div>
    </div>
  </div>
  <!--end of sliders -->

  <!--start of category -->
  <div class="col-12 text-center container mt200 " style="margin-top: 100px;">
    <h1 class="text-black-50">Our Categories</h1>
    <div id="app">
      <!-- Spring Slider -->
      <div class="spring-slider">
        <div class="swiper swiper-creative swiper-3d swiper-initialized swiper-horizontal swiper-watch-progress">
          <div class="swiper-wrapper">
            <?php
            foreach ($cats as $category) {
            ?>
              <div class="swiper-slide ppp swiper-slide-visible swiper-slide-fully-visible swiper-slide-active" style="width: 336px; transition-delay: 0ms; z-index: 5; transform: translate3d(calc(0px), calc(0px), calc(0px)) rotateX(0deg) rotateY(0deg) rotateZ(0deg) scale(1); opacity: 1;">
                <form method="get">

                  <input type="hidden" name="tca" value="<?php echo $category['id']; ?>">
                  <button class="button_cat" type="submit" name="f"><?php echo $category["name"]; ?></button>
                </form>
              </div>
            <?php } ?>
            <div class="swiper-button-prev swiper-button-disabled"></div>
            <div class="swiper-button-next"></div>
          </div>
          <div class="swiper-pagination swiper-pagination-bullets swiper-pagination-horizontal"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>
        </div>
      </div>
    </div>


  </div> <!--end of category -->
  <!--start of product -->
  <div class="row row  d-flex justify-content-center  gap-5 " style="width: 90%; margin: 0px 5%;margin-bottom: 110px;">
    <?php
    if (count($products) == 0) {
    } else {
      if (isset($_GET['tca'])) {
        $cat = $Productcontroller->getallcategory($_GET['tca']);
        $pro = $cat;
        echo $_GET['tca'];
      } else {
        $pro = $products;
      }
      foreach ($pro as $product) {
    ?>
        <!--  -->
        <?php
       
         
          if ($product["quantity"] <= 0){
            continue;
          }
        
        ?>
        <div class="mt-5 col-lg-4 col-md-6 col-sm-12 text-center d-flex justify-content-center align-content-center align-items-center">
        <a href="pro.php?id=<?php echo $product['id']; ?>" style="text-decoration: none; color: inherit;">  
        <div class="img" style="overflow: hidden;border: 1px solid;border-radius: 12px;border-color: transparent;">
            <div class="card-product">
              <div class="image_container">
                <img src="<?php echo $product['image']?>" >
              </div>
              <div class="title">
                <span><?php echo $product['name'] ?></span>
              </div>
              <div class="size">
                <span><?php echo $product['merchanty'] ?></span>

              </div>
              <div class="action">
                <div class="price">
                  <span><?php echo $product['price'], '$' ?></span>
                </div>
                <form method="post" style="width:100%;">
                  <button class="cart-button" type="submit" name="add" style="width:100%;">
                    <svg class="cart-icon" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" stroke-linejoin="round" stroke-linecap="round"></path>
                    </svg>
                    <span>Add to cart</span>
                  </button>
                  <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                  <input type="hidden" name="quantity" value="1"> <!-- Assuming quantity is always 1 for now -->
                </form>
              </div>
            </div>
            <div class="mask d-flex justify-content-center align-content-center align-items-center text-center"></div>
          </div>
        </div>
        </a>
    <?php
      }
    }
    ?>
  </div>

  <!--end of product -->
  <!--start footer -->
  <!-- Remove the container if you want to extend the Footer to full width. -->
  <footer class="text-center text-lg-start text-white" style="background-color: #929fba;margin-bottom: -6px; margin-top: 100px;">
        <!-- Grid container -->
        <div class="container p-4 pb-0">
          <!-- Section: Links -->
          <section class="">
            <!--Grid row-->
            <div class="row">
              <!-- Grid column -->
              <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">
                 Egy Loyality
                </h6><p>
                  Here you can use rows and columns to organize your footer
                  content. Lorem ipsum dolor sit amet, consectetur adipisicing
                  elit.
                </p>
                
              </div>
              <!-- Grid column -->
    
              <hr class="w-100 clearfix d-md-none">
    
              <!-- Grid column -->
              <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">About Egy Loyality</h6>
                <p>
                  <a class="text-white" href="aboutus.php">About Us</a>
                </p>
                <p>
                  <a class="text-white">Contact Us</a>
                </p>
                <p>
                  <a class="text-white">Privacy Polocy</a>
                </p>
                <p>
                  <a class="text-white">Use Policy</a>
                </p>
              </div>
              <!-- Grid column -->
    
              <hr class="w-100 clearfix d-md-none">
    
              <!-- Grid column -->
              <hr class="w-100 clearfix d-md-none">
    
              <!-- Grid column -->
              <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
                <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
      <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"></path>
    </svg> New York, NY 10012, US</p>
                <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
      <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"></path>
    </svg> info@gmail.com</p>
                <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
      <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"></path>
    </svg> + 01 234 567 88</p>
                <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-phone-flip" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M11 1H5a1 1 0 0 0-1 1v6a.5.5 0 0 1-1 0V2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v6a.5.5 0 0 1-1 0V2a1 1 0 0 0-1-1m1 13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-2a.5.5 0 0 0-1 0v2a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-2a.5.5 0 0 0-1 0zM1.713 7.954a.5.5 0 1 0-.419-.908c-.347.16-.654.348-.882.57C.184 7.842 0 8.139 0 8.5c0 .546.408.94.823 1.201.44.278 1.043.51 1.745.696C3.978 10.773 5.898 11 8 11q.148 0 .294-.002l-1.148 1.148a.5.5 0 0 0 .708.708l2-2a.5.5 0 0 0 0-.708l-2-2a.5.5 0 1 0-.708.708l1.145 1.144L8 10c-2.04 0-3.87-.221-5.174-.569-.656-.175-1.151-.374-1.47-.575C1.012 8.639 1 8.506 1 8.5c0-.003 0-.059.112-.17.115-.112.31-.242.6-.376Zm12.993-.908a.5.5 0 0 0-.419.908c.292.134.486.264.6.377.113.11.113.166.113.169s0 .065-.13.187c-.132.122-.352.26-.677.4-.645.28-1.596.523-2.763.687a.5.5 0 0 0 .14.99c1.212-.17 2.26-.43 3.02-.758.38-.164.713-.357.96-.587.246-.229.45-.537.45-.919 0-.362-.184-.66-.412-.883s-.535-.411-.882-.571M7.5 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z"></path>
    </svg> + 01 234 567 89</p>
              </div>
              <!-- Grid column -->
    
              <!-- Grid column -->
              <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">Follow us</h6>
    
                <!-- Facebook -->
                <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>
    
                <!-- Twitter -->
                <a class="btn btn-primary btn-floating m-1" style="background-color: #55acee" href="#!" role="button"><i class="fab fa-twitter"></i></a>
    
                <!-- Google -->
                <a class="btn btn-primary btn-floating m-1" style="background-color: #dd4b39" href="#!" role="button"><i class="fab fa-google"></i></a>
    
                <!-- Instagram -->
                <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac" href="#!" role="button"><i class="fab fa-instagram"></i></a>
    
                <!-- Linkedin -->
                <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
                <!-- Github -->
                <a class="btn btn-primary btn-floating m-1" style="background-color: #333333" href="#!" role="button"><i class="fab fa-github"></i></a>
              </div>
            </div>
            <!--Grid row-->
          </section>
          <!-- Section: Links -->
        </div>
        <!-- Grid container -->
    
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
          © 2024 Copyright:
          <a class="text-white" href="https://mdbootstrap.com/">ooeoo</a>
        </div>
        <!-- Copyright -->
      </footer>

  <!-- End of .container -->
  <!--end of footer-->


  <!-- Cloudflare Pages Analytics -->
  <script defer src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{"token": "5b8a4238551240709662b3d2e6eef8a1"}'></script><!-- Cloudflare Pages Analytics -->


  <script src="js/jquery-3.7.0.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/popper.min.js"></script>
</body>

</html>
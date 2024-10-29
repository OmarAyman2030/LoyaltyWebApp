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
$flag=0;
if(isset($_POST["search"])){
$_SESSION["search"]=$_POST["search"];
}

if (isset($_POST['add'])) {
  $product_id =   $_POST['product_id'];
  //$quantity = $_POST['quantity'];

  // Set user ID and add item to cart
  $cart->setUserId($UserId);
  $cart->setItems($product_id);
  if (!$cart->userHaspro($UserId, $product_id))
    $cart->addtocart($UserId, $product_id);
  else
    $cart->ubdatetocart($UserId, $product_id);
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

<?php require_once("../Models/cus_nav.php");?>
  <!--end of nav -->


 
  <!--start of product -->
  <div class="row row  d-flex justify-content-center  gap-5 " style="width: 90%; margin: 0px 5%;margin-bottom: 110px;">
   
    <?php
      foreach ($products as $product) {
    ?>
    <?php
    $x="x".$product["name"];
    $y=$_SESSION["search"];
    $i=strtolower($y);
    $s=strpos($x,$i);
    
    if(!empty($s))
  {  $flag=1;
    ?>    <!--  -->
        <div class="mt-5 col-lg-4 col-md-6 col-sm-12 text-center d-flex justify-content-center align-content-center align-items-center">
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
                <form method="post">
                  <button class="cart-button" type="submit" name="add">
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
        
    <?php
      }
      }
   
   
   if($flag==0){
    ?>
            <div class="alert alert-primary" role="alert">
<?php echo "Result Not found ";?>
</div>
<?php
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
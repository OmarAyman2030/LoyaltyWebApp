<?php
session_start();
if ($_SESSION['userrole'] != "Customer") {
  header("location:../Views/login.php ");
}
require_once("../Controlles/Authcontroller.php");
require_once("../Controlles/Productcontroller.php");
require_once("../Models/product.php");
require_once("../Controlles/Dbcontroller.php");
require_once("../Models/cart.php");
if (!isset($_SESSION['usepoint']))  $up = 0;
else $up = $_SESSION['usepoint'];
$Price = 0;
$Discount = 6.97;
$Texas = 4.97;
$cart = new cart();
$UserId = $_SESSION['userid'];
$cat = 0;
$productC = new Productcontroller;
$db = new Dbcontroller;
$products = $cart->getcart($UserId);
$ps = $_SESSION["points"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["subtract"])) {
    $id = $_POST['subtract'];
    if ($cart->ubdatetocart($UserId, $id, -1)) {
      header("location:../Views/cart.php");
    } else {
      $errmsg = "Something went wrong while updating the cart.";
    }
  } elseif (isset($_POST["add"])) {
    $id = $_POST['add'];
    if ($cart->ubdatetocart($UserId, $id, 1)) {
      header("location:../Views/cart.php");
    } else {
      $errmsg = "Something went wrong while updating the cart.";
    }
  } elseif (isset($_POST["remove"])) {
    $id = $_POST['remove'];
    if ($cart->removefromcart($UserId, $id)) {
      header("location:../Views/cart.php");
    } else {
      $errmsg = "Something went wrong while removing the item from the cart.";
    }
  } elseif (isset($_POST["Purchase"])) {
    $x = $productC->getbyid("customer", $UserId);
    if ($x[0]['sub']) {
      header("location:../Views/payment.php");
    } else
      header("location:../Views/sub.php");
  } else if (isset($_POST["apply"])) {
    // echo 5;
    $point = $_POST["point"];
    if ($point <= $_SESSION["points"] && $point >= 0) {
      // echo $point;
      $_SESSION['usepoint'] = $point;
    } else {
      echo 2;
    }
  }
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
</head>

<body style="overflow-x: hidden;background:#fffae8; ">
  <!--start of nav-->
  <?php require_once("../Models/cus_nav.php");?>
  <!--end of nav-->
  <!--start of cart -->
  <div class="container-fluid">
    <div class="row" style="margin-bottom: 100px;">
      <aside class="col-lg-9">
        <div class="card">
          <div class="table-responsive">
            <table class="table table-borderless table-shopping-cart">
              <thead class="text-muted">
                <tr class="small text-uppercase">
                  <th scope="col">Product</th>
                  <th scope="col" width="120">Quantity</th>
                  <th scope="col" width="120">donation</th>
                  <th scope="col" width="120">Price</th>
                  <th scope="col" width="120">Total Price</th>
                  <th scope="col" class="text-right d-none d-md-block" width="200"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($products as $p) {
                  $n = $p["product_id"];
                  $product = $productC->getbyid("products", $n);
                ?>
                  <tr>
                    <td>
                      <figure class="itemside align-items-center" style="display: flex;width: 100%;">
                        <div class="aside" style="width: 82%;"><img src="<?php echo $product[0]["image"]; ?>" style="width: 41%;height: 12%;height: 152%;" class=""></div>
                        <figcaption class="info" style="width: 50%;"> <a href="#" class="title text-dark" data-abc="true"><?php echo $product[0]["name"]; ?></a>
                          <p class="text-muted small"><?php echo $product[0]["Merchant_N"]; ?></p>
                        </figcaption>
                      </figure>
                    </td>
                    <td>
                      <form method="post">
                        <span>
                          <?php if ($p["quantity"] > 1) { ?>
                            <button type="submit" name="subtract" value="<?php echo $p['product_id']; ?>" style=" background-color: white; border: aliceblue; color: #f5a623; font-size: 20px;font-weight: 600; ">-</button>
                          <?php
                          } else { ?>
                            <button style=" background-color: white; border: aliceblue; color: #5c5b65; font-size: 20px;font-weight: 600; ">-</button>
                          <?php } ?>
                        </span>
                        <span class="title text-dark">
                          <?php echo $p["quantity"]; ?>
                        </span>
                        <span>
                          <?php if ($product[0]["quantity"] > $p["quantity"]) { ?>
                            <button type="submit" name="add" value="<?php echo $p['product_id']; ?>" style=" background-color: white; border: aliceblue; color: #f5a623;font-size: 20px; font-weight: 600;">+</button>
                          <?php
                          } else { ?>
                            <button style=" background-color: white; border: aliceblue; color: #5c5b65; font-size: 20px;font-weight: 600; ">+</button>
                          <?php } ?>
                        </span>
                      </form>
                    </td>
                    <!-- ////////////////////////////// -->
                    <td>
                      <div class="price-wrap" style="display: flex;flex-direction: column;">
                        <var class=""><?php echo $product[0]["donation_p"] ?>%</var>
                      </div>
                    </td>
                    <td>
                      <div class="price-wrap" style="display: flex;flex-direction: column;">
                        <var class=""><?php echo $product[0]["price"]; ?>$</var>
                        <var class="">for each piece</var>
                      </div>
                    </td><?php $t = $product[0]["price"] * $p["quantity"];
                          $Price += $t; ?>$
                    <td>
                      <div class="price-wrap" style="display: flex;flex-direction: column;">
                        <var class=""><?php echo $t ?></var>
                      </div>
                    </td>
                    <td>
                      <form method="post"><button class="btn btn-danger" type="submit" name="remove" value="<?php echo $n; ?>">Remove</button></form>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </aside>
      <aside class="col-lg-3">
        <div class="card mb-3">
          <div class="card-body">
            <form form method="post">>
              <div class="form-group"> <label>Subsituite Points</label>
                <div class="input-group">
                  <input type="text" class="form-control coupon" name="point" id="point" placeholder="<?= isset($_SESSION['usepoint']) ? $_SESSION['usepoint'] . ' Points' : 'Enter Points'; ?>">
                  <span class="input-group-append">
                    <button type="submit" name="apply" class="btn" style="color: white; background: linear-gradient(0deg, #6d28d9 50%, #d9d9d9 125%);">
                      Apply
                    </button>
                  </span>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="card">
          <div class="card-body" style="color: black;/* gap: 26px; */display: flex;flex-direction: column;gap: 12px;">
            <div class="" style="display: flex;justify-content: space-between;">
              <h5>price:</h5>
              <div class=""><?php echo $Price ?>$</div>
            </div>
            <div class="" style="display: flex;justify-content: space-between;">
              <h5>Discount By Point:</h5>
              <div class="text-danger"><?= isset($_SESSION['usepoint']) ? ($Price - $_SESSION['usepoint'] * 0.5) : '0'; ?>$</div>
            </div>
            <div class="" style="display: flex;justify-content: space-between;">
              <h5>Texas:</h5>
              <div class=""><?php echo $Texas ?>$</div>
            </div>
            <div class="" style="display: flex;justify-content: space-between;">
              <h5>Total price:</h5>
              <?php if (($Price + $Texas) >= 0) {
                $up = 0;
                if (isset($_SESSION['usepoint'])) {
                  $up = ($_SESSION['usepoint']) * 0.5;
                 
                }

              ?>
                <div class=""><?php echo $Price + $Texas - $up;
                              $_SESSION["total_price"] = $Price + $Texas  - $up; ?>$</div>
              <?php } else { ?>
                <div class=""> 00.00$</div>
              <?php } ?>
            </div>
            <div>
              <form method="post">
                <button type="submit" name="Purchase" href="#" class="btn" style="color: white; background: linear-gradient(0deg, #6d28d9 50%, #d9d9d9 125%);" data-abc="true" action="search.php"> Make Purchase </button>
              </form>
            </div>
          </div>
        </div>
      </aside>
    </div>
  </div>
  <!--end of cart-->
  <!--start footer-->
  <footer class="text-center text-lg-start text-white" style="background-color: #929fba;margin-bottom: -6px;">
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
            </h6>
            <p>
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
  <!--end footer-->
  <script src="js/jquery-3.7.0.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/popper.min.js"></script>
</body>

</html>
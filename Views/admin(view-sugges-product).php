<?php

session_start();
if($_SESSION['userrole']!="Admin"){
    header("location:../Views/login.php "); 
    
}
if(isset($_GET["logout"])){
  require_once("../Controlles/Authcontroller.php");
    $auth=new Authcontroller;
    $auth->logout();
}
require_once("../Controlles/Productcontroller.php");
require_once("../Models/product.php");
$productC =new Productcontroller;
$products=$productC->get("suggest_products");
$dbController = new Dbcontroller;
if(isset($_POST["acc"])){
  $id=$_POST['acc'];
  if ($dbController->openconnection()) {
      // Construct the query to get product details from suggest_products table
      $query = "SELECT * FROM suggest_products WHERE id = $id";

      // Execute the query
      $result = $dbController->select($query);

      // Check if the result is not empty
      if (!empty($result)) {
          // Fetch the first row (assuming only one row is expected)
          $pro = $result[0];

          // Create a new product instance
          $product = new product;
          $product->setname($pro["name"]);
          $product->setquantity($pro['quantity']);
          $product->setdonation_p($pro['donation_p']);
          $product->setdescription($pro['descripition']);
          $product->setdonationid($pro['donation_id']);
          $product->setprice($pro['price']);
          $product->setmarchantid($pro["Merchant_N"]); // Set merchant name instead of ID
          $product->setcategoryid($pro["category_id"]);
          // Upload image
          //$location = "../Views/imagesP/" . date('h-m-s') .$pro["image"];
              $product->setimage($pro["image"]);

              // Add the product to the database
              if($productC->addproduct($product)){
                $qq = "INSERT INTO response VALUES ('" . $pro['Merchant_N'] . "', '" . $pro['name'] . "', 'Accepted')";
                if($productC->deleteSSproduct($id) && $dbController->executeQuery($qq)){
                header("location: admin(view-sugges-product).php");
                echo "Product added successfully!";
              }
              else{
                echo"error";
              }  
                  
              } else {
                  echo "Failed to add product";
              }
           
      } else {
          echo "Product not found"; // If query fails or no result found
      }

      // Close the database connection
      $dbController->closeconnection();
  } else {
      echo "Database connection failed"; // If database connection is not established
  }
}
if(isset($_POST["rej"])){
  $id=$_POST['rej'];
  if ($dbController->openconnection()){
    $query = "SELECT * FROM suggest_products WHERE id = $id";

    // Execute the query
    $result = $dbController->select($query);
    $pro;
    // Check if the result is not empty
    if (!empty($result)) {
        // Fetch the first row (assuming only one row is expected)
        $pro = $result[0];
    }


    $qq = "INSERT INTO response VALUES ('" .$pro['Merchant_N'] . "', '" . $pro['name'] . "', 'Reject')";
    if($productC->deleteSSproduct($id) && $dbController->executeQuery($qq)){
      header("location: admin(view-sugges-product).php");
      echo "Product added successfully!";
    }
    else{
      echo "something error ";
    }
  }
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
<body style="overflow-x: hidden;background:#fffae8;" >
    <!--start of nav-->
    <?php require_once("../Models/admin_nav.php");
 ?>
      <!--end of nav-->
      <!--start of delete user-->
     <!--end od view contact us  -->
     <div class="container mt-4 d-flex flex-column justify-content-center align-content-center align-items-center ">
        <div class="row" style="
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    ">
    <?php  foreach($products as $p) { ?>
               <div class="message col-lg-5 col-md-5 col-sm-12" style="color: black;display: flex;align-items: center;align-content: center;justify-content: center;">
                <div style="
    display: flex;
    align-items: center;
    align-content: center;
    justify-content: center;
"><img src=<?php echo $p["image"] ?> width="40%"></div>
                <div>Product Name: <?php echo $p["name"]?></div>
                <div>Merchant Name:<?php echo $p["Merchant_N"]?></div>
                <div>Price: <?php echo $p["price"]?></div>
                <div>Quantity: <?php echo $p["quantity"]?></div>
                <div>Denote to: <?php 
                 require_once("../Controlles/Dbcontroller.php");

$dbController = new Dbcontroller;

// Open database connection
if ($dbController->openconnection()) {
    // Construct the query
    $q = "SELECT name FROM donation WHERE id = {$p['donation_id']}";

    // Execute the query using the select method
    $result = $dbController->select($q);

    // Check if the result is not empty
    if (!empty($result)) {
        // Fetch the first row (assuming only one row is expected)
        $merchant = $result[0];
        // Display the merchant name
        echo $merchant['name'];
    } else {
        echo "Merchant not found"; // If query fails or no result found
    }

    // Close the database connection
    $dbController->closeconnection();
} else {
    echo "Database connection failed"; // If database connection is not established
}?></div>
                <div>Denote Percentage: <?php echo $p["donation_p"]?></div>
                <div>Product description :<?php echo $p["descripition"]?></div>
                <div style="
    display: flex;
    flex-direction: row;
    gap: 15px;
">
                  <form action="" method = "POST">
                    <button class="btn btn-success" name="acc" value =<?php echo $p["id"]?> >Accept Product</button></form>
                    <form action="" method = "POST">
                    <button class="btn btn-danger" name="rej" value =<?php echo $p["id"]?>>Reject Product</button>
                  </form>
                </div>
            </div>
         <?php } ?>
        </div>
     </div>
      <!--end of view contact us -->
   

      <script src="js/jquery-3.7.0.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/popper.min.js"></script>
</body>
</html>
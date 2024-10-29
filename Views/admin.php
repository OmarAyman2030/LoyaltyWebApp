
<?php
session_start();
if($_SESSION['userrole']!="Admin"){
    header("location:../Views/login.php "); 
}

require_once("../Controlles/Productcontroller.php");
require_once("../Models/product.php");
$productC=new Productcontroller;
$category=$productC->get("category");
$merchant=$productC->get("merchants");
$donation=$productC->get("donation");
$errmsg="";

if(isset($_POST["Product_Name"]) && isset($_POST["Quantity"]) && isset($_POST["Donation-percentage"]) && isset($_POST["Price"]) && isset($_POST["Description"]) && isset($_FILES["image"])){
  if(!empty($_POST["Product_Name"]) && !empty($_POST["Quantity"]) && !empty($_POST["Price"]) && !empty($_POST["Donation-percentage"]) && !empty($_POST["Description"]) && !empty($_FILES["image"])){

      // Create a new product instance
      $product = new product;
      $product->setname($_POST['Product_Name']);
      $product->setquantity($_POST['Quantity']);
      $product->setdonation_p($_POST['Donation-percentage']);
      $product->setdescription($_POST['Description']);

      // Create a new Dbcontroller instance
      $dbController = new Dbcontroller;

      // Open database connection
      if ($dbController->openconnection()) {
          // Construct the query to get cat_id and name from merchants table
          $merchantId = $_POST['Merchant'];
          $query = "SELECT name, cat_id FROM merchants WHERE id = $merchantId";

          // Execute the query
          $result = $dbController->select($query);

          // Check if the result is not empty
          if (!empty($result)) {
              // Fetch the first row (assuming only one row is expected)
              $merchant = $result[0];
              $catId = $merchant['cat_id'];
              $merchantName = $merchant['name'];
              $product->setmarchantid($merchantName); // Set merchant name instead of ID
              $product->setcategoryid($catId);
          } else {
              echo "Merchant not found"; // If query fails or no result found
          }

          // Close the database connection
          $dbController->closeconnection();
      } else {
          echo "Database connection failed"; // If database connection is not established
      }

      $product->setdonationid($_POST['donation']);
      $product->setprice($_POST['Price']);
      $location = "../Views/imagesP/" . date('h-m-s') . $_FILES["image"]["name"];

      // Upload image
      if(move_uploaded_file($_FILES["image"]["tmp_name"], $location)){  
          $product->setimage($location);
          if($productC->addproduct($product)){
              header("location: admin.php");
          } else {
              $errmsg = "Something Wrong";
          }
      } else {
          $errmsg = "Error in upload";
      }
  } else {
      $errmsg = "Please fill all Fields ";
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
<body style="overflow-x: hidden;background:#fffae8;" >
    <!--start of nav-->
<?php require_once("../Models/admin_nav.php");?>
      <!--end of nav-->
      <!--start of Add Product us-->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
<div class="container"style="margin-bottom: 119px;">
    <div class="contact__wrapper shadow-lg mt-n9">
        <div class="row no-gutters">

     
            <div class="col-lg-12 contact-form__wrapper p-5 order-lg-1">
                <form action="#" method="post" class="contact-form form-validate" novalidate="novalidate"   enctype="multipart/form-data">
                <?php 
          if($errmsg!=""){
            ?>
                    <div class="alert alert-primary" role="alert">
  <?php echo $errmsg;?>
</div>
<?php
          }
          ?>    
                <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label class="required-field" for="Product">Product Name</label>
                           
                                <input type="text" class="form-control" id="firstName" name="Product_Name" placeholder="Product Name">
                            </div>
                        </div>
    
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="Merchant Name">Merchant Name</label>
                                <select class="form-control" name="Merchant">
                                <?php 
                                foreach($merchant as $c){
                                    ?><option value="<?php echo $c["id"]; ?>"><?php echo $c["name"];?></option>
                             <?php         
                                }
                                ?>  
                                 </select>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                          <div class="form-group">
                              <label for="Price">Price</label>
                              <input type="number" class="form-control" id="lastName" name="Price" placeholder="Price">
                          </div>
                      </div>
    
                        
    
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="phone">Quantity</label>
                                <input type="number" min="1" class="form-control" id="phone" name="Quantity" placeholder="Quantity">
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                          <div class="form-group">
                              <label class="required-field" for="Category">Denote to</label>
                              <select class="form-control" name="donation">
                              <?php 
                                foreach($donation as $c){
                                    ?><option value="<?php echo $c["id"]; ?>"><?php echo $c["name"];?></option>
                             <?php         
                                }
                                ?>  
                          </select>
                          </div>
                      </div>


                      <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="Donation-percentage">Donation percentage of the product price</label>
                            <input type="number" min="10" max="80" class="form-control" id="lastName" name="Donation-percentage" placeholder="Donation-percentage">
                        </div>
                      </div>
                         
                     
                      <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="photo">Photo of Product</label>
                            <input type="file"  class="form-control"  name="image" >
                        </div>
                    </div>
    
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label class="required-field" for="message">Product Description</label>
                                <textarea class="form-control" id="message" name="Description" rows="4" placeholder="Hi there, I would like to....."></textarea>
                            </div>
                        </div>
    
                        <div class="col-sm-12 mb-3">
                            <button type="submit" onclick="validateAndSubmit()" name="submit" class="btn" style="color: white; background: linear-gradient(0deg, #6d28d9 50%, #d9d9d9 125%);">Submit</button>
                        </div>
                    </div>
                </form>
              
                <script>
        // Function to show success message in a pop-up window
        function showSuccessPopup() {
            var successMessage = "Product added successfully!";
            window.alert(successMessage); // Open a pop-up window with the success message
        }

        // Function to validate form inputs before submission
        function validateAndSubmit() {
            var inputs = document.querySelectorAll('input[type="text"], input[type="number"], textarea');
            var isEmpty = false;

            inputs.forEach(function(input) {
                if (input.value.trim() === '') {
                    isEmpty = true;
                }
            });

            if (isEmpty) {
              //  window.alert("Please complete all fields");
            } else {
                // If all fields are filled, submit the form
                document.querySelector('form').submit();
                showSuccessPopup();
            }
        }
    </script>
            </div>
            <!-- End  Form Wrapper -->
    
        </div>
    </div>
</div>
      <!--end of add product us-->
   

      <script src="js/jquery-3.7.0.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/popper.min.js"></script>
</body>
</html>
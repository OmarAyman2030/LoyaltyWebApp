
   <?php
   session_start();
   if($_SESSION['userrole']!="Admin"){
       header("location:../Views/login.php "); 
   }
   require_once("../Controlles/Productcontroller.php");
   require_once("../Controlles/Productcontroller.php");
   $product = new Product;
   $id;
   $productC=new Productcontroller;
   $donationss=$productC->get("donation");
   if (isset($_POST['product_id'])) {
    // Retrieve the product ID from the POST data
    $_SESSION["p-id"] = $_POST['product_id'];

    // Include necessary files and instantiate objects
    require_once("../Controlles/Productcontroller.php");
    require_once("../Models/product.php");
    require_once("../Controlles/Dbcontroller.php");
    $productC = new Productcontroller;
    $products = $productC->get("suggest_products");
    $dbController = new Dbcontroller;

    // Fetch product details from the database using the ID
    if ($dbController->openconnection()) {
        // Construct the query to get product details from the "products" table
        $query = "SELECT * FROM products WHERE id = " . $_SESSION['p-id'];


        // Execute the query
        $result = $dbController->select($query);

        // Check if the result is not empty
        if (!empty($result)) {
            // Fetch the first row (assuming only one row is expected)
            $pro = $result[0];

            // Create a new product instance
            $product = new Product;
            $_SESSION["p_name"] = $pro["name"];
            $_SESSION["quantity"] = $pro['quantity'];
            $_SESSION["donation_p"] =$pro['donation_p'];
            $_SESSION["p-descripition"] =$pro['descripition']; // corrected typo
            $_SESSION["don_id"] = $pro['donation_id'];
            $_SESSION["p_price"] =$pro['price'];
            $_SESSION["mer_name"] =$pro["Merchant_N"]; // Set merchant name instead of ID
            $_SESSION["cat-d"] =-$pro["category_id"];
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"]) && isset($_POST['pname']) && isset($_POST['quantity'])&& isset($_POST['price']) && isset($_POST['donation_p']) && isset($_POST['donation_to']) && isset($_POST['description'])  ) {
  if (!empty($_POST["pname"]) && !empty($_POST["quantity"]) && !empty($_POST["price"]) && !empty($_POST["donation_p"]) && !empty($_POST["donation_to"]) && !empty($_POST["description"]) ) {
    $id = $_SESSION['p-id'];
   
    $query = "UPDATE products SET name = '{$_POST['pname']}', quantity = '{$_POST['quantity']}', price = '{$_POST['price']}', donation_p = '{$_POST['donation_p']}', donation_id = '{$_POST['donation_to']}', descripition = '{$_POST['description']}' WHERE id = $id";


    $dbController = new Dbcontroller();
    $dbController->openconnection();

    if ($dbController->executeQuery($query)) {
      $_SESSION["p_name"] =$_POST['pname'];
      $_SESSION["quantity"] =$_POST['quantity'];
      $_SESSION["p_price"]=$_POST['price'];
      $_SESSION["donation_p"] =$_POST['donation_p'];
      $_SESSION["don_id"] = $_POST['donation_to'];
      $_SESSION["p-descripition"] = $_POST['description'];
      header("location:../Views/productD(merchant).php");
      exit(); // Stop further execution
    } else {
      $errmsg = "Something went wrong while updating the user's information.";
    }
  } else {
    $errmsg = "Please fill in all fields.";
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
      <!--end-nam-->
      <div class="container">
        <div class="row gutters" style="
    display: flex;
    justify-content: center;
">
        
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
            <div class="card-body">
            <form action="" method="POST">
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mb-2 text-primary">Product Details</h6>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="fullName">Product Name</label>
                                        <input type="text" class="form-control" id="fullName" name="pname" value="<?php echo $_SESSION["p_name"];?>">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="website">Quantity</label>
                                        <input type="text" class="form-control" id="website" name="quantity" value="<?php echo $_SESSION["quantity"];?>">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="eMail">Merchant Name</label>
                                        <input type="text" class="form-control" id="eMail" name="merchantName" disabled readonly  value="<?php echo $_SESSION["mer_name"];?>">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="phone">Price</label>
                                        <input type="text" class="form-control" id="phone" name="price" value="<?php echo $_SESSION["p_price"];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="Street">Donation Percentage</label>
                                        <input type="text" class="form-control" id="donationPercentage" name="donation_p" value="<?php echo $_SESSION["donation_p"] ;?>">
                                    </div>
                                </div>
                            
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="Street">Donate to</label>
                                        <select class="form-control" name="donation_to" value="<?php  require_once("../Controlles/Dbcontroller.php");

$dbController = new Dbcontroller;

// Open database connection
if ($dbController->openconnection()) {
    // Construct the query
    $q = "SELECT name FROM donation WHERE id = {$_SESSION["don_id"]}";

    // Execute the query using the select method
    $result = $dbController->select($q);

    // Check if the result is not empty
    if (!empty($result)) {
        // Fetch the first row (assuming only one row is expected)
        $donate = $result[0];
        // Display the merchant name
        echo $donate['name'];
    } else {
        echo "Merchant not found"; // If query fails or no result found
    }

    // Close the database connection
    $dbController->closeconnection();
} else {
    echo "Database connection failed"; // If database connection is not established
}?>">
                              <?php 
                                foreach($donationss as $c){
                                    ?><option value="<?php echo $c["id"]; ?>"><?php echo $c["name"];?></option>
                             <?php         
                                }
                                ?>  
                          </select>
                                    </div>
                                </div>
                                
                              </div>
                              <div class="row gutters">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="form-group">
            <label for="Street">Product Description</label>
            <!-- Use the text content between the opening and closing textarea tags for the product description -->
            <textarea class="form-control" id="donationPercentage" name="description"><?php echo $_SESSION["p-descripition"];?></textarea>
        </div>
    </div>
</div>

                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">
                                        <button type="submit" id="submit" name="submit" class="btn" style="color: white; background: linear-gradient(0deg, #6d28d9 50%, #d9d9d9 125%);">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
            </div>
        </div>
        </div>
        </div>
        </div>
<script src="js/jquery-3.7.0.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/popper.min.js"></script>
</body>
</html>
<?php
session_start();
if($_SESSION['userrole']!="Admin"){
    header("location:../Views/login.php "); 
}
require_once("../Controlles/Productcontroller.php");
require_once("../Models/product.php");
$errmsg="";
$productC =new Productcontroller;
$products=$productC->get("products");
if(isset($_POST["remove"])){
  $id=$_POST['remove'];
  if($productC->deleteproduct($id)){
    header("location:../Views/admin(delete-product).php");
  }
  else{
    $errmsg="something wrong";
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
</head>
<body style="overflow-x: hidden;background:#fffae8;" >
    <!--start of nav-->
<?php require_once("../Models/admin_nav.php");
 ?>
      <!--end of nav-->
      <!--start of delete user-->
      <div class="container mt-4">
        <h2 style="color: black;">Product Table</h2>
        <table class="table table-striped">
          <thead>
            <tr>
              <?php echo $errmsg;?>
              <th>Product ID</th>
              <th>Product Name</th>
              <th>Merchant name </th>
              <th>Remove</th>
              <th>Update</th>
            </tr>
          </thead>
          <tbody>
            <?php if(count($products)==0){
                       ?>
                <div class="alert alert-primary" role="alert">
     <?php echo "NO avaliable products";?>
    
   </div> <?php
               }   ?>
          <?php foreach($products as $p) {
$n=$p['Merchant_N'];
$u=$productC->getbyid("merchants",$n);

           ?>
          <tr>
              <td><?php echo $p["id"];?></td>
              <td><?php echo $p["name"];?></td>
              <td><?php echo $n;?></td>
              <td><form method="post"><button class="btn btn-danger" type="submit"  name="remove" value="<?php echo $p["id"];?>">Remove</button></form></td>
              <td>
    <form action="productD(merchant).php" method="POST">
        <input type="hidden" name="product_id" value="<?php echo $p["id"]; ?>">
        <button class="btn btn-success" type="submit">Update</button>
    </form>
</td>

            </tr>
            <?php
             } ?>
          </tbody>
        </table>
      </div></div><!--end od delete user -->
      <!--end of delete user-->
   

      <script src="js/jquery-3.7.0.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/popper.min.js"></script>
</body>
</html>
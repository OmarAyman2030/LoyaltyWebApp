<?php
session_start();
if ($_SESSION['userrole'] != "Admin") {
  header("location:../Views/login.php ");
}
$all;
require_once("../Controlles/Dbcontroller.php");
$dbController =new Dbcontroller;
 if ($dbController->openconnection()) {
    
  $query = "SELECT p.*, pr.donation_p, pr.donation_id,pr.name, d.name AS donation_name FROM payment p JOIN products pr ON p.product_id = pr.id JOIN donation d ON pr.donation_id = d.id";
  // Execute the query
  $result = $dbController->select($query);
  if (!empty($result)) {
   $all= $result;
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
<!--start of nav-->
<?php require_once("../Models/admin_nav.php");
 ?>
<!--end of nav-->
  <!--end of nav-->
      <!--end of nav-->
      <div class="container mt-4">
        <h2 style="color: black;">Orders Table</h2>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Merchant Name</th>
              <th>Quantity</th>
              <th>Profit of Merchant</th>
              <th>Donate to</th>
              <th>Donate by </th>
              <th>Pay by</th>
            </tr>
          </thead>
          <tbody>
           <?php foreach ($all as $a) {?>
            <tr>
              <td><?php echo $a["name"] ;?></td>
              <td><?php echo $a["Merchant-N"] ;?></td>
              <td><?php echo $a["quantity"] ;?></td>
              <td><?php echo $a["price"]-($a["price"] * ($a["donation_p"] / 100 ))."$"; ?></td>
              <td><?php echo $a["donation_name"] ;?></td>
              <td class = "" ><?php echo ($a["price"] * ($a["donation_p"] / 100 ))."$";?></td>
              <td class = "text-danger"><?php echo $a["Pay_by"]."$"; ?></td>
            </tr>
            <?php  } ?>
          </tbody>
        </table>
      </div><!--end od delete user -->
    
      <!--end of view info-->
 
    <!-- End of .container -->
      <!--end of footer-->
      <!-- Cloudflare Pages Analytics --><script defer src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{"token": "5b8a4238551240709662b3d2e6eef8a1"}'></script><!-- Cloudflare Pages Analytics -->


<script src="js/jquery-3.7.0.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/popper.min.js"></script>
</body>
</html>
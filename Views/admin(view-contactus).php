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
     <div class="container mt-4 d-flex flex-column justify-content-center align-content-center align-items-center">
        <?php
 require_once("../Controlles/Dbcontroller.php");
require_once("../Models/contact.php");

$dbController = new Dbcontroller;
if ($dbController->openconnection()) {
    $query = "SELECT * FROM contact_us";
    $contacts = $dbController->select($query);

  
    if ($contacts) {
        
        foreach ($contacts as $contact) {
            ?>
            <div class="message w-50" style="color: black;">
                <div>Name : <?php echo $contact['fname'] . ' ' . $contact['lname']; ?></div>
                <div>Email : <?php echo $contact['email']; ?></div>
                <div>Phone : <?php echo $contact['phone']; ?></div>
                <div>Message : <?php echo $contact['message']; ?></div>
            </div>
            <?php
        }
    } else {
        echo "No contacts found.";
    }
    $dbController->closeconnection();
} else {
    echo "Failed to connect to the database.";
}
?>

            
   
    </div>
      <!--end of view contact us -->
   

      <script src="js/jquery-3.7.0.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/popper.min.js"></script>
</body>
</html>
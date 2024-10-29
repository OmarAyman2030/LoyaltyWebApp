
<?php
session_start();
if ($_SESSION['userrole'] != "Admin") {
    header("location:../Views/login.php");
}

require_once("../Controlles/Dbcontroller.php");
$errmsg = "";
$dbController = new Dbcontroller;
$users = $dbController->get("users");

require_once("../Controlles/Dbcontroller.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove'])) {
  $id = $_POST['remove'];
  $query = "DELETE FROM users WHERE id = $id";
  $dbController->openconnection();
  if ($dbController->executeQuery($query)) {
      header("location:../Views/admin(delete-user).php");
      exit(); // Stop further execution
  } else {
      $errmsg = "Something went wrong while deleting the user.";
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
        <h2 style="color: black;">User Table</h2>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>User ID</th>
              <th>Email</th>
              <th>Name</th>
              <th>User Role</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user) { ?>
                <tr>
                  <?php if( $user["role_id"] == "1"){continue ;}?>
                    <td><?php echo $user["id"]; ?></td>
                    <td><?php echo $user["email"]; ?></td>
                    <td><?php echo $user["fname"]." ".$user["lname"]; ?></td>
                  <td><?php if( $user["role_id"] == "2"){echo "Customer";}
                  if( $user["role_id"] == "3"){echo "Merchant";} ?></td>
                    <td>
                        <form method="post">
                            <button class="btn btn-danger" type="submit" name="remove" value="<?php echo $user["id"]; ?>">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        </table>
      </div></div><!--end od delete user -->
      <!--end of delete user-->
   

      <script src="js/jquery-3.7.0.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/popper.min.js"></script>
</body>
</html>
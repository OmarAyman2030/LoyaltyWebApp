<?php
session_start();

require_once("../Controlles/Authcontroller.php");
require_once("../Controlles/Dbcontroller.php");

// Logout Handling
if (isset($_GET["logout"])) {
    $auth = new Authcontroller;
    $auth->logout();
}

// Form Submission Handling
if ($_SERVER["REQUEST_METHOD"] == "POST" &&  isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['phone'])) {
    if (!empty($_POST["firstName"]) && !empty($_POST["lastName"]) && !empty($_POST["phone"])) {
        $id = $_SESSION['userid'];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $phone = $_POST["phone"];

        $query = "UPDATE `users` SET fname = '$firstName', lname = '$lastName', phone = '$phone' WHERE `id` = $id";

        $dbController = new Dbcontroller();
        $dbController->openconnection();
        
        if ($dbController->executeQuery($query)) {
            $_SESSION["username"]=$firstName;
            $_SESSION["lname"]=$lastName;
            $_SESSION["userphone"]=$phone;
            header("location:../Views/view_profile(admin).php");
            exit(); // Stop further execution
        } else {
            $errmsg = "Something went wrong while updating the user's information.";
        }
    } else {
        $errmsg = "Please fill in all fields.";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['oldPassword']) && isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {
    $id = $_SESSION['userid'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
  
    // Ensure all fields are filled
    if (!empty($oldPassword) && !empty($newPassword) && !empty($confirmPassword)) {
      // Check if new password matches confirm password
      if ($newPassword === $confirmPassword && $oldPassword == $_SESSION["password"]) {
        // Hash the new password
        // Query to update password
        $query = "UPDATE users SET password = '$newPassword' WHERE id = $id";
  
        $dbController = new Dbcontroller();
        $dbController->openconnection();
  
        if ($dbController->executeQuery($query)) {
          // Update session with hashed password
          $_SESSION['password'] = $newPassword;
          header("location:../Views/view_profile.php");
          exit(); // Stop further execution
        } else {
          $errmsg = "Something went wrong while updating the password.";
        }
      } else {
        $errmsg = "New password and confirm password do not match.";
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
      <!--end of nav-->
      <!--start of view info-->
      <div class="container">
        <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
            <div class="card-body">
                <div class="account-settings">
                    <div class="user-profile">
                        <div class="user-avatar">
                            <img src="images/userp-removebg-preview.png" alt="Maxwell Admin">
                        </div>
                        <h5 class="user-name">Yuki Hayashi</h5>
                        <h6 class="user-email"><?php echo $_SESSION["useremail"];?></h6>
                    </div>
                    <div class="about text-black-50">
                        <h5>About</h5>
                        <p><?php echo "You are ".$_SESSION["userrole"]?></p>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
    <div class="card-body">
        <!-- Personal Details Form -->
        <form class="row gutters mb-4" method="post" action="">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h6 class="mb-2 text-primary">Personal Details</h6>
            </div>
            <!-- Personal Information Fields -->
            <!-- First Name -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="fullName">First Name</label>
                    <input type="text" class="form-control" id="fullName" name="firstName" placeholder="Enter full name" value="<?php echo $_SESSION["username"]; ?>">
                </div>
            </div>
            <!-- Last Name -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="website">Last Name</label>
                    <input type="text" class="form-control" id="website" name="lastName" placeholder="Enter last name" value="<?php echo $_SESSION["lname"]; ?>">
                </div>
            </div>
            <!-- Email -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="eMail">Email</label>
                    <input type="email" class="form-control" id="eMail" name="email" placeholder="Enter email ID" disabled readonly value="<?php echo $_SESSION["useremail"]; ?>">
                </div>
            </div>
            <!-- Phone -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" value="<?php echo $_SESSION["userphone"]; ?>">
                </div>
            </div>
            <!-- Submit Button -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="text-right">
                    <button type="submit" name="per-info" class="btn" style="color: white; background: linear-gradient(0deg, #6d28d9 50%, #d9d9d9 125%);">Update information</button>
                </div>
            </div>
        </form>
        
        <!-- Password Form -->
        <form class="row gutters mt-4" method="post" action="">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h6 class="mt-3 mb-2 text-primary">Password</h6>
            </div>
            <!-- Old Password -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="oldPassword">Old Password</label>
                    <input type="password" class="form-control" id="oldPassword" name="oldPassword"   placeholder="Enter Old Password">
                </div>
            </div>
            <!-- New Password -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="newPassword">New Password</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter New Password">
                </div>
            </div>
            <!-- Confirm New Password -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="confirmPassword">Re-New Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Re-Enter New Password">
                </div>
            </div>
            <!-- Submit Button -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="text-right">
                    <button type="submit" class="btn" style="color: white; background: linear-gradient(0deg, #6d28d9 50%, #d9d9d9 125%);">Update Password</button>
                </div>
            </div>
        </form>
       
    </div>
</div>

        </div>
      <!--end of view info-->
    
      <!-- Cloudflare Pages Analytics --><script defer src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{"token": "5b8a4238551240709662b3d2e6eef8a1"}'></script><!-- Cloudflare Pages Analytics -->


<script src="js/jquery-3.7.0.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/popper.min.js"></script>
</body>
</html>
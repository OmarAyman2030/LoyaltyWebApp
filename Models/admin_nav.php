<nav class="navbar navbar-expand-lg navbar-light  row d-flex flex-row" style= "margin-bottom: 100px;background: linear-gradient(0deg, #6d28d9 50%, #d9d9d9 125%);" >
    <a class="navbar-brand ml-lg-5 ml-md-2 d-flex flex-row" href="#">
      <div class="pyramid-loader">
      <div class="wrapper">
        <span class="side side1"></span>
        <span class="side side2"></span>
        <span class="side side3"></span>
        <span class="side side4"></span>
        <span class="shadow"></span>
      </div>  
    </div><h3 class=" d-none d-lg-block text-white" >Egy Loyality</h3>
   </a>
  
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto mr-3">
          <li class="nav-item">
  <a class="nav-link text-white textnav" href="admin.php">Add Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white textnav" href="viewpayment.php">View Payment</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white textnav" href="admin(delete-user).php">Delete user</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white textnav" href="admin(delete-product).php">View Product</a>
                    </li>
          <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Hi<?php echo ",".$_SESSION["username"];?>&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
              </svg>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="view_profile(admin).php">My profile</a>
              <div class="dropdown-divider"></div>
              <form action="" method = "GET">
              <button class="dropdown-item" href="#" name="logout">Log out</button>
            </form>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="admin(view-contactus).php">View Contact Us&nbsp;
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-inbound" viewBox="0 0 16 16">
                    <path d="M15.854.146a.5.5 0 0 1 0 .708L11.707 5H14.5a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 1 0v2.793L15.146.146a.5.5 0 0 1 .708 0m-12.2 1.182a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                </svg>
            </a>
        </li>
          <li class="nav-item">
            <a class="nav-link text-white textnav" href="admin(view-sugges-product).php" tabindex="-1" aria-disabled="true" >view suggest product
            </a>
          </li>
        </ul>
      </div>
  </nav>
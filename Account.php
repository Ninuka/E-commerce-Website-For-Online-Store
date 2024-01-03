<?php


session_start();
include('sever/connection.php');

if(!isset($_SESSION['logged_in'])){
  header('location: login.php');
  exit;
}



if(isset($_GET['logout'])){
  if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    header('location: login.php');
    exit;
  }
}

//change password
if(isset($_POST['change_password'])){

  $password=$_POST['password'];
  $confirmPassword  = $_POST['Confirmpassword'];
  $user_email =$_SESSION['user_email'];

   //if password dont match
   if($password !== $confirmPassword) {
    header('location: Account.php?error=Password dont match' );
  
  
  //if passwoerd is less that 6 
  }else if(strlen($password)<6){
    header('location: Account.php?error=Password must be at least 6 Charachters');
 
    //no reeor
  }else{
    $stmt= $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
    $stmt->bind_param('ss',md5($password),$user_email);

    if($stmt->execute()){
      header('location: Account.php?message=password has bee update successfuly');

    }else{
      header('location: Account.php?error=could not update the password');
    }
  }


}



//get orders
if(isset($_SESSION['logged_in'])){

  $user_id=$_SESSION['user_id'];

  $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");

  $stmt->bind_param('i',$user_id);

  $stmt->execute();

  $orders = $stmt->get_result();//[]
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>

    
     <!--navBar-->
     <nav class="navbar navbar-expand-lg navbar-white bg-body-tertiary py-3 fixed-top">
      <div class="container">
        <img class="log" src="assets/img/logo.png"/>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
           
            <li class="nav-item">
              <a class="nav-link" href="http://localhost:8000/">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="Ssop.html">Shop</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#">Blog</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="Contact.html">Contact</a>
            </li>
            
            <li class="nav-item">
             <a href="cart.html"> <i class="fa-solid fa-cart-shopping"></i></a>
             <a href="Account.html"> <i class="fa-solid fa-user"></i></a>
            </li>

          </ul> 
        </div>
      </div>
    </nav>
      

<!--account-->
      <section class="my-5 py-5">
       <div class="row container mx-auto">
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
        <p class="text-center" style="color:Green"><?php if(isset($_GET['register_success'])) {echo  $_GET['register_success'];}?></p>
        <p class="text-center" style="color:Green"><?php if(isset($_GET['login_success'])) {echo  $_GET['login_success'];}?></p>
            <h3 class="font-weight-bold">Account infor</h3>
            <hr class="mx-auto">
            <div class="account-info">
                <p>Name :<span><?php if(isset($_SESSION['user_name'])) {echo $_SESSION['user_name'];} ?></span></p>
                <p>Email :<span><?php if(isset($_SESSION['user_email'])) {echo $_SESSION['user_email'];} ?></span></p>
                <p><a href="#orders" id=order-btn>Your order</a></p>
                <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sn-12">
            <form id="account-form" method="POST" action="Account.php">
              <p class="text-center" style="color:red"><?php if(isset($_GET['error'])) {echo  $_GET['error'];}?></p>
              <p class="text-center" style="color:green"><?php if(isset($_GET['message'])) {echo  $_GET['message'];}?></p>
                <h3>Change Passowrd</h3>
                <hr class="mx-auto">
                <div class="form-group">
                    <label>Passowrd</label>
                    <input type="password" class="form-control" id="account-password" name="password" placeholder="password" required/>
                </div>
                <div class="form-group">
                    <label>Confirm Passowrd</label>
                    <input type="password" class="form-control" id="account-password-confirm" name="Confirmpassword" placeholder="password" required/>
                </div>
                <div class="form-group">
                    <input type="submit"  value="Change Passsword" name="change_password" class="btn" id="change-pass-btn">
                </div>
            </form>
        </div>
       </div> 
      </section>
<!--orders-->
      <section id="orders" class="orders container my-5 py-3">
        <div class="container mt-2">
          <h2 class="font-weight-bolde text-center">Your Orders</h2>
          <hr class="mx-auto">
        </div>
        <table class="mt-5 pt-5">
          <tr>
            <th>Order id</th>
            <th>Order Cost</th>
            <th>Order Status</th>
            <th>Order Date</th>
            <th>Order Infor</th>
          </tr>


        <?php while($row = $orders->fetch_assoc()){ ?>
                    <tr>
                      <td>
                      <!--  <div class="product-infor">
                          <img src="assets/img/F-shirt (1).jpg"/>
                          <div>  
                            <p class="mt-3"></p> 
                          </div>
                        </div>-->
                        <?php echo $row['order_id']; ?>
                      </td>
                    
                        <td>
                          <span>$<?php echo $row['order_cost']; ?></span>
                        </td>

                        <td>
                          <span><?php echo $row['order_status']; ?></span>
                        </td>

                        <td>
                          <span><?php echo $row['order_date']; ?></span>
                        </td>

                        <td>
                          <form method="POST" action="order_details.php">
                            <input type="hidden" value="<?php echo $row['order_status']?>" name="order_status"/>
                            <input type="hidden" value="<?php echo $row['order_id']?>" name="order_id"/>
                              <input class="btn orderdetails-btn" name="order_details_btn" type="submit" value="Details"/>
                         </form>
                        </td>

                    </tr>  
 
            <?php } ?>
        </table>

      </section> 
     

      <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
          <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <img class="log2"src="assets/img/logo 2.png"/>
            <p class="pt-3">We provide the best products for the most affordable prices</p>
          </div>

          <div class="footer-one col-lg-3 col-md-6 col-sm-12">
           <h5 class="pb-2">Cutomer service</h5>
           <ul class="text-uppercase">
            <li><a href="#">FAQS</a></li>
            <li><a href="#">PRIVACY POLICY</a></li>
            <li><a href="#">RETURN, REFUND & EXCHANGE</a></li>
            <li><a href="#">OUR STORY</a></li>  OUR STORY
           </ul>
          </div>

          <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Contact Us</h5>
            <div>
              <h6 class="text-uppercase">Address</h6>
              <p>1234 street Name, City</p>
            </div>
            <div>
              <h6 class="text-uppercase">Phone</h6>
              <p>1234 456 7890</p>
            </div>
            <div>
              <h6 class="text-uppercase">Email</h6>
              <p>infor@gamil.com</p>
            </div>
          </div>

          <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pd-2">Copyright © 2023, DNS.

              Designed & Developed by Octagen</h5>
          </div>

        </div>

          <div class="copyright mt-5">
            <div class="row container mx-auto">
              <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <img src="assets/img/cashondelivery1.png"/>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12 mb-4 text-nowrap mb-2">
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
              </div>
            </div>
          </div>
      </footer>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>


</body>  
</body>
</html>
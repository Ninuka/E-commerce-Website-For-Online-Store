<?php 

session_start();

include('sever/connection.php');

if(isset($_SESSION['logged_in'])){
  header('location: account.php');
  exit;
}



if(isset($_POST['login_btn'])){


    $email=$_POST['email'];
    $password = md5($_POST['password']);//hash password


  $stmt  = $conn->prepare("SELECT user_id, user_name,user_email,user_password FROM users WHERE user_email=? AND user_password = ? LIMIT 1");

  $stmt->bind_param('ss',$email,$password);

  if($stmt->execute()){
      $stmt->bind_result($user_id,$username,$user_email,$user_password);
      $stmt->store_result();

      if($stmt->num_rows()==1){
         $stmt->fetch();

         $_SESSION['user_id'] =$user_id;
         $_SESSION['user_name'] =$username;
         $_SESSION['user_email'] =$user_email;
         $_SESSION['user_password'] =$user_password;
         $_SESSION['logged_in'] = true;

         header('location: Account.php?login_success=logged in successfully');


      }else{
        header('location: login.php?error=could not verify your account');
      }

  }else{

    //error
    header('location: login.php?error=something went worng');

  }
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
      


      <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Login</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="login-form" method="POST" action="Login.php">
              <p style="colo:red" class="text-center"><?php if(isset($_GET['error'])) {echo $_GET['error'];} ?></p>
                <div class="form-group">
                    <labe>Email</labe>
                    <input type="text" class="form-control" id="login-email" name="email" placeholder="email" required/>
                </div>
                <div class="form-group">
                    <labe>Password</labe>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="password" required/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="login-btn" name="login_btn" value="login">
                </div>
                <div class="form-group">
                    <a id="register-url" href="register.php" class="btn">Don't have account ? Register</a>
                </div>
            </form>
        </div>
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
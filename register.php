<?php
 

 session_start();
 include('sever/connection.php');


 //if user a already regi , then take user to the account page
if(isset($_SESSION['logged_in'])){
  
  header('location: account.php');
  exit;

}


if(isset($_POST['register'])){

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmpassword = $_POST['confirmpassword'];


  //if password dont match
  if($password !== $confirmpassword) {
    header('location: register.php?error=Password dont match' );
  
  
  //if passwoerd is less that 6 
  }else if(strlen($password)<6){
    header('location: register.php?error=Password must be at least 6 Charachters');
 
 
    //if there is no erreo
  }else{
                //check wther ther is a user with this email or not
                $stmt1=$conn->prepare("SELECT count(*) FROM users where user_email=?");
                $stmt1->bind_param('s',$email);
                $stmt1->execute();
                $stmt1->bind_result($num_rows);
                $stmt1->store_result();
                $stmt1->fetch();
                

                //if there is a user alreday with this emali
                if($num_rows != 0){
                  header('location: register.php?error=user with this email already exists');


                  //if on user no registher with this email befor
                }else{

                            //cretae new user
                            $stmt = $conn->prepare("INSERT INTO users (user_name,user_email,user_password)
                                                    VAlUES (?,?,?)");
                                        //md5 use # the password
                            $stmt-> bind_param('sss',$name,$email,md5($password));

                            //if aacount was cretated successfully
                            if ($stmt->execute()){
                              $user_id=$stmt->insert_id;
                              $_SESSION['user_id'] = $user_id;
                              $_SESSION['user_email'] = $email;
                              $_SESSION['user_name'] = $email;
                              $_SESSION['logged_in'] = true;
                              header('location: account.php?register_success=You registered successfully');

                            //account could not be created 
                            }else{
                              header('location: register.php?error=Could not cretae an account at momont');
                            }

                }

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
            <h2 class="form-weight-bold">Register</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="register-form" method="POST" action="register.php">
              <p style="color : red"><?php if(isset($_GET['error'])) {echo $_GET['error'];} ?></P>
                <div class="form-group">
                    <labe>Name</labe>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="name" required/>
                </div>
                <div class="form-group">
                    <labe>Email</labe>
                    <input type="text" class="form-control" id="register-email" name="email" placeholder="email" required/>
                </div>
                <div class="form-group">
                    <labe>Password</labe>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="password" required/>
                </div>
                <div class="form-group">
                    <labe>Confirm Password</labe>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmpassword" placeholder="confirmpassword" required/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="register-btn" name="register" value="register">
                </div>
                <div class="form-group">
                    <a id="login-url"  href="login.php" class="btn">Do you have account ? Login</a>
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
<!--php -S localhost:8000-->

<?php

session_start();

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
                <a class="nav-link" href="Ssop.php">Shop</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="Contact.php">Contact</a>
              </li>
              
              <li class="nav-item">
               <a href="cart.php"> <i class="fa-solid fa-cart-shopping">
                
               <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] !=0) {?>
               <span><?php echo $_SESSION['quantity']; ?> <span>
                <?php } ?>
               </i>
              </a>
               <a href="Login.php"> <i class="fa-solid fa-user"></i></a>
              </li>

            </ul> 
          </div>
        </div>
      </nav>

      <!--Home-->
      <section id="home">
        <div class="container">
            <h5 style="font-size: 30px;">NEW ARRIVALS</h5>
            <h1><span>Best prices</span> This Seasson </h1>
            <p style="color: #000000; font-size: 20px;">E-shop offers the best products for the most affordable prices</p>
            <button class="button-74" role="button">Shop Now</button>
        </div>
      </section>
      
      <!--imags-->
      <section>
        <div class="row">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/img/brand1.jpg"/>
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/img/brands2.jpg"/>
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/img/brand3.webp"/>
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/img/brands4.jpg"/>
        </div>
      </section>

      <!--New-->
      <section id="new" class="w-100">
        <div class="row p-0 m-0">
          <!--One-->
          <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img-fluid" src="assets/img/trouts.jpg">
            <div class="detalis">
              <h2>Extreamely Awesome Trousers </h2>
              <button class="button-74" role="button">Shop Now</button>
            </div>
          </div>

          <!--Two-->
          <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img-fluid" src="assets/img/t-shirt.jpg">
            <div class="detalis">
              <h2>Awesome T-shirts</h2>
              <button class="button-74" role="button">Shop Now</button>
            </div>
          </div>

          <!--Three-->
          <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img-fluid" src="assets/img/Men's  Shirts.jpg">
            <div class="detalis">
              <h2>50% OFF Shirts</h2>
              <button class="button-74" role="button">Shop Now</button>
            </div>
          </div>
        </div>
      </section>


      <!--Featrured-->
      <section id="featrured"class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
          <h3>Our Featrured</h3>
          <hr class="mx-auto">
          <p>Here you can chck out our featrured products</p>
        </div>
        <div class="row mx-auto container-fluid ">

        <!--getting images form databse-->
        <?php include('sever/get_featured_products.php');?>
        <?php while($row= $featured_produtcs->fetch_assoc()) { ?>
          <!--Featrured-->
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid md-3" src="assets/img/<?php echo $row['product_image']; ?> "/>
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name"> <?php echo $row['product_name']; ?> </h5>
            <h4 class="p-price">$ <?php echo $row['product_price']; ?></h4>
            <!-- This portion indicates the start of the query string in the URL. The ? denotes 
            the beginning of the query string, and product_id= is the key of the parameter 
            that will be passed to the single_product.php fil-->
            <a href="<?php echo "Single_product.php?product_id=".$row['product_id'];?>""><button class="button-74" role="button">Shop Now</button></a>
          </div> 
          <?php } ?> 
        </div>
      </section>

      <!--Banner-->
      <section id="banner" class="my-5 py-5">
        <div class="container">
          <h4>MID SEASON'S SALE</h4>
          <h1>Autumn Collection <br>UP to 30% OFF</h1>
          <button class="button-74" role="button">Shop Now</button>
        </div>
      </section>

      <!--cloths-->
      <section id="featrured"class="my-5">
        <div class="container text-center mt-5 py-5">
          <h3>Tanks & Stringers</h3>
          <hr class="mx-auto">
          <p>Here you can chck out our amazing Tanks & Stringers</p>
        </div>
        <div class="row mx-auto container-fluid ">
          <!--Featrured1-->
           <!--getting images form databse-->
        <?php include('sever/get_trunk.php');?>
        <?php while($row= $featured_tanks->fetch_assoc()) { ?>
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid md-3" src="assets/img/<?php echo $row['product_image']; ?>"/>
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $row['product_name']; ?> </h5>
            <h4 class="p-price">$ <?php echo $row['product_price']; ?> </h4>
            <a href="<?php echo "Single_product.php?product_id=".$row['product_id'];?>""><button class="button-74" role="button">Shop Now</button></a>
        </div>  
        <?php } ?>   
        </div>
      </section>

      <!--new-->
      <section id="featrured"class="my-5">
        <div class="container text-center mt-5 py-5">
          <h3>Underwear & Inner wear</h3>
          <hr class="mx-auto">
          <p>Here you can chck out our amazing clothes</p>
        </div>
        <div class="row mx-auto container-fluid ">
          <!--Featrured1-->
          <?php include('sever/get_underwares.php');?>
          <?php while($row= $featured_underware->fetch_assoc()) { ?>
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid md-3" src="assets/img/<?php echo $row['product_image']; ?>"/>
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $row['product_name']; ?> </h5>
            <h4 class="p-price">$ <?php echo $row['product_price']; ?></h4>
            <a href="<?php echo "Single_product.php?product_id=".$row['product_id'];?>""><button class="button-74" role="button">Shop Now</button></a>
          </div>
          <?php } ?>   
        </div>
      </section> 
      
      
<!--Fotter-->
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>  
</body>
</html>
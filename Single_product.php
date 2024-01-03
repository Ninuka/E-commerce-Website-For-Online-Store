<?php

include('sever/connection.php');

    if(isset($_GET['product_id'])){

      $product_id = $_GET['product_id'];
      //This line prepares a SQL query that selects all columns from the products table where the product_id matches the value provided in the URL.
      $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ? ");
      //This line binds the value of $product_id as an integer parameter to the prepared SQL statement.
      $stmt->bind_param("i",$product_id);


      $stmt->execute();


      $product = $stmt->get_result();//[]

      //when no product id was givens 
    }else{

      header('location: index.php');

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

<!--single product-->
<section class=" container my-5 pt-5">
    <div class="row mt-5">


<?php while($row = $product->fetch_assoc()) { ?>
      
 

        <div class="col-lg-5 col-md-6 col-sm-12">
            <img class="img-fluid w-100 pd-1" src="assets/img/<?php echo $row['product_image']; ?>" id="mainImg">
            <div class="small-img-group">
                <div class="small-img-col">
                    <img src="assets/img/<?php echo $row['product_image']; ?>" width="100%" class="small-img"/>
                </div>
                <div class="small-img-col">
                    <img src="assets/img/<?php echo $row['product_image2']; ?>" width="100%" class="small-img"/>
                </div>
                <div class="small-img-col">
                    <img src="assets/img/<?php echo $row['product_image3']; ?>" width="100%" class="small-img"/>
                </div>
                <div class="small-img-col">
                <img src="assets/img/<?php echo $row['product_image4']; ?>" width="100%" class="small-img"/>
                </div>
            </div>
        </div>


    

    <div class="col-lg-6 col-md-12 col-12">
        <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
        <h2>$ <?php echo $row['product_price']; ?></h2>

      <!--create hidden form to add to cart-->
        <form method="POST" action="cart.php">
    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" />     
    <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>" />
    <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>" />
    <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>" />

    
        <input type="number" name="product_quantity" value="1"/>
        <button type="submit" name="add_to_cart">
          <span>Add to Cart</span>
          
      </button>

      </form>

        <h4 class="mt-5 mb-5">Product Details</h4>
        <span><?php echo $row['product_description']; ?></span>

    </div>

    <?php } ?>

</section>

<!--related Product-->
<section id="related-products" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Related Products</h3>
      <hr class="mx-auto">
      <p>Here you can chck out our featrured products</p>
    </div>
    <div class="row mx-auto container-fluid ">
      <!--Featrured1-->
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid md-3" src="assets/img/F-shirt (1).jpg"/>
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Shirts</h5>
        <h4 class="p-price">$199.8</h4>
        <button class="button-74" role="button">Shop Now</button>
      </div>
      <!--Featrured2-->
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid md-3" src="assets/img/Must-Have Shorts for Summer.jpg"/>
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Shorts</h5>
        <h4 class="p-price">$199.8</h4>
        <button class="button-74" role="button">Shop Now</button>
      </div>
      <!--Featrured3-->
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid md-3" src="assets/img/F-Tshirt (1).jpg"/>
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">T-shirts</h5>
        <h4 class="p-price">$199.8</h4>
        <button class="button-74" role="button">Shop Now</button>
      </div>
      <!--Featrured4-->
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid md-3" src="assets/img/f-trous (1).jpg"/>
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Trousers</h5>
        <h4 class="p-price">$199.8</h4>
        <button class="button-74" role="button">Shop Now</button>
      </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

<script>

    var mainIMG = document.getElementById("mainImg");
    var smallING = document.getElementsByClassName("small-img");

   for(let i=0; 1<4; i++){
    smallING[i].onclick = function(){
        mainIMG.src = smallING[i].src;
    }
}
    

</script>

</body>  
</body>
</html>
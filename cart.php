<?php

    session_start();


  if(isset($_POST['add_to_cart'])){

    

                //if user has alrady added to product to cart
                // and creating sessaion
                if(isset($_SESSION['cart'])){


                                        $product_array_ids = array_column($_SESSION['cart'],"product_id"); //returing ID's array [2,3,4,5]
                                        //if product has alreaady been add to the cart or not
                                          if(!in_array($_POST['product_id'],$product_array_ids )) {


                                            $product_id = $_POST['product_id'];

                                            $product_array = array(
                                      
                                                      'product_id'=>$_POST['product_id'] ,
                                                      'product_name'=>$_POST['product_name'] ,
                                                      'product_price'=>$_POST['product_price'] ,
                                                      'product_image'=>$_POST['product_image'] ,
                                                      'product_quantity'=>$_POST['product_quantity']
                                      
                                            );
                                      
                                            $_SESSION['cart'][$product_id]= $product_array;


                                          }else{

                                            //product has all ready benn addd
                                            echo '<script>alert("Product was already at the cart");</script>';
                                          

                                          }

                    
              //if this nis the first product 
                }else{
                  
                  $product_id = $_POST['product_id'];
                  $product_name = $_POST['product_name'];
                  $product_price = $_POST['product_price'];
                  $product_image = $_POST['product_image'];
                  $product_quantity = $_POST['product_quantity'];

                  $product_array = array(

                            'product_id'=>$product_id,
                            'product_name'=>$product_name,
                            'product_price'=>$product_price,
                            'product_image'=>$product_image,
                            'product_quantity'=>$product_quantity,

                  );
            
                  $_SESSION['cart'][$product_id]= $product_array;
                  // big array [   2=>[]  ,  3=>[]   ,   5=>[]    ]

                }

                //caciculate total
                calculatrTotalCart();
                
//remove product form cart
  }else if(isset($_POST['remove_product'])){

      $product_id =$_POST['product_id'];
      unset($_SESSION['cart'][$product_id]);

      calculatrTotalCart();
   
  }else if(isset($_POST['edit_quantity'])){

    //we get id and quantity form the form
    $product_id=$_POST['product_id'];
    $product_quantity=$_POST['product_quantity'];

    //get the product array form the session
    $product_array = $_SESSION['cart'][$product_id];

    //update product array old value with new value
    $product_array['product_quantity'] = $product_quantity;

    //return array back its palce 
    $_SESSION['cart'][$product_id] = $product_array;


    calculatrTotalCart();

  }else{

    header('location:index.php');

  }



  function calculatrTotalCart(){

        $total_price =0;
        $total_quantity = 0;


        foreach($_SESSION['cart'] as $key => $value){

              $product =  $_SESSION['cart'][$key];


              $price = $product['product_price'];
              $quantity = $product['product_quantity'];

              $total_price = $total_price + ($price * $quantity);
              $total_quantity = $total_quantity + $quantity;

        } 

        $_SESSION['total'] = $total_price;
        $_SESSION['quantity'] = $total_quantity;

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

      <!--cart-->
      <section class="cart container my-5 py-5">
        <div class="container mt-5">
          <h2 class="font-weight-bolde">Your Cart</h2>
          <hr>
        </div>
        <table class="mt-5 pt-5">
          <tr>
            <th>Product</th>
            <th>Quatity</th>
            <th>Sub Total</th>
          </tr>



        <?php foreach($_SESSION['cart'] as $key => $value) { ?>



          <tr>
            <td>
              <div class="product-infor">
                <img src="assets/img/<?php  echo $value['product_image']; ?>">
              <div>
                  <p><?php  echo $value['product_name']; ?></p>
                  <small><span>$</span><?php echo $value['product_price']; ?></small>
                  <br>
                  <!--remove btn-->
                  <form method="POST" action="cart.php">
                  <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />
                  <input type="submit"  name="remove_product"  class="remove-btn" value="remove"/> 
                  </form>
              </div>
              </div>
            </td>
            <td>
             
              <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php  echo $value['product_id']; ?>"/>
                    <input type="number" name="product_quantity" value="<?php echo  $value['product_quantity']; ?>"/>
                    <input type="submit" class="edit-btn" value="edit" name="edit_quantity"/>
              </form>

            </td>
            <td>
             <span>$</span>
              <span class="Product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
            </td>
          </tr>  
          
          <?php } ?>

        </table>


          <div class="cart-total">
            <table>
              <tr>
                <td>Total</td>
                <td>$ <?php  echo $_SESSION['total'];?></td>
              </tr>
            </table>
          </div>

          <div class="checkout-contain">
            <form method="POST" action="checkout.php">
              <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout">
        </form>
        <div>
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
</body>  
</body>
</html>
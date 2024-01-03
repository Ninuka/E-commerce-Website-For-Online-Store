<?php


//not paid
//shipped
//deliverd

include('sever/connection.php');

if (isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {
  $order_id = $_POST['order_id'];
  $order_status = $_POST['order_status'];

  $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id=?");
  $stmt->bind_param('i', $order_id);
  $stmt->execute();

  // Fetch the result set and bind the variables
  $order_details = $stmt->get_result();
  $stmt->close();

  $total = 0;

  // Fetch rows from the result set
  while ($row = $order_details->fetch_assoc()) {
      $product_price = $row['product_price'];
      $product_quantity = $row['product_quantity'];

      $total = $total + ($product_price * $product_quantity);
  }

  $order_total_price = $total;
} else {
  header('location: account.php');
  exit;
}




function calculatrTotalOrderPrice($order_details){

  $total =0;
  
  foreach($order_details as  $row){
   
    $product_price = $row['product_price'];
    $product_quantity = $row['product_quantity'];

    $total = $total + ($product_price * $product_quantity );

  }

  return $total;

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


<!--  order details-->

    <section id="orders" class="orders container my-5 py-3">
        <div class="container mt-5">
          <h2 class="font-weight-bolde text-center"> Orders Details</h2>
          <hr class="mx-auto">
        </div>
        <table class="mt-5 pt-5 mx-auto">
          <tr>
            <th>Product </th>
            <th>Price</th>
            <th>Quantity</th>
          </tr>


          <?php foreach($order_details as $row){ ?>
                    <tr>
                      <td>
                       <div class="product-infor">
                          <img src="assets/img/<?php echo $row['product_image']; ?>"/>
                          <div>  
                            <p class="mt-3"><?php echo $row['product_name']; ?></p> 
                          </div>
                        </div>
                      </td>
                    
                        <td>
                          <span>$ <?php echo $row['product_price']; ?></span>
                        </td>

                        <td>
                          <span><?php echo $row['product_quantity']; ?></span>
                        </td>


                    </tr>  
                    <?php } ?>
           
        </table>

        <?php if($order_status == "not paid") { ?>
        <form style="float: right;" method="POST" action="payment.php">
            <input type="hidden" name="order_total_price" value="<?php echo $order_total_price; ?>" />
            <input type="hidden" name="order_status" value="<?php echo $order_status; ?>" />
            <input type="submit" name="order_pay_btn" class="btn btn-primary" value="Pay Now"/>
        </form>
    <?php } ?>




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
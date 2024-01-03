<?php

include('sever/connection.php');

//serach product fillerte
if(isset($_POST["search"])){

  $category =$_POST['category'];
  $price =$_POST['price'];


  $stmt = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=?");

  $stmt->bind_param("sd",$category,$price);

  $stmt->execute();

  $produtcs = $stmt->get_result();//[]




//return all froducts
}else{

//1. determine page no
  if(isset($_GET['page_no']) &&  $_GET['page_no'] !="" ){


    //if user has already eneterd page then number is the one that they selected
    $page_no= $_GET['page_no'];
  }else{
    //if user eneterd the page then default page is 1
    $page_no =1;
  }

  //2.return number of product

  $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products");
  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1->fetch();


  //3.product pre page
  $total_records_pre_page = 3;

  $offset = ($page_no - 1) * $total_records_pre_page;

  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;

  $adjacent = "2";

  $total_no_of_page = ceil($total_records/$total_records_pre_page);



  //4. get all products

  $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_no_of_page");
  $stmt2->execute();
  $produtcs = $stmt2->get_result();


}



?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css"/>

    <style>
        product img{
            width:100%;
            height:auto;
            box-sizing: border-box;
            object-fit: cover;
        }

        .pagination a{
          color:coral
        }

        .pagination li:hover a{
          color:#fff;
          background-color: coral;
        }
        
        footer {
        background-color: #fff; /* Set the background color to white */
         }

        #serach {
                float: left;
                width: 20%;
                margin-right: 30px;
                background-color: white; /* Set the background color to transparent */
                padding: 15px; /* Add padding as needed */
                box-sizing: border-box; /* Include padding and border in the element's total width and height */
              }

              #featrured {
                float: right;
                width: 75%;
                background-color: white;
              }

              #customRange2 {
                      height: 15px;
                      background-color: transparent; /* Set the background color of the track to transparent */
                  }

                  #customRange2::-webkit-slider-runnable-track {
                      background-color: #000; /* Set the background color of the track to black */
                  }
                  
              .button-5 {
                align-items: center;
                background-clip: padding-box;
                background-color: #fa6400;
                border: 1px solid transparent;
                border-radius: .25rem;
                box-shadow: rgba(0, 0, 0, 0.02) 0 1px 3px 0;
                box-sizing: border-box;
                color: #fff;
                cursor: pointer;
                display: inline-flex;
                font-family: system-ui,-apple-system,system-ui,"Helvetica Neue",Helvetica,Arial,sans-serif;
                font-size: 16px;
                font-weight: 600;
                justify-content: center;
                line-height: 1.25;
                margin: 0;
                min-height: 3rem;
                padding: calc(.875rem - 1px) calc(1.5rem - 1px);
                position: relative;
                text-decoration: none;
                transition: all 250ms;
                user-select: none;
                -webkit-user-select: none;
                touch-action: manipulation;
                vertical-align: baseline;
                width: auto;
              }

              .button-5:hover,
              .button-5:focus {
                background-color: #fb8332;
                box-shadow: rgba(0, 0, 0, 0.1) 0 4px 12px;
              }

              .button-5:hover {
                transform: translateY(-1px);
              }

              .button-5:active {
                background-color: #c85000;
                box-shadow: rgba(0, 0, 0, .06) 0 2px 4px;
                transform: translateY(0);
              }

    </style>


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


<!--serach-->

<section id="serach" class="my-5 py-5 ms-2">
  <div class="container mt-5 py-5">
    <p>Serach Product</p>
    <hr>
      </div>


        <form action="Ssop.php" method="POST">
          <div class="row mx-auto container">
            <div class="col-gl-12 col-md-12 col-sm-12">

            <p>Category</p>
            <div class="form-check">
              <input class="form-check-input" value="HOODIE" type="radio" name="category" id="category_one">
              <label class="form-check-labe" for="felxRadioDefault1">
              HOODIE
                <label>
                  <div>

                  
                  <div class="form-check">
              <input class="form-check-input" value="T-shirt" type="radio" name="category" id="category_two" checked>
              <label class="form-check-labe" for="felxRadioDefault2">
              T-shirt
                <label>
                  <div>

                  <div class="form-check">
              <input class="form-check-input" value="underware" type="radio" name="category" id="category_two" checked>
              <label class="form-check-labe" for="felxRadioDefault2">
              underware
                <label>
                  <div>

                  <div class="form-check">
              <input class="form-check-input" value="tank" type="radio" name="category" id="category_two" checked>
              <label class="form-check-labe" for="felxRadioDefault2">
              tank
                <label>
                  <div>

      </div>
      </div>

      <div class="row mx-auto container mt-5">
        <div class="col-gl-12 col-md-12 col-sm-12">

        <p>price</p>
        <input type="range" class="form-range w-50" name="price"  value="50" min="1" max="100" id="customRange2">
        <div class="W-50">
          <span style="float: left;">100</span>
          <span style="float: right;">1</span>
          <div>
        <div>
      </div>

      <div class="form-group my-3 mx-3">
        <input type="submit" name="search" value="Serach" class="button-5">
        <div>

      </form>
      </section>



<!--shop-->
<section id="featrured"class="my-5 py-5">
        <div class="container mt-5 py-5">
          <h3>Our Products</h3>
          <hr>  
          <p>Here you can chck out our products</p>
        </div>

        <div class="row mx-auto container">
        <?php while($row= $produtcs->fetch_assoc()) { ?>
          <div  onclick="window.location.href='<?php echo "Single_product.php?product_id=".$row['product_id']; ?>';" class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid md-3" src="assets/img/<?php echo $row ['product_image']; ?>"/>
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $row ['product_name']; ?></h5>
            <h4 class="p-price">$ <?php echo $row ['product_price']; ?></h4>
            <button class="button-74" role="button" ><a href="<?php echo "Single_product.php?product_id=".$row['product_id']; ?>"> Buy Now</a></button>
          </div>


          <?php } ?> 
        



  <!--page neviagetion bar-->

  <nav aria-label="Page navigation">
      <ul class="pagination mt-5">
        <li class="Page-item<?php if($page_no<=1){echo 'disabled';}?>">
          <a class="page-link" href="<?php if($page_no <= 1 ){echo '#';}else {echo "?page_no".$page_no-1;}?>">Previous</a>
        </li>
        <li class="Page-item"><a class="page-link" href="?page_no=1">1</a></li>
        <li class="Page-item"><a class="page-link" href="?page_no=2">2</a></li>

        <?php if($page_no>=3) {?>
        <li class="Page-item"><a class="page-link" href="#">...</a></li>
        <li class="Page-item"><a class="page-link" href="<?php echo "?page_no"?>"><?php echo $page_no; ?></a></li>
        <?php } ?>




        <li class="Page-item <?php if($page_no >= $total_no_of_page){echo "disabled";}?>">
          <a class="page-link" href="<?php if($page_no >= $total_no_of_page){echo '#';} else {echo "?page_no=".$page_no+1;}?>">Next</a></li>
      </ul>
  </nav>
        </div>
      </section>


<!--fotter-->
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
</html>
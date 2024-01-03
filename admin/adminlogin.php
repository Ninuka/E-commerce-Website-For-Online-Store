<?php 

session_start();

include('../sever/connection.php');

if(isset($_SESSION['admin_logged_in'])){
  header('location: admindashbord.php');
  exit;
}



if(isset($_POST['adminlogged_in'])){


    $email=$_POST['email'];
    $password = md5($_POST['password']);//hash password


  $stmt  = $conn->prepare("SELECT admin_id, admin_name, admin_email,admin_password FROM admins WHERE admin_email=? AND admin_password = ? LIMIT 1");

  $stmt->bind_param('ss',$email,$password);

  if($stmt->execute()){
      $stmt->bind_result($admin_id,$admin_name,$admin_email,$admin_password);
      $stmt->store_result();

      if($stmt->num_rows()==1){
         $stmt->fetch();

         $_SESSION['admin_id'] =$admin_id;
         $_SESSION['admin_name'] =$adminname;
         $_SESSION['admin_email'] =$admin_email;
         $_SESSION['admin_password'] =$admin_password;
         $_SESSION['admin_logged_in'] = true;

         header('location: admindashbord.php?login_success=logged in successfully');


      }else{
        header('location: adminlogin.php?error=could not verify your account');
      }

  }else{

    //error
    header('location: adminlogin.php?error=something went worng');

  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <style>
        /* Your existing CSS styles */
        body {
            font-family: 'Open Sans', helvetica, arial, sans;
            background: url(http://farm8.staticflickr.com/7064/6858179818_5d652f531c_h.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            margin: 0;
        }

        .log-form {
            width: 40%;
            min-width: 320px;
            max-width: 475px;
            background: #fff;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0px 2px 5px rgba(0, 0, 0, .25);
            overflow: hidden; /* Ensure the background covers the entire form */
        }

        @media (max-width: 40em) {
            .log-form {
                width: 95%;
                position: relative;
                margin: 2.5% auto 0 auto;
                left: 0%;
                transform: translate(0%, 0%);
            }
        }

        form {
            display: block;
            width: 100%;
            padding: 2em;
        }

        .log-form h2 {
            color: #fff; /* Adjusted color for better visibility */
            font-family: 'Open Sans Condensed';
            font-size: 1.5em; /* Adjusted font size */
            text-align: center; /* Centered text */
            padding: .75em 0;
            margin: 0;
            background: #2a2a2a;
        }

        input {
            display: block;
            margin: auto auto;
            width: calc(100% - 2em);
            margin-bottom: 2em;
            padding: .5em 1em;
            border: none;
            border-bottom: 1px solid #eaeaea;
            color: #757575;
            box-sizing: border-box;

            &:focus {
                outline: none;
            }
        }

        .btn {
            display: inline-block;
            background: #1fb5bf;
            border: 1px solid #1a9ba4;
            padding: .5em 2em;
            color: white;
            margin-right: .5em;
            box-shadow: inset 0px 1px 0px rgba(255, 255, 255, 0.8);

            &:hover {
                background: #25c2cd;
            }

            &:active {
                background: #1fb5bf;
                box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.9);
            }

            &:focus {
                outline: none;
            }
        }

        .forgot {
            color: #30c1cb;
            line-height: .5em;
            position: relative;
            top: 2.5em;
            text-decoration: none;
            font-size: .75em;
            margin: 0;
            padding: 0;
            float: right;

            &:hover {
                color: #29a9b1;
            }
        }
    </style>
</head>

<body>
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5 log-form">
            <h2 class="form-weight-bold">Login</h2>
            <p style="color:red" class="text-center"><?php if(isset($_GET['error'])) {echo $_GET['error'];} ?></p>
            <form id="login-form" method="POST" action="adminlogin.php">
                <div class="form-group mt-2">
                    <label>Email</label>
                    <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="login-btn" name="adminlogged_in" value="Login">
                </div>
            </form>
        </div>
    </section>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>



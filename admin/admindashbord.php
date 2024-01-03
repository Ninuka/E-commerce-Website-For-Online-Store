<?php
session_start();

if (isset($_GET['adminlogout']) && $_GET['adminlogout'] == 1) {
    if (isset($_SESSION['admin_logged_in'])) {
        unset($_SESSION['admin_logged_in']);
        unset($_SESSION['admin_user_email']);
        unset($_SESSION['admin_name']);
        header('location: adminlogin.php');
        exit;
    }
} else {
    // Redirect to the login page or handle the situation accordingly
    header('location: adminlogin.php');
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        #header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #header h1 {
            margin: 0;
        }

        #header button {
            padding: 10px;
            background-color: #d9534f;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        #header button:hover {
            background-color: #c9302c;
        }

        #sidebar {
            width: 250px;
            height: 100%;
            background-color: #333;
            padding-top: 20px;
            position: fixed;
        }

        #sidebar a {
            padding: 10px;
            text-decoration: none;
            font-size: 18px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        #sidebar a:hover {
            color: #f1f1f1;
        }

        #content {
            margin-left: 250px;
            padding: 16px;
        }
    </style>
</head>
<body>

<div id="header">
    <h1>Company Name</h1>
    <form action="adminlogout.php" method="get">
    <button name="adminlogout" herf="adminlogout.php?adminlogout=1">Sign Out</button>
</div>



<div id="sidebar">
    <a href="#" onclick="showContent('orders')">Orders</a>
    <a href="#" onclick="showContent('products')">Products</a>
    <a href="#" onclick="showContent('customers')">Customers</a>
    <a href="#" onclick="showContent('createProduct')">Create Product</a>
    <a href="#" onclick="showContent('createAccount')">Create Account</a>
</div>

<div id="content">
    <h2>Welcome to the Admin Dashboard</h2>
    <p>Select an option from the sidebar to manage your e-commerce site.</p>
</div>

<script>
    function showContent(contentType) {
        var contentDiv = document.getElementById('content');
        switch (contentType) {
            case 'orders':
                contentDiv.innerHTML = '<h2>Manage Orders</h2><p>List of orders goes here.</p>';
                break;
            case 'products':
                contentDiv.innerHTML = '<h2>Manage Products</h2><p>List of products goes here.</p>';
                break;
            case 'customers':
                contentDiv.innerHTML = '<h2>Manage Customers</h2><p>List of customers goes here.</p>';
                break;
            case 'createProduct':
                contentDiv.innerHTML = '<h2>Create Product</h2><p>Form for creating a new product goes here.</p>';
                break;
            case 'createAccount':
                contentDiv.innerHTML = '<h2>Create Account</h2><p>Form for creating a new account goes here.</p>';
                break;
            default:
                contentDiv.innerHTML = '<h2>Welcome to the Admin Dashboard</h2><p>Select an option from the sidebar to manage your e-commerce site.</p>';
        }
    }

</script>

</body>
</html>

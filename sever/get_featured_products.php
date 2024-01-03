<?php

include('connection.php');

//In PHP, the prepare() function is used to prepare an SQL statement for execution. 
//When you prepare a statement, you can execute it multiple times with different parameters without 
//re-parsing the SQL query, which can improve performance and security


$stmt = $conn->prepare("SELECT * FROM products LIMIT 4");

$stmt->execute();

/*In PHP, the get_result() function is used with a prepared statement to retrieve the 
result set into a mysqli_result object. It is commonly used when you execute a prepared 
statement and want to fetch the results into an associative array or an object.*/

$featured_produtcs = $stmt->get_result();//[]
?>
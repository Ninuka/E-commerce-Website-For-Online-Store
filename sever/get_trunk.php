<?php

        include('connection.php');

        $stmt=$conn->prepare("SELECT * FROM products WHERE product_category='tank' LIMIT 4");

        $stmt->execute();

        $featured_tanks = $stmt->get_result();

?>
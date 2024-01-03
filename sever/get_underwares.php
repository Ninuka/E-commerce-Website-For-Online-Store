<?php

        include('connection.php');

        $stmt=$conn->prepare("SELECT * FROM products WHERE product_category='underware' LIMIT 4");

        $stmt->execute();

        $featured_underware = $stmt->get_result();

?>
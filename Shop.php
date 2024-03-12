<?php



$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "sparkshop"; 

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // If the connection is successful, send a confirmation message
    echo "Connected to the database successfully";
} catch(PDOException $e) {
    // If an error occurs during connection, display the error message
    echo "Connection failed: " . $e->getMessage();
}



?>


 <!DOCTYPE html>
<html>
<head>
    <title>Shop</title>
    <link rel="stylesheet" href="style.css">
    <?php include "nav.php"; ?>
    <style>
        body {
            text-align: center;
        }

        h1 {
            text-align: center;
        }

        .product-container {
            display: inline-block;
            margin: 5px;
            width: 30%; /* Adjust as needed */
            text-align: left;
        }

        .w3-card-4 img {
            width: 100%;
            height: auto;
        }
        .list-collection {
            text-align:left; 
            width:50%
        }
    </style>
</head>
<body>
    <h1>Here we'll have Spark Shop</h1>
    <div class='cols-c'>
        <article>
            <header>
                <h1 class="m20"> Squash Rackets </h1>
            <p class="link-btn wide desktop-hide" tabindex="-1" aria-hidden="true" focusable="false"><a href="./" class="b toggle-filters" tabindex="-1">Filter</a></p></header>
            <form action='' method="get" class="form-sort" id="filter_form">
                <h5 style="z-index:64;" class="mobile-hide">67 products</h5>
                <p class="blank strong" style="z-index:63;">
                <label for="limit">Show:</label>
                <select id="limit" name="limit" onchange="$('#formSortModeLimit').submit();">
                <option value="12">12</option>
                <option value="24" selected="selected">24</option>
                <option value="36">36</option>
                <option value="72">72</option>

            </select>
            <ul class="list-collection">
                <li class="has-label getted-image filled" data-url="" data-image-size="410x610x" style="z-index:61;">
                <div class="img">
                    <figure>
                        <a href="https://www.squashpoint.com/head-extreme-120.html">
                    <img src="https://cdn.webshopapp.com/shops/40033/files/444028632/660x900x1/head-extreme-120-1.jpg" alt="Head Extreme 120" class="second-image" style="width: 205px; height: 305px; display: none;">
                    <img src="https://cdn.webshopapp.com/shops/40033/files/444028634/660x900x1/head-extreme-120.jpg" alt="Head Extreme 120" width="310" height="430" class="first-image">
                </a>
            </figure>
            <form action="https://www.squashpoint.com/cart/add/291330412/" method="post" class="variant-select-snippet" data-novariantid="147604649" data-problem="https://www.squashpoint.com/head-extreme-120.html">
                <p style="z-index: 60;"><span class="variant" style="display: none;">
                <select>
                    <option disabled="" selected="">Make a choice</option>
                </select>
            </span>
            <button class="add-size-to-cart full-width" type="">Add to basket</button>
        </p>
    </form>
</div>


<h3 class="mobile-nobrand"><a href="https://www.squashpoint.com/head-extreme-120.html">Head Extreme 120</a>
<p class="price">
    <span>€119,99</span>
    <span class="legal">Incl. VAT</span></p>
</body>
</html> 





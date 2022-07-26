<?php

// Set variables for our request
$shop = $_GET['shop'];
$api_key = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";   //commented out for security purposes
$scopes = "read_orders,write_orders,read_products,write_products";
$redirect_uri = "https://example.com/token.php";  //enter the URL for your app here

// Build install/approval URL to redirect to
$install_url = "https://" . $shop . ".myshopify.com/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($redirect_uri);

// Redirect
header("Location: " . $install_url);
die();
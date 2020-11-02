<?php

// Set variables for our request
$shop = $_GET['shop'];
$api_key = "a7c27e8f9be9114a91383bc3aac70e28";
$scopes = "read_orders,write_orders,read_products,write_products";
$redirect_uri = "https://bbcac14e5897.ngrok.io/generate_token.php";

// Build install/approval URL to redirect to
$install_url = "https://" . $shop . ".myshopify.com/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($redirect_uri);

// Redirect
header("Location: " . $install_url);
die();
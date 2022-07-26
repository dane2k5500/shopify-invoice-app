<?php 
    $shopify = $_GET;

    $sql = "SELECT * FROM shops WHERE shop_url='" . $shopify['shop'] . "' LIMIT 1";
    
    $check = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($check) < 1) {
        header("Location: install.php?shop=" . $shopify['shop']);
        exit();
    } else {
        $shop_row = mysqli_fetch_assoc($check);
        
        $shop_url = $shopify['shop'];
        $token = $shop_row['access_token'];
        
        // echo $shop_url . '<br >';
        // echo $token . '<br >';
    }
?>
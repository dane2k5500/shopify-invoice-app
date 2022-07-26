<!--The database information has been commented out for security!-->

<?php 
    $host = "XXXXXXXXX";
    $username = "XXXXXXXXXXXXXX";
    $password = "XXXXXXXXXXXX";
    $database = "XXXXXXXXXXXXXX";
    
    $conn = mysqli_connect($host, $username, $password, $database);
    
    if(!$conn) {
        die("Connection Error: " . mysqli_connect_error());
    }
?>
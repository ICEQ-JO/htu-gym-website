<?php
$con = mysqli_connect('localhost', 'root', '', 'htuGym', 3307);

if ($con) {
    echo "success";
} else {
    echo "Connection failed: " . mysqli_connect_error();
}
?>



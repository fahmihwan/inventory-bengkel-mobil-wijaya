<?php

$conn = mysqli_connect('localhost', 'root', 'root', 'db_inventroy_wijaya');

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit;
}

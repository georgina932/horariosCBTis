<?php

$conexion = mysqli_connect("localhost", "root", "", "horarios");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>

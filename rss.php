<?php
session_start();
$_SESSION["opcion"] =  $_POST["opciones"];
header("location: index.php");
?>
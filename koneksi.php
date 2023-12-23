<?php 

$host="localhost";
$user="root";
$pass="";
$db="crud";

$kon=mysqli_connect($host, $user, $pass, $db);

if (!$kon){
    die("koneksi gagal :".mysqli_connect_error());

  
}

?>
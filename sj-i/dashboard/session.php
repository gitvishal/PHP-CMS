<?php 
session_start();
if( !isset( $_SESSION['cms_user'] ) ) {

    header("location:../index.php");
    exit();
}

include 'conf.php';
include 'dashboard.php';
include 'user_id.php';
?>
<?php
    include 'functions.php';

    //Fetch form field values 
    $username = $_POST['txtRegUsrName'];
    $password = $_POST['txtRegPassword'];
    $cnfrmPassword = $_POST['txtRegPasswordConfirm'];
    $email = $_POST['txtRegEmail'];	
    $mobile = $_POST['txtRegMobile'];
    $address = $_POST['txtRegAddress'];
    $zip = $_POST['txtRegZip'];
    $res = validateRegistrationForm($username, $password, $cnfrmPassword, $email, $mobile, $zip);
    if($res->result==true){
    	registerUserInDB($username, $password, $email, $mobile, $address, $zip, "volunteer");
    }
    
    header('Content-Type: application/json');
    echo json_encode($res);
?>
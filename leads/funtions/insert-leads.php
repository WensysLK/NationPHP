<?php
include '../../includes/db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $nic = $_POST['nic'];
    $passport = $_POST['passport'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $source = $_POST['source'];

    $sql = "INSERT INTO leads (name,lname,nic,passportNumber, email, phone, source) VALUES ('$fname','$lname','$nic','$passport', '$email', '$phone', '$source')";
    
    if ($conn->query($sql) === TRUE) {
        header('Location: ../view_all_leads.php');  // Redirect to lead list after adding
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
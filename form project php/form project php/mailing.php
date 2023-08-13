<?php

$fullname = $_POST['fullname'];
$phonenumber = $_POST['phonenumber'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    if (empty($email)) {
        echo "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    } else {
        // Email is valid
        // Proceed with other validation and data processing
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];

    if (empty($fullname)) {
        echo "Full Name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $fullname)) {
        echo "Only letters and white space allowed in Full Name.";
    } else {
        // Full Name is valid
        // Proceed with other validation and data processing
    }
}

$mailheader = "From:".$fullname."<".$email.">\r\n";

$recipient = "test@techsolvitservice.com";


mail($recipient,$subject,$message,$mailheader) or die("Error!");

echo'

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact form</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Thank you for contacting me. I will get back to you as soon as possible!</h1>
        <p class="back">Go back to the <a href="index.html">homepage</a>.</p>
        
    </div>
</body>
</html>



';


/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$mysqli = new mysqli("localhost", "root", "", "phpprojectdatabase");
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
 
// Escape user inputs for security
$fullname = $mysqli->real_escape_string($_REQUEST['fullname']);
$phonenumber = $mysqli->real_escape_string($_REQUEST['phonenumber']);
$email = $mysqli->real_escape_string($_REQUEST['email']);
$subject = $mysqli->real_escape_string($_REQUEST['subject']);
$message= $mysqli->real_escape_string($_REQUEST['message']);


 
// Attempt insert query execution
$sql = "INSERT INTO contact_form( fullname , phonenumber , email ,subject,message) VALUES ('$fullname','$phonenumber', '$email','$subject','$message')";
if($mysqli->query($sql) === true){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}
 
// Close connection
$mysqli->close();
?>

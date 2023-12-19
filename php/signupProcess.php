<?php
include "../connection.php";

$fname = $_POST["f"];
$lname = $_POST["l"];
$email = $_POST["e"];
$password = $_POST["p"];
$mobile = $_POST["m"];
$gender = $_POST["g"];

if(empty($fname)){
    echo("Please Enter Your First Name.");
}elseif(strlen($fname) > 50){
    echo("First Name Must Contain LOWER THAN 50 Characters.");
}elseif(empty($lname)){
    echo("Please Enter Your Last Name.");
}elseif(strlen($lname) > 50){
    echo("Last Name Must Contain LOWER THAN 50 Characters.");
}elseif(empty($email)){
    echo("Please Enter Your Email Address.");
}elseif(strlen($email) > 100){
    echo("Email Address Must Contain LOWER THAN 100 Characters.");
}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Invalid Email Address.");
}elseif(empty($password)){
    echo("Please Enter Your Password.");
}elseif(strlen($password) < 5 || strlen($password) > 20){
    echo("Password Must Contain 5 to 20 Characters.");
}elseif(empty($mobile)){
    echo("Please Enter Your Mobile Number.");
}else if(strlen($mobile) != 10){
    echo("Mobile Number Must Contain 10 Characters.");
}elseif(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $mobile)){
    echo("Invalid Mobile Number.");
} else {
    $rs = Database::search("SELECT * FROM `users` WHERE `email`='".$email."' OR `mobile`='".$mobile."'");
    $n = $rs->num_rows;

    if($n > 0){
        echo ("User With The Same Email Address or Same Mobile Number Already Exists.");
    } else {

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `users`(`fname`,`lname`,`email`,`password`,`mobile`, `joined_date`, `gender_id`, `status`) VALUES 
        ('".$fname."', '".$lname."', '".$email."', '".$password."', '".$mobile."', '".$date."', '".$gender."', '1')");

        echo ("success");
    }
}

    

?>
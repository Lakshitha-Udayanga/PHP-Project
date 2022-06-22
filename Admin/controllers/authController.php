<?php

use Stripe\Terminal\Location;

session_start();

require 'config/db.php';
require_once 'config/constants.php';


$errors = array();
$username = "";
$email = "";

// if user clicks on the sign up button
if (isset($_POST['signup-btn'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];

    // validation
    if (empty($username)){
        $errors['username'] = "Username required";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email address is invalid";
    }


    if (empty($email)){
        $errors['email'] = "Email required";
    }

    if (empty($password)){
        $errors['password'] = "Password required";
    }

    if ($password !== $passwordConf) {
        $errors['password'] = "The two password do not match";
    }

    $emailQuery = "SELECT * FROM admi WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($emailQuery);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $userCount = $result->num_rows;
    $stmt->close();
    
    if ($userCount > 0) {
        $errors['email'] = "Email already exists";
    }


    if (count($errors) === 0) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(50));
        $verified = false;

        $sql = "INSERT INTO admi (username, email, verified, token, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssdss', $username, $email, $verified, $token, $password);

        if ($stmt->execute()) {
            // login user
            $user_id = $conn->insert_id;
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = $verified;


            $verification_code = sha1($email . time());
            $verfication_URL  = 'http://localhost/e-solution/singin-signup/admin/controllers/verify.php?code=' . $token;
    
            $query = "INSERT INTO admi (username, email, verified, token, password) VALUES ('{$username}', '{$email}', false, '{$verification_code}', '{$password}' )";
    
            $result = mysqli_query($connection, $query);
    
            // mail sending code
            $to	 		  = $email; // receiver
            $sender		  = 'lakshithaudayanga19@gmai.com'; // email address of the sender
            $mail_subject = 'Verify Email Address';
            $email_body   = '<p>Dear ' . $username . '</p>';
            $email_body  .= '<p>Thank you for signing up. There is one more step.
    Click below link to verify your email address in order to activate your account.</p>';
            $email_body  .= '<p>' . $verfication_URL . '</p>';
            $email_body  .= '<p>Thank You, <br>E-solution</p>';
    
            $header       = "From: {$sender}\r\nContent-Type: text/html;";
    
            $send_mail_result = mail($to, $mail_subject, $email_body, $header);
    
            if ( $send_mail_result ) {
                // mail sent successfully
                echo 'Please check your email.';
            } else {
                // mail could not be sent 
                echo 'Error.';
            }
    

            // set flash message
            $_SESSION['message'] = "You are now logged in!";
            $_SESSION['alert-class'] = "alert-success";
            header('location:Dashboad/index.php');
            exit();

        } else {
            $errors['db_error'] = "Database error: failed to register";
        }

        
    }
}


// if user clicks on the login button
if (isset($_POST['login-btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // validation
    if (empty($username)){
        $errors['username'] = "Username required";
    }

    if (empty($password)){
        $errors['password'] = "Password required";
    }

    if ($email == "lakshithaudayanga19@gmai.com"){
        header('location: ../Profile/index.php');
    }



    if (count($errors) === 0) {
        $sql = "SELECT * FROM admi WHERE email=? OR username=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    
        if (password_verify($password, $user['password'])){
            // loging success
    
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['verified'] = $user['verified'];



            // set flash message
            $_SESSION['message'] = "You are now logged in!";
            $_SESSION['alert-class'] = "alert-success";
            header('location: Dashboad/index.php');
            exit();
    
        } else {
            $errors['login_fail'] = "Wrong credentials";
        }
    }
}
// logout user
 if (isset($_GET['logout'])){
     session_destroy();
     unset($_SESSION['id']);
     unset($_SESSION['username']);
     unset($_SESSION['email']);
     unset($_SESSION['verified']);
     header('location: login.php');
     exit();
 }


// if user clicks on the forgot password button
if (isset($_POST['forgot-password'])) {
    $email = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email address is invalid";
    }


    if (empty($email)){
        $errors['email'] = "Email required";
    }

    if (count($errors) == 0){
        $sql = "SELECT * FROM admi WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);
        $token = $user['token'];
        
            $verification_code = sha1($email . time());
            $verfication_URL  = 'http://localhost/e-solution/singin-signup/admin/index.php?password-token=' . $token;
    
            //$query = "INSERT INTO user (username, email, verified, token, password) VALUES ('{$username}', '{$email}', false, '{$verification_code}', '{$password}' )";
    
            //$result = mysqli_query($connection, $query);
    
            // mail sending code
            $to	 		  = $email; // receiver
            $sender		  = 'lakshithaudayanga19@gmai.com'; // email address of the sender
            $mail_subject = 'Reset your password';
            $email_body   = '<p>Dear ' . $username . '</p>';
            $email_body  .= '<p>Forgot your password?.
    Click below link to reset your password and add new password</p>';
            $email_body  .= '<p>' . $verfication_URL . '</p>';
            $email_body  .= '<p>Thank You, <br>E-solution</p>';
    
            $header       = "From: {$sender}\r\nContent-Type: text/html;";
    
            $send_mail_result = mail($to, $mail_subject, $email_body, $header);
    
            if ( $send_mail_result ) {
                // mail sent successfully
                echo 'Please check your email.';
            } else {
                // mail could not be sent 
                echo 'Error.';
            }

        
        exit(0);
    }

}

//if user clicked on reset password button
if (isset($_POST['reset-password-btn'])) {
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];

    if (empty($password) || empty($passwordConf)){
        $errors['password'] = "Password required";
    }

    if ($password !== $passwordConf) {
        $errors['password'] = "The two password do not match";
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $email = $_SESSION['email'];

    if (count($errors) == 0) {
        $sql = "UPDATE admi SET password='$password' WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('location: login.php');
            exit(0);
        }
    }

}

function resetPassword($token)
{
    global $conn;
    $sql = "SELECT * FROM admi WHERE token='$token' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    $_SESSION['email'] = $user['email'];
    header('location: reset_password.php');
    exit(0);
}
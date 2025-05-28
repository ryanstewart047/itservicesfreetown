<?php
$reCAPTCHA_secret_key = '6LdFeb0nAAAAADeGINNb9g_c7kkF-Nqu2NUXFSBM';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $service = $_POST['service'];
    $brand = $_POST['brand'];
    $DeviceType = $_POST['DeviceType'];
    $message = $_POST['message'];

    // Basic format validation for phone number
    $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
    if (!preg_match('/^[0-9]{10,15}$/', $phone)) {
        $errorMessage = 'Please make sure you provide valid information.';
    }

    // Standard email validation
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Please enter a valid email address.';
    }

    // Validate the character limit for the message field (200 characters)
    if (mb_strlen($message, 'UTF-8') > 200) {
        $errorMessage = 'Message exceeds the character limit of 200 characters.';
    }

    if (!isset($errorMessage)) {
        // ... Continue with email sending and other processing ...
    }

    $to = 'support@itservicesfreetown.com';
    $subject = 'Repair Form Submission';
    $headers = "From: $email\r\n";

    $messageBody = "Name: $name\r\nPhone: $phone\r\nEmail: $email\r\nAddress: $address\r\nService: $service\r\nBrand: $brand\r\nDeviceType: $DeviceType\r\nMessage: $message";

    $sent = mail($to, $subject, $messageBody, $headers);

    if ($sent) {
        $successMessage = 'Thank you for your request! One of our technicians will contact you as soon as possible.';
    } else {
        $errorMessage = 'Oops! Something went wrong. Please try again.';
    }
}
?>








<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="description" content="IT Services Freetown Computer Repair Service"/>
<meta name="keywords" content="computer repair service, mobile repair, Camera repair, glass repair, laptop repair, electronic repair,"/>
<meta name="author" content="Ryan Josiah Stewart"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>IT Services</title>
    <style>
  .background-image {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('images/gallery05.jpg');
  background-size: cover;
  opacity: 0.5; /* Change the value to adjust the opacity (0.0 - 1.0) */
  z-index: -1;
}


        .container {
            max-width: 500px;
            padding: 20px;
            background-color: hsl(240, 0%, 90%);
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
        }

        h3 {
            text-align: center;
            margin-top: 0;
        }

        .logo {
            display: block;
            margin: 0 auto;
            text-align: center;
            margin-bottom: 20px;
        }

        .social-icons {
            text-align: center;
            margin-top: 20px;
        }

        .social-icons a {
            display: inline-block;
            margin: 5px;
            color: #000;
            text-decoration: none;
            font-size: 25px;
        }

        .success-message {
            background-color: #e5f9e9;
            color: #006600;
            padding: 10px;
            font-size: 20px;
            border-radius: 5px;
            text-align: center;
            animation: fadeOut 3s ease-in;
        }

        .error-message {
            background-color: #ffe6e6;
            color: #cc0000;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            animation: fadeOut 3s ease-in;
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

        .homepage-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #040e40;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        
        .follow-us-button {
            display: inline-block;
            padding: 8px 20px;
            background-color: #040e40;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            margin-bottom: 40px;
        }

        .follow-us-button:hover {
            background-color: #ff0000;
        }
      
    </style>
</head>
<body>
    <div class="background-image"></div>
    <div class="container">
        <img class="logo" src="images/logo.png" alt="Logo">

        <h3><a class="follow-us-button" href="https://facebook.com/itservicefreetown">Follow us</a></h3>
        <div class="social-icons">
        <a href="https://facebook.com/itservicefreetown"><i class="fab fa-facebook"></i></a>
		<a href="https://tiktok.com/@itservicesfreetown"><i class="fab fa-tiktok"></i></a>
		<a href="https://instagram.com/itservicesfreetown"><i class="fab fa-instagram"></i></a>
		<a href="https://www.youtube.com/channel/UCWyQ6_Pu056pKgDp-8YUS2g"><i class="fab fa-youtube"></i></a>
        </div>

        <?php if (isset($successMessage)) : ?>
            <div class="success-message">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($errorMessage)) : ?>
            <div class="error-message">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <a class="homepage-button" href="index.html">Go to Homepage</a>
    </div>

    <!-- Include Font Awesome library -->
    <script src="https://kit.fontawesome.com/your-kit-code.js" crossorigin="anonymous"></script>
</body>
</html>

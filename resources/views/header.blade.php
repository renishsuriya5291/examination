<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examination</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        .navbar-custom {
            background-color: #2c5a72;
        }

        .admin-button {
            background-color: #fc937b;
            color: white;
            border-radius: 20px;
        }

        .glass-effect {
            background-image: url('Images/bg1.jpg');
            background-position: center;
            background-size: cover;
            height: 80vh;
            position: relative;
        }

        .wrapper{
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .glass-effect-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .glass-effect-buttons button {
            margin: 5px;
            border-radius: 20px;
            font-weight: bold;
        }

        .button1 {
            color: #2c5a72;
            background-color: white;
            font-size: 20px;
            width: 100%;
            border-radius: 40px;
        }

        .btn2_bg {
            background-color: #ffffff;
            border-radius: 20px;
            padding-top: 10px;
            padding-bottom: 10px;   
        }

        .button2 {
            color: white;
            background-color: #fc937b;
            margin-top: 13px;
            margin-bottom: 13px;
            width: 35%;
            border-radius: 50px;
        }

        /* Default styles for larger screens */
        .navbar-band {
            font-size: 29px;
            font-weight: bold;
            margin-left: 4px;
        }

        /* Media query for smaller screens */
        @media screen and (max-width: 600px) {
            .navbar-band {
                font-size: 18px;
            }

            .logo_img {
                width: 10%;
            }
        }

        /* Default styles for larger screens */
        .logo_img {
            height: 20%;
            width: 15%;
        }

        .glass-effect-content {
            /* background: rgba(255, 255, 255, 0.3); */
            /* Transparent white background */
            height: 35%;
            width: 36%;
            border-radius: 12px;
            margin-top: 8%;
            /* backdrop-filter: blur(10px); */
            /* padding-top: 3%; */
            /* Adjust the blur value as needed */
        }

        /* Media query for smaller screens */
        @media screen and (max-width: 600px) {
            .logo_img {
                width: 10%;
            }
        }

        .nav-div {
            align-items: center;
            width: 50%;
        }

        button {
            background-color: #fff6e7;
        }

        .row {
            padding-top: 5%;
            padding-bottom: 5%;
        }

        .container-fluid {
            background-color: #2c5a72;
            /* color: white; */
        }

        .button2:hover {
            background-color: #f6d4c4;
            color: black;
        }

        .card-body {
            background-color: #fff6e7;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Adjust the shadow values as needed */
        }

        .img-fluid {
            max-width: 100%;
            height: 17%;
            width: auto;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .fixed-height-col {
            height: 75%;
            /* Set your desired fixed height */
            overflow: hidden;
        }

        .img-parent {
            max-height: 100%;
            overflow: hidden;
        }

        .navbar-nav-divider {
            position: relative;
            height: 1px;
            /* Set the height of the hr */
            margin: 15px 0;
            /* Adjust the margin as needed */
            background-color: rgba(0, 0, 0, 0.1);
            /* Adjust the color and opacity as needed */
        }

        .navbar-nav-divider::before {
            content: '';
            position: absolute;
            top: -5px;
            /* Adjust the top position to create a shadow effect */
            left: 0;
            width: 100%;
            height: 10px;
            /* Adjust the height of the shadow effect */
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
            pointer-events: none;
            /* Ensure the shadow effect is not clickable */
        }

        .nav-link {
            color: white !important;
        }

        .card-body{
            height: 12rem;
            overflow: hidden;
        }

        #name_container{
            background: #fc937b9e;
            border-radius: 12px;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <!-- Include the navigation -->

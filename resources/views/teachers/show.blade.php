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

        .card-body {
            height: 12rem;
            overflow: hidden;
        }

        #name_container {
            background: #fc937b9e;
            border-radius: 12px;
            font-size: 20px;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <!-- Include the navigation -->
    <script>
        var userEmail = localStorage.getItem('userEmail');
        var userRole = localStorage.getItem('userRole');
    </script>

    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
            <div class="d-flex nav-div">
                <a href="/">
                    <img src="../Images/main.png" alt="" class="logo_img">
                    <span class="navbar-band text-white">Scumeme</span>
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="container"
                    style="font-size: 25px;
            font-weight: bold;
            color: white;">
                    <ul class="navbar-nav ml-auto mb-3" style="align-items: center;">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <script>
                                if (userRole == null) {
                                    document.write(`<a class="nav-link" href="#"> Course </a>`)
                                } else if (userRole == "student") {
                                    document.write(`<a class="nav-link" href="/teacher"> Teachers </a>`)
                                }
                            </script>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Manit</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Resgaale</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Social BULS</a>
                        </li>
                        <li class="nav-item">

                            <script>
                                if (userEmail == null) {
                                    document.write('<a href="/register" style="font-size: 24px;" class="btn btn-sm admin-button">Registration</a>');
                                } else {
                                    if (userRole == "superadmin") {
                                        document.write(
                                            '<a href="/users" style="font-size: 24px;" class="btn btn-sm admin-button">Users</a>');
                                    } else if (userRole == "admin") {
                                        document.write(
                                            '<a href="/users" style="font-size: 24px;" class="btn btn-sm admin-button">Users</a>');
                                    } else {
                                        document.write(
                                            '<a href="/results" style="font-size: 24px;" class="btn btn-sm admin-button">Show Results</a>');
                                    }
                                }
                            </script>
                        </li>
                    </ul>

                    <div class="navbar-nav-divider"></div> <!-- Add the divider here -->


                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item ">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Manit</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Resgaale</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Social BULS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="name_container" href="#">
                                <script>
                                    if (localStorage.getItem("userRole") == null) {
                                        document.write("Examination")
                                    } else {
                                        var userEmail = localStorage.getItem("userEmail")
                                        var userRole = localStorage.getItem("userRole")
                                        var username = userEmail.split('@')[0];
                                        document.write(username)
                                        document.write(" as ")
                                        document.write(userRole)
                                    }
                                </script>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <script>
            var userEmail = localStorage.getItem('userEmail');
            if (userEmail == null) {
                window.location.href = '/login';
            }
        </script>

        <div class="container mt-5 mb-5">
            <div class="container mt-5 mb-5">
                <div class="card">
                    <h5 class="card-header" id="name">Loading...</h5>
                    <div class="card-body">
                        <h5 class="card-title" id="email"></h5>
                        <p class="card-text" id="phone"></p>
                    </div>
                </div>
            </div>
        </div>

    </div>

        <script>
            var idFromLaravel = {{ $id }};

            fetch(`http://localhost:8000/stu/fetchTeachers/${idFromLaravel}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'token': localStorage.getItem('userToken')
                        // Include any other headers that your API requires
                    },
                    // Include any request body if required by your API
                    // body: JSON.stringify({ key: 'value' }),
                })
                .then(response => response.json())
                .then(data => {
                    // Get the tbody element where the data will be inserted
                    const name = document.getElementById('name');
                    const phone = document.getElementById('phone');
                    const email = document.getElementById('email');
                    name.textContent = data.data.fullname;
                    phone.textContent = data.data.phone;
                    email.textContent = data.data.email;
                    // Iterate through the data and create table rows
                    console.log(data);


                })
                .catch(error => console.error('Error fetching data:', error));
        </script>

        @include('footer')

<div class="wrapper">
<script>
    var userEmail = localStorage.getItem('userEmail');
    var userRole = localStorage.getItem('userRole');
</script>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="d-flex nav-div">
        <a href="/" id="homeLink">
            <img src="Images/main.png" alt="" class="logo_img">
            <span class="navbar-band text-white">Scumeme</span>
        </a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <div class="container" style="font-size: 25px;
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
    document.addEventListener("DOMContentLoaded", function() {
        // Get user role from localStorage
        const userRole = localStorage.getItem('userRole');

        // Get the anchor element
        const homeLink = document.getElementById('homeLink');

        // Update href based on user role
        switch (userRole) {
            case 'admin':
                homeLink.href = '/admin';
                break;
            case 'superadmin':
                homeLink.href = '/superadmin';
                break;
            case 'student':
                homeLink.href = '/';
                break;
            default:
                // Handle other roles or unexpected values
                console.error('Invalid user role:', userRole);
                break;
        }
    });
</script>

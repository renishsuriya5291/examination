<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="d-flex nav-div">
        <a href="/">
            <img src="Images/main.png" alt="" class="logo_img">
            <span class="navbar-band text-white">Scumeme</span>
        </a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
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

                    <script>
                        var userEmail = localStorage.getItem('userEmail');
                        if (userEmail == null) {
                            document.write('<a href="/register" style="font-size: 24px;" class="btn btn-sm admin-button">Registration</a>');
                        } else {
                            document.write('<a href="/results" style="font-size: 24px;" class="btn btn-sm admin-button">Show Results</a>');
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
                    <a class="nav-link" href="#">Examination</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

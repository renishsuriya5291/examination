@include('header')
@include('nav')

<div class="container mt-5 mb-4" style="height: 70vh;">
    <div class="container text-center mx-auto">
        <h2>Login</h2>
    </div>
    <form id="loginForm">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="userRole" class="form-label">Select Role</label>
            <select class="form-select" id="userRole" name="userRole" style="width: 100%;">
                <option value="Student">Student</option>
                <option value="SuperAdmin">SuperAdmin</option>
                <option value="Admin">Admin</option>
            </select>
        </div>
        <a href="/login"
            style="text-decoration: none; color: #007bff; display: block; text-align: center; margin-top: 10px;">
            Not Have An Account?
        </a>
        <button type="button" class="button1 btn btn-light d-block mx-auto" onclick="submitForm()"
            style="font-weight: bold;
            font-size: 20px;
            margin-top: 20px;
            color: white;
            background-color: #fc937b;
            width: 22%;
            border-radius: 50px;">
            Submit
        </button>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function submitForm() {
            var selectedRole = document.getElementById('userRole').value;
            var apiUrl;

            switch (selectedRole) {
                case 'Student':
                    apiUrl = 'http://localhost:8000/stu/login';
                    break;
                case 'SuperAdmin':
                case 'Admin':
                    apiUrl = 'http://localhost:8000/superadmin/login';
                    break;
                default:
                    // Handle default case if needed
                    break;
            }

            var formData = {
                email: document.getElementById('exampleInputEmail1').value,
                password: document.getElementById('exampleInputPassword1').value
            };

            // Make fetch request to the selected API endpoint
            fetch(apiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formData),
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the API response here, you can redirect or show a success message
                    if (data.success) {
                        // Store the email in localStorage
                        localStorage.setItem('userEmail', formData.email);
                        localStorage.setItem('userToken', data.User.token);
                        localStorage.setItem('userId', data.User.userId);
                        
                        // Redirect to another page
                        window.location.href =
                            '/'; // Change the URL to the desired page
                    } else {
                        // Display an error message
                        alert('Login failed. ' + data.message);
                    }

                    console.log('API Response:', data);
                })
                .catch(error => {
                    // Handle errors, show an error message or log the error
                    console.error('Error:', error);
                });

        }
        document.querySelector('.button1').addEventListener('click', submitForm);
    });
</script>


@include('footer')
